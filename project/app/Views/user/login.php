<?php include(__DIR__ . '/../templates/header.php'); ?>
<div class="login-container">
    <h2>Connexion</h2>
    <?php if (isset($error)): ?>
        <div class="error-message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="/project/public/login" method="POST">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button">Se connecter</button>
    </form>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>
