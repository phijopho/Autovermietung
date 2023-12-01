function togglemenu() {
    var table=document.getElementById("desc");
    var button = document.querySelector('.buttonToggle');
    if (table.style.opacity == 0){
        table.style.opacity = "1.0" ;
        button.classList.add('rotated'); // adds CSS class to rotate button
    } else {
        table.style.opacity = "0.0";
        button.classList.remove('rotated'); // remove rotation
    }
}