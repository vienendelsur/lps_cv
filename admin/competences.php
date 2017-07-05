<?php require '../connexion/connexion.php' ?>
<?php 
	//gestion des contenus
	//insertion d'une compétence
		if(isset($_POST['competence'])){//si on récupère une nelle compétence
			if($_POST['competence']!=''){// si compétence n'est pas vide
				$competence = addslashes($_POST['competence']);
				$pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '1') ");//mettre $id_utilisateur quand on l'aura en variable de session
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
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' ");
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Admin : compétences <?php echo $ligne_utilisateur['pseudo']; ?></title>

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
		$sql = $pdoCV->prepare("SELECT * FROM t_competences WHERE utilisateur_id = '1' "); // prépare la requête
		$sql->execute(); // exécute-la
		$nbr_competences = $sql->rowCount(); //compte les lignes
	 ?>
    <div class="col-lg-12 page-header text-center">
      <h2>COMPÉTENCES</h2>
      <p>Il y a <?php echo $nbr_competences; ?> compétences dans la table pour <?php echo $ligne_utilisateur['pseudo']; ?></p>
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
			<th scope="col">compétences</th>
			<th scope="col">modifier</th>
			<th scope="col">supprimer</th>
		</tr>
		<tr>
			<?php while ($ligne_competence = $sql->fetch()) { ?>
			<td><?php echo $ligne_competence['competence']; ?></td>
			<td><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td>
<a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">
			<span class="glyphicon glyphicon-trash"></span></a></span></td>
		</tr>
			<?php } ?>
		</tbody>
	</table>
      </div>
    </div>
   
        <div class="row text-center">
          <div class="col-xs-3">
          	re coucou
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
<div class="well"> </div>

<!-- FOOTER -->
<div class="container">
  <div class="row">
    <div class="col-lg-offset-3 col-xs-12 col-lg-6">
      
    </div>
  </div>
</div>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © MyWebsite. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- / FOOTER --> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../js/bootstrap.js"></script>
</body>
</html>
