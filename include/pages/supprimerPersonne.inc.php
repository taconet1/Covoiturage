<h1>Supprimer une personne</h1>

<?php if(empty($_POST["personneSupp"])&& empty($_POST['go'])){ ?>
  <form action="#" method="post">
    <label for="personneSupp"> Nom de la personne : </label>
    <select id="personneSupp" name="personneSupp">
      <?php
      $personnes=$personneManager->getAllPersonne();
      foreach ($personnes as $personne) {?>
        <option value="<?php echo $personne->getPerNum();?>"> <?php echo $personne->getPerNum().' '.$personne->getPerNom().' '.$personne->getPerPrenom() ?> </option>
      <?php  }?>
    </select>
    <input type="submit" name="valider" value="Valider">
  </form>
<?php }else
if(!empty($_POST["personneSupp"]) && isset($_POST['valider']) && $_POST['valider']=='Valider'){ ?>
  Veuillez confirmer votre suppression
  <form action="#" method="post">
  <input type="submit" name="go" value="Valider">
  </form>
  <?php $_SESSION["personneSupp"]=$_POST["personneSupp"];
}else{

    if(null!=$personneManager->getEtudiant($_SESSION["personneSupp"])):
      $personneManager->supprimerEtudiant($_SESSION["personneSupp"]);
    endif;
    if(null!=$personneManager->getSalarie($_SESSION["personneSupp"])):
      $personneManager->supprimerSalarie($_SESSION["personneSupp"]);
    endif;
    $personneManager->supprimerPropose($_SESSION["personneSupp"]);
    $personneManager->supprimerAvis($_SESSION["personneSupp"]);
    $personneManager->supprimerPersonne($_SESSION["personneSupp"]);
  }
 ?>
