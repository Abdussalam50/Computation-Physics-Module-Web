<?php 
    session_start();
    if($_SESSION["Role"]!=="Mahasiswa"){
        session_unset();
        session_destroy();
        $em="Silahkan login terlebih dahulu sebagai mahasiswa";
        header("Location:login.php?em=$em");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="navigasi">
            <div class="menu">
                <input type="checkbox" nama="" id="">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header">
                <h1>FISIKA KOMPUTASI</h1>
            </div>
            <div class="info">
                <div class="profil">
                    <span><?php print_r($_SESSION["Username"])?></span>
                    <span><?php print_r($_SESSION["Identity"])?></span>
                </div>
                <div class="foto">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_euB_FyLkQcjDkkx1GlunaeSEQMIyQ9Evdw&usqp=CAU" alt="">
                </div>
            </div>
        </div>
    </nav>
    
    <div  class="container">
        <div class="item">
            <div class="item1">
                <p>Aktivitas</p>
            </div>
            <div class="item2">
                <p>Tugas</p>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="content1">Materi</div>
        <div class="content2">Jadwal</div>
    </div>
    <!--------------Logout php------------->
    <?php
        if(isset($_POST["logout"])){
            session_unset();
            session_destroy();
            header("Location: login.php");
        }
    ?>
    <div class="nav2">
        <ul>
            <li><a href="">Profil</a></li>
            <li><a href="menu kelas_SISWA.php">Kelas</a></li>
            <li><a href="">Bantuan</a></li>
            <li><form action="" method="post"><button type="submit" name="logout">Logout</button></li></form>

        </ul>
    </div>
<script src="dashboard.js">
    
</script>
</body>
</html>