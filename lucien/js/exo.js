// c'est un commentaire

// variable

// Question : comment on déclrare une variable ?
let a = ''; // let a = 0;
const b = ''; // const b = 0;

// Question : Comment affecter une chaine de caracteres a une variable ?
let c = 'Bonjour les gens !!';

// Question : Comment changer une valeur dans une  variable ?
c = 'Bonjour la DWEB !!!' ;

// Question : Comment verifier le contenue d'uen variable ?
//alert (c);

// Qusetion : De quoi avons nous besoin pour faire une addition ?
let d = 5 + 6;

let e = 5; let f = 6;
let total = e + f;

// Question : De quoi avons besoin pour une concatenation ?
let section = "DWEB";
let salutation = "Bonjour";
//alert(salutation+section);


// exercice
/**
 * - Créer 4 variables 3 numerique et une avec la chaine de caracteres suivante
 * - "Le total est : "
 * - Vous devez mettre en place une division, une multiplication, une soustraction et une addition
 * avec des chiffres differents et afficher pour chaque operation une alerte avec le resultat.
 */
 
let l = 7;
let o = 3;
let r = 4;
const s = 'Le total est :';
//alert(s+(l+o));
//alert(s+(r-o));
//alert(s+(l*r));
//alert(s+(l/o));

// Question: Comment changer le contenu d'1 element html
// Identifier element html h1
// alert(document.body.children);
let bh1 = document.querySelector("h1");
bh1.innerHTML = "Bienvenue la DWEB";

// Question : Comment changer le contenu d'1 element html et l'affecter dans un autre element
// identifier element  html h2
let bh2 = document.querySelectorAll("h2");

// identifier le 2eme element h2 et changer son contenu
bh2[1].innerHTML = "Section en avant";

// affecter contenu du 2eme h2 dans h3
let bh3 = document.querySelector("h3");
let changeH2 = bh2[1].innerHTML = "Merci beaucoup";

bh3.innerHTML = changeH2;

let bh2s = document.querySelector("h2.ssh2");
bh2s.innerHTML = "BENJAMIN mal de tête";

console.log(bh2);

// exercice
/**
 * Creer la variable 'paragraphe' puis recuperer l'element html p et ajouter le contenu suivant :
 * 'La DWEB  est en vacance à partir du 1er mars 2022'
 * 
 */

let bp = document.querySelector("p");
bp.innerHTML = "La DWEB  est en vacance à partir du 1er mars 2022";

// Question : Comment ajouter un element html en javascript ?
// dans la div.info ajouter un element html
// cibler element parent
let divI = document.querySelector("div.info"); 

// creation nouveau paragraphe
let pHtml = document.createElement("p");
let pText = document.createTextNode("La DWEB maitrise javascript.");

// ajouter texte dans la balise html p
pHtml.appendChild(pText);

// ajouter le paragraphe dans la div.info
divI.append(pHtml);

console.log(pHtml);


// Comment poser une question ?
// window.prompt("Poser une question");

// Comment recuperer une repose a une question
//let reponse = document.querySelector("p.r");
//reponse.innerHTML = prompt ("Comment va la DWEB ce matin ?");

//Exercice
/**
 *  Questionnaire
 *  Poser les questions correspondant aux texte des paragraphes present dans la division 'div.form'
 *  Afficher pour CHAQUE paragraphe, les reponses.
 *  Option : Mettre en majuscule le NOM et la ville
 */

/* let divF = document.querySelector("div.form");
console.log(divF.children);
divF.children[0].append(""+prompt("Votre nom ?").toUpperCase());
divF.children[1].append(""+prompt("Votre prénom ?"));
divF.children[2].append(""+prompt("Civilité"));
divF.children[3].append(""+prompt("Date de naissance ?"));
divF.children[4].append(""+prompt("Lieu de naissance?"));
divF.children[5].append(""+prompt("Adresse ?"));
divF.children[6].append(""+prompt("Code postal ?"));
divF.children[7].append(""+prompt("Ville ?").toUpperCase()); */

/* let n = prompt("Votre nom ?");
let nom = document.querySelector("p.nom");
nom.append(n); */

// Question : Comment vérifier si une variable est vide ou pas ?
let action = "Benjamin";
let actioN = "benjamin"

//if(action == actioN){
    //alert("c'est egal");
//} else if (myName == ""){
    //alert("pas egal");
//}

// Question : Comment stoker les 6 mois de l'annee dans une variable ?
// let semestre = "janvier, fevrier, mars, avril, mai, juin";
let annee = ["janvier", "fevier","mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"];
//console.log(annee);

// compter le nombre d'element d'1 tableau
let nbrAnnee = annee.length;

// boucle for
//let i = 0; // on commence a compter a partir de zero
 
//si i est plus petit que nbrAnnee  alors ajoute a i +1
for(let i = 0; i < nbrAnnee; i++) {
    //test
    //console.log(i);

    //afficher le mois de mars manuellement
    //console.log(annee[2]);

    //pour afficher 1 fois le mois de mars
    if(annee[1] == "mars"){
        console.log(annee[i])
    }
}

// autre boucle
annee.forEach(mois =>{
    //console.log(moi);

    if(mois == "aout"){
        let message = "Benjamin est né au mois :"+mois;

        //alert(message);
    }
});
// Question : Comment mettre en place automatiquement ...
// afficher un nom dans un element html vide
function afficheNom(){
    let dA= document.querySelector("div.afficher");
    
    //dA.children[0].innerHTML = "Rosario";
    dA.children[0].innerHTML = prompt("Quel est votre prénom ?")
    
    return dA;
}

// executer function afficheNom
//afficheNom();

// Question : Comment creer une horloge numerique
// Question : Comment rendre l'horloge dynamique
function afficheHeure(){
    //recuperer element html
    let divA = document.querySelector("div.afficher");

    //recuperer et ecrire dans paragraphe
    divA.children[0].innerHTML = "Afficher heure";

    //creer un objet Date
    let objDate = new Date();

    /**
     * heure = getHours
     * minute = getMinutes
     * seconde = getSeconds
     */


    divA.children[0].innerHTML = objDate.getHours()+":"+objDate.getMinutes()+":"+objDate.getSeconds();
    // renvoi resultat
    return divA;
}
//aexecuter afficheHeure
afficheHeure();