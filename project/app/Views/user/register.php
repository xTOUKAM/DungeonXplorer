<?php include(__DIR__ . '/../templates/header.php'); ?>
<div class="register-container">
    <h2>Inscription</h2>
    <form action="/project/public/register" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button">S'inscrire</button>
    </form>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>