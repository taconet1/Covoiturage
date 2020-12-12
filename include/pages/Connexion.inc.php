<h1>Pour vous connecter</h1>

<?php if (!isset($_POST['loginUtilisateur']) || !isset($_POST['mdp']) || !isset($_POST['sommeNombres'])) : ?>
  <form action="#" method="POST">
    <label for="loginUtilisateur">Nom d'utilisateur: </label><br>
    <input id="loginUtilisateur" type="text" name="loginUtilisateur" required><br>

    <label for="mdp">Mot de passe: </label><br>
    <input id="mdp" type="password" name="mdp" required><br>

    <?php $nombre1=rand(1,9); $nombre2=rand(1,9); $_SESSION['resultatSomme']=$nombre1+$nombre2;?>

    <img class="nombre" src="image/nb/<?php echo $nombre1; ?>" alt="nombre1"><span class="operation"> + </span>
    <img class="nombre" src="image/nb/<?php echo $nombre2; ?>" alt="nombre2"><span class="operation"> = </span><br>
    <input type="number" name="sommeNombres" required><br><br>

    <input type="submit" value="Valider">
  </form>
<?php else: $mdp = $personneManager->getMdp($_POST['loginUtilisateur']); ?>
  <?php if (crypterMDP($_POST['mdp'])==$mdp && $_SESSION['resultatSomme']==$_POST['sommeNombres']):
    $_SESSION['loginUtilisateur'] = $_POST['loginUtilisateur'];
    header('location: index.php'); ?>
  <?php endif; ?>
<?php endif; ?>

<?php if (!empty($_POST['loginUtilisateur']) && $personneManager->getMdp($_POST['loginUtilisateur'])!=crypterMDP($_POST['mdp'])): ?>
  <p class="errMessage">Votre mot de passe ou votre login est faux !</p>
<?php endif; ?>

<?php if (!empty($_POST['sommeNombres']) && $_SESSION['resultatSomme']!=$_POST['sommeNombres']): ?>
  <p class="errMessage">L'addition des deux nombres est fausse !</p>
<?php endif; ?>
