<html lang="en">
  <head>
    <?php
      include('../includes/htmlhead.php')
    ?>
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="css/styleKontaktformular.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>

<body>

  <?php
    include('../includes/header.html'); // Einbinden des Headers
  ?>
    



<!--Buchungsdaten Übersicht-->

<form>
        <h1>Kontaktformular</h1>
        <div class="inputbox">
            <input type="Vorname" required autofocus placeholder="Vorname" name="vorname"> <br>
            <input type="Nachname" required placeholder="Nachname" name="nachname"> <br>
            <input type="E-Mail" required placeholder="E-Mail" name="e-mail"> <br>
            <input type="Nachricht" required placeholder="Nachricht" name="nachricht">
        </div>
        <button name="login">Anfrage senden</button>
</form>

      








</body>
</html>