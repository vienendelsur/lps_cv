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
	//gestion des contenus
	//insertion d'une compétence
		if(isset($_POST['competence'])){//si on récupère une nelle compétence
			if($_POST['competence']!=''){// si compétence n'est pas vide
				$competence = addslashes($_POST['competence']);
				$pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$id_utilisateur') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/competences.php");
				exit();
			}//ferme le if
		}//ferme le if isset
	
	//suppression d'une compétence
		if(isset($_GET['id_competence'])){
			$efface = $_GET['id_competence'];
			$sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";
			$pdoCV -> query($sql);// ou on peut avec exec
			header("location: ../admin/competences.php");
		}

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
<title>Admin : modification d'une compétence <?php echo $ligne_utilisateur['pseudo']; ?></title>

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
   <?php
		$sql = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id = '$id_utilisateur' "); // prépare la requête
		$sql->execute(); // exécute-la
		$nbr_competences = $sql->rowCount(); //compte les lignes
	 ?>
    <div class="col-lg-12 page-header text-center">
      <h2>COMPÉTENCES</h2>
      <p>Il y a <?php echo $nbr_competences; ?> compétences dans la table pour <?php echo $ligne_utilisateur['pseudo']; ?></p>
    </div>
  </div>
  <div class="container">
    <div class="row text-center">
     <div class="col-xs-3 jumbotron">
          	<span class="glyphicon glyphicon-road"></span>
     </div>
      <div class="col-xs-9 text-center">
	<table class="table table-striped">
		<tbody>
		<tr class="info">
			<th scope="col">compétences</th>
			<th scope="col">modifier</th>
			<th scope="col">supprimer</th>
		</tr>
		<tr>
			<?php while ($ligne_competence = $sql->fetch()) { ?>
			<td><?php echo $ligne_competence['competence']; ?></td>
			<td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td>
<a class="supr" href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">
			<span class="glyphicon glyphicon-trash"></span></a></span></td>
		</tr>
			<?php } ?>
		</tbody>
	</table>
      </div>
    </div>   
        <div class="row text-center">
          <div class="col-xs-3">- - 
          </div>
          <div class="text-center col-xs-9">
           <div class="jumbotron"> 
            <!-- form insertion d'une compétence -->
            <form action="competences.php" method="post" class="text-center">
              <div class="form-group">
                <label for="competence">Compétence</label>
                <input type="text" name="competence" class="form-control" id="competence" placeholder="insérez une compétence" required>
              </div>
              <input type="submit" value="Envoyez" class="btn btn-primary btn-lg" style="margin-top: 10px;">
            </form>
            <!-- fin formulaire insertion des compétences --> 
          </div>
        </div>
      </div>
  <div class="container">
  à voir
</div>
  <!-- / CONTAINER--> 
</section>
<div class="well text-center"><span class="glyphicon glyphicon-leaf"></span></div>
<!-- FOOTER -->
	<?php include("include_footer.php"); ?>
<!-- / FOOTER --> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../js/bootstrap.js"></script>
<script src="../js/pisola_js.js"></script>
</body>
</html>
