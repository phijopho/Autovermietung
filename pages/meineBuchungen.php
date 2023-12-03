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
    include('../includes/header.html'); // Einbinden des Headers
  ?>
    
  <article>
      <h1>Meine Buchungen</h1>

      <div class="onTopContainer">
          <h3>Buchungs-ID</h3>
          <h3>Buchungsdatum</h3>
          <h3>Abholdatum</h3>
          <h3>Rückgabedatum</h3>
          <h3>Hersteller</h3>
          <h3>Modell</h3>
      </div>

    <dl id="ud_accordion">
      <dt>
          <p>2023112901</p>
          <p>29.11.2023</p>
          <p>02.12.2023</p>
          <p>06.12.2023</p>
          <p>Audi</p>
          <p>A8</p>

      </dt>
      <dd>Platz für weitere Informationen</dd>
    
      <dt>Buchungszeile 2</dt>
      <dd>Platz für weitere Informationen</dd>

      <dt>Buchungszeile 3</dt>
      <dd>Platz für weitere Informationen</dd>

      <dt>Buchungszeile 4</dt>
      <dd>Platz für weitere Informationen</dd>

      <dt>Buchungszeile 5</dt>
      <dd>Platz für weitere Informationen</dd>
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

