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
  <dl id="ud_accordion">
    <dt>Buchungszeile 1</dt>
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

</body>
</html>

