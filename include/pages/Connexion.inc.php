<?php include("include/functions.inc.php");
$nb= 0;
 $nombre1=rand(1,9); $nombre2=rand(1,9); $nb=$nombre1+$nombre2;
if (empty($_POST["nomUtilisateur"]) || empty($_POST["mdp"]) || empty($_POST["nombre"] )){
?>
  <h1>Pour vous connecter</h1>

  <form action="#" method="POST">
    <label for="nomUtilisateur">Nom d'utilisateur: </label><br>
    <input type="text" name="nomUtilisateur"><br>
    <label for="mdp">Mot de passe: </label><br>
    <input type="password" name="mdp"><br>

     <?php $_SESSION["nombre"]=$nombre1+$nombre2;?>

    <img class="nombre" src="image/nb/<?php echo $nombre1; ?>" alt="nombre1"><span class="operation"> + </span>
    <img class="nombre" src="image/nb/<?php echo $nombre2; ?>" alt="nombre2"><span class="operation"> = </span><br>
    <input type="number" name="nombre"><br><br>

    <input type="submit" value="Valider">
  </form>
<?php
}else{
  $res = $personneManager->getmdp($_POST["nomUtilisateur"] );
  if ($res !="" && crypterMDP($_POST["mdp"]) == $res && $_SESSION["nombre"] == $_POST["nombre"]){
    $_SESSION["nomUtilisateur"]= $_POST["nomUtilisateur"];
    header('location: index.php?page=0');
  }else{
    if ($res =="" || crypterMDP($_POST["mdp"])!= $res){
      echo "Votre mot de passe ou votre login est faux !";
    }
    if ($_SESSION["nombre"] != $_POST["nombre"]){
      echo "L'addition des deux nombre est fausse !";
    }

  }


}
 ?>
