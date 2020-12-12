<h1>Modifier une personne</h1>

<?php if (!empty($_POST["submitEtudiant"]) || !empty($_POST["submitSalarie"])):
  $personneManager->modifierDetails(new Personne($_POST)); ?>
  <?php
  if ($personneManager->getEtudiant($_SESSION['idModifier'])!=null) {
    if (!empty($_POST["submitSalarie"])) {
      $etudiantManager->supprimerById($_SESSION['idModifier']);
      $salarieManager->ajouter(new Salarie(array('sal_telprof'=>$_POST['sal_telprof'],'fon_num'=>$_POST['fon_num'],'per_num'=>$_SESSION['idModifier'])));
    }else {
      $etudiantManager->modifierDetails(new Etudiant(array('div_num'=>$_POST['div_num'],'dep_num'=>$_POST['dep_num'],'per_num'=>$_SESSION['idModifier'])));
    }
  }

  if ($personneManager->getEtudiant($_SESSION['idModifier'])==null) {
    if (!empty($_POST["submitEtudiant"])) {
      $salarieManager->supprimerById($_SESSION['idModifier']);
      $etudiantManager->ajouter(new Etudiant(array('div_num'=>$_POST['div_num'],'dep_num'=>$_POST['dep_num'],'per_num'=>$_SESSION['idModifier'])));
    }else {
      $salarieManager->modifierDetails(new Salarie(array('sal_telprof'=>$_POST['sal_telprof'],'fon_num'=>$_POST['fon_num'],'per_num'=>$_SESSION['idModifier'])));
    }
  }
  ?>
  <img src="image/valid.png" alt="Valider"> Le compte a été bien modifié<br><br>
<?php endif; ?>

<?php if (empty($_GET["id"])): ?>
<?php $listePersonnes = $personneManager->getAllPersonne();?>
  <table>
    <thead><tr><th></th><th>Numéro</th><th>Nom</th><th>Prénom</th></tr></thead>

    <tbody>
    <?php foreach ($listePersonnes as $personne): ?>
      <tr>
        <td>
          <a href="index.php?page=3&id=<?php echo $personne->getPerNum(); ?>" ><img src="image/modifier.png" alt="Modifier"></a>
        </td>
        <td>
          <?php echo $personne->getPerNum(); ?>
        </td>
        <td><?php echo $personne->getPerNom(); ?></td>
        <td><?php echo $personne->getPerPrenom(); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>

  </table>
<?php endif; ?>

<?php if (!empty($_GET["id"]) && empty($_POST["submitModificationDetails"])): ?>
  <?php $personne = $personneManager->getDetailPersonneById($_GET["id"]); ?>
  <form name="formulaire_personne" action="#" method="post">
    <div id="ajouter_personne">

      <div class="left">
        <div class="etiquette">
            <label for="per_nom">Nom : </label>
            <label for="per_tel">Téléphone : </label>
            <label for="per_login">Login : </label>
        </div>
        <div class="champ">
          <input type="text" id="per_nom" name="per_nom" value="<?php echo $personne->getPerNom(); ?>"pattern="[A-zÀ-ú]*-?[A-zÀ-ú]*" required>
          <input type="tel" id="per_tel" name="per_tel" value="<?php echo $personne->getPerTel(); ?>" minlength="10" maxlength="10" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" required>
          <input type="text" id="per_login" name="per_login" value="<?php echo $personne->getPerLogin(); ?>" required>
        </div>
      </div>

      <div class="right">
        <div class="etiquette">
          <label for="per_prenom">Prénom : </label>
          <label for="per_mail">Mail : </label>
          <label for="per_pwd">Password : </label>
        </div>
        <div class="champ">
          <input type="text" id="per_prenom" name="per_prenom" value="<?php echo $personne->getPerPrenom(); ?>" pattern="[A-zÀ-ú]*-?[A-zÀ-ú]*" required>
          <input type="email" id="per_mail" name="per_mail" value="<?php echo $personne->getPerMail(); ?>" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
          <input type="password" id="per_pwd" name="per_pwd">
        </div>
      </div>
    </div>

    <span>Catégorie : </span>

    <?php if ($personneManager->getEtudiant($_GET["id"])!=null) {
      $checkEtudiant = "checked";
      $checkSalarie = "";
    }else {
      $checkEtudiant = "";
      $checkSalarie = "checked";
    } ?>

    <input type="radio" id="etudiant" name="personne" value="etudiant" required <?php echo $checkEtudiant; ?>>
    <label for="etudiant">Etudiant</label>

    <input type="radio" id="personnel" name="personne" value="personnel" <?php echo $checkSalarie; ?>>
    <label for="personnel">Personnel</label><br><br>

    <input type="reset" value="Annuler">
    <input type="submit" name="submitModificationDetails" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_POST["submitModificationDetails"])): ?>
  <?php
  $personneModifie=new Personne($_POST);
  $personneModifie->setPerNum($_GET["id"]);
  if ($_POST["per_pwd"]=="") {
    $personneModifie->setPerPwd("");
  }
  $personneManager->modifierDetails($personneModifie);
  ?>
<?php endif; ?>

<?php if (!empty($_POST["personne"]) && $_POST["personne"]=="etudiant"): ?>
  <form action="index.php?page=3" method="post">
    <?php  $etudiantExistant=$personneManager->getEtudiant($_GET["id"]); $_SESSION['idModifier']=$_GET['id'];?>
    <label for="div_num">Année : </label>
    <select id="div_num" name="div_num">
      <?php $divisions=$divisionManager->getAllDivision();
      foreach ($divisions as $division ): ?>
        <?php
        if ($etudiantExistant!=null && $division->getDivNum()==$etudiantExistant->getDivNum()){
          $default="selected";
        } else {
          $default="";
        }?>
        <option value="<?php echo $division->getDivNum(); ?>" <?php echo $default; ?>><?php echo $division->getDivNom(); ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <label for="dep_num">Département : </label>
    <select id="dep_num" name="dep_num">
      <?php $departements=$departementManager->getAllDepartement();
      foreach ($departements as $departement): ?>
        <?php
        if ($etudiantExistant!=null && $departement->getDepNum()==$etudiantExistant->getDepNum()){
          $default="selected";
        } else {
          $default="";
        }?>
        <option value="<?php echo $departement->getDepNum(); ?>" <?php echo $default; ?>><?php echo $departement->getDepNom();?> (<?php echo $villeManager->getVil($departement->getVilNum()); ?>)</option>
      <?php endforeach; ?>
    </select><br><br>

    <input type="submit" name="submitEtudiant" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_POST["personne"]) && $_POST["personne"]=="personnel"): ?>
  <form action="index.php?page=3" method="post">
    <?php  $salarieExistant=$personneManager->getSalarie($_GET["id"]); $_SESSION['idModifier']=$_GET['id'];?>
    <label for="sal_telprof">Téléphone professionnel : </label>
    <?php if ($salarieExistant!=null) {
      $value=$salarieExistant->getTelProf();
    } ?>
    <input id="sal_telprof" type="tel" name="sal_telprof" minlength="10" maxlength="10" value="<?php echo $value; ?>" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" required><br><br>

    <label for="fon_num">Fonction : </label>
    <select id="fon_num" name="fon_num">
      <?php $fonctions=$fonctionManager->getAllFonction();
      foreach ($fonctions as $fonction): ?>
        <?php
        if ($salarieExistant!=null && $fonction->getFonNum()==$salarieExistant->getFonNum()){
          $default="selected";
        } else {
          $default="";
        }?>
        <option value="<?php echo $fonction->getFonNum(); ?>" <?php echo $default; ?>><?php echo $fonction->getFonLibelle(); ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <input type="submit" name="submitSalarie" value="Valider">
  </form>
<?php endif; ?>
