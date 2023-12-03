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
    <link rel="stylesheet" href="../css/styleRegistration.css">
    <title>Registrieren</title>
    <base href="/Autovermietung/">

</head>

<body>
    <?php
    include('../includes/dbConnection.php');
    include('../includes/header.html'); // Einbinden des Headers


    if (isset($_POST["register"])) {
        var_dump($_POST);
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username OR Email=:email");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $userExists = $stmt->fetchColumn();

        if (!$userExists) {
            register($firstName, $lastName, $age, $email, $username, $password);
        } else {
            echo "<br> Es existiert bereits ein Account mit diesem Username oder dieser Email.";
        }
    }

    function register($firstName, $lastName, $age, $email, $username, $password)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO User (FirstName, LastName, Age, EMail, Username, Password) VALUES (:firstName, :lastName, :age, :email, :username, :password)");
        $stmt->bindParam(":firstName", $firstName);
        $stmt->bindParam(":lastName", $lastName);
        $stmt->bindParam(":age", $age);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        if ($stmt->execute()) {
            header("Location: ../index.php");
        } else { //add include file with error message
        }
    }

    ?>

    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <h1>Registrieren</h1>
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

    <?php
    include('../includes/footer.html'); // Einbindung des Footers
    ?>
</body>