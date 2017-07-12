<?php require '../connexion/connexion.php' ?>
<?php
	
session_start();// à mettre dans toutes les pages de l'admin ; SESSION et authentification
	if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){
		$id_utilisateur=$_SESSION['id_utilisateur'];
		$prenom=$_SESSION['prenom'];	
		$nom=$_SESSION['nom'];
		
		//echo $_SESSION['connexion'];
		
	}else{//l'utilisateur n'est pas connecté
		header('location:authentification.php');
	}
//pour se déconnecter
if(isset($_GET['quitter'])){// on récupère le terme quitter dans l'url
	
	$_SESSION['connexion']='';// on vide les variables de session
	$_SESSION['id_utilisateur']='';
	$_SESSION['prenom']='';
	$_SESSION['nom']='';
	
	unset($_SESSION['connexion']);
	session_destroy();
	
	header('location:../index.php');
}

	?>
	<?php 
	//gestion des contenus, mise à jour d'une compétence
	if(isset($_POST['titre_e'])){// par le nom du premier input
		
		$titre_e = addslashes($_POST['titre_e']);
		$dates_e = addslashes($_POST['dates_e']);
		$sous_titre_e = addslashes($_POST['sous_titre_e']);
		$description_e = addslashes($_POST['description_e']);
		$id_experience = $_POST['id_experience'];
		$pdoCV->exec(" UPDATE t_experiences SET titre_e='$titre_e', sous_titre_e='$sous_titre_e', dates_e='$dates_e', description_e='$description_e' WHERE id_experience='$id_experience' ");
			 header('location: ../admin/experiences.php'); //le header pour revenir à la liste des compétences de l'utilisateur
        exit();
	}	
	//je récupère la compétence
	$id_experience = $_GET['id_experience']; // par l'id et $_GET
	$sql = $pdoCV->query("SELECT * FROM t_experiences WHERE id_experience = '$id_experience' ");// la requête égale à l'id
	$ligne_experience = $sql->fetch();  
	
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='$id_utilisateur' ");
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Modification d'une compétence : <?php echo $ligne_utilisateur['pseudo']; ?></title>
<!--CKEditor-->
<script src="//cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<!-- Bootstrap -->
<link rel="stylesheet" href="../css/bootstrap.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include("include_nav.php"); ?>

<!-- HEADER -->
<header>
 <?php 
	$sql = $pdoCV->query(" SELECT * FROM t_titres_cv WHERE utilisateur_id='$id_utilisateur' ");
$ligne_titre = $sql->fetch();
	?>
</header>
<!-- / HEADER --> 

<!--  SECTION-1 -->
<section>
  <div class="row">
   
    <div class="col-lg-12 page-header text-center">
      <h2>Mise à jour : expérience pro</h2>
    </div>
  </div>
  <div class="container">
      
<div class="row text-center">
          <div class="col-xs-3 jumbotron">
          	<span class="glyphicon glyphicon-send"></span>
  </div>
          <div class="text-center col-xs-9">
           <div class="jumbotron"> 
            <!-- form modification d'une expérience -->
            <form action="modif_experience.php" method="post" class="text-center">
		<div class="form-group">
			<label for="titre_e">Titre de l'expérience</label>
			<input type="text" name="titre_e" class="form-control" value="<?php echo $ligne_experience['titre_e']; ?>">
			<label for="dates_e">Dates</label>
			<input type="text" name="dates_e" class="form-control" value="<?php echo $ligne_experience['dates_e']; ?>">
			<label for="sous_titres_e">Sous-titre</label>
			<input type="text" name="sous_titre_e" class="form-control" value="<?php echo $ligne_experience['sous_titre_e']; ?>">
			<label for="description_e">Description</label>
			<textarea name="description_e" class="form-control" cols="80" rows="10" maxlength="200" id="description_e"><?php echo $ligne_experience['description_e']; ?></textarea>
			 <script>
            		CKEDITOR.replace( 'description_e' );
        	</script>
			<input hidden name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
		</div>
              <input type="submit" value="Mettre à jour" class="btn btn-primary btn-lg" style="margin-top: 10px;">
            </form>
            <!-- fin formulaire modification des compétences --> 
          </div>
        </div>
      </div>
  <div class="container">
  ... une div class container avec rien
</div>
 <div class="row">
     <hr>
    </div>
  <!-- / CONTAINER--> 
</section>
<div class="well"> </div>

<!-- FOOTER -->
	<?php include("include_footer.php"); ?>
<!-- / FOOTER --> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../js/bootstrap.js"></script>
</body>
</html>
