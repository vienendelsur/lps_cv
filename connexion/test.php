<?php require '../connexion/connexion.php' ?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Test connection</title>
	<link rel="stylesheet" href="../css/style_pisola.css">
</head>

<body>
	<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' ");
		$ligne_utilisateur = $sql->fetch();
	?>
	<p>Coucou ! <?php echo $ligne_utilisateur['prenom'].' '.$ligne_utilisateur['nom']; ?></p>
</body>
</html>
