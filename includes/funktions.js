// Produktdetailseite toggle Menu 

window.onload = function() {
    // Beim Laden der Seite die Höhe des divGallery auf die Höhe des divFoto setzen
    var fotoHeight = document.querySelector('.foto').clientHeight;
    var gallery = document.querySelector('.divgallery');
    gallery.style.height = fotoHeight + 'px';
}

function togglemenu() {
    var table = document.getElementById("desc");
    var button = document.querySelector('.buttonToggle');

    if (table.style.opacity === '0') {
        table.style.opacity = '1.0';
        table.style.maxHeight = '100%'; // Setzen Sie die Höhe des Elements auf 100% oder eine geeignete Höhe.
        button.classList.add('rotated');
    } else {
        table.style.opacity = '0';
        table.style.maxHeight = '0';
        button.classList.remove('rotated');
    }
}


// Homepage

//scroll to anker

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
          window.scrollTo({
            top: targetOffset,
            behavior: 'smooth' // Glatte Scrollanimation
          });
        }
      });
    });
  });
  
  
  
  

//Header

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

  // add 'active'-class bbsed on current url
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

  // Event-Listener for clicked links
  navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
          navLinks.forEach(item => {
              item.classList.remove('active');
          });
          this.classList.add('active');
      });
  });

  // Set links as active while on page
  setActiveLink();
});



