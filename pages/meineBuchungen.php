<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      include('../includes/htmlhead.php')
    ?>
    <title>Meine Buchungen</title>
    <link rel="stylesheet" href="css/styleMeineBuchungen.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>

<body>
<?php
include('dbConnection.php');
if (isset($_POST['addBooking'])) {
    $carTypeId = $_POST['carType_ID'];
 
    $availableCarIDs=getAvailableCarIDs($carTypeId);
    if($availableCarIDs>1){
      $randomIndex = array_rand($availableCarIDs);
      $carID = $availableCarIDs[$randomIndex];
    } else {
      $carID=$availableCarIDs[0];
    }

    $stmt = "INSERT INTO Rental (User_ID, Car_ID, StartDate, EndDate) VALUES (:user_id, :car_id, :startDate, :endDate)";
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(':user_id', $_SESSION['User_ID']);
    $stmt->bindParam(':car_id', $carID);
    $stmt->bindParam(':startDate', $_SESSION['pickUpDate']);
    $stmt->bindParam(':endDate', $_SESSION['returnDate']);

    $stmt->execute();
    header('Location: ' .$_SERVER['PHP_SELF']);
 
    echo "<br>Buchung erfolgreich hinzugefügt!";
}
?>
<!--Buchungsdaten Übersicht-->
<article>
      <h1>Meine Buchungen</h1>

      <div class="onTopContainer">
        <h3>Buchungs-ID</h3>
        <h3>Buchungsdatum</h3>
        <h3>Abholdatum</h3>
        <h3>Rückgabedatum</h3>
        <h3>Hersteller</h3>
        <h3>Modell&nbsp;&nbsp;&nbsp;</h3>
      </div>

  <?php 
  // retrieve Infos from database to fill them into accordion
    $bookingInfos=getBookingInfos($_SESSION['User_ID']); 
  ?>
  <dl id="ud_accordion">
    <?php
      $numberOfBookings=getNumberOfBookings();
      if($numberOfBookings>0){
        for($i=0; $i<$numberOfBookings; $i++){
        ?>
            <dt>
              <p><?php echo "BuchungsID"; ?></p>
              <p><!--Variable--></p>
              <p><!--Variable--></p>
              <p><!--Variable--></p>
              <p><!--Variable--></p>
              <p><!--Variable-->&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </dt>
  
            <dd>
              Abhol- und Rückgabeort: <!--Variable--><br>
              Gesamtpreis der Buchung: <!--Variable--><br>
            </dd>
        <?php
          }
        ?>

        <?php
        // Schleife für das Generieren weiterer Buchungszeilen
        for ($i = 2; $i <= $lastBookingNumber; $i++) {

          // Formatiere die Buchungs-ID für die neue Buchung | neue Buchungszeilen werden nur nach Bedarf generiert
          $newBookingID = $currentDate . str_pad($lastBookingNumber + $i, 2, '0', STR_PAD_LEFT);
        ?>

          <!-- Neue Buchungszeile -->
          <dt>
            <p><?php echo $newBookingID; ?></p>
            <p><!--Variable--></p>
            <p><!--Variable--></p>
            <p><!--Variable--></p>
            <p><!--Variable--></p>
            <p><!--Variable-->&nbsp;&nbsp;&nbsp;&nbsp;</p>
          </dt>

          <dd>
            Abhol- und Rückgabeort: <!--Variable--><br>
            Gesamtpreis der Buchung: <!--Variable--><br>
          </dd>

        <?php
        }
        ?>
      </dl>
    </article>


    
<!--js code for accordion--> 
<script>
$(document).ready(function() { //code execudes when document is fully loaded
  $("#ud_accordion dt") //selects all elements within the accordion
    .stop()
    .click(function() {
      if ($(this).hasClass("ud_active")) { //checking if the clicked <dt> has the class ud_active
        $(this).removeClass("ud_active"); //current element "this" is removed from ud_active
        $(this)
          .next()
          .slideUp(300);
      } else { //if the clicked <dt> has not ud_active, all <dt> elements are removed from ud_active
        $(this)
          .parent()
          .children()
          .removeClass("ud_active");
        $(this).addClass("ud_active"); //adds the class ud_active to the current element "this"
        if ( //check if the next element of <dt> is a <dd>element
          $(this)
            .next()
            .is("dd")
        ) {
          $(this) //search for all <dd> elements in the container <dt> and close them by sliding up
            .parent()
            .children("dd")
            .slideUp(300);
          $(this) //when <dt> element is clicked, the next element is faded in.the animation duration is 300 milliseconds 
            .next()
            .slideDown(300);
        }
      }
    });
});
</script>


<?php
    include('../includes/footer.html'); // Einbindung des Footers
?>


</body>
</html>