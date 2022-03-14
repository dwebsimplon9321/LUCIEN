/**
 * Mise en place API pokemon
 */

//balise html
const listePU = document.querySelector("ul.liste-poke");

//nbr dynamique de poke
const nbrPoke = 50;

//tableau de datas
let allPokemon = [];
let tableauFin = [];
let CpTab = [];

/* appel API pokemon */
function findPoke(){
    //url API pokemon
    fetch("https://pokeapi.co/api/v2/pokemon?limit="+nbrPoke)
        .then( reponse => reponse.json())
        .then((allPoke => {
            //console.table(allPoke);

            allPoke.results.forEach(pokemon => {
                // function pour affichage info complete
                fullInfoPoke(pokemon);
            })
        }))
}

// executer la fonction 
findPoke();

// info sur un pokemon
function fullInfoPoke(iPokemon){
    let objetPokeFull = {}; // recuperer format json vide

    let urlPoke = iPokemon.url;
    let namePoke = iPokemon.name;

    //console.table(urlPoke);

    //recupere inforation urlPoke
    fetch(urlPoke)

        //reponse appel sur urlPoke
        .then(reponse => reponse.json())    //sortie format json
        .then(( dataPoke => {
            console.log(dataPoke);

            // recuperer info que je souhaite
            /**
             * - name
             * - sprite(images)
             * - son id (identifiant)
             */


            objetPokeFull.nom = dataPoke.name;
            objetPokeFull.id = dataPoke.id;
            objetPokeFull.imgF = dataPoke.sprites.front_default;
            objetPokeFull.imgB = dataPoke.sprites.back_default;


            // console.log(objetPokeFull);
            /**
             *  url : https://pokeapi.co/api/v2/pokemon-species/    
             *  - id du pokemon
            */

            fetch("https://pokeapi.co/api/v2/pokemon-species/"+dataPoke.id)
                .then(reponse =>reponse.json())
                .then( (dataPoke => {
                    //console.log(dataPoke);

                    //recuperer couleur du pokemon
                    /**
                     * - color.name = la couleur
                     */

                    objetPokeFull.couleur = dataPoke.color.name;
                    objetPokeFull.nomF = dataPoke.names[4].name;

                    // console.log(objetPokeFull);

                    //ajouter objetPokeFull dans un tableau

                    allPokemon.push(objetPokeFull);
                    if (allPokemon.length === nbrPoke) {
                        //console.log(allPokemon[10].nomF);

                        //trier les id par ordre croissant
                        tableauFin = allPokemon.sort((a ,b) => {
                            return a.id -  b.id;
                        });
                        
                        //console.log(tableauFin);

                        //creation des cartes en html
                        createCard(tableauFin);

                    }
                }))

        }))
}       

// creer les cartes html
function createCard(tab){


    //lire contenu de la variable en paramettre tab

    for( let i=0; i < tab.length; i++){
        console.log(tab[i]);

        //carte = li avec les couleurs 
        const carte = document.createElement("li");
        let couleur = tab[i].couleur;

        carte.style.backgroundColor = couleur; 

        // ajouter id du pokemon
        const idCarte = document.createElement("h3");
        idCarte.innerHTML = tab[i].id;

        //ajouter nom du pokemon
        const nomCarte = document.createElement("p");
        nomCarte.innerHTML = tab[i].nom;

        //ajouter image front du pokemon
        const imageF = document.createElement("img");
        imageF.src = tab[i].imgF;
        imageF.setAttribute("alt", tab[i].nom);


       //ajouter un ecouteur pour tourner la carte
       hoverLI(carte, tab[i].imgB, imageF , tab[i].imgF, nomCarte);
       



        // ajouter les li 
        carte.appendChild(idCarte);
        carte.appendChild(nomCarte);
        carte.appendChild(imageF);


        

        // ajouter dans ul les li
        listePU.appendChild(carte);
    }
}


// ecouteur sur hover
function hoverLI(carteLI, urlImgB, image, urlImgF, nomFr){
    carteLI.addEventListener("mouseover", () =>{
        image.src = urlImgB;     
    });
    carteLI.addEventListener("mouseout", () =>{
        image.src = urlImgF;             
    });

    
}

// scroll infini
window.addEventListener("scroll", () => {

    /**
     * scrollTop : different entre ce que l'on a scroller depuis le haut de page
     * scrollHeight : hauteur total
     * ClientHeight : hauteur page actuel deja scrolle et visible
     */
    const { scrollTop, scrollHeight, ClientHeight } =document.documentElement;

    console.log(scrollTop, scrollHeight, ClientHeight);
});