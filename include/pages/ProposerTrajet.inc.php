<h1>Proposer un trajet</h1>

<?php if (empty($_POST["depart"]) && empty($_POST["arrivee"])): ?>
  <form id="proposer" action="#" method="post">
    <label for="depart">Ville de départ : </label><br><br>
    <select name="depart" onChange='javascript:document.getElementById("proposer").submit()'>
        <option value="0">Choisissez</option>
      <?php $parcours=$proposeManager->getListeVilleDepart();
            foreach ($parcours as $ville): ?>
        <option value="<?php echo $ville->getVilNum(); ?>"><?php echo $ville->getVilNom(); ?></option>
      <?php endforeach; ?>
    </select>
  </form>

<?php endif; ?>

<?php if (!empty($_POST["depart"])): ?>
  <form id="trajet" action="#" method="post">
    <div class="gauche">
      <p id="villeDepart">Ville de départ : <?php echo $villeManager->getVil($_POST["depart"]); ?></p><br>

      <?php date_default_timezone_set("Europe/Amsterdam");?>
      <label for="dateDepart">Date de départ : </label>
    <input type="date" name="dateDepart" value="<?php $dateDepart=date("Y-m-d"); echo $dateDepart; ?>"><br>

      <label for="places">Nombre de places : </label>
      <input type="number" name="places" required>
    </div>

    <div class="droite">
      <label for="arrivee">Ville d'arrivée : </label>
      <select name="arrivee">
        <?php $listeVille=$proposeManager->getListeVilleArrivee($_POST["depart"]);
              foreach ($listeVille as $ville): ?>
          <option value="<?php echo $ville->getVilNum(); ?>"><?php echo $ville->getVilNom(); ?></option>
        <?php endforeach; ?>
      </select><br>

      <label for="heureDepart">Heure de départ : </label>
      <input type="time" name="heureDepart" value="<?php $horaireDepart=date("H:i:s"); echo $horaireDepart; ?>">
    </div><br>

    <input type="submit" value="Valider">
  </form>
  <?php $_SESSION['depart']=$_POST["depart"]; ?>
<?php endif; ?>

<?php if (!empty($_SESSION['depart']) && !empty($_POST["arrivee"])):
  $trajet=new Propose($_POST);
  $trajet->setParNum($proposeManager->getParNum($_SESSION['depart'],$_POST["arrivee"]));
  // !!!! $_SESSION
  $trajet->setPerNum(1);
  $trajet->setProSens($proposeManager->getSensTrajet($_SESSION['depart']));
  if ($proposeManager->existe($trajet)==0) {
    $proposeManager->ajouter($trajet);?>
    <img src="image/valid.png" alt="Valid"> Votre proposition a été prise en compte
  <?php
  } else{?>
    <img src="image/erreur.png" alt="Erreur"> Votre proposition a déjà été enregistré
  <?php }?>

<?php endif; ?>
