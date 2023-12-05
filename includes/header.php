<?php session_start(); ?>
<div class="headercontainer">
    <div class="logobox"><a href="index.php"><img src="images/SWIFT.svg" alt="SWIFT logo"></a></div>
    <div class="headerbox"><a href="./pages/produktuebersicht.php">Auto mieten</a></div>
    <div class="headerbox"><a href="#">Preise</a></div>
    <div class="headerbox"><a href="http://localhost/Autovermietung/pages/standorte.php">Standorte</a></div>
    <?php if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) { ?>
        <div class="divhover">
        <ul>
            <li>
                <a>Hallo <?php echo $_SESSION["firstName"] ?> </a>
              <ul>
                <li><a href="#">Mein Profil</a></li>
                <li><a href="#">Meine Buchung</a></li>
                <li><a href="./includes/logout.php">Abmelden</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
    <?php } else { ?>
        <div class="loginbox"><a href="./pages/login.php">Login</a> | <a href="./pages/registration.php"> Registrieren</a></div>
    <?php } ?>
</div>