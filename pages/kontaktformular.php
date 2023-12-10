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
    



  <form action="SENDEADRESSE" id="ft-form" method="POST" accept-charset="UTF-8">
  <h1>Kontaktformular</h1>
      <label>
        	<input type="Vorname" required autofocus placeholder="Vorname" name="vorname"> <br>
      </label>

      <label>
        <input type="Nachname" required placeholder="Nachname" name="nachname"> <br>
      </label>

      <label>
        <input type="E-Mail" required placeholder="E-Mail" name="e-mail"> <br>
      </label>
      
      <label>
        <textarea rows="6" name="Nachricht" required></textarea> <br>
      </label>
      <div>

      <button name="login">Anfrage senden</button>
</form>


</body>
</html>