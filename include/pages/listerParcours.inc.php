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
    <th>Numéro</th>
    <th>Nom ville</th>
    <th>Nom Ville</th>
    <th>Nombre de Km</th>
  </thead>
  <tbody>
    <?php
    $parcours=$parcoursManager->getAllParcours();
    foreach ($parcours as $par){ ?>
    		<tr><td><?php echo $par['par_num'];?>
    		</td><td><?php echo $par['ville1'];?>
    		</td><td><?php echo $par['ville2'];?>
        </td><td><?php echo $par['par_km'];?>
    		</td></tr>
    	<?php }?>
  </tbody>
</table>
