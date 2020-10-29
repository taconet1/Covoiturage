<?php if (empty($_POST["id"])): ?>
  <h1>Liste des personnes enregistrées</h1>
  Actuellement <?php echo $personneManager->getNombrePersonne(); ?> personnes enregistrées<br><br>

  <?php $listePersonnes = $personneManager->getAllPersonne();?>
  <form id="form" action="#" method="post">
    <table>
      <thead>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Prénom</th>
      </thead>

      <tbody>
      <?php foreach ($listePersonnes as $personne): ?>
          <tr>
            <td>
              <a href="#" onclick='document.getElementById("form").submit()'>
                <input name="id" type="hidden" value="<?php echo $personne->getPerNum(); ?>">
                <?php echo $personne->getPerNum(); ?>
              </a>
            </td>
            <td><?php echo $personne->getPerNom(); ?></td>
            <td><?php echo $personne->getPerPrenom(); ?></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </form>
<?php endif; ?>


<?php if (!empty($_POST["id"])):
  $etudiant=$personneManager->getEtudiant($_POST["id"]); ?>
  <h1>Détail sur l'étudiant <?php echo $etudiant->getPerNom(); ?></h1>
  <table>
    <thead>
      <th>Prénom</th>
      <th>Mail</th>
      <th>Tel</th>
      <th>Département</th>
      <th>Ville</th>
    </thead>

    <tbody>
      <tr>
        <td><?php echo $etudiant->getPerPrenom(); ?></td>
        <td><?php echo $etudiant->getPerMail(); ?></td>
        <td><?php echo $etudiant->getPerTel(); ?></td>
        <td><?php echo $departementManager->getDep($etudiant->getDepNum()); ?></td>
        <td><?php echo $departementManager->getDepVil($etudiant->getDepNum()); ?></td>
      </tr>
    </tbody>
  </table>
<?php endif; ?>
