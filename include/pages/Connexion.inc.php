
<h1>Pour vous connecter</h1>
<form action="#" method="POST">
  Nom d'utilisateur: <br>
  <input type="text" name="nomUtilisateur"><br>
  Mot de passe:<br>
  <input type="password" name="mdp"><br>

  <?php $nb1=rand(1,9); $nb2=rand(1,9);
  echo "$nb1 + $nb2 = "
  ?><br>
  <input type="number" name="nombre"><br>
  <input type="submit" value="Valider">
</form>
