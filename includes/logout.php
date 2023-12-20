<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    session_start();
        if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) {
            session_unset();
            session_destroy();
            header("Location: ../index.php?loggedOut=1");
        } else {
            header("Location: ../index.php");
        }
    ?>
</body>

</html>