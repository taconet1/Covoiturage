<h1>Supprimer une personne</h1>

<?php if(empty($_POST["personneSupp"])){ ?>
  <form action="#" method="post">
    <label for="personneSupp"> Nom de la personne : </label>
    <select id="personneSupp" name="personneSupp">
      <?php
      $personnes=$personneManager->getAllPersonne();
      foreach ($personnes as $personne) {?>
        <option value="<?php echo $personne->getPerNum();?>"> <?php echo $personne->getPerNom()." ".$personne->getPerPrenom() ?> </option>
      <?php  }?>
    </select>
    <input type="submit" value="Valider">

  </form>
<?php }else{
   if(null!=$personneManager->getEtudiant($_POST["personneSupp"])):
     $etudiantManager->supprimer($_POST["personneSupp"]);
   endif;
   if(null!=$personneManager->getSalarie($_POST["personneSupp"])):
     $salarieManager->supprimer($_POST["personneSupp"]);
   endif;
   $personneManager->supprimerPropose($_POST["personneSupp"]);
   $personneManager->supprimerAvis($_POST["personneSupp"]);
   $personneManager->supprimerPersonne($_POST["personneSupp"]);

} ?>
