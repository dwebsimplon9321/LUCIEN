/**
 * 
 */
const addbt = document.querySelector("button#add");
addbt.addEventListener("click", ajouterChien);
function ajouterChien(event){
    // empecher chargement du formulaire
    event.preventDefault();

    const dvaddc = document.querySelector("div.dvaddc");
    copydvaddc = dvaddc.cloneNode(dvaddc);

    dvaddc.appendChild(copydvaddc);

}