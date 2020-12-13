<?php if (empty($_POST['personne'])): ?>
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
        <input type="text" id="per_nom" name="per_nom" pattern="[A-zÀ-ú]*-?[A-zÀ-ú]*" required>
        <input type="tel" id="per_tel" name="per_tel" minlength="10" maxlength="10" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" required>
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
        <input type="text" id="per_prenom" name="per_prenom" pattern="[A-zÀ-ú]*-?[A-zÀ-ú]*" required>
        <input type="email" id="per_mail" name="per_mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
        <input type="password" id="per_pwd" name="per_pwd" required>
      </div>
    </div>
  </div>

  <span>Catégorie : </span>
  <input type="radio" id="etudiant" name="personne" value="etudiant" required>
  <label for="etudiant">Etudiant</label>

  <input type="radio" id="personnel" name="personne" value="personnel">
  <label for="personnel">Personnel</label><br><br>

  <input type="submit" value="Valider">
</form>
<?php endif; ?>

<?php if (!empty($_POST['personne'])): ?>
  <?php if ($personneManager->existe($_POST['per_login'])!=false): ?>
    <h1>Ajouter une personne</h1>
    <img src="image/erreur.png" alt="Erreur"> Le login existe déjà
  <?php endif; ?>

  <?php if ($personneManager->existe($_POST['per_login'])==false):?>
    <?php if ($_POST['personne']=='etudiant'): ?>
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
            <option value="<?php echo $departement->getDepNum(); ?>"><?php echo $departement->getDepNom();?> (<?php echo $villeManager->getVille($departement->getVilNum()); ?>)</option>
          <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Valider">
      </form>
    <?php endif; ?>

    <?php if ($_POST['personne']=='personnel'): ?>
      <h1>Ajouter un salarié</h1>

      <form action="index.php?page=1" method="post">
        <label for="telpro">Téléphone professionnel : </label>
        <input id="telpro" type="tel" name="telpro" minlength="10" maxlength="10" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" required><br><br>

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
  <?php endif; ?>
<?php endif; ?>

<?php
  if (!empty($_POST['personne'])) {
    if ($personneManager->existe($_POST['per_login'])==false) {
      $personne=new Personne($_POST);
      $personneManager->ajouter($personne);
    }
  }
?>

<?php
  if (!empty($_POST['departement']) && !empty($_POST['annee'])) {
    $infos=array('per_num'=>$pdo->lastInsertId(),'dep_num'=>$_POST['departement'],'div_num'=>$_POST['annee']);
    $etudiant=new Etudiant($infos);
    $etudiantManager->ajouter($etudiant);
  }

  if (!empty($_POST['telpro']) && !empty($_POST['fonction'])) {
    $infos=array('per_num'=>$pdo->lastInsertId(),'sal_telprof'=>$_POST['telpro'],'fon_num'=>$_POST['fonction']);
    $salarie=new Salarie($infos);
    $salarieManager->ajouter($salarie);
  }
?>
