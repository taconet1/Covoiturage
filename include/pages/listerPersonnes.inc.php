<?php if (!isset($_POST["personne"])): ?>
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
      <?php foreach ($listePersonnes as $personne): $i=0;?>
          <tr>
            <td>
              <a href="#" onclick='document.getElementById("form").submit();'>
                <input type="hidden" name="personne[]" value="<?php echo $personne->getPerNum(); ?>">
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

<?php if (isset($_POST["personne"])): var_dump($_POST["personne"])?>

<?php endif; ?>
<?php /*if (isset($id): ?>
  <?php if (!empty($personneManager->getEtudiant())):
    $personne=$personneManager->getEtudiant($_POST["personne[]"]);?>
    <h1>Détail sur l'étudiant <?php echo $personne->getPerNom(); ?></h1>
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
          <td><?php echo $personne->getPerPrenom(); ?></td>
          <td><?php echo $personne->getPerMail(); ?></td>
          <td><?php echo $personne->getPerTel(); ?></td>
          <td><?php echo $departementManager->getDep($personne->getDepNum()); ?></td>
          <td><?php echo $departementManager->getDepVil($personne->getDepNum()); ?></td>
        </tr>
      </tbody>
    </table>

  <?php else: */ $personne=$personneManager->getSalarie(1);?>
    <h1>Détail sur le salarié <?php echo $personne->getPerNom(); ?></h1>
    <table>
      <thead>
        <th>Prénom</th>
        <th>Mail</th>
        <th>Tel</th>
        <th>Tel pro</th>
        <th>Fonction</th>
      </thead>

      <tbody>
        <tr>
          <td><?php echo $personne->getPerPrenom(); ?></td>
          <td><?php echo $personne->getPerMail(); ?></td>
          <td><?php echo $personne->getPerTel(); ?></td>
          <td><?php echo $personne->getTelProf(); ?></td>
          <td></td>
        </tr>
      </tbody>
    </table>
<?php print($salarieManager->getSalFon($personne->getFonNum())); ?>

//récupérer $post ?
//getfonnum ne fonctionnepas
