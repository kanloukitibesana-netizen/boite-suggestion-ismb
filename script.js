let nonprenom=document.getElementById("nom_prenom");
let anonyme=document.getElementById("anonyme");
let visible=document.getElementById("visible");
let nom=document.getElementById("nom");
let prenom=document.getElementById("prenom");
let telephone=document.getElementById("telephone");
let email=document.getElementById("email");

let sujetvalue=document.getElementById("sujet"); 
let statuevalue=document.getElementById("status");
let categorieValue=document.getElementById("categories");
let suggestionValue=document.getElementById("suggestion");
let nomValue=nom.value;
let prenomValue=prenom.value;
let telephoneValue=telephone.value;
let emailValue=email.value;


// var suggestion
let formulaire_suggestion=document.getElementById("formSuggestion");

// var pour message
let message=document.getElementById("message");
//message d'ereur
let messageErreu=document.getElementById("messageereur");
// utilisateur
let disparaitre=document.getElementById("utilisateur");
// bouton de nouveau message 
let btnnouveausuggestion=document.getElementById("btn");


/*let nomValue=nom.value;
    console.log(nomValue);
    let prenomValue=prenom.value;
    console.log(prenomValue);
    let telephoneValue=telephone.value;
    console.log(telephoneValue);
    let emailValue=email.value;
    console.log(emailValue);*/

  function comportement_utilisateur(){

    if(anonyme.checked){
    //  display:none nom_premon
       nonprenom.style.display="none";
       nom.required=false;
       prenom.required=false;
       telephone.required=false;
       email.required=false;
    }
    else{
     //   display: flex
     nonprenom.style.display="flex";
       nom.required=true;
       prenom.required=true;
       telephone.required=true;
       email.required=true;
       
    }

  }

  anonyme.addEventListener("change",comportement_utilisateur);
visible.addEventListener("change",comportement_utilisateur);


 
function gererFormulaire(event) {
  event.preventDefault();
  if(suggestionValue.value.trim().length<15  ){

    messageErreu.textContent="Votre suggestion doit contenir au moins 15 caracteres. ";
    messageErreu.style.color="red";
  }
 else{
   messageErreu.style.display="none"
   message.textContent="Votre suggestion a été envoyée avec succès .\n Merci de contribuer à l'ameloiration de l'ISMB.";
   message.style.display="block";
    disparaitre.style.display="none";
    btnnouveausuggestion.style.display="block";
   //emailjs ent
   //emailjs.send();

   const parametres={
    visibilite: anonyme.checked ? "anonyme":"visible",
    nom: nom.value,
    prenom: prenom.value,
    telephone: telephone.value,
    email: email.value,
    categorie: categories.value,
    statut: statut.value,
    sujet: sujet.value,
    suggestion: suggestion.value,
   }
   
   emailjs.send(
    "service_678a4t9",
    "template_fj4g8bj",
    parametres
)
.then(function(response) {
    console.log("Email envoyé !", response);
})
.catch(function(error) {
    console.log("Erreur :", error);
});
   console.log(parametres);
    formulaire_suggestion.reset();
  }  
  
  } 
     anonyme.addEventListener("change",comportement_utilisateur);
visible.addEventListener("change",comportement_utilisateur);

formulaire_suggestion.addEventListener("submit",gererFormulaire);
 function nouvellesuggestion(){
  disparaitre.style.display="block";
  message.style.display="none";
  btnnouveausuggestion.style.display="none";

 }
 btnnouveausuggestion.addEventListener("click",nouvellesuggestion);