<?php if (empty($_SESSION['nomUtilisateur'])) {
    header('location: index.php');
} else {?>
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
        <label for="pro_date">Date de départ : </label>
        <input type="date" name="pro_date" value="<?php $dateDepart=date("Y-m-d"); echo $dateDepart; ?>"><br>

        <label for="pro_place">Nombre de places : </label>
        <input type="number" name="pro_place" required>
      </div>

      <div class="droite">
        <label for="arrivee">Ville d'arrivée : </label>
        <select name="arrivee">
          <?php $listeVille=$proposeManager->getListeVilleArrivee($_POST["depart"]);
                foreach ($listeVille as $ville): ?>
            <option value="<?php echo $ville->getVilNum(); ?>"><?php echo $ville->getVilNom(); ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="pro_time">Heure de départ : </label>
        <input type="time" name="pro_time" value="<?php $horaireDepart=date("H:i:s"); echo $horaireDepart; ?>">
      </div><br>

      <input type="submit" value="Valider">
    </form>
    <?php $_SESSION['depart']=$_POST["depart"]; ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['depart']) && !empty($_POST["arrivee"])):
    $trajet=new Propose($_POST);

    $trajet->setParNum($proposeManager->getParNum($_SESSION['depart'], $_POST["arrivee"]));
    $trajet->setPerNum($personneManager->getPerNum($_SESSION["nomUtilisateur"]));
    $trajet->setProSens($proposeManager->getSensTrajet($_SESSION['depart']));

    if ($proposeManager->existe($trajet)==false) {
      $estAjoute = $proposeManager->ajouter($trajet);
      if ($estAjoute==true) {?>
        <img src="image/valid.png" alt="Valid"> Votre proposition a été prise en compte
      <?php }
    } else{?>
      <img src="image/erreur.png" alt="Erreur"> Votre proposition a déjà été enregistré
    <?php }?>

  <?php endif; ?>

<?php }?>
