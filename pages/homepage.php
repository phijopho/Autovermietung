<?php 
include('includes/dbConnection.php');
include("./includes/functions.php");
?>

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
            <!-- When click on button, then AboutUs page opens -->
            <div class="divbutton">
                <a href="http://localhost/Autovermietung/pages/aboutus.php" class="button">Discover more</a>
            </div>
        </div>

        <div class="divModels">
            <div class="slideshow-container">
                <div class="my Slides fade">
            <?php
                $type=selectDistinctColumn('Type', 'CarType');
                for ($i=1; $i<=5; $i++){
                    echo "<div class='mySlides'>";
                        echo "<img src='images/Default_Car_Cabrio_from_mercedes_no_car_brand_visible_silver_n_0_3ab7f2a6-a473-48dc-ba48-421b05e7453f_0.png' alt='Bild 1'>";
                        echo "<div class='caption'>";
                            $MinPrice=getMinMaxPrice($type[$i]);
                            echo $type[$i]." ab: ".$MinPrice['min']." &euro;";
                        echo "</div>";
                    echo "</div>";
                }         
            ?>
            
<!--  Next and previous buttons --> 

  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>


                    <!-- The dots/circles -->
                    <div class="divDots">
                        <span class="dot" onclick="currentSlide(1)"></span> 
                        <span class="dot" onclick="currentSlide(2)"></span> 
                        <span class="dot" onclick="currentSlide(3)"></span> 
                        <span class="dot" onclick="currentSlide(1)"></span> 
                        <span class="dot" onclick="currentSlide(2)"></span>  
                    </div>
            </div>
        </div> 
    </div>
 </div>

    <br>
    <br>

<!-- including Java Script scoll style for anchor and slide effects for gallery -->
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


    // Slideshow

    let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}

</script>
