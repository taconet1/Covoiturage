<?php include_once("include/functions.inc.php"); ?>

<h1>Rechercher un trajet</h1>

<?php if (empty($_POST["ville_depart"]) && empty($_POST["arrivee"])): ?>
  <form id="recherche" action="#" method="post">
    <label for="ville_depart">Ville de départ : </label>
    <?php $recherche=$proposeManager->getListeVilleDepartDeLaRecherche();?>
    <select name="ville_depart" onChange='javascript:document.getElementById("recherche").submit()';>
        <option value="0">Choisissez</option>
      <?php foreach ($recherche as $ville): ?>
        <option value="<?php echo $ville->getVilNum(); ?>"><?php echo $ville->getVilNom(); ?></option>
      <?php endforeach; ?>
    </select>
  </form>
<?php endif; ?>


<?php if (!empty($_POST["ville_depart"])): $_SESSION["ville_depart"]=$_POST["ville_depart"];?>
  <form id="trajet" action="#" method="post">
    <div class="gauche">
      <p>Ville de départ : <?php echo $villeManager->getVil($_POST["ville_depart"]); ?></p><br>

      <label for="date_depart">Date de départ : </label>
      <input type="date" name="date_depart" value="<?php $dateDepart=date("Y-m-d"); echo $dateDepart; ?>"><br>

      <label for="heure">A partir de : </label>
      <select name="heure">
        <?php for($i=0; $i < 24; $i++): ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?>h</option>
        <?php endfor; ?>
      </select>
    </div>

    <div class="droite">
      <label for="arrivee">Ville d'arrivée : </label>
      <select name="arrivee">
        <?php $villes=$proposeManager->getListeVilleArrivee($_POST["ville_depart"]); ?>
        <?php foreach ($villes as $ville): ?>
          <option value="<?php echo $ville->getVilNum(); ?>"><?php echo $ville->getVilNom(); ?></option>
        <?php endforeach; ?>
      </select><br>

      <label for="precision">Précision : </label>
      <select name="precision">
          <option value="0">Ce jour</option>
        <?php for ($i=1;$i<=3;$i++) : ?>
          <option value="<?php echo $i; ?>"><?php echo "+/- ".$i." jour(s)"; ?></option>
        <?php endfor; ?>
      </select>
    </div><br>

    <input type="submit" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_SESSION["ville_depart"]) && !empty($_POST["arrivee"])): ?>
  <?php
    $parNum = $proposeManager->getParNum($_SESSION["ville_depart"],$_POST["arrivee"]);
    $dateDebut = date('Y-m-d', strtotime($_POST['date_depart']."-".$_POST['precision'].'days'));
    $dateFin = date('Y-m-d', strtotime($_POST['date_depart']."+".$_POST['precision'].'days'));
    $heureDepart = $_POST["heure"];
    $sens = $proposeManager->getSensTrajet($_SESSION["ville_depart"]);
    $infos = array('par_num' => $parNum,'dateDebut' => $dateDebut, 'dateFin' => $dateFin, 'heureDepart' => $heureDepart, 'pro_sens' => $sens);
    $trajets = $proposeManager->getAllTrajetsRecherches($infos);
  ?>

  <?php if (empty($trajets)): ?>
    <img src="image/erreur.png" alt="Erreur">
    <span>Désolé, pas de trajet disponible !</span>
  <?php endif; ?>

  <?php if (!empty($trajets)): ?>
    <table>
      <thead>
        <th>Ville départ</th>
        <th>Ville arrivée</th>
        <th>Date départ</th>
        <th>Heure départ</th>
        <th>Nombre de place(s)</th>
        <th>Nom du covoitureur</th>
      </thead>

      <tbody>
        <?php foreach ($trajets as $trajet): ?>
          <tr>
            <td><?php echo $villeManager->getVil($_SESSION["ville_depart"]); ?></td>
            <td><?php echo $villeManager->getVil($_POST["arrivee"]); ?></td>
            <td>
              <?php
                $date=getUnitedKingdomDate($trajet->getProDate());
                echo $date;
              ?>
            </td>
            <td><?php echo $trajet->getProTime(); ?></td>
            <td><?php echo $trajet->getProPlace(); ?></td>
            <td>
              <?php
                $moyenne=$avisManager->getMoyenneAvis($parNum, $trajet->getPerNum());
                $commentaire=$avisManager->getAvisCommentaire($parNum, $trajet->getPerNum());
                if ($moyenne==null || $commentaire==false) {
                  $moyenne="Aucune note";
                  $commentaire="Aucun commentaire";
                }
              ?>
              <a class="nomCovoit" title="<?php echo "Moyenne des avis : ".$moyenne."\nDernier avis : ".$commentaire; ?>">
                <?php $personne=$personneManager->getPrenomNom($trajet->getPerNum());
                      echo $personne[0]." ".$personne[1];
                ?>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
<?php endif; ?>
