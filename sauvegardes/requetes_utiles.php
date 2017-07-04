<?php
// les utilisateurs
$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' ");
$ligne_utilisateur = $sql->fetch();

//le titre et l'accroche
$sql = $pdoCV->query(" SELECT * FROM t_titres_cv WHERE utilisateur_id ='1' ");
$ligne_titre = $sql->fetch();

//autre requête

	$sql = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id = '1' "); // prépare la requête
    $sql->execute(); // exécute-la
    $nbr_competences = $sql->rowCount(); //compte les lignes


?>