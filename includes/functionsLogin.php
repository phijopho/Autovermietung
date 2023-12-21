<?php

function login()
{
    if (isset($_POST["login"])) {
        handleLogin();
    }
}

function handleLogin()
{
    global $conn;

    $username = $_POST["username"];
    $_SESSION['username'] = $username;
    $password = $_POST["password"];

    $existingUser = getUserByUsername($username);

    if (!empty($existingUser)) {
        $passwordHash = $existingUser[0]["Password"];
        $checkPassword = password_verify($password, $passwordHash);

        if ($checkPassword) {
            $_SESSION['User_ID'] = getUserID(); // if password correct add Session User ID 
            startSessionAndRedirect($existingUser[0]["FirstName"]);
        } else {
            displayLoginError(); //error if password wrong
        }
    } else {
        displayLoginError(); //error if username doesn't exist in database
    }
}

function getUserByUsername($username)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    return $stmt->fetchAll();
}

function startSessionAndRedirect($firstName)
{
    session_start();
    $_SESSION["firstName"] = $firstName;
    // redirect to car details page if user came from there
    if (isset($_SESSION['carType_ID_Login'])){
        header("Location: ../pages/productDetails.php?carType_ID=".$_SESSION['carType_ID_Login']);
    } else {
        header("Location: ../index.php");
    }
}

function displayLoginError()
{
?>
    <div class="error">
        <p class="textError">Falscher Username oder falsches Passwort</p>
    </div>
<?php
}

?>