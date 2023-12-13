<!DOCTYPE html>
<html lang="en">

<head>
    <?php
      include('../includes/htmlhead.php')
    ?>

    <?php
        include('dbConnection.php');
    ?>

    <!-- html page specifics -->
    <link rel="stylesheet" href="css/styleMeinProfil.css">
    <link rel="stylesheet" href="css/styleFooter.css">
    <title>Mein Profil</title>
</head>

<?php
    include('../includes/header.php'); // Einbinden des Headers
?>
<body>


<div class="contentBox">
    <div class="gif1">
        <img src="./images/neonlightsrev.gif">
    </div>
    
    <form>
        <h1>Mein Profil</h1>
        <div class="inputbox">
        <input type="text" required placeholder="Vorname" value="<?php echo $user['FirstName']; ?>">
        <input type="text" required placeholder="Nachname" value="<?php echo $user['LastName']; ?>">
        <input type="text" required placeholder="Alter" value="<?php echo $user['Age']; ?>">
        <input type="email" required placeholder="Email" value="<?php echo $user['Email']; ?>">
        <input type="text" required placeholder="Username" value="<?php echo $user['Username']; ?>">
        <input type="password" required placeholder="Password" value="<?php echo $user['Password']; ?>">

            <button>Bearbeiten</button>
        </div>
    </form>

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // example data | müssen später mit variablen gefüllt werden
            var userData = {
                vorname:  <?php echo json_encode($user['FirstName']); ?>,
                nachname: "Mustermann",
                alter: "25",
                email: "max@example.com",
                username: "maxmuster",
                password: "geheim"
            };

            // Function for filling the form fields with the existing data
            function fillForm() {
                document.querySelector('input[placeholder="Vorname"]').value = userData.vorname;
                document.querySelector('input[placeholder="Nachname"]').value = userData.nachname;
                document.querySelector('input[placeholder="Alter"]').value = userData.alter;
                document.querySelector('input[placeholder="Email"]').value = userData.email;
                document.querySelector('input[placeholder="Username"]').value = userData.username;
                document.querySelector('input[placeholder="Password"]').value = userData.password;
            }

            // Calls the function to fill the form when loading the page
            fillForm();

            // Mask password field
            var passwordInput = document.querySelector('input[placeholder="Password"]');
            passwordInput.type = "password";

            // Function for displaying/hiding the password
            function togglePassword() {
                passwordInput.type = passwordInput.type === "password" ? "text" : "password";
            }

            // Event listener for displaying/hiding the password
            document.getElementById('togglePassword').addEventListener('click', togglePassword);
        });
    </script>    
</body>

<?php
    include('../includes/footer.html');
?>
</html>