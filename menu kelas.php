<?php 
    session_start();
    if($_SESSION["Role"]!=="Dosen"){
        session_unset();
        session_destroy();
        header("Location:login.php?= Silahkan login sebagai dosen!");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Merriweathr+sans:wght@600&display=swap" rel="stylesheet">    
    <title>Document</title>
    <link rel="stylesheet" href="css/menu kelas dosen.css">
</head>
<body>
<nav>
    <div class="nav">
        <div class="judul">
            <h1>Fisika Komputasi</h1>
            <h2>Kelas Dosen</h2>
        </div>
        <div class="profil">
            <div class="txt">
            <p><?php print_r($_SESSION["Username"])?></p>
            <p><?php print_r($_SESSION["Identity"])?></p>
        </div>
        <div class="f-profil">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_euB_FyLkQcjDkkx1GlunaeSEQMIyQ9Evdw&usqp=CAU">
            </div>
        </div>
        <button type="submit" nama="logout"> Logout</button>
     </div>
</nav>
<div class="container">
    <div class="List">
        <ul>
            <li><a href="">Add materi pembelajaran</a></li>
            <li><a href="">penilaian tugas</a></li>
            <li><a href="list_tugas(Dosen).php">Tugas</a></li>
        </ul>
    </div>
    <div class="materi">
        <embed src="modul/BAB 1 MODUL SEMENTARA.pdf" type="" height="100%" width="100%">
    </div>
    <div class="contoh">
    <iframe src="https://trinket.io/embed/python3/f79af42840" width="100%" height="100%" frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe>
    </div>
</div>
</body>
</html>