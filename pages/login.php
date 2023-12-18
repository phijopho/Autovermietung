<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('../includes/htmlhead.php');
    ?>

    <!-- html page specifics -->
    <link rel="stylesheet" href="css/styleLogin.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <title>Anmelden</title>
</head>

<?php
include('../includes/header.php'); // include header
?>

<body>
    <?php
    include('../includes/functionsLogin.php');
    preventEnterIfLoggedIn();
    ?>
    <div class="contentBox">
        <div class="gif1">
            <img src="./images/neonlightsrev.gif">
        </div>
        <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
            <h1>Anmelden</h1>

            <?php login(); ?>

            <div class="inputbox">
                <input type="text" required autofocus placeholder="Username" name="username">
                <input type="password" required placeholder="Password" name="password">
            </div>
            <button name="login">Login</button>
        </form>
    </div>
</body>
<?php
include('../includes/footer.html');
?>

</html>