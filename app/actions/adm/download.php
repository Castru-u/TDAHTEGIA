<?php

$file = '../../../public/uploads/'.$_POST['documento'];

// Verifica se o arquivo existe
if (file_exists($file)) {
    // Define os cabeçalhos
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));

    flush();

    readfile($file);

    exit;
} else {
    echo 'Arquivo não encontrado.',$file;
}
?>