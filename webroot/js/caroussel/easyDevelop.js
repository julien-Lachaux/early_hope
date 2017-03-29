// FONCTION : createCarrousel(param1, param2, param3)
// param1 : String, format querySelector ex: '#test' / '.test' / 'div a' defini la cible
// param2 : Array, format ['fileName.extension', 'fileName.extension'...] defini les images utiliser
// param3 : Int, defini le nombre d'image afficher
//
var createCarrousel = function(cible, img, visible) {
    // on recupere l'emplacement ou generer le carrousel
    var carrousel = document.querySelector(cible);
    carrousel.classList.add('carrousel');
    
    var boutonGauche = document.createElement('div');
    carrousel.appendChild(boutonGauche);
    
    var boutonDroit = document.createElement('div');
    carrousel.appendChild(boutonDroit);

    boutonGauche.classList.add('btnGauche');
    boutonDroit.classList.add('btnDroit');

    for(var i = 0; i < img.length; i++) {
        var test = document.createElement('img');
        carrousel.appendChild(test);
    }

    var images = carrousel.querySelectorAll('img');
    for(var i = 0; i< images.length; i++) {
        images[i].setAttribute('src', img[i]);
        if(i <= visible) {
            images[i].classList.add('active');
        }else {
            images[i].classList.add('hidden');
        }
    }

    var card = carrousel.querySelectorAll('img');

    for (var i = 0; i < card.length; i++) {
    card[i].style.order = i;
    if (i > visible) {
        card[i].classList.toggle('hidden');
    }
    }

    boutonDroit.addEventListener('click', function(){
    card = carrousel.querySelectorAll('.carrousel img');
    for (var i = 0; i < card.length; i++) {
        if (card[i].style.order <= 0) {
            card[i].style.order = card.length - 1;
            if (card[i].style.order >= visible) {
                card[i].classList.add('hidden');
            }
        }else {
            card[i].style.order -= 1;
            if (card[i].style.order <= visible) {
                card[i].classList.remove('hidden');
            }
        }
    }
    });

    boutonGauche.addEventListener('click', function(){
    card = carrousel.querySelectorAll('.carrousel img');
    for (var i = 0; i < card.length; i++) {
        if (card[i].style.order >= (card.length - 1)) {
            card[i].style.order = 0;
            card[i].classList.remove('hidden')

        }else {
            card[i].style.order = parseInt(card[i].style.order) + 1;
            if (card[i].style.order >= visible) {
                card[i].classList.add('hidden');
            }
        }
    }
});
}