<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include('../includes/htmlhead.php'); 
        include('../includes/functionsRegister.php');
    ?>

    <!-- html page specifics -->
    <link rel="stylesheet" href="css/styleRegistration.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <title>Registrieren</title>
</head>

<?php include('../includes/header.php'); ?>
<body>
<?php
    preventEnterIfLoggedIn();
?>
<div class="contentBox">
    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <h1>Registrieren</h1>

        <?php register(); ?>

        <div class="inputbox">
            <input type="text" required autofocus placeholder="Vorname*" name="firstName">
            <input type="text" required placeholder="Nachname*" name="lastName">
            <input type="number" required min="18" max="150" placeholder="Alter*" name="age">
            <input type="email" required placeholder="Email*" name="email">
            <input type="text" required placeholder="Username*" name="username"> <!-- maybe add pattern to disallow spaces -->
            <input type="password" required placeholder="Password*" name="password">
        </div>
        <button name="register">Registrieren</button>
    </form>
    <div class="gif1">
        <img src="./images/neonlights.gif">
    </div>

</div>    
</body>

<?php
    include('../includes/footer.html');
?>

</html>
