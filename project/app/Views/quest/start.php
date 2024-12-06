<?php include('../templates/header.php'); ?>
<div class="quest-start-container">
    <h2 class="quest-title">Commencer une Quête</h2>
    <form action="/quest/start" method="POST" class="quest-form">
        <div class="form-group">
            <label for="hero_id">Choisir un Héros</label>
            <select id="hero_id" name="hero_id" required>
                <?php foreach ($heroes as $hero): ?>
                    <option value="<?= htmlspecialchars($hero->hero_id) ?>"><?= htmlspecialchars($hero->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="button">Commencer</button>
    </form>
</div>
<?php include('../templates/footer.php'); ?>
