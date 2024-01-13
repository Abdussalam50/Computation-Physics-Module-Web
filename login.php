<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login_style.css">
</head>
<body>
    <?php
    
        if(isset($_POST["Login"])){
            require "Db_Require.php";
            $username=strtolower($_POST["username"]);
            $password=mysqli_real_escape_string($conn,$_POST["password"]);
                    
            $sql="SELECT * FROM user WHERE Username='$username'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $usernameDb=$row["Username"];
                $Identity=$row["Identity"];
                $passwordDb=$row["Password"];
                $roleDb=$row["Role"];
                if(password_verify($password,$passwordDb)){
                    if($roleDb=="Mahasiswa"){
                        echo "<script>alert('Anda Mahasiswa')</script>";
                        session_start();
                        $_SESSION["Username"] = $usernameDb;
                        $_SESSION["Role"] =$roleDb;
                        $_SESSION["Identity"] = $Identity;

                        header("Location:Dasbord.php");
                        }else{
                            
                            session_start();
                            $_SESSION["Username"] = $usernameDb;
                            $_SESSION["Role"] =$roleDb;
                            $_SESSION["Identity"] = $Identity;
                            header("Location:Dashboard_dosen.php");
                            }
                        }else{
                            echo "<script>alert('Password Salah!')</script>";
                        }
                    }else{
                        echo "<script>alert('User Tidak Ditemukan!')</script>";
                    }
            }
        
    ?>
<form action=""method="post">
    <div class="login">
        <h1></h1>
            <p>Username</p>
            <input class="username" type="text" name="username">
            <p>password</p>
            <input class="password" type="password"  name="password">
            <button class="submit" type="submit" name="Login">Login</button>
    </div>
</form>
   
</body>
</html>