#import torch
import pandas as pd
#import random
import json
#import transformers
from huggingface_hub import login
#from transformers import AutoTokenizer, AutoModelForCausalLM, pipeline
import pandas as pd
import sys
import csv
#from pyrml import RMLConverter  # Ensure this import is at the top if possible
from openai import OpenAI
import logging
from datetime import datetime
import re

def functionlama():
    df_orig = pd.read_csv("esempio/dataset_sample_originale.csv")
# Pulizia dei DataFrame
    df_orig.drop(df_orig[df_orig['id'] == 25530].index, inplace=True)
    df_orig.drop(df_orig[df_orig['id'] == 25426].index, inplace=True)
    df_orig.drop(df_orig[df_orig['id'] == 173344].index, inplace=True)
    df_orig.drop(df_orig[df_orig['id'] == 173449].index, inplace=True)
    print(len(df_orig))
# Autenticazione Hugging Face
   # login(token='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')  # Sostituisci con il tuo token

# Converti il DataFrame in JSON usando 'index' come orientamento
    json_data = df_orig.to_json(orient='index', force_ascii=False)
    data_dict = json.loads(json_data)


# Caricamento del modello
    model_id = "meta-llama/Meta-Llama-3-8B-Instruct"
    tokenizer = transformers.AutoTokenizer.from_pretrained(model_id)
    model = transformers.AutoModelForCausalLM.from_pretrained(
        model_id,
        torch_dtype=torch.bfloat16,
        device_map = "auto",
    )

    # Creazione della pipeline
    pipeline = transformers.pipeline(
        "text-generation",
        model=model,
        tokenizer=tokenizer,
        model_kwargs={"torch_dtype": torch.bfloat16}
    )

    # Lista per memorizzare i risultati
    results = []

    # Itera su ciascun ID per generare e valutare il prompt
    for id_key, details in data_dict.items():

        formatted_details = json.dumps(details, ensure_ascii=False)

        # Prepara il prompt usando il tuo prompt esistente
        messages = [
            {
                "role": "system",
                "content": (
                    "You are tasked with cleaning and structuring data from UNIMARC datasets into a standardized format. Each field has specific requirements. "
                    "Ensure that all extracted information is strictly derived from the provided data without alterations or additions. Fields should be represented accurately, and any missing or ambiguous information should be clearly marked as 'Nan'. "
                    "Your goal is to ensure data integrity and accuracy. Please follow these guidelines carefully."
                )
            },
            {
                "role": "user",
                "content": (
                    "You are tasked with cleaning and structuring data from UNIMARC datasets into a standardized format. Follow the specific requirements for each field listed below:"
                    "1) 'id' should be the identifier of the row."
                    "2) 'year' must be in YYYY format and standardized across the dataset."
                    "3) 'language' must use the ISO code (e.g., 'EN' for English)."
                    "4) 'title' must not include any UNIMARC subfields (e.g., '|e' or '2|') and special characters must be removed, presenting only the clean textual content of the title. Do not translate the original title. "
                    "5) 'author' must include the author's name in the format 'surname, name'"
                    "6) 'contributors' must include the names of the contributors in the format 'surname, name', excluding the author's name. Each name should be separated by the ';' character."
                    "7) 'phd_cycle' must include an Arabic number or Roman numeral followed by the string 'ciclo' if in italian or 'cycle' if in english (e.g., 'XXII ciclo', '12 ciclo'). If not available, mark as 'Nan'."
                    "8) 'ssd' should only include the academic discipline code, adhering to the format defined by the Italian MIUR. This code is composed by five characters, and it consists of a three-letter abbreviation (not numbers) of the scientific discipline followed by a slash, i.e. '/', and two numbers, representing the specific subject area. It is crucial that this field is filled only with explicit information found in the dataset and has the previous defined format. If the ssd code is not clearly present in the data, the field should be marked as 'Nan'. Do not assume or generate an ssd code based on related text or descriptions."
                    "9) 'ssd_complete' must only include the full descriptive name of the academic discipline. If the description is not available, it should also be marked as 'Nan'."
                    "10) 'univ1' must include only the primary unique university name you can extract from the dataset. If the items is incomplete, e.g. the extracted information is 'Università degli studi', mark the field as Nan. If there are multiple names, separated by the hyphen character, i.e. '-', split them in the univ2 field and keep in univ1 field only the first extracted item."
                    "11) 'univ2' must include only the second unique university name if more than one affiliation is available. If only one is present, this field should be 'Nan'."
                    "12) 'univ3' should include only the third unique university affiliation if available. If not, this field should be set to 'Nan'."
                    "13) 'univ4' should include only the fourth unique university affiliation if applicable. If fewer than four affiliations are noted, this field should be 'Nan'."
                    "14) 'abstract' should contain the thesis abstract in its original language from the dataset, cleaned of any formatting errors. Do not translate the field. It should not replicate the title or any other field. Note that the abstract must not be extracted from the same source of the title. If the abstract is missing or duplicates the title, use 'Nan'."
                    "If the field contains the abstract in multiple languages, keep only the italian abstract"
                    "15) 'department' should include the full name of the department associated with the work if available.  It should be fully spelled out and standardized across the dataset."
                    f"Please process this entry according to the guidelines specified above, extract only the 15 fields requested and return the output as a structured JSON object: {formatted_details}"
                        )
        }

        ]

        # Crea il prompt per il modello
        prompt = pipeline.tokenizer.apply_chat_template(
            messages,
            tokenize=False,
            add_generation_prompt=True
        )

        input_ids = tokenizer.apply_chat_template(
            messages,
            add_generation_prompt=True,
            return_tensors="pt"
        ).to(model.device)

        terminators = [
            tokenizer.eos_token_id,
            tokenizer.convert_tokens_to_ids("<|eot_id|>")
        ]

        # Genera l'output con il modello
        outputs = pipeline(
            prompt,
            max_new_tokens=700, #512, 1024, 800
            eos_token_id=terminators,
            do_sample=True,
            temperature=0.1, #0.1 funziona
            top_p=0.9,
        )

        # Estrai e stampa l'output generato
        response = outputs[0]["generated_text"][len(prompt):]
        print(f"Output modello per l'ID {id_key}: {response}")
        #print(f"{response}")

        # Salva i risultati per ulteriore analisi
        results.append({id_key: response})

# Visualizza tutti i risultati
    print(results)

    final_results = []

    # Itera sui risultati per estrarre e processare i dati JSON
    for el in results:
        # Assumiamo che `el` sia un dizionario con un solo elemento
        for id_key, output in el.items():
            # Stampa ID e output per debug
            print(f"ID: {id_key}, Output: {output}")

            # Trova l'inizio e la fine del JSON
            json_start = output.find('{')
            json_end = output.rfind('}')

            if json_start != -1 and json_end != -1:
                json_str = output[json_start:json_end + 1]
            else:
                json_str = "{}"  # Oggetto vuoto

            # Rimuovi i delimitatori di codice (```), sostituisci 'Nan' e 'nan' con 'null'
            json_str = json_str.replace("```", "").strip().replace('Nan', 'null').replace('nan', 'null')
            # Scappa gli apostrofi interni nelle stringhe
            json_str = json_str.replace("'", "\\'")
            # Sostituisci le virgolette singole con doppie
            json_str = json_str.replace("'", '"')

            # Stampa il JSON per il debug (opzionale)
            print(f"JSON per l'id {id_key} generato dal modello dopo la pulizia:")
            print(json_str)  # Stampa l'intero testo generato per verificare la pulizia

            # Prova a caricare il JSON
            try:
                # Prova a fare il parsing del JSON
                result = json.loads(json_str)
                # Aggiungi l'ID come parte del risultato
                result['id'] = id_key
                final_results.append(result)

            except json.JSONDecodeError as e:
                print(f"Errore nel parsing del JSON per l'id {id_key}: {e}")
                print("Testo generato che causa l'errore:")
                print(output)  # Mostra l'intero output che causa l'errore
    results_df = pd.DataFrame(final_results)

    # Stampa il DataFrame finale per verifica
    print(results_df)
    results_df.to_csv("./esempio/results_prova.csv")

def read_procedure(file_path):
    with open(file_path, 'r') as file:
        return file.read()
        
def read_and_split_dataSets(file_path):
    df_orig = pd.read_csv(file_path)
# Pulizia dei DataFrame
    df_orig.drop(df_orig[df_orig['id'] == 25530].index, inplace=True)
    df_orig.drop(df_orig[df_orig['id'] == 25426].index, inplace=True)
    df_orig.drop(df_orig[df_orig['id'] == 173344].index, inplace=True)
    df_orig.drop(df_orig[df_orig['id'] == 173449].index, inplace=True)
    print(len(df_orig))

# Converti il DataFrame in JSON usando 'index' come orientamento
    json_data = df_orig.to_json(orient='index', force_ascii=False)
    data_dict = json.loads(json_data)
    print(data_dict)
    return data_dict



def generate_prompt(CQs, procedure="", previous_output=""):
    return (
        f"Read the following instructions: '{procedure}'. Basing on the procedure, and following the previous output: '{previous_output}', clean the following details : '{CQs}'.  When you're done send me only the whole dataset you've made in json format, without any comment outside the json."
    )

def pulDataset(prompt):
    try:
        # Print dataset_info_new for debugging
        messages = [
            {"role": "system", "content": "You are an expert dataset analyst. Follow the instructions clean the dataset."},
            {"role": "user", "content": prompt}
        ]

        # Call the OpenAI API
        response = client.chat.completions.create(
            model="gpt-4-1106-preview",
            messages=messages,
            temperature=0,
            max_tokens=4096,
            #response_format = {"type": "json_object"} #only output json
        )

        logging.info(f"Response at {datetime.now()}: {response.choices[0].message.content.strip()}")
        cqs_list = response.choices[0].message.content.strip()


        # Print the list for debugging
        #print("Generated CQs:", cqs_list)

        # Return the original list of CQs (not as a DataFrame)
        return response.choices[0].message.content.strip(), response.usage.total_tokens
    except Exception as e:
        print(f"Error generating : {str(e)}")




def inizio(data_dict, procedure=None, output_file_name=None):
    total_tokens_used = 0
    previous_output = ""  # Reset previous output for each trial

    for id_key, details in data_dict.items():
    
        formatted_details = json.dumps(details, ensure_ascii=False) #trasfomra in json
        print(formatted_details)
        prompt = generate_prompt(details, procedure if procedure else "", previous_output)
        dataset_output, tokens_used = pulDataset(prompt)
        total_tokens_used += tokens_used
        previous_output += f"\n\n{dataset_output}"





    output_path = f'{output_file_name}'
    with open(output_path, 'w') as file:
        file.write(previous_output)
    print(f"Ontology written to {output_path}. Total tokens used: {total_tokens_used}")

    return previous_output

#input from Html
var=[]
if len(sys.argv)>0:
    for i in range(1,len(sys.argv)):
        var.append(sys.argv[i])



field=var[0]
nomeFileIn =var[1]
nomeFileOut=var[2]
path=var[3]
llms=var[4]
#risultato="hello word 2 " + field +" "+nomeFileIn +" "+nomeFileOut+" "+path #var[0]  field    var[1]  nomefileInput var[2] nomeFileOutput var[3] path
#risultato="hello word 3 "
#print(risultato)
#procedure_content = read_procedure('data/procedure.txt')

# Reading and splitting the CQs
#pathData=path+"/"+sys.argv[1]
#CQs=read_and_split_CQs(nomeFileIn,split_into_groups=True)


iteration = 1 #ricorda di cambiare
if llms=="1":
    print(llms," chatGPT")
    procedure_content = read_procedure('data/procedure.txt')
    dataset=read_and_split_dataSets(nomeFileIn)
    inizio(dataset,procedure_content, nomeFileOut)
    #chatGPT(CQs,procedure_content,combined_pattern_str,iteration, nomeFileOut, path)
else:
    print(llms, " llama3")
    functionlama()

