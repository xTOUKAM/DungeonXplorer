<nav class="header">
    <h1>DungeonXplorer</h1>
    <ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="/project/public/profile">Profil</a></li>
            <li><a href="/project/public/logout">Déconnexion</a></li>
        <?php else: ?>
            <li><a href="/project/public/login">Connexion</a></li>
            <li><a href="/project/public/register">Inscription</a></li>
        <?php endif; ?>
    </ul>
</nav>
