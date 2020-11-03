
<h1>Proposer un trajet</h1>

<?php //if (condition): ?>
  <form id="proposer" action="#" method="post">
    <label for="depart">Ville de départ : </label>
    <select name="depart" onChange='javascript:document.getElementById("proposer").submit()'>
        <option value="0">Choisissez</option>
      <?php foreach ($variable as $key => $value): ?>
        <option value="<?php  ?>"><?php  ?></option>
      <?php endforeach; ?>
    </select>
  </form>

<?php //endif; ?>

<?php //if (condition): ?>
  <form id="trajet" action="#" method="post">
    <div class="gauche">
      <p>Ville de départ : <?php  ?></p><br>

      <label for="date_depart">Date de départ : </label>
      <input type="date" name="date_depart" value="<?php  ?>"><br>

      <label for="places">Nombre de places : </label>
      <input type="number" name="places">
    </div>
    <div class="droite">
      <label for="arrivee">Ville d'arrivée : </label>
      <select name="arrivee">
        <?php foreach ($variable as $key => $value): ?>
          <option value="<?php  ?>"><?php  ?></option>
        <?php endforeach; ?>
      </select><br>

      <label for="heure_depart">Heure de départ : </label>
      <input type="time" name="heure_depart" value="<?php  ?>">
    </div><br>

    <input type="submit" value="Valider">
  </form>

<?php //endif; ?>
