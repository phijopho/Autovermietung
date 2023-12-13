<?php session_start(); ?>
<div class="headercontainer">
    <div class="logobox"><a href="index.php"><img src="images/SWIFT.svg" alt="SWIFT logo"></a></div>
    <div class="headerbox"><a class="nav-link" href="./pages/produktuebersicht.php">Auto mieten</a></div>
    <div class="headerbox"><a class="nav-link scroll-link" data-target="section2" href="index.php#section2">Preise</a></div>
    <div class="headerbox"><a class="nav-link scroll-link" data-target="map-container" href="index.php#map-container" >Standorte</a></div>
    <?php if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) { ?>

      <div class="divhover nav-link" onmouseleave="handleMouseLeave(event)">
    <ul>
        <li onmouseenter="handleMouseEnter()">
                <a>Hallo <?php echo $_SESSION["firstName"] ?> </a>
              <ul id="submenu" onmouseenter="cancelCloseTimer()" onmouseleave="startCloseTimer()">
              <li class="nav-link"><a href="#"><p>Mein Profil</p></a></li>
                <li class="nav-link"><a href="#"><p>Meine Buchung</p></a></li>
                <li class="nav-link" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"><a href="./includes/logout.php">Abmelden</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
    <?php } else { ?>
        <div class="loginbox"><a class="nav-link" href="./pages/login.php">Login</a> | <a class="nav-link" href="./pages/registration.php"> Registrieren</a></div>
    <?php } ?>
</div>