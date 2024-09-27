<?php
// Nome del file che vuoi far scaricare
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verifica e riceve il campo field
    $file = isset($_GET['file']) ? $_GET['file'] : '';
}
echo $file;

// Verifica se il file esiste
if (file_exists($file)) {
    // Imposta l'intestazione per il download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    
    // Pulizia del buffer di output e lettura del file
    flush(); // Svuota il buffer di output del sistema
    readfile($file);
    exit;
} else {
    echo "Il file non esiste.";
}
?>
