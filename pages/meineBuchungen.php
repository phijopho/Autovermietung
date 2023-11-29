<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meine Buchungen</title>
    <base href="/Autovermietung/">
    <link rel="stylesheet" href="css/style.css"> 
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
        <h4>2023112901</h4>
        <h4>29.11.2023</h4>
        <h4>02.12.2023</h4>
        <h4>06.12.2023</h4>
        <h4>Audi</h4>
        <h4>A8</h4>

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

