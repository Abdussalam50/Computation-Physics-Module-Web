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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/list_tugas(dosen).css">
    <script src="https://kit.fontawesome.com/1bac164c78.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="navigasi"> 
            <div class="menu">
                <input type="checkbox" name="" id="">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header">
                <h1>FISIKA KOMPUTASI</h1>
            </div>
            <div class="info">
                <div class="profil">
                    <span> <?php print_r($_SESSION["Username"])?> </span>
                    <span> <?php print_r($_SESSION["Identity"])?></span>
                </div>
                <div class="foto">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_euB_FyLkQcjDkkx1GlunaeSEQMIyQ9Evdw&usqp=CAU" alt="">
                </div>
                </div>
        </div>
        
        </div>
    </nav>
    <div class="content">
        <div class="listChapter">
            <ul id="chapter">
                <li><a href="">Bab 1 Persamaan Non Linear</a></li>
                <li><a href="">Bab 2 Persamaan Non Linear</a></li>
                <li><a href="">Bab 3 Persamaan Non Linear</a></li>
            </ul>
        </div>
        <div class="listContent">
            <ul id="list-content" style="overflow-y:scroll">
                <h2>List Tugas</h2>
    <?php
        require "Db_Require.php";
        $query="SELECT* FROM deadline_tugas";
        $result=mysqli_query($conn,$query);
        while ($rows = mysqli_fetch_assoc($result)) {
            $nameTask=$rows["task"];
            $times=$rows["time"];
            $currTime= strtotime(date('Y-m-d H:i:s'));
            $convertTime=strtotime($times);
            $dline=$convertTime-$currTime;
        
            if($dline<=0){
                echo " <li><a href='pengumpulan-tugas.php?nameAssign=".urlencode($nameTask)."'>".$nameTask."</a> Deadline selesai</li>";
            }else{
                $day=floor($dline/(60*60*24));
                $hour=floor(($dline%(60*60*24))/(60*60));
                $minute=floor(($dline%(60*60)/60));
                $second=$dline%60;
                echo "<li><a href='pengumpulan-tugas.php?nameAssign=".urlencode($nameTask)."'>$nameTask</a> $day Hari $hour Jam $minute Menit $second detik</li>";
            }
        }
    
        if(isset($_POST["Submit"])){
            
            $assign=str_replace(" ","_",$_POST["assignName"]);
            $time=$_POST["times"];
            $insertQuery="INSERT INTO deadline_tugas VALUES('','$assign','$time')";
            if(mysqli_query($conn,$insertQuery)){
                $queryTime="SELECT * FROM deadline_tugas WHERE task = '$assign'";
                $result=mysqli_query($conn,$queryTime);
                if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                $strTime=$row["time"];
                $toTime=strtotime($strTime);
                $currentTime= strtotime(date('Y-m-d H:i:s'));
                $deadline= $toTime - $currentTime;
                if($deadline<=0){
                    echo " <li><a href='pengumpulan-tugas.php?nameAssign=$assign'>".$assign."</a> Deadline selesai</li>";
                }else{
                $days=floor($deadline/(60*60*24));
                $hours=floor(($deadline%(60*60*24))/(60*60));
                $minutes=floor(($deadline%(60*60)/60));
                $seconds=$deadline%60;
            echo " <li><a href='pengumpulan-tugas.php?nameAssign=$assign'>$assign</a> $days Hari $hours Jam $minutes Menit $seconds detik</li>";
                }

            }
        }else{
            echo "<script>alert('Gagal menambahkan tugas: '" . mysqli_error($conn).")"."</script>";
       }
   
    }
    $queryExist="CREATE TABLE IF NOT EXISTS tugas_$assign(
        Id int(255),
        nama VARCHAR(60),
        NIM VARCHAR(30),
        File_Tugas VARCHAR(60),
        tanggal DATETIME
    )";
if(mysqli_query($conn, $queryExist)){
    $queryValue="CREATE TABLE IF NOT EXISTS nilai_$assign(
        Id int(255),
        name VARCHAR(60),
        NIM VARCHAR(30),
        score int(2))";
    mysqli_query($conn,$queryValue);
}
}

    ?>
            </ul>
    <!----------------------------------------------------------------->

            <div class="input-exam">
                <div id="title-input"><h2>Input Tugas</h2></div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input">
                        <label for="fileUpload">Tugas</label>
                        <input type="text" name="assignName" id="">
                        <label for="">Waktu Pengumpulan</label>
                        <input type="datetime-local" name="times" id="">
                        <div class="input-button">
                            <button type="submit" name="Submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="nav2">
        <ul>
              <li><a href="">Profil</a></li>
              <li><a href="">Kelas</a></li>
              <li><a href="">Bantuan</a></li>
              <li><form action="" method="post"><button type="submit" name="logout">Logout</button></form></li>
        </ul>
    </div>

<script src="li-tugas.js"></script>
<script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
</script>
</body>
</html>