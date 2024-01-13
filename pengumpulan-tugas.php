<?php
    session_start();
    if($_SESSION["Role"]!=="Dosen"){
        session_unset();
        session_destroy();
        header("Location:login.php?=Silahkan Login sebagai Dosen!");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Merriweathr+sans:wght@600&display=swap" rel="stylesheet">   
    <link rel="stylesheet" href="css/pengumpulan-tugas(dosen).css">
    <script src="https://kit.fontawesome.com/1bac164c78.js" crossorigin="anonymous"></script>
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
            <?php
                if(isset($_POST["logout"])){
                    session_unset();
                    session_destroy();
                    header("Location:login.php");
                }
            ?>
            <form action="" method="post"><button type="submit" name="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button></form>
         </div>
    </nav>
    <div class="container">
        <div class="List">
            <ul>
                <li></i><a href=""><i class="fa-solid fa-book"> </i> Materi Pembelajaran </a><i id="drop-content"class="fa-solid fa-caret-down "></i>
                <ul class="drop-menu">
                    <li><a href="">Bab 1 Penyelesaian Persamaan Non Linear</a></li>
                    <li><a href="">Bab 2 Penyelesaian Persamaan Non Linear</a></li>
                    <li><a href="">Bab 3 Penyelesaian Persamaan Non Linear</a></li>
                </ul></li>
            
                    <li><a href=""> <i class="fa-solid fa-note-sticky"></i> Tugas</a> <i class="fa-solid fa-caret-down"></i>
                    <ul class="drop">
                        <li><a href="">Tidak tersedia</a></li>
                    </ul>
                </li>
                <li><a href="Nilai.php?score=<?php echo $_GET["nameAssign"]?>"> <i class="fa-regular fa-star-half-stroke"></i> Nilai</a></li>
            </ul>
        </div>
        <div class="materi" > 
            <h2>Tugas Mahasiswa</h2>
            <div class="mahasiswa-list">
                <ul id="list">
                    <?php 
                    if($_GET["nameAssign"]){
                        require "Db_Require.php";
                        $sql = "SELECT * FROM tugas_".$_GET["nameAssign"];
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                        while ($row=mysqli_fetch_assoc($result)){ 
                            $MahasiswaName=$row["nama"];
                            $File_tugas=$row["File_Tugas"];
                            $dateAssignment=$row["tanggal"];
                            echo "<li>$MahasiswaName <a href='download.php?file=".urlencode($File_tugas)."'>".$File_tugas."</a>".$dateAssignment."</li>";
                        }
                    }else{
                        echo "Tugas tidak ditemukan !!";
                    }
                    }else{
                        echo "not found";
                    }
                        
                    
                    ?>
                    
                </ul>
            </div>
        </div>
        <div class="contoh" id="container">
            <iframe src="https://trinket.io/embed/python/3d8d7ce66b" width="100%" height="100%" frameborder="0" marginwidth="0" marginheight="0" allowfullscreen></iframe>
        </div>
    
    </div>
    <?php
        if(isset($_POST["valueSubmit"])){
            $studentName=strtolower($_POST["name"]);
            $score=$_POST["score"];

            if($_GET["nameAssign"]){
                $value=$_GET["nameAssign"];
                require "Db_Require.php";
                $sqlStudent="SELECT * FROM user WHERE Username='$studentName'";
                $resultStudent=mysqli_query($conn,$sqlStudent);
                if(mysqli_num_rows($resultStudent)>0){
                    $row=mysqli_fetch_assoc($resultStudent);
                   $ID= $row["Identity"];
                   $sqlScore="INSERT INTO nilai_$value VALUES ('','$studentName','$ID','$score')";
                   if(mysqli_query($conn,$sqlScore)){
                    echo"<script>alert('Nilai berhasil Diinput!')</script>";
                   }else{
                    echo "<script>alert('error!')</script>";
                   }
                }else{
                    echo "<script>alert('Data mahasiswa tidak ditemukan')</script>";
                }
               
            }else{
                echo "Not Found";
            }
        }
    ?>
    <div class="assesment">
        <h2><i class="fa-solid fa-chart-simple"></i> Nilai Tugas</h2>
        <form action="" method="post">
            <label for="">Nama Mahasiswa</label>
            <input type="text" name="name" id="">
            <label for="">Nilai</label>
            <input type="number" name="score" id="">
            <button type="submit" name="valueSubmit">Berikan Nilai</button>
        </form>
    </div>
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
    </script>
</body>
</html>