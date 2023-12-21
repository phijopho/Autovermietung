<div class="headercontainer">
  <div class="logobox"><a href="index.php"><img src="images/SWIFT.svg" alt="SWIFT logo"></a></div>
  <div class="headerbox"><a class="nav-link" href="./pages/productOverview.php">Auto mieten</a></div>
  <div class="headerbox"><a class="nav-link scroll-link" data-target="anker" href="http://localhost/Autovermietung/index.php#anker">Preise</a></div>
  <div class="headerbox"><a class="nav-link scroll-link" data-target="section3" href="http://localhost/Autovermietung/index.php#section3">Standorte</a></div>

  <?php if (isset($_SESSION["firstName"]) && !empty($_SESSION["firstName"])) { ?>
    <div class="divhover" onmouseleave="handleMouseLeave(event)">
      <ul>
        <li style="background-color: #525252;" onmouseenter="handleMouseEnter()">
          <a>Hallo <?php echo $_SESSION["firstName"] ?> </a>
          <ul id="submenu" onmouseenter="cancelCloseTimer()" onmouseleave="startCloseTimer()">
            <li><a href="pages/meinProfil.php">Mein Profil</a></li>
            <li><a href="pages/myBookings.php">Meine Buchungen</a></li>
            <li style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;"><a href="./includes/logout.php">Abmelden</a></li>
          </ul>
        </li>
      </ul>
    </div>
</div>
<?php } else { ?>
  <div class="loginbox"><a class="nav-link" href="./pages/login.php">Login</a> | <a class="nav-link" href="./pages/registration.php">Registrieren</a></div>
<?php } ?>
</div>