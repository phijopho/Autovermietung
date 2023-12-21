<?php

function login()
{
    if (isset($_POST["login"])) { // check if login button was clicked
        handleLogin();
    }
}

// login handler
function handleLogin()
{
    global $conn;
    // save input username and password from form into variables
    $username = $_POST["username"];
    $_SESSION['username'] = $username; // save username in session variable
    $password = $_POST["password"];

    $existingUser = getUserByUsername($username); // save return value of checking if username exists in variable

    if (!empty($existingUser)) { // check if username exists, if so verify password
        $passwordHash = $existingUser[0]["Password"];
        $checkPassword = password_verify($password, $passwordHash);

        if ($checkPassword) {
            $_SESSION['User_ID'] = getUserID(); // if password correct add user id to session
            startSessionAndRedirect($existingUser[0]["FirstName"]);
        } else {
            displayLoginError(); // error if password wrong
        }
    } else {
        displayLoginError(); // error if username doesn't exist in database
    }
}

// check if username already exists in database
function getUserByUsername($username)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    return $stmt->fetchAll(); // return username if it was found, otherwise return false
}

// function for what happens after successful login
function startSessionAndRedirect($firstName)
{
    session_start();
    $_SESSION["firstName"] = $firstName; // save first name in session to display name in header
    // redirect to car details page if user came from there
    if (isset($_SESSION['carType_ID_Login'])){
        header("Location: ../pages/productDetails.php?carType_ID=".$_SESSION['carType_ID_Login']);
    } else {
        header("Location: ../index.php"); // else redirect to homepage
    }
}

// error message
function displayLoginError()
{
?>
    <div class="error">
        <p class="textError">Falscher Username oder falsches Passwort</p>
    </div>
<?php
}

?>