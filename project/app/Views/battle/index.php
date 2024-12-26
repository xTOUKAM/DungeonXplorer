<?php include('../templates/header.php'); ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <h1>Combat</h1>
        <h2>Héros : <?= $hero->name ?> (PV : <?= $hero->pv ?>)</h2>
        <h2>Monstre : <?= $monster->name ?> (PV : <?= $monster->pv ?>)</h2>
        <p>Vous affrontez un <?= htmlspecialchars($battle->monster_name) ?> !</p>

        <div>
            <h3>Journal de Combat :</h3>
            <ul>
                <?php foreach ($result as $log): ?>
                    <li><?= $log ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <form action="/battle/result" method="POST">
            <div class="form-group">
                <label for="action">Choisissez votre action</label>
                <select class="form-control" id="action" name="action" required>
                    <option value="attack">Attaque Physique</option>
                    <option value="magic">Attaque Magique</option>
                    <option value="potion">Utiliser une Potion</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Exécuter</button>
        </form>
    </div>
</div>
<?php include('../templates/footer.php'); ?>
