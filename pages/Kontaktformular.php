<html lang="en">
<head>
    <?php
    include('../includes/htmlhead.php');
    ?>
    <title>Kontaktformular</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/styleKontaktformular.css">
    <link rel="stylesheet" href="../css/styleFooter.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

<?php
include('../includes/dbConnection.php');
include('../includes/header.html'); // Einbinden des Headers

$confirmationMessage = ''; // Neue Variable für die Bestätigungsnachricht

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Formulardaten abrufen, nachdem das Formular abgeschickt wurde 
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $email = $_POST['e-mail'];
        $nachricht = $_POST['Nachricht'];

        // Prepared Statements funktionieren noch nicht! Müssen dringend gefixed werden
            // $stmt = $dbh->prepare("INSERT INTO anfragen (vorname, nachname, email, nachricht) VALUES (:vorname, :nachname, :email, :nachricht)");
            //$stmt->bindParam(':vorname', $vorname, PDO::PARAM_STR);
            //$stmt->bindParam(':nachname', $nachname, PDO::PARAM_STR);
            //$stmt->bindParam(':email', $email, PDO::PARAM_STR);
            //$stmt->bindParam(':nachricht', $nachricht, PDO::PARAM_STR);

            // SQL-Befehl ausführen
            //$stmt->execute();

        // Bestätigungsnachricht anzeigen
              $confirmationMessage = sprintf('Vielen Dank für Ihre Anfrage! Ihre Daten wurden gespeichert.', htmlspecialchars($vorname));
          } catch (PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
}
?>

<!-- Bestätigungsnachricht nur anzeigen, wenn sie gesetzt ist und wenn der Button geklickt wurde -->
<?php if (!empty($confirmationMessage) && isset($_POST['login'])) : ?>
    <div id="confirmation"><?php echo $confirmationMessage; ?></div>
<?php endif; ?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="ft-form" method="POST" accept-charset="UTF-8">
    <div id="confirmation"></div>
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
</form>

</body>
    <?php
    include('../includes/footer.html');
    ?>
</html>





