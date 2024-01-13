<!----<?php
  session_start();
  if($_SESSION["Role"]!=="Dosen"){
    session_unset();
    session_destroy();
    header("Location:login.php?em=Silahkan login sebagai dosen");
  }
?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Merriweathr+sans:wght@600&display=swap" rel="stylesheet">  
    <script src="https://kit.fontawesome.com/1bac164c78.js" crossorigin="anonymous"></script>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/evaluasi.css">
</head>
<body>
    <nav>
        <div class="nav">
            <div class="judul">
                <h1 class="fs-3 mb-1">Fisika Komputasi</h1>
                <h2 class="fs-4">Nilai Mahasiswa</h2>
            </div>
            <div class="profil">
                <div class="txt">
                <p class="mt-2 mb-1 fs-6"><?php print_r($_SESSION["Username"])?></p>
                <p class="mt-1 mb-2"><?php print_r($_SESSION["Identity"])?></p>
            </div>
            <div class="f-profil">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_euB_FyLkQcjDkkx1GlunaeSEQMIyQ9Evdw&usqp=CAU">
                </div>
            </div>
  <!---- <?php
                if(isset($_POST["logout"])){
                    session_unset();
                    session_destroy();
                    header("Location:login.php");
                }
            ?>-->
            <form action="" method="post"><button type="submit" name="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</button></form>
         </div>
    </nav>

    <div class="list-nilai">
        <div class="List">
            <ul>
                <li><a href="">Materi Pembelajaran</a> <i id="drop-content"class="fa-solid fa-caret-down "></i></li>
                <li><a href="">Penilaian Tugas</a> </li>
                <li><a href="list_tugas(Dosen).php?nameAssign=<?php $_GET["score"]?>">Tugas</a></li>
                
            </ul>
        </div>

        <div id="body" class=" container-md list-content container-secondary">
          <h2 class="fs-3 text-dark mt-2 mb-4"> <i class="fa-solid fa-user-check"></i> Nilai Mahasiswa</h2>
            <table class="table table-hover table-secondary ">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nilai</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if($_GET["score"]){
                      $nameScore=$_GET["score"];
                      require "Db_Require.php";
                    $sql = "SELECT * FROM nilai_$nameScore";
                    $result=mysqli_query($conn,$sql);
                    $int=1;
                    if(mysqli_num_rows($result)>0){
                      while ($row=mysqli_fetch_assoc($result)) {
                        $nameMhs=$row["name"];
                        $id=$row["NIM"];
                        
                        $scores=$row["score"];
                          echo "<tr>
                          <th scope='row'>".$int++."</th>
                          <td>$nameMhs</td>
                          <td>$id</td>
                          <td>$scores</td>
                        </tr>";
                    }
                  }else{
                    echo "<p class='fs-3 text-center text-secondary'>Tidak ada Nilai Mahasiswa yang tersedia untuk tugas ini!</p>";
                  }
                }  
                  ?>
           
                </tbody>
              </table>

        </div>
    </div>
    <script src="https://kit.fontawesome.com/1bac164c78.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>