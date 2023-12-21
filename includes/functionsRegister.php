<?php

function register()
{
    if (isset($_POST["register"])) { // check if register button was clicked
        $firstName = $_POST["firstName"]; // save input values from form into variables
        $lastName = $_POST["lastName"];
        $age = $_POST["age"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // hash password

        $userExists = userExists($username, $email); // save return value of checking if user exists in variable

        handleRegistration($userExists, $firstName, $lastName, $age, $email, $username, $password);
    }
}

// check if user is already registered
function userExists($username, $email)
{
    // search in database with prepared statement to see if submitted username or email from form is already in database
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username=:username OR Email=:email");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    return $stmt->fetchColumn(); // return value of next column in database if a result was found (true). otherwise, meaning user isnt registered, return false
}

// registration handler
function handleRegistration($userExists, $firstName, $lastName, $age, $email, $username, $password)
{
    if (!$userExists) { // check if user is not registered yet
        addUserToDatabase($firstName, $lastName, $age, $email, $username, $password);
        displaySuccessMessage();
    } else {
        displayErrorMessage();
    }
}

// add user to database with prepared statement and using values of submitted form
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

// success message
function displaySuccessMessage()
{
?>
    <div class="success">
        <p class="textSuccess">
            Erfolgreich registriert,
        </p>
    </div>
    <div class="success">
        <a href="./pages/login.php" class="linkHere">hier klicken zum Anmelden!</a>
    </div>
<?php
}

// error message
function displayErrorMessage()
{
?>
    <div class="error">
        <p class="textError"> Der Username oder die Email ist bereits vergeben. </p>
    </div> 
<?php
}
?>