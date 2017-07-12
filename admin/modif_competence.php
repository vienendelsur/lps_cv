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
	if(isset($_POST['competence'])){// par le nom du premier input
		$competence =  addslashes($_POST['competence']);
		$id_competence = $_POST['id_competence'];
		$pdoCV->exec(" UPDATE t_competences SET competence='$competence' WHERE id_competence='$id_competence' ");
			 header('location: ../admin/competences.php'); //le header pour revenir à la liste des compétences de l'utilisateur
        exit();
	}	
	//je récupère la compétence
	$id_competence = $_GET['id_competence']; // par l'id et $_GET
	$sql = $pdoCV->query("SELECT * FROM t_competences WHERE id_competence = '$id_competence' ");// la requête égale à l'id
	$ligne_competence = $sql->fetch();  
	
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
	$sql = $pdoCV->query(" SELECT * FROM t_titres_cv WHERE utilisateur_id ='$id_utilisateur' ");
$ligne_titre = $sql->fetch();
	?>
</header>
<!-- / HEADER --> 

<!--  SECTION-1 -->
<section>
  <div class="row">
   
    <div class="col-lg-12 page-header text-center">
      <h2>Mise à jour d'une compétence</h2>
    </div>
  </div>
  <div class="container">
      
        <div class="row text-center">
          <div class="col-xs-3 jumbotron">
          	<h2><span class="glyphicon glyphicon-send"></span></h2>
          </div>
          <div class="text-center col-xs-9">
           <div class="jumbotron"> 
            <!-- form modification d'une compétence -->
            <form action="modif_competence.php" method="post" class="text-center">
              <div class="form-group">
                <label for="competence">Formulaire de mise à jour de la compétence</label>
                <input type="text" name="competence" class="form-control" value="<?php echo $ligne_competence['competence']; ?>">
                <input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
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
