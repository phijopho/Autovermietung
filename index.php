<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include('includes/htmlhead.php')
        ?>
        <!-- Einbinden der style.css -->
        <link rel="stylesheet" href="css/styleHomepage.css">
        <title>SWIFT rentals</title>

    </head>
<header>
    <?php 
    
        include('includes/header.html'); // include header
        
    ?>

</header> 

    <body>

        <?php

            include('includes/dbConnection.php'); // connect database

            include('pages/Homepage.php'); // include body content
            
        

        ?> 

    </body>

<footer>

    <?php
        include('includes/footer.html'); // include footers
        
    ?>

</footer>
</html>
