


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>

<script>hljs.highlightAll();</script>
</head>
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


    // Mostra un messaggio di conferma o errore
    
    echo "<h1>Generated RDF data</h1>";
    
    $file = './data/data.ttl';
    
    
    
    if (($handle = fopen($file, 'r')) !== FALSE) {
    
        echo "<div class='table-container'>";
    	
        echo "<pre><code class='highlight highlight-source-turtle'>";
    
	    while (($line = fgets($handle)) !== FALSE){
            
            echo htmlspecialchars($line);

        }
        
        echo "</code></pre>";
        echo "</div>";
        
        fclose($handle); // Chiudi il file
    
    }
    

    

} else {
    echo 'Metodo di richiesta non supportato.';
}
?>

<br/>
<a href="#"><button type="submit">Enrich data</button></a -->


<a href="../../home.html"><button type="submit">Home</button></a>

<div class="wpb_text_column"><div class="wpb_wrapper"> </div></div><div class="w-post-elm post_content" itemprop="text">
</div></div></div></div></div></section>

</body>
</html>
