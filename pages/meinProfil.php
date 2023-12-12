<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
      include('../includes/htmlhead.php')
    ?>
    <link rel="stylesheet" href="css/styleRegistration.css">
    <title>Mein Profil</title>
</head>

<?php
    include('../includes/header.php'); // Einbinden des Headers
?>
<body>
    <form> <!--Text wird in button angezeigt und verschwindet sobald etwas eingetippt wird.-->
        <h1>Mein Profil</h1>
        <div class="inputbox">
            <input type="text" required placeholder="Vorname">
            <input type="text" required placeholder="Nachname">
            <input type="text" required placeholder="Alter">
            <input type="email" required placeholder="Email">
            <input type="text" required placeholder="Username">
            <input type="password" required placeholder="Password">

            <button>Bearbeiten</button>
        </div>
    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // example data | müssen später mit variablen gefüllt werden
            var userData = {
                vorname: "Max",
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
    </script>    
</body>
<?php
    include('../includes/footer.html'); // Einbindung des Footers
?>
</html>
