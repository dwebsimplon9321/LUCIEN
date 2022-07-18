// formulaire le boutons
const btCommunes = document.querySelectorAll("button.btComm");
const divCommune = document.querySelector("div.reponse");
const divListeComm = document.querySelector("div.listeC");


// boucle for

for (let i = 0; i < btCommunes.length; i++) {
    //console.log(i);

    btCommunes[i].addEventListener("click", commune);
}
function commune(event){
    //console.log(this);
    event.preventDefault();


    // console.log(divCommune);

    if (divCommune.childElementCount === 5) {

        false;
    } else {
        divCommune.appendChild(this);
        this.classList.remove("btn-primary");
        this.classList.add("btn-warning");

        // ajouter texte champs cache
        let inputC = document.createElement("input");
        inputC.setAttribute("type", "hidden");
        inputC.setAttribute("name", "inputCommune[]");
        inputC.value = this.innerHTML;
        const divH = document.querySelector("div.hidden")
        
        divH.appendChild(inputC);

        // retirer une/plusieurs communes
        const nbrC = divCommune.childElementCount;

        for(let c=0; c < nbrC; c++){
            divCommune.children[c].addEventListener('click', retirer_commune);
        }


        // stocke_commune(divCommune);
    }

}

function retirer_commune(){
    divListeComm.appendChild(this)

    this.classList.add("btn-primary");
    this.classList.remove("btn-warning");
}









// function stocke_commune(blockC){
//     console.log(blockC.children[0].innerHtml);

//     if(blockC.length === 5)
//     blockC.children[0].innerHtml;

//     if(blockC.length === 5){
//         const comm1 = blockC.children[0].innerHtml;
//         const comm2 = blockC.children[1].innerHtml;
//         const comm3 = blockC.children[2].innerHtml;
//         const comm4 = blockC.children[3].innerHtml;
//         const comm5 = blockC.children[4].innerHtml;
//     }
// }
