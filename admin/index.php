<?php require '../connexion/connexion.php';

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
<title>Admin : <?php echo $ligne_utilisateur['pseudo']; ?></title>
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
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="text-center"><?php echo $ligne_titre['titre_cv']; ?></h2>
          <p class="text-center"><?php echo $ligne_titre['accroche']; ?></p>
          <p>&nbsp;</p>
          <p class="text-center"><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> </p>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- / HEADER --> 
<!--  SECTION-1 -->
<section>
  <div class="row">
    <div class="col-lg-12 page-header text-center">
      <h2>ABOUT US</h2>
    </div>
  </div>
  <div class="container ">
    <div class="row">
      <div class="col-lg-4 col-sm-12 text-center"> <img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="../images/140X140.gif" data-holder-rendered="true">
        <h3>Titre de niveau 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="../images/140X140.gif" data-holder-rendered="true">
        <h3>Titre de niveau 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="../images/140X140.gif" data-holder-rendered="true">
        <h3>Titre de niveau 3 dolor</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="../images/140X140.gif" data-holder-rendered="true">
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="../images/140X140.gif" data-holder-rendered="true">
        <h3>Lorem ipsum dolor</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      </div>
      <div class="col-lg-4 col-sm-12 text-center"><img class="img-circle" alt="140x140" style="width: 140px; height: 140px;" src="../images/140X140.gif" data-holder-rendered="true">
        <h3>Lorem ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 page-header text-center">
        <h2>TESTIMONIALS</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-6 col-lg-6">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
      </div>
      <div class="col-6 col-lg-6">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
      </div>
      <div class="col-6 col-lg-6">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
      </div>
      <div class="col-6 col-lg-6">
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <small>Someone famous in <cite title="Source Title">Source Title</cite></small> </blockquote>
      </div>
    </div>
    
  </div>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-9 col-lg-9">
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore, praesentium, autem, veritatis error quidem eos fuga atque asperiores magnam deleniti necessitatibus sequi quo</p>
        </div>
        <div class=" text-center col-sm-6 col-lg-3 col-sm-offset-3 col-md-3 col-xs-offset-4 col-xs-5 col-lg-offset-0"> 
        	<a class="btn  btn-block btn-lg btn-success" href="#" title="">Sign up now!</a> 
        </div>
      </div>
    </div>
  </div>
  
  <!-- /container -->
  
  <div class="container">
    <div class="row">
      <div class="col-lg-12 page-header text-center">
        <h2>OUR SERVICES</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 col-lg-4">
        <h3>Feature Description</h3>
        <p> <i class="icon-desktop "></i>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt impedit est voluptatem doloremque architecto corporis suscipit quidem ratione! Quis laborum nam optio dolorem doloremque ex nobis quibusdam ad quo dolores? </p>
        <p><a class="btn btn-default" href="http://www.bootstraptor.com">View details »</a></p>
      </div>
      <div class="col-xs-6 col-lg-4">
        <h3>Feature Description</h3>
        <p> <i class="icon-desktop "></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, illo, libero esse assumenda culpa consequatur exercitationem beatae odio praesentium nihil iste ipsum reiciendis pariatur. Recusandae, reiciendis quidem eaque aut ab. </p>
        <p><a class="btn btn-default" href="http://www.bootstraptor.com">View details »</a></p>
      </div>
      <div class="col-xs-6 col-lg-4">
        <h3>Feature Description</h3>
        <p> <i class="icon-desktop "></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, adipisci recusandae veniam laudantium distinctio temporibus eveniet dolorum earum iusto veritatis provident ducimus minima dolore quas vel omnis cumque voluptas quibusdam.</p>
        <p><a class="btn btn-default" href="http://www.bootstraptor.com">View details »</a></p>
      </div>
      <div class="col-xs-6 col-lg-4">
        <h3>Feature Description</h3>
        <p> <em class="icon-desktop "></em> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, earum rem nostrum provident repellat inventore laborum deleniti quas facere Quasi impedit autem qui cupiditate modi vero vitae dolorum nisi explicabo ea dolores animi. Inventore, omnis.</p>
        <p><a class="btn btn-default" href="http://www.bootstraptor.com">View details »</a></p>
      </div>
      <div class="col-xs-6 col-lg-4">
        <h3>Feature Description</h3>
        <p> <i class="icon-desktop "></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, iure, perspiciatis, ab ad quia animi esse repudiandae tempore quisquam dolorem sequi voluptatum qui fugiat. Quasi impedit autem qui cupiditate iusto?</p>
        <p><a class="btn btn-default" href="http://www.bootstraptor.com">View details »</a></p>
      </div>
      <div class="col-xs-6 col-lg-4">
        <h3>Feature Description</h3>
        <p> <i class="icon-desktop "></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, aut, hic laudantium reprehenderit sapiente nemo consequatur corrupti accusantium! Hic, non rerum nihil reprehenderit excepturi explicabo error tempore aliquam eveniet odit.</p>
        <p><a class="btn btn-default" href="http://www.bootstraptor.com">View details »</a></p>
      </div>
    </div>
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
</body>
</html>
