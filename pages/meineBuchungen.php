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
$(document).ready(function() {
  $("#ud_accordion dt")
    .stop()
    .click(function() {
      if ($(this).hasClass("ud_active")) {
        $(this).removeClass("ud_active");
        $(this)
          .next()
          .slideUp(300);
      } else {
        $(this)
          .parent()
          .children()
          .removeClass("ud_active");
        $(this).addClass("ud_active");
        if (
          $(this)
            .next()
            .is("dd")
        ) {
          $(this)
            .parent()
            .children("dd")
            .slideUp(300);
          $(this)
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

