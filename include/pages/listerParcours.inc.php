<h1> Liste des parcours proposés</h1>

<?php
$pdo = new Mypdo();

$parcoursManager = new ParcoursManager($pdo);


$total=$parcoursManager->nombre();
if ($total == 1) {?>
  Actuellement <?php echo $total?> parcours est enregistré
<?php }else{ ?>
  Actuellement <?php echo $total?> parcours sont enregistrés
<?php }?>

<table>
  <tr>
    <td>Numéro</td>
    <td>Nom ville</td>
    <td>Nom Ville</td>
    <td>Nombre de Km</td>
  </tr>
<?php
$parcours=$parcoursManager->getAllParcours();
foreach ($parcours as $par){ ?>
		<tr><td><?php echo $par['par_num'];?>
		</td><td><?php echo $par['ville1'];?>
		</td><td><?php echo $par['ville2'];?>
    </td><td><?php echo $par['par_km'];?>
		</td></tr>
	<?php }?>

</table>
