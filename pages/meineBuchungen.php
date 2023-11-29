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
include('../includes/header.html');
?>

<!--Buchungsübersicht gesamt-->
<article>
    
    <!--Orientierungsleiste-->
    <div class="onTopContainer">
        <h4>Buchungs-ID</h4>
        <h4>Abholdatum</h4>
        <h4>Rückgabedatum</h4>
        <h4>Hersteller</h4>
        <h4>Modell</h4>
        <h4>Buchungsdatum</h4>
    </div>

    <!--Accordion beginnt-->
    <dl id="ud_accordion">

    <!--erste Zeile-->
        <dt>
    <div class="dataBuchung">
        <h4>2023281101</h4>
        <h4>30.11.2023</h4>
        <h4>02.12.2023</h4>
        <h4>Audi</h4>
        <h4>A8</h4>
        <h4>28.11.2023</h4>
    </div>
        </dt>

        <!--scroll down element infos-->
        <dd>Beliebiger Text</dd>


  
        <dt>x</dt>
        <dd>x</dd>

        <dt>x</dt>
        <dd>x</dd>

        <dt>x</dt>
        <dd>x</dd>

        <dt>x</dt>
        <dd>x</dd>

        <dt>x</dt>
        <dd>x</dd>
    </dl>
    </article>





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
include('../includes/footer.html');
?>

</body>
</html>

