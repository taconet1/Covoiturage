<?php session_start();?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="utf-8">
<link rel="icon" type="image/png" href="image/logo.png">

<?php $title = "Bienvenue sur le site de covoiturage de l'IUT.";?>
<title><?php echo $title ?></title>

<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
</head>
	<body>
	<div id="header">
		<div id="entete">
			<div class="colonne">
				<a href="index.php?page=0">
					<img src="image/logo.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" />
				</a>
			</div>
			<div class="colonne">
				Covoiturage de l'IUT,<br/>Partagez plus que votre véhicule !!!
			</div>
			</div>
			<div id="connect">
        <?php if (!isset($_SESSION['loginUtilisateur'])): ?>
          <a href="index.php?page=11">Connexion</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['loginUtilisateur'])): ?>
          Utilisateur : <?php echo $_SESSION['loginUtilisateur']; ?>
          <a href="index.php?page=12">Déconnexion</a>
        <?php endif; ?>
			</div>
	</div>
