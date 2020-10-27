<?php
require_once("include/config.inc.php");
require_once("include/autoLoad.inc.php");
require_once("include/header.inc.php");

$pdo=new Mypdo();
$villeManager=new VilleManager($pdo);
$parcoursManager=new ParcoursManager($pdo);
$personneManager=new PersonneManager($pdo);
$divisionManager=new DivisionManager($pdo);
$departementManager=new DepartementManager($pdo);
$etudiantManager=new EtudiantManager($pdo);
$salarieManager=new SalarieManager($pdo);

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
