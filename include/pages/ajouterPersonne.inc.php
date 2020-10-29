<?php if (empty($_POST["personne"])): ?>

  <h1>Ajouter une personne</h1>
  <form action="#" method="post">
    <div id="ajouter_personne">

      <div class="left">
        <div class="etiquette">
            <label for="per_nom">Nom : </label>
            <label for="per_tel">Téléphone : </label>
            <label for="per_login">Login : </label>
        </div>
        <div class="champ">
          <input type="text" id="per_nom" name="per_nom" required>
          <input type="tel" id="per_tel" name="per_tel" minlength="10" maxlength="10" required>
          <input type="text" id="per_login" name="per_login" required>
        </div>
      </div>

      <div class="right">
        <div class="etiquette">
          <label for="per_prenom">Prénom : </label>
          <label for="per_mail">Mail : </label>
          <label for="per_pwd">Password : </label>
        </div>
        <div class="champ">
          <input type="text" id="per_prenom" name="per_prenom" required>
          <input type="email" id="per_mail" name="per_mail" required>
          <input type="password" id="per_pwd" name="per_pwd" required>
        </div>
      </div>
    </div>

    <label for="personne">Catégorie : </label>
    <input type="radio" id="etudiant" name="personne" value="etudiant" required>
    <label for="etudiant">Etudiant</label>
    <input type="radio" id="personnel" name="personne" value="personnel">
    <label for="personnel">Personnel</label><br><br>
    <input type="submit" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_POST["personne"]) && $_POST["personne"]=="etudiant"): ?>

  <h1>Ajouter un étudiant</h1>

  <form action="index.php?page=1" method="post">
    <label for="annee">Année : </label>
    <select id="annee" name="annee">
      <?php $divisions=$divisionManager->getAllDivision();
      foreach ($divisions as $division ): ?>
        <option value="<?php echo $division->getDivNum(); ?>"><?php echo $division->getDivNom(); ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <label for="departement">Département : </label>
    <select id="departement" name="departement">
      <?php $departements=$departementManager->getAllDepartement();
      foreach ($departements as $departement): ?>
        <option value="<?php echo $departement->getDepNum(); ?>"><?php echo $departement->getDepNom();?> (<?php echo $villeManager->getVil($departement->getVilNum()); ?>)</option>
      <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="Valider">
  </form>
<?php endif; ?>

<?php if (!empty($_POST["personne"]) && $_POST["personne"]=="personnel"): ?>

  <h1>Ajouter un salarié</h1>

  <form action="index.php?page=1" method="post">
    <label for="telpro">Téléphone professionnel : </label>
    <input type="tel" name="telpro" minlength="10" maxlength="10" required><br><br>
    <label for="fonction">Fonction : </label>
    <select id="fonction" name="fonction">
      <?php $fonctions=$fonctionManager->getAllFonction();
      foreach ($fonctions as $fonction): ?>
          <option value="<?php echo $fonction->getFonNum(); ?>"><?php echo $fonction->getFonLibelle(); ?></option>
      <?php endforeach; ?>
    </select><br><br>
    <input type="submit" value="Valider">
  </form>
<?php endif; ?>

<?php
  if (!empty($_POST["personne"])){
    $personne=new Personne($_POST);
    $personneManager->ajouter($personne);
  }

  if (!empty($_POST["departement"]) && !empty($_POST["annee"])) {
    $infos=array("per_num"=>$pdo->lastInsertId(),"dep_num"=>$_POST["departement"],"div_num"=>$_POST["annee"]);
    $etudiant=new Etudiant($infos);
    $etudiantManager->ajouter($etudiant);
  }

  if (!empty($_POST["telpro"]) && !empty($_POST["fonction"])) {
    $infos=array("per_num"=>$pdo->lastInsertId(),"dep_num"=>$_POST["telpro"],"div_num"=>$_POST["fonction"]);
    $salarie=new Salarie($infos);
    $salarieManager->ajouter($salarie);
  }
?>
