// Produktdetailseite toggle Menu 

window.onload = function() {
  var fotoHeight = document.querySelector('.foto').clientHeight;
  var gallery = document.querySelector('.divgallery');
  gallery.style.height = fotoHeight + 'px';
}

function togglemenu() {
  var table = document.getElementById("desc");
  var button = document.querySelector('.buttonToggle');
  
  // show table on click when not visible
  if (table.style.opacity == '0') {
      table.style.opacity = '1.0';
      table.style.maxHeight = '100%';
      button.classList.add('rotated');
  // hide table on click when visible
  } else {
      table.style.opacity = '0';
      table.style.maxHeight = '0';
      button.classList.remove('rotated');
  }
}

// Homepage
// scroll to anker
document.addEventListener('DOMContentLoaded', function() {
  var scrollLinks = document.querySelectorAll('.scroll-link');
  scrollLinks.forEach(function(scrollLink) {
      scrollLink.addEventListener('click', function(event) {
          event.preventDefault();
          var targetId = this.getAttribute('data-target');
          var targetSection = document.getElementById(targetId);
          if (targetSection) {
              var headerHeight = document.querySelector('.headerbox').offsetHeight;
              var targetOffset = targetSection.offsetTop - headerHeight;
              // Überprüfen, ob sich die aktuelle Seite auf der index.php befindet
              if (window.location.pathname === '/Autovermietung/index.php') {
                  window.scrollTo({
                      top: targetOffset,
                      behavior: 'smooth'
                  });
              } else {
                  // Wenn nicht, leiten Sie den Benutzer zur index.php-Seite weiter
                  window.location.href = 'index.php#' + targetId;
              }
          }
      });
  });
});



// Header
// Scrollfunction 
window.onscroll = function() {
 scrollFunction();
};

//Change of padding when scroll
function scrollFunction() {
 var headerContainer = document.querySelector(".headercontainer");
 if (document.documentElement.scrollTop > 30) {
   headerContainer.style.padding = "0px 20px";

 } else {
   headerContainer.style.padding = "10px 10px";
 }
}


//Link stays active and marked while on page
document.addEventListener('DOMContentLoaded', function() {
  const navLinks = document.querySelectorAll('.nav-link');

  // Funktion zum Markieren des aktiven Links
  function setActiveLink() {
      const currentUrl = window.location.href;
      navLinks.forEach(link => {
          if (currentUrl.includes(link.href)) {
              link.classList.add('active');
          } else {
              link.classList.remove('active');
          }
      });
  }

  // Event-Listener für geklickte Links
  navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
          navLinks.forEach(item => {
              item.classList.remove('active');
          });
          this.classList.add('active');
          // Aktivieren des Links, wenn darauf geklickt wird
          setActiveLink();
      });
  });

  // Aktiviere den Link basierend auf der aktuellen URL beim Laden der Seite
  setActiveLink();

  // Überwache Änderungen in der URL (Seitenwechsel)
  window.addEventListener('popstate', setActiveLink);
});


//Hovermenu closing slower
let closeTimer;


function handleMouseEnter() {
  document.getElementById('submenu').style.display = 'block';
}


function startCloseTimer() {
  closeTimer = setTimeout(() => {
      document.getElementById('submenu').style.display = 'none';
  }, 800); 
}


function cancelCloseTimer() {
  clearTimeout(closeTimer);
}

function handleMouseLeave(event) {
  if (!event.relatedTarget || (event.relatedTarget !== document.getElementById('submenu') && !document.getElementById('submenu').contains(event.relatedTarget))) {
      startCloseTimer(); 
}
}

