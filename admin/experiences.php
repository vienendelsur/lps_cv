<?php require '../connexion/connexion.php' ?>
<?php 
	//gestion des contenus
	//insertion d'une expérience
		if(isset($_POST['titre_e'])){//si on récupère une nelle expérience
			if($_POST['titre_e']!='' && $_POST['description_e']!='' && $_POST['dates_e']!=''){// si expérience et les autres champs ne sont pas vide
				$titre_e = addslashes($_POST['titre_e']);
				$sous_titre_e = addslashes($_POST['sous_titre_e']);
            	$description_e = addslashes($_POST['description_e']);
            	$dates_e = addslashes($_POST['dates_e']);
				
				$pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_e', '$sous_titre_e', '$description_e', '$dates_e', '1') ");//mettre $id_utilisateur quand on l'aura en variable de session
				header("location: ../admin/experiences.php");
				exit();
			}//ferme le if
		}//ferme le if isset
	
	//suppression d'une expérience
		if(isset($_GET['id_experience'])){
			$efface = $_GET['id_experience'];
			$sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' ";
			$pdoCV -> query($sql);// ou on peut avec exec
			header("location: ../admin/experiences.php");
		}

	?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' ");
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Admin : modification d'une expérience <?php echo $ligne_utilisateur['pseudo']; ?></title>

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
	$sql = $pdoCV->query(" SELECT * FROM t_titres_cv WHERE utilisateur_id ='1' ");
$ligne_titre = $sql->fetch();
	?>
</header>
<!-- / HEADER --> 

<!--  SECTION-1 -->
<section>
  <div class="row">
   <?php
		$sql = $pdoCV->prepare("SELECT * FROM t_experiences WHERE utilisateur_id = '1' ORDER BY id_experience DESC "); // prépare la requête
		$sql->execute(); // exécute-la
		$nbr_experiences = $sql->rowCount(); //compte les lignes
	 ?>
    <div class="col-lg-12 page-header text-center">
      <h2>Expériences</h2>
      <p>Il y a <?php echo $nbr_experiences; ?> expériences dans la table pour <?php echo $ligne_utilisateur['pseudo']; ?></p>
    </div>
  </div>
  <div class="container">
    <div class="row">
     <div class="col-xs-3">
     	<p>coucou</p>
     </div>
      <div class="col-xs-9 text-center">
	<table class="table table-striped">
		<tbody>
		<tr class="info">
			<th scope="col">Titre</th>
			<th scope="col">sous-titre</th>
		  	<th scope="col">description</th>
		  	<th scope="col">dates</th>
			<th scope="col">modifier</th>
			<th scope="col">supprimer</th>
		</tr>
		<tr>
			<?php while ($ligne_experience = $sql->fetch()) { ?>
			<td><?php echo $ligne_experience['titre_e']; ?></td>
			<td><?php echo $ligne_experience['sous_titre_e']; ?></td>
			<td><?php echo $ligne_experience['description_e']; ?></td>
			<td><?php echo $ligne_experience['dates_e']; ?></td>
			<td><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><a class="supprimer" href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><span class="glyphicon glyphicon-trash"></span></a></span></td>
		</tr>
			<?php } ?>
		</tbody>
	</table>
      </div>
    </div>
   
        <div class="row text-center">
          <div class="col-xs-3 jumbotron">
          	<span class="glyphicon glyphicon-road"></span>
          </div>
          <div class="text-center col-xs-9">
           <div class="jumbotron"> 
            <!-- form insertion d'une expérience -->
            <form action="experiences.php" method="post" class="text-center">
              <div class="form-group">
                <label for="titre_e">Titre de l'expérience</label>
                <input type="text" name="titre_e" class="form-control" id="titre_e" placeholder="insérez une expérience">
                <label for="sous_titre_e">Sous-titre</label>
                <input type="text" name="sous_titre_e" class="form-control" id="sous_titre_e" placeholder="le sous-titre est facultatif">
                <label for="dates_e">Dates</label>
                <input type="text" name="dates_e" class="form-control" id="dates_e" placeholder="dates de début et de fin">
                <label for="description_e">Description</label>
                <textarea name="description_e" cols="80" rows="4" class="form-control" id="description_e" placeholder="description de l'expérience"></textarea>
              </div>
              <input type="submit" value="Envoyez" class="btn btn-primary btn-lg" style="margin-top: 10px;">
            </form>
            <!-- fin formulaire insertion des expériences --> 
          </div>
        </div>
      </div>
  <div class="container">
  à voir
</div>
  <!-- / CONTAINER--> 
</section>
<div class="well text-center"> ??? </div>

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
