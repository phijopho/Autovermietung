
// Produktdetailseite toggle Menu 

function togglemenu() {
    var table = document.getElementById("desc");
     var button = document.querySelector('.buttonToggle');

     if (table.style.opacity == '0') {
         table.style.opacity = '1.0';
         button.classList.add('rotated');
         table.style.maxHeight = table.scrollHeight + 'px';
        
     } else {
         table.style.opacity = '0.0';
         button.classList.remove('rotated');
         table.style.maxHeight = '0';
     }
 }


// Homepage



//Header

// if clicked on link in header (Preise) scroll to anker.
window.onscroll = function() {
   scrollFunction();
 };

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



