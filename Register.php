<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <?php
        
        function regist($data){
            require "Db_Require.php";
            $username=$data["Username"];
            $password=$data["Password"];
            $Identity=$data["Identity"];
            $role=$data["roles"];
            
            $hashPass=password_hash($password,PASSWORD_DEFAULT);
            $query="INSERT INTO user VALUES ('','$username','$Identity','$hashPass','$role')";
            mysqli_query($conn,$query);
            return true;
        }

        if(isset($_POST["Register"])){
            if(regist($_POST)>0){
                echo "<script>alert('Silahkan Login')</script>";
            }else{
                echo "<script>alert('Error occured')</script>";
            }
        }
    ?>



    <form action="" method="post"><!----form digunakan untuk memasukkan data kedalam website-->
    <div class="login">
        <h1>Register Form</h1>
    <form action="" method="post"><!----form digunakan untuk memasukkan data kedalam website-->
            <p>Username</p>
            <input class="Username" type="text " value="" name="Username"placeholder="Masukkan username Anda">
            <p>Password</p>
            <input class="Password" type="password" value="" name="Password" placeholder="Masukkan Password Anda">
            <p>NIM/NIP</p>
            <input class="KPassword" type="text" value="" name="Identity" placeholder="NIM/NIP">
            <p>Role</p>
            <div class="role">
                <input type="radio" name="roles" id="" value="Mahasiswa">Mahasiswa
                <input type="radio" name="roles" id="" value="Dosen">Dosen
            </div>
            <button class="submit" type="submit" name="Register" >Register</button>
    </form>
        </div>
 
</body>
</html>