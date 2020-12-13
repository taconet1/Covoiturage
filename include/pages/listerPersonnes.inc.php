<?php if (empty($_GET['id'])): ?>
  <h1>Liste des personnes enregistrées</h1>

  Actuellement <?php echo $personneManager->getNombrePersonne(); ?> personnes enregistrées<br><br>

  <?php $listePersonnes = $personneManager->getAllPersonne();?>
    <table>
      <thead>
        <tr>
          <th>Numéro</th>
          <th>Nom</th>
          <th>Prénom</th>
        </tr>
      </thead>

      <tbody>
      <?php foreach ($listePersonnes as $personne): ?>
        <tr>
          <td>
            <a href="index.php?page=2&id=<?php echo $personne->getPerNum(); ?>" >
              <?php echo $personne->getPerNum(); ?>
            </a>
          </td>
          <td><?php echo $personne->getPerNom(); ?></td>
          <td><?php echo $personne->getPerPrenom(); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>

    </table>
<?php endif; ?>


<?php if (!empty($_GET['id'])):?>
  <?php if (!empty($etudiantManager->getEtudiant($_GET['id']))): $personne=$etudiantManager->getEtudiant($_GET['id']);?>
  <h1>Détail sur l'étudiant <?php echo $personne->getPerNom(); ?></h1>

  <table>
    <thead>
      <tr>
        <th>Prénom</th>
        <th>Mail</th>
        <th>Tel</th>
        <th>Département</th>
        <th>Ville</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><?php echo $personne->getPerPrenom(); ?></td>
        <td><?php echo $personne->getPerMail(); ?></td>
        <td><?php echo $personne->getPerTel(); ?></td>
        <td><?php echo $departementManager->getDep($personne->getDepNum()); ?></td>
        <td><?php echo $departementManager->getDepVil($personne->getDepNum()); ?></td>
      </tr>
    </tbody>
  </table>

  <?php else:
      $personne=$salarieManager->getSalarie($_GET['id']);?>
    <h1>Détail sur le salarié <?php echo $personne->getPerNom(); ?></h1>
    <table>
      <thead>
        <tr>
          <th>Prénom</th>
          <th>Mail</th>
          <th>Tel</th>
          <th>Tel pro</th>
          <th>Fonction</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $personne->getPerPrenom(); ?></td>
          <td><?php echo $personne->getPerMail(); ?></td>
          <td><?php echo $personne->getPerTel(); ?></td>
          <td><?php echo $personne->getTelProf(); ?></td>
          <td><?php echo $fonctionManager->getFon($personne->getFonNum()); ?></td>
        </tr>
      </tbody>
    </table>
  <?php endif; ?>
<?php endif; ?>
