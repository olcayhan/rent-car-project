<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <link href="../style.css" rel="stylesheet" />
  </head>
  <body>
  <?php include("../connection.php"); ?>

    <header>
      <a href="/"><img src="../assets/car-header.png" alt="car-png" /></a>
      <h1>Rent a Car</h1>
      <a href="/pages/login.html" class="login">Giriş Yap / Kayıt Ol</a>
    </header>

     
    <div class="login-container">
      <div class="login-main">

            <?php
          if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $id = rand(100000,999999);
            $sql = "INSERT INTO users (id, name, email, password) VALUES ('$id','$username','$email','$password')";
            $sql2 = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($sql2);
            if(empty($username) || empty($email) || empty($password)){
              echo '<p id="error" class="text-center text-white bg-danger py-2">
                      Bu kısımlar boş olamaz
                    </p>';
            } else if( $result->fetch_assoc() > 0){
              echo '<p id="error" class="text-center text-white bg-danger py-2">
                     Bu Email zaten kullanılıyor
                </p>';
            } 
            else {
              if ($conn->query($sql) === TRUE) {
                header("Location: /pages/login.php"); 
              }
            }
          }
        ?>     
        <form action="<?php
          echo $_SERVER['PHP_SELF']
        ?>" method="post">
        

        
          <div class="form-group mt-3 mx-3">
            <label for="username" class="text-light my-2">Username</label>
            <input type="text" class="form-control" id="username" name="username" />
          </div>


          <div class="form-group mx-3 mt-3">
            <label for="email" class="text-light my-2">E-mail</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
            />
          </div>

          <div class="form-group mt-3 mx-3">
            <label for="password" class="text-light my-2">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
            />
          </div>
          <div class="mt-3 mx-3">
            <input
              type="submit"
              class="btn btn-secondary w-100"
              id="search"
            />
          </div>
        </form>

        <p class="text-center py-3">
          Zaten bir hesabınız varmı ?
          <span class="ms-2"
            ><a href="./login.php">buradan giriş yapınız</a></span
          >
        </p>
      </div>
    </div>
    <script src="auth.js"></script>
  </body>
</html>


