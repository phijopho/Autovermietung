<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- add font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Einbinden der style.css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <title>Anmelden</title>
    <base href="/Autovermietung/">

</head>

<body>
    <?php
    include('../includes/dbConnection.php');
    include('../includes/header.html'); // Einbinden des Headers
    ?>

    <form>
        <h1>Anmelden</h1>
        <!-- <div class="comment">Mit * gekennzeichnete Felder müssen ausgefüllt werden</div> -->
        <div class="inputbox">
            <input type="text" required autofocus placeholder="Username">
            <input type="password" required placeholder="Password">
        </div>
        <button>Login</button>
    </form>

    <?php
    include('../includes/footer.html'); // Einbindung des Footers
    ?>
</body>