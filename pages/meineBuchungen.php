<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    include('../includes/htmlhead.php')
  ?>

  <!-- html page specifics -->
  <title>Meine Buchungen</title>
  <link rel="stylesheet" href="css/styleMeineBuchungen.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<?php
    include('../includes/header.php');
?>
<body>
 
 <?php
 preventEnterIfLoggedOut();
 ?>
 
<!--Buchungsdaten Übersicht-->
<article>
  <h1>Meine Buchungen</h1>

  <div class="onTopContainer">
    <h3>Buchungs-ID</h3>
    <h3>Buchungsdatum</h3>
    <h3>Abholdatum</h3>
    <h3>Rückgabedatum</h3>
    <h3>Modell&nbsp;&nbsp;&nbsp;</h3>
  </div>

  <?php 
  // retrieve Infos from database to fill them into accordion
    $userID=getUserID();
    $bookingInfos=getBookingInfos($userID); 
  ?>
  <dl id="ud_accordion">
    <?php
      $numberOfBookings=getNumberOfBookings();
      if($numberOfBookings>0){
        for($i=0; $i<$numberOfBookings; $i++){
        ?>
          <dt>
            <p><?php echo $bookingInfos[$i]['Rent_ID']; ?></p>
            <p><?php echo $bookingInfos[$i]['BookingDate']; ?></p>
            <p><?php echo $bookingInfos[$i]['StartDate']; ?></p>
            <p><?php echo $bookingInfos[$i]['EndDate']; ?></p>
            <p><?php echo $bookingInfos[$i]['Brand']; echo " ".$bookingInfos[$i]['Model']; ?>&nbsp;&nbsp;&nbsp;</p>
          </dt>

          <dd>
            Abhol- und Rückgabeort: <?php echo $bookingInfos[$i]['CarLocation']; ?><br>
            Gesamtpreis der Buchung: <?php echo $bookingInfos[$i]['TotalPrice']; ?> &euro;<br>
          </dd>
        <?php
        }     
      } else {
        echo "<br>Keine Buchungen vorhanden.";
      }
      ?>
  </dl>
</article>

<?php
  // checks
  // echo "Number of bookings: ".$numberOfBookings;
  // echo "<br><br>";
  // echo var_dump($bookingInfos);
  // echo "<br> User ID: ".$userID;
  // print_r($_SESSION);
?>

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
</body>
<?php
    include('../includes/footer.html'); // Einbindung des Footers
?>
</html>

