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
	//insertion d'un loisir
		if(isset($_POST['loisir'])){//si on récupère un nouveau loisir
			if($_POST['loisir']!=''){// si loisir n'est pas vide
				$loisir = addslashes($_POST['loisir']);
				$pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '$id_utilisateur') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/loisirs.php");
				exit();
			}//ferme le if
		}//ferme le if isset
	
	//suppression d'un loisir
		if(isset($_GET['id_loisir'])){
			$efface = $_GET['id_loisir'];
			$sql = " DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";
			$pdoCV -> query($sql);// ou on peut avec exec
			header("location: ../admin/loisirs.php");
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
<title>Admin : modification d'une loisir <?php echo $ligne_utilisateur['pseudo']; ?></title>

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
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php">Admin : <?php echo $ligne_utilisateur['pseudo']; ?></a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a> </li>
        <li><a href="#">Link</a> </li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Insertions <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="competences.php">Compétences</a> </li>
            <li><a href="experiences.php">Expériences</a> </li>
            <li><a href="formations.php">Formations</a> </li>
            <li><a href="intertitres.php">Intertitres</a> </li>
            <li><a href="loisirs.php">Loisirs</a> </li>
            <li><a href="realisations.php">Réalisations</a> </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Déconnexion</a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

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
		$sql = $pdoCV->prepare("SELECT * FROM t_loisirs WHERE utilisateur_id = '$id_utilisateur' "); // prépare la requête
		$sql->execute(); // exécute-la
		$nbr_loisirs = $sql->rowCount(); //compte les lignes
	 ?>
    <div class="col-lg-12 page-header text-center">
      <h2>LOISIRS</h2>
      <p>Il y a <?php echo $nbr_loisirs; ?> loisirs dans la table pour <?php echo $ligne_utilisateur['pseudo']; ?></p>
    </div>
  </div>
  <div class="container">
    <div class="row">
     <div class="col-xs-3 jumbotron text-center">
     	<span class="glyphicon glyphicon-cutlery"></span>
     </div>
      <div class="col-xs-9 text-center">
	<table class="table table-striped">
		<tbody>
		<tr class="info">
			<th scope="col">loisirs</th>
			<th scope="col">modifier</th>
			<th scope="col">supprimer</th>
		</tr>
		<tr>
			<?php while ($ligne_loisir = $sql->fetch()) { ?>
			<td><?php echo $ligne_loisir['loisir']; ?></td>
			<td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td>
<a class="supprimer" href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"></a></span></td>
		</tr>
			<?php } ?>
		</tbody>
	</table>
      </div>
    </div>
   
        <div class="row text-center">
          <div class="col-xs-3 jumbotron">
          	
          </div>
          <div class="text-center col-xs-9">
           <div class="jumbotron"> 
            <!-- form insertion d'un loisir -->
            <form action="loisirs.php" method="post" class="text-center">
              <div class="form-group">
                <label for="loisir">Loisir</label>
                <input type="text" name="loisir" class="form-control" id="loisir" placeholder="insérez un loisir" required>
              </div>
              <input type="submit" value="Envoyez" class="btn btn-primary btn-lg" style="margin-top: 10px;">
            </form>
            <!-- fin formulaire insertion d'un loisir --> 
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
