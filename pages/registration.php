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
    <?php preventEnterIfLoggedIn(); ?>
    
    <!-- content of page -->
    <div class="contentBox">
        
        <!-- registration form -->
        <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
            
            <h1>Registrieren</h1>

            <!-- function for registration -->
            <?php register(); ?>

            <!-- input fields for registration form -->
            <div class="inputbox">
                <input type="text" required autofocus placeholder="Vorname*" maxlength="128" name="firstName">
                <input type="text" required placeholder="Nachname*" maxlength="128" name="lastName">
                <input type="number" required min="18" max="150" placeholder="Alter*" name="age">
                <input type="email" required placeholder="Email*" maxlength="128" name="email">
                <input type="text" required placeholder="Username*" maxlength="128" name="username" pattern="[A-Za-z0-9_.]+" title="Bitte verwende nur Buchstaben, Zahlen, Unterstriche und Punkte.">
                <input type="password" required placeholder="Password*" name="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" title="Mindestens 8x Zeichen, 1x Gro&szlig;buchstaben, 1x Kleinbuchstaben, 1x Zahl">
            </div>

            <!-- register button -->
            <button name="register">Registrieren</button>
            
            <!-- info for already registered users -->
            <div class="loginInfo">
                Sie haben bereits ein Konto?&nbsp;
                <a href="./pages/login.php" class="loginLink">
                    Hier klicken zum Anmelden!
                </a>
            </div>
        </form>
        
        <!-- background gif -->
        <div class="gif1">
            <img src="./images/neonlights.gif">
        </div>
    </div>
</body>

<?php include('../includes/footer.html'); ?>

</html>