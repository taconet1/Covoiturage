<h1> Liste des parcours proposés</h1>

<?php
$total=$parcoursManager->nombre();
if ($total == 1) {?>
  Actuellement <?php echo $total?> parcours est enregistré<br><br>
<?php }else{ ?>
  Actuellement <?php echo $total?> parcours sont enregistrés<br><br>
<?php }?>

<table>
  <thead>
    <tr>
      <th>Numéro</th>
      <th>Nom ville</th>
      <th>Nom Ville</th>
      <th>Nombre de Km</th>
    </tr>
  </thead>

  <tbody>
  <?php $parcours=$parcoursManager->getAllParcours(); ?>
  <?php foreach ($parcours as $par): ?>
    <tr>
      <td><?php echo $par->getNumero();?></td>
      <td><?php echo $par->getVille1();?></td>
      <td><?php echo $par->getVille2();?></td>
      <td><?php echo $par->getKilometre();?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
