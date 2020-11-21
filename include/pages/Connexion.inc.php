<h1>Pour vous connecter</h1>
<form action="#" method="POST">
  <label for="nomUtilisateur">Nom d'utilisateur: </label><br>
  <input type="text" name="nomUtilisateur"><br>
  <label for="mdp">Mot de passe: </label><br>
  <input type="password" name="mdp"><br>

  <?php $nombre1=rand(1,9); $nombre2=rand(1,9);?>
  <img class="nombre" src="image/nb/<?php echo $nombre1; ?>" alt="nombre1"><span class="operation"> + </span>
  <img class="nombre" src="image/nb/<?php echo $nombre2; ?>" alt="nombre2"><span class="operation"> = </span><br>
  <input type="number" name="nombre"><br><br>
  <input type="submit" value="Valider">
</form>
