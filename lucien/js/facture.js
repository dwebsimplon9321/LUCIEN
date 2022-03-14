// Comment recuperer le sous total ?
let sstotal = document.querySelector("td.sstotal");

// recuperer le montant ht (sstotal.innerHtml)
const tvaDom = 8.50;
 
// Calcul de la tva (prix ht * 8.50/100)
let montantTVA = sstotal.innerHTML * tvaDom / 100;


// conversion avec decimal


// calcul TTC
let ttc = parseInt(sstotal.innerHTML) + montantTVA;

// mettre a jour element de la facture
let tdTVA = document.querySelector("td.tva");
tdTVA.innerHTML = Number.parseFloat(montantTVA).toFixed(2);

let tdTotal = document.querySelector("td.total");
tdTotal.innerHTML = Number.parseFloat(ttc).toFixed(2);

sstotal.innerHTML = "s"+sstotal.innerHTML
