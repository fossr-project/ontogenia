import pandas as pd
import os
from io import StringIO
#from rdflib import Graph, Literal, RDF, Namespace
import csv
#from pyrml import RMLConverter  # Ensure this import is at the top if possible
import sys
import pandas as pd
from openai import OpenAI
import logging
from datetime import datetime
import json
import re
import ast


# Parte 1: genera cqs da un dataset

def function_parte1(dataset_info_new, topic, abstract):
    try:
        # Print dataset_info_new for debugging
        messages = [
            {"role": "system", "content": "You are an ontology engineer expert."},
            {"role": "user", "content": f'Generate four competency questions and respective IDs for the following data: {dataset_info_new}.  Remeber: it is important the first row because there are saved  names of the columns. Using your known in the context of {topic}, return only a dictionary with only keys CQID, CQ.'}
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
        return cqs_list
    except Exception as e:
        print(f"Error generating CQs: {str(e)}")
def llama3():
    #login(token='xxxx')  # Replace with your actual token

    #model_id = "meta-llama/Meta-Llama-3-8B-Instruct"

    #pipeline = transformers.pipeline(
    #"text-generation",
    #model=model_id,
    ## The quantization line
    #model_kwargs={"torch_dtype": torch.bfloat16, "load_in_4bit": True}
    #)
    output_path = f'{output_file_name}'
    with open(output_path, 'w') as file:
        file.write("prova")
    print ("hello !")
# Reading the procedure and patterns from files





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
abstract=var[5]
#risultato="hello word 2 " + field +" "+nomeFileIn +" "+nomeFileOut+" "+path #var[0]  field    var[1]  nomefileInput var[2] nomeFileOutput var[3] path
#risultato="hello word 3 "
#print(risultato)
#procedure_content = read_procedure('data/procedure.txt')

# Reading and splitting the CQs
#pathData=path+"/"+sys.argv[1]
#CQs=read_and_split_CQs(nomeFileIn,split_into_groups=True)


iteration = 1 #ricorda di cambiare
if llms=="1":
    df = pd.read_csv(nomeFileIn)
    #print(function_parte1(df)," chatGPT")
    cqs = function_parte1(df,field, abstract)
    print("Generated CQs:", cqs)
    try:
        dict_string = re.search(r'{.*}', cqs, re.DOTALL).group(0)

    # Convertire la stringa del dizionario in un vero dizionario Python
        data = ast.literal_eval(dict_string)

        # Nome del file CSV di output
        csv_file = nomeFileOut

        # Scrittura del file CSV
        with open(csv_file, mode='w', newline='', encoding='utf-8') as file:
            writer = csv.writer(file)
            # Scrittura dell'intestazione (colonne)
            writer.writerow(['CQID', 'CQ'])

            # Scrittura dei dati
            for cqid, question in data.items():
                writer.writerow([cqid.replace('"', ''), question])
    
    except json.JSONDecodeError as e:
        print(f"Failed to parse CQs JSON: {e}")
        logging.error(f"Failed to parse CQs JSON: {e}")
    
    #chatGPT(CQs,procedure_content,combined_pattern_str,iteration, nomeFileOut, path)
else:
    print(llms, " llama3")
    #llama3



