// JavaScript Document pisola
// merci Ali !
// console.log("coucou");

$(function(){// vérifier que le chargement de la page se fait correctement
	//on met l'écouteur d'évènement au clique sur les balises a
	$('.supprimer').on("click",function(evenement){
		evenement.preventDefault();//cela empèche le comportement par défaut d'envoyer vers le lien
		var confirmation = confirm('Voulez vraiment effacer cette enregistrement ?');
		if(confirmation){
			//console.log('ça passe ?');
			var lien = $(this).attr('href');
			//console.log(lien);
			window.location.href=lien;
		}
	});
});