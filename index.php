<?php
require_once("include/config.inc.php");
require_once("include/autoLoad.inc.php");
require_once("include/header.inc.php");

$pdo=new Mypdo();

$departementManager=new DepartementManager($pdo);
$divisionManager=new DivisionManager($pdo);
$etudiantManager=new EtudiantManager($pdo);
$fonctionManager=new FonctionManager($pdo);
$parcoursManager=new ParcoursManager($pdo);
$personneManager=new PersonneManager($pdo);
$proposeManager=new ProposeManager($pdo);
$salarieManager=new SalarieManager($pdo);
$villeManager=new VilleManager($pdo);

?>
<div id="corps">
<?php
require_once("include/menu.inc.php");
require_once("include/texte.inc.php");
?>
</div>

<div id="spacer"></div>
<?php
require_once("include/footer.inc.php"); ?>
