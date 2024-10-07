


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
    $nameFile=$nameFile.'.ttl';
    $pathDown='/data/'.date('Ymd_His')."/";
    $path='./'.$pathDown;
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    } else {
        $path='./data/';
    }
    $nameFileDown="./3".$pathDown.$nameFile;
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
            $message = 'Il file è stato caricato con successo.';
        } else {
            $message = 'C\'è stato un errore durante il caricamento del file. Assicurati che la directory di destinazione esista e sia scrivibile.';
        }
    } else {
        $message = 'Non è stato caricato nessun file o si è verificato un errore nel caricamento.';
    }

    // Mostra un messaggio di conferma o errore
    
    echo "<h1>Risultato del caricamento</h1>";
   

   # $comando="python3 ./script.py " . escapeshellarg($username) . " " . escapeshellarg($dest_path) ;
    $command=escapeshellcmd("/usr/local/bin/python3 3scriptOnto.py " . escapeshellarg($field) . " " . escapeshellarg($dest_path) . " " .escapeshellarg($nameFile) . " " .escapeshellarg($path));
    
   $output = [];
   $return_var = -1;

   exec($command, $output, $return_var);
   echo implode("\n", $output);
  #if ($output == 0){
   # echo "<form action="download.php" method="get">";
    #echo "<input type="hidden" name="$nameFile" value="tuo_file.owl">";
    #echo  "<button type="submit">Scarica il file OWL</button></form>";
   
  #  }
        
   
    

} else {
    echo 'Metodo di richiesta non supportato.';
}
?>
<form action="../download.php" method="get">
<input type="hidden" name="file" value="<?php echo $nameFileDown; ?>">
<button type="submit">Download ttl</button></form>
<div class="w-separator size_large"></div>
<a href="https://service.tib.eu/webvowl/"><button type="submit">View Graph</button></a>


<a href="../../home.html"><button type="submit">Home</button></a>

<div class="wpb_text_column"><div class="wpb_wrapper"> </div></div><div class="w-post-elm post_content" itemprop="text">
</div></div></div></div></div></section>

</body>
</html>
