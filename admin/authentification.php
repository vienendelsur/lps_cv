<?php require '../connexion/connexion.php' ?>
<?php	
session_start();// à mettre dans toutes les pages de l'admin ; SESSION et authentification 
	$msg_authentification_erreur='';// on initialise la variable en cas d'erreur
if(isset($_POST['connexion'])){// on envoie le form avec le name du bouton (on a cliqué sur le bouton)
	$email = addslashes($_POST['email']);
	$mdp = addslashes($_POST['mdp']);
	$sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' ");// on vérifie courriel et mdp et ...
	$sql->execute();
	$nbr_utilisateur = $sql->rowCount();//on compte s'il est ds la table, le compte répond 1 s'il y est et 0 s'il n'y est pas
		if($nbr_utilisateur==0){// il n'y est pas !
			$msg_authentification_erreur="Erreur d'authentification !";	
		}else{//on le trouve il est inscrit !
			$ligne_utilisateur = $sql->fetch();// on retrouve ses infos
			
			$_SESSION['connexion']='connecté';
			$_SESSION['id_utilisateur']=$ligne_utilisateur['id_utilisateur'];
			$_SESSION['prenom']=$ligne_utilisateur['prenom'];
			$_SESSION['nom']=$ligne_utilisateur['nom'];
			
			header('location: index.php');
		}
	}//ferme if isset	
	?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin : Patrick Isola</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style_pisola.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
    <!--formulaire de connexion à l'admin du site CV--> 
     <form class="form-signin" action="authentification.php" method="post">       
      <h2 class="form-signin-heading">Bienvenue</h2>
      <label for="email">Courriel</label>
      <input type="email" class="form-control" name="email" placeholder="Votre courriel" required autofocus />
      <br>
      <label for="mdp">Mot de passe</label>
      <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" required>
      <br>      
      <button name="connexion" class="btn btn-lg btn-primary btn-block" type="submit">Connexion à l'admin</button>   
    </form>
	</div>
  </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../js/bootstrap.js"></script>
</body>
</html>
