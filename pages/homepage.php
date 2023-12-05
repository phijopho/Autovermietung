<?php 
include('includes/dbConnection.php');
include("./includes/functions.php");
?>

<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>
 

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
    
                    <label for="Abholdatum">Abholdatum:</label>
      <!-- Verwende input-Felder und füge die Klasse 'datepicker' hinzu -->
      <input type="text" name="Abholdatum" id="Abholdatum" class="datepicker" /> 
      <label for="Abholdatum">Abholdatum:</label>     
      <!-- Verwende input-Felder und füge die Klasse 'datepicker' hinzu -->
      <input type="text" name="Rueckgabedatum" id="Rueckgabedatum" class="datepicker" />
      
      <br><br>
     
      <input type="submit" value="Suchen" class="submitButton" />
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
    </div>
</div>



<script>
    $(function() {
        var dateFormat = "dd MM yy",
        from = $("#Abholdatum").datepicker({
            dateFormat: dateFormat,
            regional: "de",
            monthNames: ["Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
            numberOfMonths: 2,
            minDate: 0,
            onSelect: function(selectedDate) {
                to.datepicker("option", "minDate", selectedDate);
            }
        }),
        to = $("#Rueckgabedatum").datepicker({
            dateFormat: dateFormat,
            regional: "de",
            numberOfMonths: 2,
            monthNames: ["Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
            minDate: 0,
            onSelect: function(selectedDate) {
                from.datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>



