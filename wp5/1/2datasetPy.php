


<!DOCTYPE html>
<html>
<?php include '../head.html'; ?>

<body class="post-template-default single single-post postid-9577 single-format-standard l-body Impreza_8.23.2 us-core_8.23.2 headerinpos_top wpb-js-composer js-comp-ver-7.6 vc_responsive header_hor disable_effects state_tablets" itemscope="" itemtype="https://schema.org/WebPage">
     <div class="l-canvas type_wide">
         <main id="page-content" class="l-main" itemprop="mainContentOfPage">
     <section class="l-section wpb_row us_custom_abf3ca82 height_small"><div class="l-section-h i-cf"><div class="g-cols vc_row via_grid cols_1 laptops-cols_inherit tablets-cols_inherit mobiles-cols_1 valign_top type_default stacking_default"><div class="wpb_column vc_column_container"><div class="vc_column-inner"><div class="g-cols wpb_row section-with-two-column-on-mobile via_grid cols_4 laptops-cols_inherit tablets-cols_inherit mobiles-cols_1 valign_middle type_default stacking_default" style="--gap:3rem;"><div class="wpb_column vc_column_container"><div class="vc_column-inner"><div class="w-image us_custom_da4cf359 align_center"><div class="w-image-h"><img width="500" height="123" src="https://www.fossr.eu/wp-content/uploads/2023/05/EN-Funded-by-the-European-Union_WHITE-Outline_500px.webp" class="attachment-large size-large" alt="" loading="lazy" decoding="async" srcset="https://www.fossr.eu/wp-content/uploads/2023/05/EN-Funded-by-the-European-Union_WHITE-Outline_500px.webp 500w, https://www.fossr.eu/wp-content/uploads/2023/05/EN-Funded-by-the-European-Union_WHITE-Outline_500px-300x74.webp 300w" sizes="(max-width: 500px) 100vw, 500px" data-cmp-ab="2" data-cmp-info="10"></div></div></div></div><div class="wpb_column vc_column_container"><div class="vc_column-inner"><div class="w-image us_custom_da4cf359 align_center"><div class="w-image-h"><img width="500" height="150" src="https://www.fossr.eu/wp-content/uploads/2023/05/LOGOBIANCO-_UniversitaRicerca-Nolineare_-500px.webp" class="attachment-large size-large" alt="" loading="lazy" decoding="async" srcset="https://www.fossr.eu/wp-content/uploads/2023/05/LOGOBIANCO-_UniversitaRicerca-Nolineare_-500px.webp 500w, https://www.fossr.eu/wp-content/uploads/2023/05/LOGOBIANCO-_UniversitaRicerca-Nolineare_-500px-300x90.webp 300w" sizes="(max-width: 500px) 100vw, 500px" data-cmp-ab="2" data-cmp-info="10"></div></div></div></div><div class="wpb_column vc_column_container"><div class="vc_column-inner"><div class="w-image us_custom_da4cf359 align_center"><div class="w-image-h"><img width="500" height="217" src="https://www.fossr.eu/wp-content/uploads/2023/05/italia-domani-tracciato_COLOREBIANCO_500px.webp" class="attachment-large size-large" alt="" loading="lazy" decoding="async" srcset="https://www.fossr.eu/wp-content/uploads/2023/05/italia-domani-tracciato_COLOREBIANCO_500px.webp 500w, https://www.fossr.eu/wp-content/uploads/2023/05/italia-domani-tracciato_COLOREBIANCO_500px-300x130.webp 300w" sizes="(max-width: 500px) 100vw, 500px" data-cmp-ab="2" data-cmp-info="10"></div></div></div></div><div class="wpb_column vc_column_container"><div class="vc_column-inner"><div class="w-image us_custom_da4cf359 align_center"><div class="w-image-h"><img width="500" height="109" src="https://www.fossr.eu/wp-content/uploads/2023/05/Logo_CNR_affiancato_neg_500px.webp" class="attachment-large size-large" alt="" loading="lazy" decoding="async" srcset="https://www.fossr.eu/wp-content/uploads/2023/05/Logo_CNR_affiancato_neg_500px.webp 500w, https://www.fossr.eu/wp-content/uploads/2023/05/Logo_CNR_affiancato_neg_500px-300x65.webp 300w" sizes="(max-width: 500px) 100vw, 500px" data-cmp-ab="2" data-cmp-info="10"></div></div></div></div></div></div></div></div></div></section>
     <section class="l-section wpb_row height_small"><div class="l-section-h i-cf"><div class="g-cols vc_row via_grid cols_1 laptops-cols_inherit tablets-cols_inherit mobiles-cols_1 valign_top type_default stacking_default"><div class="wpb_column vc_column_container">
         <div class="vc_column-inner">
        
<?php
#putenv('PATH=' . getenv('PATH') . ':/usr/local/bin');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica e riceve il campo field
    $field = isset($_POST['field']) ? $_POST['field'] : '';
    $nameFile = isset($_POST['namefile']) ? $_POST['namefile'] : '';
    $nameFile=$nameFile.'.csv';
    $pathDown='/data/'.date('Ymd_His')."/";
    $path='./'.$pathDown;
    $llms=isset($_POST['llm']) ? $_POST['llm'] : '';
    
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    } else {
        $path='./data/';
    }
    $nameFileDown="./1".$pathDown.$nameFile;
    $nameFile=$path.$nameFile;
    
    
    
    // Verifica e riceve il file caricato
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Imposta il percorso di destinazione del file
        #$uploadFileDir = $path;
        $dest_path = $path . $fileName;

        // Creare la directory se non esiste
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // Sposta il file nella directory di destinazione
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $message = 'File is uploded.';
        } else {
            $message = 'Error during the uploded. Directory must be writeble.';
        }
    } else {
        $message = 'It is not uploaded the file. It is an error during the upload.';
    }

    // Mostra un messaggio di conferma o errore
    
    echo "<h1>Result</h1>";
 
   
if ($llms=="1")
{
    $file1 = './data/ChatGPT/dataset_sample_originale.csv';
    $file2 = './data/ChatGPT/prova32.csv';
    $separatorefile1=",";
}
    else
    {
        $file1 = './data/llama/dataset_sample_originale.csv';
        $file2 = './data/llama/dataset_dottori_sample.csv';
        $separatorefile1=";";
    }
     
    echo "<h3>Original dataset</h3>";

    if (($handle1 = fopen($file1, 'r')) !== FALSE) {
        echo "<div class='table-container'>";
        echo "<table><thead>"; // Inizia la tabella HTML
        // (Opzionale) Leggi l'intestazione se il file CSV ha un'intestazione
        //echo "sono qui=";
        
        if (($header1 = fgetcsv($handle1, 1000, $separatorefile1)) !== FALSE) {
            echo "<tr>"; // Inizia una nuova riga per l'intestazione
            foreach ($header1 as $colonna1) {
                echo "<th>" . htmlspecialchars($colonna1) . "</th>"; // Crea le celle di intestazione
            }
            echo "</tr>";
            
        }
        
        echo "<tbody>";
        // Ciclo per leggere ogni riga del CSV
        while (($data1 = fgetcsv($handle1, 5000, $separatorefile1)) !== FALSE){
            
            echo "<tr>"; // Inizia una nuova riga della tabella
            foreach ($data1 as $campo1) {
                echo "<td><div style='width:100%; max-height:100px; overflow:auto'>" . htmlspecialchars($campo1) . "</div></td>"; // Crea le celle della tabella
            }
            echo "</tr>";

        }
        echo "</tbody></table></div>";
       
        fclose($handle1); // Chiudi il file
    }
    
    echo "<h3>Cleansed dataset</h3>";
        
    if (($handle2 = fopen($file2, 'r')) !== FALSE) {
        echo "<div class='table-container'>";
        echo "<table><thead>"; // Inizia la tabella HTML
        // (Opzionale) Leggi l'intestazione se il file CSV ha un'intestazione
        //echo "sono qui=";
        
		if (($header2 = fgetcsv($handle2, 1000, ";")) !== FALSE) {
			echo "<tr>"; // Inizia una nuova riga per l'intestazione
            foreach ($header2 as $colonna2) {
            	echo "<th>" . htmlspecialchars($colonna2) . "</th>"; // Crea le celle di intestazione
            }
            echo "</tr></thead>";
        }
        
        echo "<tbody>";
        // Ciclo per leggere ogni riga del CSV
        while (($data2 = fgetcsv($handle2, 6000, ";")) !== FALSE){
            
            echo "<tr>"; // Inizia una nuova riga della tabella
            foreach ($data2 as $campo2) {
                echo "<td><div style='width:100%; max-height:100px; overflow:auto'>" . htmlspecialchars($campo2) . "</div></td>"; // Crea le celle della tabella
            }
            echo "</tr>";
        }
        echo "</tbody></table></div>";
        
        fclose($handle2);
        
        
        //      fclose($handle2); // Chiudi il file
        
    //}
    }else {
        echo "Errore nell'aprire il file CSV.";
    
    }
    
    

   # $comando="python3 ./script.py " . escapeshellarg($username) . " " . escapeshellarg($dest_path) ;
   # $command=escapeshellcmd("/usr/local/bin/python3 3import_llama.py " . escapeshellarg($field) . " " . escapeshellarg($dest_path) . " " .escapeshellarg($nameFile) . " " .escapeshellarg($path)." " .escapeshellarg($llms));
    
  # $output = [];
   #$return_var = -1;

   #exec($command, $output, $return_var);
 #   echo $llms;
  # echo implode("\n", $output);
  #if ($output == 0){
   # echo "<form action="download.php" method="get">";
    #echo "<input type="hidden" name="$nameFile" value="tuo_file.owl">";
    #echo  "<button type="submit">Scarica il file OWL</button></form>";
   
  #  }
        
   
    

}
?>
<form action="../download.php" method="get">
<input type="hidden" name="file" value="<?php echo $nameFileDown;?>">
<button type="submit">Download dataset</button></form>
<div class="w-separator size_large"></div>
             <a href="../2/1CQs.html"><button type="submit">Generate Competency Questions</button></a>
             <div class="w-separator size_large"></div>
             
<a href="../../home.html"><button type="submit">Home</button></a>
<div class="w-separator size_large"></div>
             
             </div><div class="wpb_text_column"><div class="wpb_wrapper">
</div></div><div class="w-post-elm post_content" itemprop="text">
    </div></div></div></div>
             </section>
         </main>
    </div>
</body>
</html>
