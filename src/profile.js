
var btnPool = document.getElementById("btnAddPool");
var hrefPool = btnPool.getAttribute("href");
function consultaLink() {
    if (hrefPool == "") {
        btnPool.classList.add('hover:bg-red-700')
        btnPool.classList.remove('hover:bg-slate-400/[0.4]')
    }
    else {
        btnPool.classList.add('hover:bg-slate-400/[0.4]')
        btnPool.classList.remove('hover:bg-red-700')
        
    }
}

function deletePool(divPai, paizao) {
    if (divPai.innerText.trim() === "") {
        paizao.classList.add('hidden');
    } else {
        paizao.classList.remove('hidden');
    }
}

//remove e adiciona a classe truncate no nav bar
// truncate: não deixa o texto vazar da div pai
function addTruncate() {
    document.getElementById("email").classList.add("truncate");
}

function removeTruncate() {
    document.getElementById("email").classList.remove("truncate");
}

window.addEventListener('load', consultaLink())

window.addEventListener('load', deletePool(document.getElementById("pool1"), document.getElementById("poolCard1")))
window.addEventListener('load', deletePool(document.getElementById("pool2"), document.getElementById("poolCard2")))
window.addEventListener('load', deletePool(document.getElementById("pool3"), document.getElementById("poolCard3")))

function avisoConta() {
    if (hrefPool == "") {
        window.confirm("Não é possível adicionar novas piscinas \nPara adicionar uma nova piscina, adquira uma conta premium ou apague uma já existente!")
    }
}

function emulateInput(i) {
    i.click();
}

function popUp() {
    const elemento = document.getElementById('limpadores')
    if (elemento.classList.contains("hidden")) {
        elemento.classList.remove("hidden")
    }
    else {
        elemento.classList.add("hidden")
    }
    
}

