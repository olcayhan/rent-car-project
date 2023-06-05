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

    <link href="style.css" rel="stylesheet" />
  </head>

  <body>
    <?php include("./connection.php"); ?>
    <!-- Header -->
    <header>
      <a href="/"><img src="./assets/car-header.png" alt="car-png" /></a>
      <h1>Rent a Car</h1>
      <?php
          if (isset($_SESSION['user'])) {
            echo '<a href="/pages/logout.php" class="login">Çıkış Yap</a>';
          }else{
            echo '<a href="/pages/login.php" class="login">Giriş Yap / Kayıt Ol</a>';
          }
       ?>

    </header>

    <!-- Navbar -->
    <nav>
        <ul>
          <li><a>Home</a></li>
          <li><a>About us</a></li>
          <li><a>Services</a></li>
          <li><a>Contact us</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <main>
      <!-- Home Section -->
      <section id="home" class="home-section">
        <h1>Search. Compare. Hire.</h1>
        <p>Car rental at the best prices</p>

        <div class="form-menu row p-3 container">
          <div class="form-group align-self-center py-3 ml-3 col-lg-3">
            <p class="text-center">Şehir</p>
            <form method="POST" action="<?php
                          echo $_SERVER['PHP_SELF']
                         ?>" >
                <select name="city" id="city-select" class="w-100 border-none py-1">
                  <?php 
                        $sql = "SELECT DISTINCT city FROM cardb";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                          echo '
                          <option class="py-2 btn w-100" >
                              '.$row["city"] .'
                          </option>
                          ';
                        }
                      }
                      ?>
                </select>
           </div>

              <div class="form-group align-self-center ml-3 py-3 col-lg-3">
                <p class="text-center">Alış Tarihi</p>
                <input type="date" class="form-control" name="date-begin" id="date-begin" />
              </div>

              <div class="form-group align-self-center ml-3 py-3 col-lg-3">
                <p class="text-center">Teslim Tarihi</p>
                <input type="date" class="form-control" id="date-finish"  name="date-finish" />
              </div>

              <div class="align-self-center ml-3 py-3 col-lg-3">
                <p class="text-center">Seçili Tarihler Arasında Ara</p>
                <button class="btn btn-success w-100" id="search" type="submit">Ara</button>
              </div>

            </form>
          
        
          <div class="all-cars">
            <?php 
              
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                                
                $city = $_POST['city'];
                $sql = "SELECT * FROM cardb WHERE city = '$city' ";
                $result = $conn->query($sql);

                $datebegin = $_POST['date-begin'];
                $datefinish= $_POST['date-finish'];

                $rentDay = (strtotime($datefinish)-strtotime($datebegin)) / (3600 * 24);
             if(isset($_SESSION["user"])){

                if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()){
                echo '
                  <div class="car row" >
                  <a class="col-lg-3" href="/pages/cars.php?carId='.$row["id"].'">
                  <img  src=' . $row["img"] . ' alt=""/>
                  </a>
                    <div class="col-lg">
                        <h3>' . $row["name"] . '</h3>
                        <p>Year : ' . $row["year"] . '</p>
                        <p>Model : ' . $row["model"] . '</p>
                    </div>
                    <div class="col-lg">
                        <p>Price : ' . $row["price"] . '₺/day<p>
                        <p>Total price: ' . $row["price"] * $rentDay . '₺ / ' . $rentDay. ' day</p>
                    </div>
                    <button class="rentBtn btn btn-outline-dark col-lg-1">Kirala</button>
                </div >
                ';
                }
              }
            }
            else{
              header("Location: /pages/login.php"); 
            }
          }

            ?>
          </div>
          </div>
        </div>
      </section>
      <!-- About Section -->
      <section id="about">
        <div class="p-5 container">
          <h2 class="fw-bold">Advantages of renting with Rent a Car</h2>
          <div class="row mt-5">
            <div class="col-lg-3">
              <div class="icon">
                <img src="/assets/icons/dollar-sign.svg" alt="" />
              </div>
              <h4 class="fw-bold text-center">Best price: up to 30%OFF</h4>
              <p class="text-center">
                Get access to the best deals from global car rental companies,
                discounts of 30% and even more exclusive offers all year long.
              </p>
            </div>
            <div class="col-lg-3">
              <div class="icon">
                <img src="/assets/icons/credit-card.svg" alt="" />
              </div>
              <h4 class="fw-bold text-center">
                Bookings with up to 10% cashback
              </h4>
              <p class="text-center">
                Place your reservation and earn cashback in your digital wallet
                to save on your next bookings while being able to edit your
                reservation at any time.
              </p>
            </div>
            <div class="col-lg-3">
              <div class="icon">
                <img src="/assets/icons/coins.svg" alt="" />
              </div>
              <h4 class="fw-bold text-center">
                Compare the best prices from over 160 countries
              </h4>
              <p class="text-center">
                Compare prices from over 200 car rental companies across more
                than 7,000 cities and 20,000 service points.
              </p>
            </div>
            <div class="col-lg-3">
              <div class="icon">
                <img src="/assets/icons/car.svg" alt="" />
              </div>
              <h4 class="fw-bold text-center">
                Convenient and easy car rental
              </h4>
              <p class="text-center">
                In addition to the speed and practicality of renting on
                Rentcars, you can alsocount on 7-days-a-week support from a
                specialized service team ready to help you whenever you need.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- Contact Section -->
      <section id="details">
        <div class="container row mx-auto">
          <div class="col-lg-4 text-center mt-4">
            <p class="fs-4" style="color: #f9a828">Privacy Policy</p>
            <p>Customer Privacy Notice</p>
            <p>Privacy Notice For Branches</p>
            <p>Privacy Notice For Call Center</p>
            <p>Privacy Policy</p>
            <p>PDP Policy</p>
          </div>
          <div class="col-lg-4 text-center mt-4">
            <p class="fs-4" style="color: #f9a828">Popular Cities</p>
            <p>İstanbul Car Rental</p>
            <p>Ankara Car Rental</p>
            <p>Adana Car Rental</p>
            <p>Antalya Car Rental</p>
            <p>Bursa Car Rentall</p>
          </div>
          <div class="col-lg-4 text-center mt-4">
            <p class="fs-4" style="color: #f9a828">Popular Airports</p>
            <p>Sabiha Gökçen Car Rental</p>
            <p>Adana Airport Car Rental</p>
            <p>Antalya Airport Car Rental</p>
            <p>Trabzon Airport Car Rental</p>
            <p>Dalaman Airport Car Rental</p>
          </div>
        </div>
      </section>
    </main>
    <!-- Footer -->
    <footer>
      <p>©2023 Olcay Han Korkut | All Rights Reserved</p>
    </footer>

    <script src="script.js"></script>
  </body>
</html>
