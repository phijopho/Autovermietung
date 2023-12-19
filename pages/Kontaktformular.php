<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../includes/htmlhead.php');
    ?>

    <!-- html page specifics -->

    <link rel="stylesheet" href="css/styleKontaktformular.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Kontaktformular</title>
    <base href="/Autovermietung/">

    <?php
    include('../includes/header.php'); // Including the header
    ?>
</head>

<body>

    <?php
    include('../includes/dbConnection.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Display confirmation message
        echo '<script>alert("Vielen Dank für Ihre Anfrage! Wir werden uns bald mit Ihnen in Verbindung setzen.");</script>';
    }
    ?>

    <!--Daten für das Kontaktformular können hier eingetragen werden-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="ft-form" method="POST" accept-charset="UTF-8">
        <div id="confirmation"></div>
        <h1> </h1>
        <h1>Kontaktformular</h1>
        <label>
            <input type="text" required autofocus placeholder="Vorname" name="vorname"> <br>
        </label>

        <label>
            <input type="text" required placeholder="Nachname" name="nachname"> <br>
        </label>

        <label>
            <input type="email" required placeholder="E-Mail" name="e-mail"> <br>
        </label>

        <label>
            <textarea rows="6" name="Nachricht" required></textarea> <br>
        </label>
        <div>
            <button type="submit" name="login">Anfrage senden</button>
        </div>
        <h1></h1>
    </form>

</body>
<?php
include('../includes/footer.html');
?>

</html>