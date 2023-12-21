<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    session_start();
        if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) { // check if user is logged in
            session_unset();
            session_destroy();
            header("Location: ../index.php?loggedOut=1"); // redirect user to homepage and display successful logout message
        } else {
            header("Location: ../index.php"); // if not logged in, redirect user to homepage without logging out or displaying any message
        }
    ?>
</body>

</html>