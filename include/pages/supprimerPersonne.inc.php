<h1>Supprimer une personne</h1>

<?php if (empty($_POST['personneSupp']) && empty($_POST['valider'])): ?>
  <form action="#" method="post">
    <label for="personneSupp"> Nom de la personne : </label>
    <select id="personneSupp" name="personneSupp">
      <?php $personnes=$personneManager->getAllPersonne();?>
      <?php foreach ($personnes as $personne): ?>
        <option value="<?php echo $personne->getPerNum();?>"> <?php echo $personne->getPerNum().' '.$personne->getPerNom().' '.$personne->getPerPrenom() ?> </option>
      <?php endforeach; ?>
    </select>
    <input type="submit" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_POST['personneSupp'])): $_SESSION['personneSupp']=$_POST['personneSupp'];?>
  <form action="#" method="post">
    Veuillez confirmer votre suppression<br><br>
    <input type="submit" name="valider" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_POST['valider']) && !empty($_SESSION['personneSupp'])): ?>
  <?php
    if (null!=$etudiantManager->getEtudiant($_SESSION['personneSupp'])) {
      $etudiantManager->supprimerById($_SESSION['personneSupp']);
    }
    if (null!=$salarieManager->getSalarie($_SESSION['personneSupp'])) {
      $salarieManager->supprimerById($_SESSION['personneSupp']);
    }
    $proposeManager->supprimerPropose($_SESSION['personneSupp']);
    $avisManager->supprimerAvis($_SESSION['personneSupp']);
    $suppressionSucces=$personneManager->supprimerPersonne($_SESSION['personneSupp']);
    if ($suppressionSucces=true) { ?>
      <img src="image/valid.png" alt="Valid"> La personne a été bien supprimé
    <?php
    }
   ?>
<?php endif; ?>
