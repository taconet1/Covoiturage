<h1>Liste des villes</h1>

Actuellement <?php echo $villeManager->getNombreVille();?> ville(s) est/sont enregistrée(s)<br><br>

<table>
  <thead>
    <tr>
      <th>Numéro</th>
      <th>Nom</th>
    </tr>
  </thead>

  <tbody>
  <?php $listeVilles = $villeManager->getAllVille(); ?>
  <?php foreach ($listeVilles as $ville): ?>
    <tr>
      <td><?php echo $ville->getVilNum(); ?></td>
      <td><?php echo $ville->getVilNom(); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
