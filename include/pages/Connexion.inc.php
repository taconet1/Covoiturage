<?php include("include/functions.inc.php"); ?>

<h1>Pour vous connecter</h1>

<?php if (!isset($_POST["nomUtilisateur"]) || !isset($_POST["mdp"]) || !isset($_POST["nombre"])) : ?>
  <form action="#" method="POST">
    <label for="nomUtilisateur">Nom d'utilisateur: </label><br>
    <input id="nomUtilisateur" type="text" name="nomUtilisateur" required><br>

    <label for="mdp">Mot de passe: </label><br>
    <input id="mdp" type="password" name="mdp" required><br>

    <?php $nombre1=rand(1,9); $nombre2=rand(1,9); $_SESSION["nombre"]=$nombre1+$nombre2;?>

    <img class="nombre" src="image/nb/<?php echo $nombre1; ?>" alt="nombre1"><span class="operation"> + </span>
    <img class="nombre" src="image/nb/<?php echo $nombre2; ?>" alt="nombre2"><span class="operation"> = </span><br>
    <input type="number" name="nombre" required><br><br>

    <input type="submit" value="Valider">
  </form>

  <?php if (isset($_POST["randSum"]) && isset($nombre1) && isset($nombre2) && $_SESSION["randSum"]!=$_POST["nombre"]): ?>
    Le nombre est incorrect
  <?php endif; ?>

<?php else: $mdp = $personneManager->getMdp($_POST["nomUtilisateur"]); ?>
  <?php if ($mdp != "" && crypterMDP($_POST["mdp"]) == $mdp && $_SESSION["nombre"] == $_POST["nombre"]):
    $_SESSION["nomUtilisateur"] = $_POST["nomUtilisateur"];
    header('location: index.php'); ?>
  <?php endif; ?>
<?php endif; ?>

<?php if (!empty($_POST["nomUtilisateur"]) && $personneManager->getMdp($_POST["nomUtilisateur"]) != crypterMDP($_POST["mdp"])): ?>
  Votre mot de passe ou votre login est faux !
<?php endif; ?>

<?php if (!empty($_POST["nombre"]) && $_SESSION["nombre"] != $_POST["nombre"]): ?>
  L'addition des deux nombre est fausse !
<?php endif; ?>
