let btn_menu=document.getElementById("btn-menu");
let navbar=document.getElementById("navbar"); 

//fonction d'affiche des elements d'acceuil sur petit telephone
 function afficher_menu(){
   navbar.classList.toggle("active");

 }
 btn_menu.addEventListener("click",afficher_menu);