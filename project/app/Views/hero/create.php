<?php include(__DIR__ . '/../templates/header.php'); ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <h2>Créer un Héros</h2>
        <form action="/project/public/hero/create" method="POST">
            <div class="form-group">
                <label for="name">Nom du Héros</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="class_id">Classe</label>
                <select class="form-control" id="class_id" name="class_id" required>
                    <option value="1">Guerrier</option>
                    <option value="2">Voleur</option>
                    <option value="3">Magicien</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>
