<h1> Liste des parcours proposés</h1>

Actuellement <?php echo $parcoursManager->getNombreParcours();?> parcour(s) est/sont enregistré(s)<br><br>

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
  <?php $listeParcours=$parcoursManager->getAllParcours(); ?>
  <?php foreach ($listeParcours as $parcours): ?>
    <tr>
      <td><?php echo $parcours->getParNum();?></td>
      <td><?php echo $villeManager->getVille($parcours->getVilNum1());?></td>
      <td><?php echo $villeManager->getVille($parcours->getVilNum2());?></td>
      <td><?php echo $parcours->getParKm();?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
