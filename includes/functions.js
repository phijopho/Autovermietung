// Produktdetailseite toggle Menu 

window.onload = function () {
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

 // JavaScript-Funktionen, um die Modal Box zu öffnen und zu schließen
 function displayModal() {
    document.getElementById('myModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}


// Homepage

  //Crousel with prices and categories 
  function cSlider() {
    'use strict';

    var $carousel = jQuery('.cslider');

    if ($carousel.length > 0) {

        // Variablen
        var $carouselItem = $carousel.find('.cslider-item'),
            $prev = $carousel.find('.cslider-prev'),
            $next = $carousel.find('.cslider-next'),
            itemLength = $carouselItem.length,
            index = 0;


        // Funktionen
        function setIndex(i, add) {
            if (i + add >= itemLength) {
                return i + add - itemLength;
            } else {
                return i + add;
            }
        }

        function setState(i) {
            // Reset der Klassen
            $carouselItem.attr('class', 'cslider-item')

            // Zuweisung der Klassen
            $carouselItem.eq(setIndex(i, 0)).addClass('cslider-item-first');
            $carouselItem.eq(setIndex(i, 1)).addClass('cslider-item-previous');
            $carouselItem.eq(setIndex(i, 2)).addClass('cslider-item-selected');
            $carouselItem.eq(setIndex(i, 3)).addClass('cslider-item-next');
            $carouselItem.eq(setIndex(i, 4)).addClass('cslider-item-last');


        }

        // Kontrollfelder
        $next.on('click', function () {
            index = index + 1;
            if (index >= itemLength) {
                index = 0;
            }
            setState(index);
        });

        $prev.on('click', function () {
            if (index <= 0) {
                index = itemLength;
            }
            index = index - 1;
            setState(index);
        });

        // Starte Slider
        setState(index);

    }

}

// Shorthand for $( document ).ready()
jQuery(function () {
    cSlider();
});

// date filter: disallow return dates that are before selected pick up date
function setMinReturnDate() {
    var pickUpDate = document.getElementById("pickUpDate").value;
    document.getElementById("returnDate").min = pickUpDate;
}


// Header
// Scrollfunction 
window.onscroll = function () {
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

// scroll to anker
function scrollToAnchor() {
    var scrollLinks = document.querySelectorAll('.scroll-link');
    scrollLinks.forEach(function (scrollLink) {
        scrollLink.addEventListener('click', function (event) {
            event.preventDefault();
            var targetId = this.getAttribute('data-target');
            var targetSection = document.getElementById(targetId);
            if (targetSection) {
                var headerHeight = document.querySelector('.headerbox').offsetHeight;
                var targetOffset = targetSection.offsetTop ;
                window.scrollTo({
                    top: targetOffset,
                    behavior: 'smooth'
                });
            }
        });
    });
}






// Initialisieren Sie die Scroll-Funktion nur, wenn sich die Seite auf der index.php befindet
if (window.location.pathname === '/Autovermietung/index.php') {
    document.addEventListener('DOMContentLoaded', function () {
        scrollToAnchor();
    });
}


//Link stays active and marked while on page
document.addEventListener('DOMContentLoaded', function () {
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
        link.addEventListener('click', function (e) {
            navLinks.forEach(item => {
                item.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Set links as active while on page
    setActiveLink();
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
