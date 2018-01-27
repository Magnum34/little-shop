
//variable
var slideIndex = 1;

//initial
let left = document.getElementById("button-left");
let right = document.getElementById("button-right");

showDivs(slideIndex);
left.addEventListener("click",function(){   plusDivs(-1) });
right.addEventListener("click",function(){  plusDivs(1) });   


function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    let i;
    let gallery = document.getElementsByClassName("gallery");
    if(gallery.length > 0){
        if (n > gallery.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = gallery.length}
        for (i = 0; i < gallery.length; i++) {
            gallery[i].style.display = "none";  
        }
        gallery[slideIndex-1].style.display = "block";
    }  
}
