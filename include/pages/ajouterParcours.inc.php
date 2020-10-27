<h1>Ajouter un parcours </h1>
<?php
$pdo=new Mypdo();
$parcoursManager = new ParcoursManager($pdo);
$villes=$parcoursManager->listerVille();
if (empty($_POST["kilometre"])){//premier appel
?>

<form name="info" action="index.php?page=5" method="POST">
    Ville 1 :

    <select name="ville1">
      <?php
      foreach ($villes as $ville){ ?>
      <option value="<?php echo $ville['vil_num'];?>"> <?php echo $ville['vil_nom'] ?> </option>
      <?php } ?>

    </select>
    Ville 2 :
    <select name="ville2">
      <?php
      foreach ($villes as $ville){ ?>
      <option value="<?php echo $ville['vil_num'];?>"> <?php echo $ville['vil_nom'] ?> </option>
      <?php } ?>
    </select>

    Nombres de kilometre(s) :
    <input type="number" name="kilometre" >
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
