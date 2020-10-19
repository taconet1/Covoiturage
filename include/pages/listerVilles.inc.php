<h1>Liste des villes</h1>
Actuellement <?php echo $villeManager->getNombreVille();?> villes sont enregistrées<br><br>
<table>
  <thead>
    <tr>
      <th>Numéro</th>
      <th>Nom</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $listeVilles = $villeManager->getAllVille();
    foreach ($listeVilles as $ville) {?>
      <tr>
        <td><?php echo $ville->getVilNum(); ?></td>
        <td><?php echo $ville->getVilNom(); ?></td>
      </tr>
    <?php }?>
  </tbody>
</table>
