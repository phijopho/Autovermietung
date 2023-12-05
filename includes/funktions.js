
// Produktdetailseite toggle Menu 

function togglemenu() {
    var table = document.getElementById("desc");
     var button = document.querySelector('.buttonToggle');

     if (table.style.opacity == '0') {
         table.style.opacity = '1.0';
         button.classList.add('rotated');
         table.style.maxHeight = table.scrollHeight + 'px';
         table.scrollIntoView({ behavior: 'smooth', block: 'start' });
     } else {
         table.style.opacity = '0.0';
         button.classList.remove('rotated');
         table.style.maxHeight = '0';
     }
 }


// Homepage



//Header

// Change of padding in header while scrolling

 //When the user scrolls down 30px from the top of the document, resize the navbar's padding and the logo's font size
//  window.onscroll = function() {scrollFunction()};

//  function scrollFunction() {
//    if (document.documentElement.scrollTop > 10) {
//      document.getElementsByClassName("headercontainer").style.padding = "5px 20px";
//    } else {
//      document.getElementsByClassName("Headercontainer").style.padding = "10px 10px";
//    }
// }

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


// clicked link stays active when on page

 const navLinks = document.querySelectorAll('.headercontainer a');

 // Event-Listener i clicked links
 navLinks.forEach(link => {
   link.addEventListener('click', function(e) {
    e.preventDefault(); // avoids standard behaviour of links

    // remove all active classes
    navLinks.forEach(item => {
      item.classList.remove('active');
     });

    // underline active link
     this.classList.add('active');
  });
});

