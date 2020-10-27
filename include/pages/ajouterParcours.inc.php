<h1>Ajouter un parcours </h1>
<?php
$pdo=new Mypdo();
$parcoursManager = new ParcoursManager($pdo);
$villes=$parcoursManager->listerVille();
if (empty($_POST["kilometre"])){//premier appel
?>

<form name="info" action="index.php?page=5" method="POST">
    <label for="ville1">Ville 1 : </label>
    <select id="ville1" name="ville1">
      <?php
      foreach ($villes as $ville){ ?>
      <option value="<?php echo $ville['vil_num'];?>"> <?php echo $ville['vil_nom'] ?> </option>
      <?php } ?>
    </select>

    <label for="ville2">Ville 2 : </label>
    <select id="ville2" name="ville2">
      <?php
      foreach ($villes as $ville){ ?>
      <option value="<?php echo $ville['vil_num'];?>"> <?php echo $ville['vil_nom'] ?> </option>
      <?php } ?>
    </select>

    <label for="kilometre">Nombres de kilometre(s) : </label>
    <input type="number" id="kilometre" name="kilometre" ><br><br>
    <input type="submit" value="Valider">

</form>
<?php
} else
{


$parcours = new Parcours($_POST);
$retour=$parcoursManager->add($parcours);
//on appelle la méthode add en lui passant un objet client

if ($retour !=0) //retour contient le nombre de lignes affectées
 echo "insertion effectuée" ;
 else
 echo "problème";
}
?>
