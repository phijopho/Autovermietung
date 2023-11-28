<!DOCTYPE html>
<html lang="en">

<head>
<?php 
include('includes/dbConnection.php');
include("./includes/functions.php");
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/styleHomepage.css">
    <title>SWIFT rentals</title>
    <base href="/Autovermietung/">

</head>


</head>
<body>

<div class="BackgroundAudi"> 
    <div class="divContentContainer">
        <!-- <div class="divBookingForm"> -->
            <div class="containerBookingForm">
                <!-- <h1>Buchung</h1> -->
                <h1>Buchung</h1>
                    <?php 
                    $pickUpLocation = array("Hamburg");
                    $default="Hamburg";
                    $stmtGetCities = $conn->prepare("SELECT City FROM Location WHERE City!=:cityIdent");
                    $stmtGetCities->bindParam(':cityIdent', $default);
                    $stmtGetCities->execute();
                    while($row = $stmtGetCities->fetch()){
                        $pickUpLocation[] = $row['City'];
                    }
                    ?>
        <!-- Link zur Produktübersichtseite statt index -->
            <form action="./index.php" method="post"> 
                <label for="Abholort">Abholort:</label>
                    <select id="Abholort" name="Abholort">
                        <?php //aus Datenbank ziehen, außer HH
                        foreach($pickUpLocation as $city){
                        echo "<option value='$city'>$city</option>";
                        }
                        ?>
                    </select>
                <label for "Abholdatum">Abholdatum:</label>
                    <input type="date" name="Abholdatum" value="<?php echo date('Y-m-d'); ?>" />
                <label for "Rueckgabedatum">R&uuml;ckgabedatum:</label>
                    <input type="date" name="Rueckgabedatum" value="<?php echo date('Y-m-d'); ?>" /><br><br>
                    <input type="submit" value="Suchen">
            </form>
        </div>

<div class="divAboutUs">
  <div class="divGoal1">
    <p> Every single detail of  SWIFT rentals  is
        measured against our continuing goal: to
        enhance costumer enjoyment.
    </p>
  </div>

  <div class="divGoal2">
    <p> Every single detail of  SWIFT rentals  is
        measured against our continuing goal: to
        enhance costumer enjoyment.
    </p>
  </div>

  <div class="divGoal3">
    <p> Every single detail of  SWIFT rentals  is
        measured against our continuing goal: to
        enhance costumer enjoyment.
    </p>
  </div>

  <div class="divGoal4">
    <p> Every single detail of  SWIFT rentals  is
        measured against our continuing goal: to
        enhance costumer enjoyment.
    </p>
  </div>
  <br>
      <div class="divbutton">
          <a href="http://localhost/Autovermietung/pages/aboutus.php" class="button">Discover more</a>
      </div>
</div>

    <div class="divModels">

        <div class="gallery">
         <?php
            $type=array("Cabrio", "Combi", "Mehrt&uuml;rer", "SUV", "Coupé", "Limousine");
            for ($i=1; $i<=6; $i++){
                       echo "<div class='imageContainer'>";
                       echo "<img src='images/Default_Car_Cabrio_from_mercedes_no_car_brand_visible_silver_n_0_3ab7f2a6-a473-48dc-ba48-421b05e7453f_0.png' alt='Bild 1'>";
                       echo "<div class='caption'>";
                           $MinPrice=getMinMaxPrice($type[$i-1]);
                       echo $type[$i-1]." ab: ".$MinPrice['min']." &euro;";
                       echo "</div>";
                echo "</div>";
          }
           
            ?>
        </div>

    </div> 

</div>
</div>

<br>
<br>
<br>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var scrollLink = document.querySelector('.scroll-link');

      scrollLink.addEventListener('click', function(event) {
        event.preventDefault();

        var targetSection = document.querySelector('.divModels');

        if (targetSection) {
          var headerHeight = document.querySelector('.headerbox').offsetHeight;
          var targetOffset = targetSection.offsetTop - headerHeight;

          window.scrollTo({
            top: targetOffset,
            behavior: 'smooth' // Glatte Scrollanimation
          });
        }
      });
    });

    

    document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".gallery .imageContainer");
    let currentImageIndex = 0;

    // Hide all images except the first one
    images.forEach((image, index) => {
      if (index !== currentImageIndex) {
        image.style.display = "none";
      }
    });

    function showNextImage() {
      images[currentImageIndex].style.display = "none";
      currentImageIndex = (currentImageIndex + 1) % images.length;
      images[currentImageIndex].style.display = "block";
    }


    // Add click event listener to show the next image
    document.querySelector('.gallery').addEventListener("click", showNextImage);
  });


  </script>

</body>

</html>
