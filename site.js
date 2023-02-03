


//////////////---------------Button order----------------------

// récupérer le bouton
var button = document.querySelector(".order ");//pour sélectionner un élément HTML qui a la classe "order". Ce bouton sera utilisé pour la fonctionnalité de bouton fixe.

// ajouter une classe CSS pour fixer la position du bouton
function fixButton() {//La fonction fixButton() est déclarée. Cette fonction utilise la propriété classList de l'élément sélectionné pour ajouter une classe CSS nommée "fixed-top" au bouton. Cette classe CSS peut être utilisée pour fixer la position du bouton en utilisant les propriétés CSS appropriées (comme position:fixed).
  button.classList.add("fixed-top");
}

// détecter le défilement de la page
window.onscroll = function() {//La propriété onscroll de l'objet window est utilisée pour détecter le défilement de la page. Lorsque l'utilisateur défile sur la page, la fonction anonyme qui y est associée sera déclenchée.
  var scrollTop = document.documentElement.scrollTop;//Dans cette fonction anonyme, la variable scrollTop est définie en utilisant la propriété scrollTop de l'élément document.documentElement. Cette propriété renvoie la distance en pixels entre le haut de la page et le point où la page a été défilée.
  if (scrollTop > 0) {//Une condition if est utilisée pour vérifier si scrollTop est supérieur à 0. Si c'est le cas, cela signifie que l'utilisateur a défilé vers le bas de la page et la fonction fixButton() est appelée pour fixer le bouton en haut de la page.
    fixButton();//Si l'utilisateur ne défile pas, la condition if ne sera pas remplie et la fonction fixButton() ne sera pas appelée, le bouton restera à sa position initiale.
  }
};
//-------------------------------ZOOM IMAGE---------------------------------
let mesThumbnails = document.querySelectorAll('.plat-img ');//a méthode querySelectorAll() pour sélectionner tous les éléments HTML qui ont la classe "plat-img" et les stocker dans une variable nommée "mesThumbnails".


console.log(mesThumbnails);// la fonction console.log() pour afficher les images sélectionnées dans la console du navigateur.

for(let i=0 ;i< mesThumbnails.length;i++){//La boucle for est utilisée pour parcourir toutes les images sélectionnées dans la variable "mesThumbnails".
  mesThumbnails[i].addEventListener('mouseenter',function(){// la méthode addEventListener() pour ajouter un écouteur d'événement "mouseenter" à chaque image. Lorsque l'utilisateur passe la souris sur une image, la fonction au dessous associée à cet événement est déclenchée.
    mesThumbnails[i].style=(' width:50%;  height:179px; ')// la propriété style pour changer la largeur et la hauteur de l'image sélectionnée en utilisant des valeurs en pourcentage pour la largeur et en pixels pour la hauteur.


this.addEventListener('mouseout',function(){//a méthode addEventListener() pour ajouter un écouteur d'événement "mouseout" à chaque image. Lorsque l'utilisateur sort la souris de l'image, la fonction anonyme associée à cet événement est déclenchée.
  mesThumbnails[i].style=(' width:160px;  height:170px;')//la propriété style pour changer la largeur et la hauteur de l'image sélectionnée à nouveau, cette fois en utilisant des valeurs en pixels pour la largeur et la hauteur pour la faire revenir à sa taille d'origine.
})
   
})
}






//---------------------------caroussel-image-blog---------------------------------------

var carouselImages = document.querySelectorAll('.carousel-image');// la méthode querySelectorAll() pour sélectionner tous les éléments HTML qui ont la classe "carousel-image". Ces éléments sont stockés dans la variable carouselImages.
var current = 0;//La variable current est déclarée et initialisée à 0. Cette variable est utilisée pour stocker l'index de l'image actuellement affichée dans le carrousel.

function next() {//La fonction next() est déclarée. Cette fonction utilise la propriété classList de l'élément HTML actuellement affiché pour supprimer la classe CSS "active", qui est utilisée pour styliser l'image actuellement affichée. Ensuite, elle incrémente la valeur de current en utilisant l'opérateur modulo (%) pour s'assurer qu'elle reste dans les limites du tableau carouselImages. Enfin, elle utilise la propriété classList de l'élément HTML suivant pour ajouter la classe CSS "active", pour styliser l'image suivante.
    carouselImages[current].classList.remove('active');
    current = (current + 1) % carouselImages.length;
    carouselImages[current].classList.add('active');
}

function prev() {//La fonction prev() est déclarée. Elle fonctionne de manière similaire à la fonction next() mais décrémente current pour afficher l'image précédente.
    carouselImages[current].classList.remove('active');
    current = (current - 1 + carouselImages.length) % carouselImages.length;
    carouselImages[current].classList.add('active');
}
//La méthode querySelector() est utilisée pour sélectionner les éléments HTML qui ont les classes "prev" et "next", qui sont utilisés pour les boutons de navigation du carrousel. La méthode addEventListener() est utilisée pour ajouter des écouteurs d'événements click aux boutons qui appelleront les fonctions prev() et next() lorsque l'utilisateur clique sur les boutons.
document.querySelector('.prev').addEventListener('click', prev);
document.querySelector('.next').addEventListener('click', next);
// ce code permet de créer une fonctionnalité de carrousel d'images en utilisant des propriétés JavaScript natives pour sélectionner les éléments HTML et gérer les interactions utilisateur, et des classes CSS pour styliser les images actives. Les boutons précédent et suivant permettent de naviguer dans les images en utilisant les fonctions précédemment définies.





