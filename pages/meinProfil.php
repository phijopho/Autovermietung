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
    <title>Mein Profil</title>
    <base href="/Autovermietung/">

</head>

<body>
    <?php
    include('../includes/dbConnection.php');
    include('../includes/header.html'); // Einbinden des Headers
    ?>

    <form>
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

            // Event listener for displaying/hiding the password
            document.getElementById('togglePassword').addEventListener('click', togglePassword);
        });
    </script>


    <?php
    include('../includes/footer.html'); // Einbindung des Footers
    ?>
</body>

</html>
