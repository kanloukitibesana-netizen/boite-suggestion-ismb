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

//les variables de la date
let date=new Date();
let jours=date.getDate();
let mois=date.getMonth()+1;
let annee=date.getFullYear();
let heur=date.getHours();
let minnute= date.getMinutes();
let seconde= date.getSeconds();

function date_finale(){
  if(jours<10){
    jours="0"+jours;
  }

  if(mois<10){
    mois="0"+mois;
  }
  if(heur<10){
    heur="0"+heur;
  }
  if(minnute<10){
    minnute="0"+minnute;
  }
   return jours+"/"+mois+"/"+annee+" à "+heur+"h:"+minnute;
  
}
 //let fina_date= date_finale();
 


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



  function comportement_utilisateur(){

    if(anonyme.checked){
    
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
   
   //emailjs ent
   //emailjs.send();

   const parametres={
    date: date_finale(),
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

    message.textContent = "Votre suggestion a été envoyée avec succès.\nMerci de contribuer à l'amélioration de l'ISMB.";
    message.style.display = "block";

    disparaitre.style.display = "none";
    btnnouveausuggestion.style.display = "block";

    formulaire_suggestion.reset();
})
.catch(function(error) {
    console.log("Erreur :", error);
     messageErreu.textContent = "La suggestion n'a pas pu être envoyée. Veuillez réessayer.\n Veuillez vérifier votre connexion et réessayer.";
    messageErreu.style.display = "block";
    messageErreu.style.color = "red";
});
   console.log(parametres);
    
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

 
