<?php
    session_start();
    if($_SESSION["Role"]!=="Mahasiswa"){
        session_unset();
        session_destroy();
        $em="Silahkan login sebagai mahasiswa";
        header("Location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/a6f42c71af.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Merriweathr+sans:wght@600&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="css/tugas_code.css">

</head>
<body>
    <?php
        if(isset($_POST["logout"])){
            session_unset();
            session_destroy();
            header("Location:login.php");
        }
    ?>
    <nav>
        <div class="nav">
            <div class="judul">
                <h1>Fisika Komputasi</h1>
                <h2>Tugas </h2>
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
            <form action="" method="post"><button type="submit" name="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button></form>
         </div>
    </nav>
    <!----------------Body------------------------------------------>
    <h2 id="title">Tugas Fisika Komputasi</h2>
    <div class="content">
        <div class="exam">
            <div class="paper">

            </div>
        </div>
        <!------------------Php code ----------------------->
        <?php
    if(isset($_GET["subject"])){
        $nameAss=strtolower($_GET["subject"]);
        require "Db_Require.php";
           if(isset($_POST["upload"])){
            //DECLARE VARIABLE
                $userAssign=$_POST["user"];
                $IDuser=$_POST["ID"];
                $nameFiles= $_FILES["files"]["name"];
                $tempName =$_FILES["files"]["tmp_name"];
                $error=$_FILES["files"]["error"];
            //make Extention
            $extStr= explode(".",$nameFiles);
            $ext=strtolower(end($extStr));
            //checking extention
            $allowedExt= "py";
            if($ext!==$allowedExt){
                echo "<script>alert('Only python file allowed')</script>";
            }else{
                //Move to Folder
                date_default_timezone_set("Asia/Jakarta");
                $path="FileTugas/".$nameFiles;
                $date=date("Y-m-d H:i:s");
                if(file_exists($path)){
                    echo "<script>alert('File sudah ada !')</script>";
                }else{
                if(move_uploaded_file($tempName,$path)){
                    //Insert Into Story 
                    $querySql="INSERT INTO tugas_$nameAss(nama,Identity,File_Tugas,tanggal) VALUES('$userAssign','$IDuser','$nameFiles','$date')";
                    if(mysqli_query($conn,$querySql)){
                        echo "<script>alert('Tugas telah diupload')</script>";
                    }else{
                        echo "<script>alert('Failed to upload')</script>";
                    }
                    
                }else{
                    echo "<script>alert('Failed Upload')</script>";
                }
            }
        }

    }
    }
        
        ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-box">
            <label for="">Nama </label>
            <input type="text" name="user" id="user">
            <label for="">NIM</label>
            <input type="text" name="ID" id="ID">
            <label for="">File tugas</label>
            <input type="file" name="files" id="file">
            <div class="button">
                <button type="submit" name="upload">Upload Tugas</button>
            </div>
        </div>
    </form>
    </div>
    <p id="title-compiler">Untuk mengerjakan tugas gunakan Workspace dibawah!</p>
    <div class="compiler">
        <iframe src="https://trinket.io/embed/python/3d8d7ce66b" width="100%" height="500px" frameborder="0" marginwidth="0" marginheight="20" allowfullscreen></iframe>
    </div>

</body>
</html>