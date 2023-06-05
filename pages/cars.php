

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Rent a Car</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
    <!-- Header -->
    <header>
      <a href="/"><img src="../assets/car-header.png" alt="car-png" /></a>
      <h1>Rent a Car</h1>
      <?php
          if (isset($_SESSION['email'])) {
            echo '<a href="/pages/logout.php" class="login">Çıkış Yap</a>';
          }else{
            echo '<a href="/pages/login.php" class="login">Giriş Yap / Kayıt Ol</a>';
          }
       ?>

    </header>

    <?php
    require("../connection.php");

    $sql = "SELECT * FROM cardb WHERE id=".$_GET["carId"];
    $result = $conn->query($sql);

    if($result->num_rows > 0){
       $row = $result->fetch_assoc();
      echo '    <div class="car row px-5 py-4" >
                    <img src=' . $row["img"] . ' alt="" class="col-lg"/>
                    <div class="col-lg items-center gap-4">
                        <h2>' . $row["name"] . '</h2>
                        <h4>Year : ' . $row["year"] . '</h4>
                        <h4>Model : ' . $row["model"] . '</h4>
                        <h4>Price : ' . $row["price"] . '₺</h4>
                    </div>
                
               </div>';
       
    }else{
        echo "There is no available data";
    }
?>
  </body>
</html>
