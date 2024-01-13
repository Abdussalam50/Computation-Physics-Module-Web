<?php
    session_start();
    if($_SESSION["Role"]!=="Dosen"){
        session_unset();
        session_destroy();
        header("Location: login.php?= Silahkan login sebagai Dosen!");
    }

    if(isset($_GET["file"])){
        $nameFile = $_GET['file'];
        
        $filePath="FileTugas/".$nameFile;

        if ($boolean=is_file($filePath)) {

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "File tidak ditemukan.";
        }
    }
?>