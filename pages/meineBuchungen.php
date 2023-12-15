?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
  <link rel="stylesheet" href="css/styleFooter.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<?php
    include('../includes/header.php');
?>


<body>


<?php
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

// Pagination
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = 5;
$offset = ($currentPage - 1) * $perPage;

$numberOfBookings = getNumberOfBookings();
$totalPages = ceil($numberOfBookings / $perPage);

$bookingInfos = getBookingInfos($_SESSION['User_ID'], $perPage, $offset);
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

  <dl id="ud_accordion">
    <?php
      if (count($bookingInfos) > 0) {
        foreach ($bookingInfos as $bookingInfo) {
          ?>
          <dt>
            <p><?php echo $bookingInfo['Rent_ID']; ?></p>
            <p><?php echo $bookingInfo['BookingDate']; ?></p>
            <p><?php echo $bookingInfo['StartDate']; ?></p>
            <p><?php echo $bookingInfo['EndDate']; ?></p>
            <p><?php echo $bookingInfo['Brand'] . " " . $bookingInfo['Model']; ?>&nbsp;&nbsp;&nbsp;</p>
          </dt>

          <dd>
            Abhol- und Rückgabeort: <?php echo $bookingInfo['CarLocation']; ?><br>
            Gesamtpreis der Buchung: <?php echo $bookingInfo['TotalPrice']; ?> &euro;<br>
          </dd>
          <?php
        }
      } else {
        echo "<br>Keine Buchungen vorhanden.";
      }
    ?>
  </dl>

  <div class="pagination-container">
    <?php
      if ($totalPages > 1) {
        for ($i = 1; $i <= $totalPages; $i++) {
          $activeClass = ($i == $currentPage) ? 'ud_active' : '';
          echo "<a href='?page=$i' class='pagination-link $activeClass'>$i</a>";
        }
      }
    ?>
  </div>
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


// code für pagination site switch
document.addEventListener("DOMContentLoaded", function() {
  const itemsPerPage = 5; // Anzahl der anzuzeigenden Elemente auf einer Seite
  const bookings = <?php echo json_encode($bookingInfos); ?>; // Booking Infos werden gefüllt
  let currentPage = 1;

  function displayBookings(page) { //Start- und Endindex werden berechnet | Buchungen werden beim Seitenwechsel mit neuen Buchungsinfos gefüllt.(Der HTML inhalt des Accordions wird neu geladen)
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageBookings = bookings.slice(startIndex, endIndex);

    const accordionContainer = document.getElementById('ud_accordion');
    accordionContainer.innerHTML = generateBookingHtml(pageBookings);
  }

  //html code wird für jede Buchung erstellt
  function generateBookingHtml(bookings) {
    let html = '';
    bookings.forEach(booking => { 
      html += `
        <dt>
          <p>${booking['Rent_ID']}</p>
          <p>${booking['BookingDate']}</p>
          <p>${booking['StartDate']}</p>
          <p>${booking['EndDate']}</p>
          <p>${booking['Brand']} ${booking['Model']}&nbsp;&nbsp;&nbsp;</p>
        </dt>
        <dd>
          Abhol- und Rückgabeort: ${booking['CarLocation']}<br>
          Gesamtpreis der Buchung: ${booking['TotalPrice']} &euro;<br>
        </dd>
      `;
    });

    return html; //html code wird wiedergegeben
  }

  //Pagination Links werden aktualisiert
  function updatePagination() {
    const paginationContainer = document.querySelector('.pagination-container'); //paginationContainer ist nur für das Positionen auf der Website notwendig
    paginationContainer.innerHTML = '';

    const totalGroups = Math.ceil(bookings.length / itemsPerPage); //Gesamtzahl der Seiten berechnen

    //Für jede Seite wird eine Zahl erstellt und für jede Seite ein neues HTML Dokument
    for (let i = 1; i <= totalGroups; i++) {
      const pageLink = document.createElement('a');
      pageLink.href = '#';
      pageLink.classList.add('pagination-link');
      pageLink.textContent = i;
      pageLink.addEventListener('click', function(event) { //Wenn man auf eine Zahl klickt wird reagiert der code
        event.preventDefault(); // Verhindert das Standardverhalten des Links
        currentPage = i;
        displayBookings(currentPage); //Wenn auf eine Zahl geklickt wird die Funktion displayBookings hervorgerufen
        updatePagination();
      });

      paginationContainer.appendChild(pageLink);
    }
  }

  displayBookings(currentPage);
  updatePagination();
});
</script>

</body>

<?php
    include('../includes/footer.html');
?>
</html>