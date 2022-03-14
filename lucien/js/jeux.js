// commentaires
/**
 * commentaire
 * multilignes
 */
/**
 * generer nombre aleatoire entre 1 et 150
 * afficher limite aleatoire de 1 à n
 * recuperer nombre propose
 * verefier le nombre
 *  - si le nombre est bon :
 * afficher message gagnant
 * 
 *  - si le nombre pas bon :
 * verefier limite :
 *  - si limite atteinte :
 * afficher bon nombre
 * afficher message perdu
 * 
 *  - si limite non atteinte :
 * afficher indice
 */

//let section ="salut";
//alert(section);


//generer nombre aleatoire entre 1 et 150
function devineMoi(min, max){
    // generateur aleatoire javascript
    return Math.floor(Math.random() *max) +min;
}

let resultat = devineMoi(1, 150);

// generer nombre aleatoire entre 1 et 15
function essai(min, max){
    //nombre essai
    return Math.floor(Math.random() *max) +min;
}
let nbrE = essai(1, 15);

// afficher nbrE dans le jeux
let spanE = document.querySelector("span.essais");
spanE.innerHTML = nbrE;

// ecouteur sur le bouton 'reponse'

let bt = document.querySelector("button")
bt.addEventListener("click", function(){
    let reponse = document.querySelector("input.repnse");

    // comparere reponse et resultat
    if(reponse.innerHTML == resultat){
        console.log ("oui")
    } else {
        console.log ("non, le bon nombre est :"+resultat);
    }
});