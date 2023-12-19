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
    $_SESSION['User_ID'] = getUserID();
    $password = $_POST["password"];

    $existingUser = getUserByUsername($username);

    if (!empty($existingUser)) {
        $passwordHash = $existingUser[0]["Password"];
        $checkPassword = password_verify($password, $passwordHash);

        if ($checkPassword) {
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
    header("Location: ../index.php");
}

function displayLoginError()
{
?>
    <div class="error">
        <p class="textError"> Falscher Username oder falsches Passwort </p>
    </div>
<?php
}

?>