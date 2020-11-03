<h1>Rechercher un trajet</h1>

<?php //if (condition): ?>
  <form id="recherche" action="index.html" method="post">

  </form>
<?php //endif; ?>
<label for="ville_depart">Ville de départ : </label>
<select name="ville_depart" onChange='javascript:document.getElementById("recherche").submit()';>
    <option value="0">Choisissez</option>
  <?php foreach ($variable as $key => $value): ?>
    <option value="<?php  ?>"><?php  ?></option>
  <?php endforeach; ?>
</select>

<?php //if (condition): ?>
  <form id="trajet" action="#" method="post">
    <div class="gauche">
      <p>Ville de départ : <?php  ?></p><br>

      <label for="date_depart">Date de départ : </label>
      <input type="date" name="date_depart" value="<?php  ?>"><br>

      <label for="heure">A partir de : </label>
      <select name="heure">
        <option value="<?php  ?>"><?php  ?>h</option>
      </select>
    </div>
    <div class="droite">
      <label for="arrivee">Ville d'arrivée : </label>
      <select name="arrivee">
        <?php foreach ($variable as $key => $value): ?>
          <option value="<?php  ?>"><?php  ?></option>
        <?php endforeach; ?>
      </select><br>

      <label for="precision">Précision : </label>
      <select name="precision">
        <option value="0">Ce jour</option>
        <option value="<?php  ?>"><?php  ?> jour</option>
        <option value="<?php  ?>"><?php  ?> jours</option>
      </select>
    </div><br>

    <input type="submit" value="Valider">
  </form>
<?php //endif; ?>

<?php //if (condition): ?>
  <table>
    <thead>
      <th>Ville départ</th>
      <th>Ville arrivée</th>
      <th>Date départ</th>
      <th>Heure départ</th>
      <th>Nombre de place(s)</th>
      <th>Nom du covoitureur</th>
    </thead>

    <tbody>
      <tr>
        <td><?php  ?></td>
        <td><?php  ?></td>
        <td><?php  ?></td>
        <td><?php  ?></td>
        <td><?php  ?></td>
        <td><a href="" title=""><?php //Title c'est le hover pour faire apparaître la moyenne ?></a></td>
      </tr>
    </tbody>
  </table>
<?php //endif; ?>

<?php //if (condition): ?>
  <img src="image/erreur.png" alt="Erreur">
  <p>Désolé, pas de trajet disponible !</p>
<?php //endif; ?>
