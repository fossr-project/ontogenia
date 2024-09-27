<?php include '../head.html'; ?>

<?php
#putenv('PATH=' . getenv('PATH') . ':/usr/local/bin');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica e riceve il campo field
    $field = isset($_POST['field']) ? $_POST['field'] : '';

    // Verifica e riceve il file caricato
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Imposta il percorso di destinazione del file
        $uploadFileDir = './data/';
        $dest_path = $uploadFileDir . $fileName;

        // Creare la directory se non esiste
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
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
    $command=escapeshellcmd("/usr/local/bin/python3 scriptOntoTot.py " . escapeshellarg($field) . " " . escapeshellarg($dest_path));
    
    $output = [];
    $return_var = -1;

    exec($command, $output, $return_var);

    echo "Command: $command\n";
    echo "Return Status: $return_var\n";
    echo "Output:\n";
    echo implode("\n", $output);    
    #echo 'Current PATH: ' . getenv('PATH') . "\n";
    echo "<br>";
    echo "<br>";
    
    $message=shell_exec("/usr/local/bin/python3 script.py " . escapeshellarg($field) ." " . escapeshellarg($dest_path) );
    echo "<br>success<br> Messaggio:";
    print_r($message);
    echo "<br>";
    #echo"success<br>Messaggio:";
    #print_r($out[0],$out[1]);
    #print_r($status);
  

} else {
    echo 'Metodo di richiesta non supportato.';
}
       

?>
