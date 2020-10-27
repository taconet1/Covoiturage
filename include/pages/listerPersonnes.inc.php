<h1>Liste des personnes enregistrées</h1>
Actuellement <?php echo $personneManager->getNombrePersonne(); ?> personnes enregistrées<br><br>
<?php
$listePersonnes = $personneManager->getAllPersonne();?>
<table>
  <thead>
    <th>Numéro</th>
    <th>Nom</th>
    <th>Prénom</th>
  </thead>
  <tbody>
<?php foreach ($listePersonnes as $personne) {?>
    <tr>
      <td>
        <a href="#" name="id_personne" method="post">
          <?php echo $personne->getPerNum(); ?>
        </a>
      </td>
      <td><?php echo $personne->getPerNom(); ?></td>
      <td><?php echo $personne->getPerPrenom(); ?></td>
    </tr>
<?php  }?>
  </tbody>
</table>
<?php if (!empty($_POST["id_personne"])): ?>
  <h1>Détail sur l'étudiant </h1>

<?php endif; ?>
