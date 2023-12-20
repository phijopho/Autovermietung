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
  preventEnterIfLoggedOut(); 
  ?>

  <?php
  if (isset($_POST['addBooking'])) {
    $carTypeId = $_POST['carType_ID'];

    $availableCarIDs = getAvailableCarIDs($carTypeId);
    if ($availableCarIDs > 1) {
      $randomIndex = array_rand($availableCarIDs);
      $carID = $availableCarIDs[$randomIndex];
    } else {
      $carID = $availableCarIDs[0];
    }

    //New query is added to the table rental
    $stmt = "INSERT INTO Rental (User_ID, Car_ID, StartDate, EndDate) VALUES (:user_id, :car_id, :startDate, :endDate)";
    $stmt = $conn->prepare($stmt);
    $stmt->bindParam(':user_id', $_SESSION['User_ID']);
    $stmt->bindParam(':car_id', $carID);
    $stmt->bindParam(':startDate', $_SESSION['pickUpDate']);
    $stmt->bindParam(':endDate', $_SESSION['returnDate']);

    $stmt->execute();
    header('Location: ' . $_SERVER['PHP_SELF']);

    echo "<br>Buchung erfolgreich hinzugefügt!";
  }

  // Pagination
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $perPage = 5;
  $offset = ($currentPage - 1) * $perPage;

  $numberOfBookings = getNumberOfBookings();
  $totalPages = ceil($numberOfBookings / $perPage);

  $bookingInfos = getBookingInfos($_SESSION['User_ID'], $perPage, $offset);

  $bookingInfos = array_reverse($bookingInfos); //To arrange bookings in descending order
  ?>

  <!--Booking data overview-->
  <article>
    <h1>Meine Buchungen</h1>
 
  <table>
  <tr>
  <td>
      <div class="tile">
        <h3>Buchungs_ID</h3>
      </div>
    </td>
    <td>
    <td>
      <div class="tile">
        <h3>Buchungsdatum</h3>
      </div>
    </td>
    <td>
      <div class="tile">
        <h3>Abholdatum</h3>
      </div>
    </td>
    <td>
      <div class="tile">
        <h3>Rückgabedatum</h3>
      </div>
    </td>
    <td>
      <div class="tile">
        <h3>Modell</h3>
      </div>
    </td>
  </tr>
</table>


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
            <p><?php echo $bookingInfo['Brand'] . " " . $bookingInfo['Model']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
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
    $(document).ready(function() {
      $("#ud_accordion").on("click", "dt", function() {
        if ($(this).hasClass("ud_active")) { //checking if the clicked <dt> has the class ud_active
          $(this).removeClass("ud_active"); //current element "this" is removed from ud_active
          $(this).next().slideUp(300);
        } else {
          $(this)
            .parent()
            .children()
            .removeClass("ud_active");
          $(this).addClass("ud_active");
          if ($(this).next().is("dd")) {
            $(this)
              .parent()
              .children("dd")
              .slideUp(300);
            $(this).next().slideDown(300);
          }
        }
      });
    });



    // code für pagination site switch
    document.addEventListener("DOMContentLoaded", function() {
      const itemsPerPage = 5; //Number of elements to be displayed on a page
      const bookings = <?php echo json_encode($bookingInfos); ?>; //Booking info will be filled
      let currentPage = 1;

      function displayBookings(page) { //Start and end index are calculated | Bookings are filled with new booking information when the page is changed (the HTML content of the accordion is reloaded).
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageBookings = bookings.slice(startIndex, endIndex);

        const accordionContainer = document.getElementById('ud_accordion');
        accordionContainer.innerHTML = generateBookingHtml(pageBookings);
      }

      //html code is created for each booking (or per 5 bookings on a page)
      function generateBookingHtml(bookings) {
        let html = '';
        bookings.forEach(booking => {
          html += `

        <dt>
          <div class="box"><p>${booking['Rent_ID']}</p></div>
          <div class="box"><p>${booking['BookingDate']}</p></div>
          <div class="box"><p>${booking['StartDate']}</p></div>
          <div class="box"><p>${booking['EndDate']}</p></div>
          <div class="box"><p>${booking['Brand']} ${booking['Model']}</p></div>
        </dt>

        <dd>
          Abhol- und Rückgabeort: ${booking['CarLocation']}<br>
          Gesamtpreis der Buchung: ${booking['TotalPrice']} &euro;<br>
        </dd>
      `;
        });

        return html; //html code is rendered
      }

      //Pagination links are updated
      function updatePagination() {
  const paginationContainer = document.querySelector('.pagination-container'); // paginationContainer is only necessary for the positions on the website
  paginationContainer.innerHTML = '';

  const totalGroups = Math.ceil(bookings.length / itemsPerPage); // Calculate total number of pages

  // A number is created for each page and a new HTML document is created for each page
  for (let i = 1; i <= totalGroups; i++) {
    const pageLink = document.createElement('a');
    pageLink.href = '#';
    pageLink.classList.add('pagination-link');
    pageLink.textContent = i;
    if (i === currentPage) {
      pageLink.classList.add('ud_active'); // Add the active class for the current page
    }
    pageLink.addEventListener('click', function (event) {
      event.preventDefault();
      currentPage = i;
      displayBookings(currentPage); // When a number is clicked, the displayBookings function is called up
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