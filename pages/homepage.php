<?php 
include('includes/dbConnection.php');
include("./includes/functions.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    

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
      <!-- Verwende input-Felder und füge die Klasse 'datepicker' hinzu -->
      <!-- <input type="text" name="Rueckgabedatum" id="Rueckgabedatum" class="datepicker" /><br><br> -->
      <br><br>
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
  // Flatpickr-Initialisierung für die Datumsauswahl
  flatpickr(".datepicker", {
    mode: "range", // Zeitspannen-Auswahl aktivieren
    dateFormat: "Y-m-d", // Datumsformat
    minDate: "today", // Mindestdatum ist heute
    onClose: [function(selectedDates, dateStr, instance) {
      // Wenn das Abholdatum ausgewählt wurde, fokussiere das Rückgabedatum
      if (dateStr.length > 0) {
        instance.setDate(selectedDates[0]);
        instance.open();
      }
    }],
    onChange: [function(selectedDates, dateStr, instance) {
      // Zeige die ausgewählte Zeitspanne im Konsolen-Log
      console.log(dateStr);
    }]
  });

   
  
</script>

<script>
    flatpickr(".datepicker", {
      mode: "range",
      dateFormat: "d.m.Y",
      minDate: "today"
    }); 
  </script>

