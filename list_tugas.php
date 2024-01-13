<?php
    session_start();
    if($_SESSION["Role"]!=="Mahasiswa"){
        session_unset();
        session_destroy();
        $em="Login terlebih dahulu sebagai mahasiswa";
        header("Location: login.php?em=$em");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/list-tugas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Merriweathr+sans:wght@600&display=swap" rel="stylesheet">  
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
                    <span><?php print_r($_SESSION["Username"])?> </span>
                    <span> <?php print_r($_SESSION["Identity"])?></span>
                </div>
                <div class="foto">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_euB_FyLkQcjDkkx1GlunaeSEQMIyQ9Evdw&usqp=CAU" alt="">
                </div>
                </div>
        </div>
        
        </div>
    </nav>
    <!--------------------------Body Content------------------------>
    <div class="content">
        <div class="listChapter">
            <ul id="chapter">
                <li><a href="">Bab 1 Persamaan Non Linear</a></li>
                <li><a href="">Bab 2 Persamaan Non Linear</a></li>
                <li><a href="">Bab 3 Persamaan Non Linear</a></li>
            </ul>
        </div>
        <?php
            // require "Db_require.php";
            // $username= mysqli_real_escape_string($conn,$_SESSION["Username"]);
            // $sql="SELECT * FROM tugas_mahasiswa WHERE Nama='$username'";
            // $completedTask='';
            // if ( mysqli_query($conn, $sql)) {
            //     $completedTask='completed';
            // }
        ?>
        <div class="listContent">
            <ul id="list-content">
                <h2>List Tugas</h2>
                <li><a href="tugas_CODE.php">Tugas 1</a> 2 Jam 30 menit 10 detik <i class="fa-solid fa-circle-check <?php echo "$completedTask"?>" id="label"></i> Selesai</li>
                <li><a href="">Tugas 2</a></li>
                <li><a href="">Tugas 3</a></li>
                <li><a href="">Tugas 4</a></li>
                <?php
                //Malam rabu aku update -_-
                    require "Db_Require.php";
                    $queryDuty="SELECT * FROM deadline_tugas";
                    $resultQuery =mysqli_query($conn,$queryDuty);
                    if(mysqli_num_rows($resultQuery)>0){
                        while($row=mysqli_fetch_assoc($resultQuery)){
                            $nameTask=$row["task"];
                            $timeStr=strtotime($row["time"]);
                            $timeCurr=strtotime(date("Y-m-d H:i:s"));
                            $deadline=$timeStr-$timeCurr;
                            $days=floor($deadline/(60*60*24));
                            $hours=floor(($deadline%(60*60*24))/(60*60));
                            $minutes=floor(($deadline%(60*60)/60));
                            $seconds=$deadline%60;
                            $username= mysqli_real_escape_string($conn,$_SESSION["Username"]);
                            $sql="SELECT * FROM tugas_$nameTask WHERE Nama='$username'";
                            $completedTask='';
                            $results=mysqli_query($conn, $sql);
                            if (mysqli_num_rows($results)>0) {
                                $completedTask='completed';
                            }
                            if($deadline<=0){
                                echo "<li><a href='tugas_CODE.php?subject=".$row["task"]."'>Tugas $nameTask</a> Anda terlambat mengumpulkan tugas! <i class='fa-solid fa-circle-check' id='label'></i> Selesai</li>";
                            }else{
                                echo "<li><a href='tugas_CODE.php?subject=".$row["task"]."'>Tugas $nameTask</a> $days hari $hours Jam $minutes menit $seconds detik <i class='fa-solid fa-circle-check $completedTask id='label'></i> Selesai</li>";
                            }
                            
                        }
                        
                    }else{
                        echo "Selamat tidak ada tugas yang tersedia karena dosen sedang malas";
                    }
                ?>
            </ul>
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

</body>
</html>