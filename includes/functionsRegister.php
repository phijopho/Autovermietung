<?php

function register()
{
    if (isset($_POST["register"])) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $userExists = userExists($username, $email);

        handleRegistration($userExists, $firstName, $lastName, $age, $email, $username, $password);
    }
}

function userExists($username, $email)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username OR Email=:email");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function handleRegistration($userExists, $firstName, $lastName, $age, $email, $username, $password)
{
    if (!$userExists) {
        addUserToDatabase($firstName, $lastName, $age, $email, $username, $password);
        displaySuccessMessage();
    } else {
        displayErrorMessage();
    }
}

function addUserToDatabase($firstName, $lastName, $age, $email, $username, $password)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO User (FirstName, LastName, Age, EMail, Username, Password) VALUES (:firstName, :lastName, :age, :email, :username, :password)");
    $stmt->bindParam(":firstName", $firstName);
    $stmt->bindParam(":lastName", $lastName);
    $stmt->bindParam(":age", $age);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
}

function displaySuccessMessage()
{
?>
    <div class="success">
        <p class="textSuccess"> Erfolgreich registriert, <a href="./pages/login.php" class="linkHere"> jetzt Anmelden! </a></p>
    </div>
<?php
}

function displayErrorMessage()
{
?>
    <div class="error">
        <p class="textError"> Der Username oder die Email ist bereits vergeben. </p>
    </div> <?php
        }

            ?>