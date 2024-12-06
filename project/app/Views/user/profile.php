<?php include(__DIR__ . '/../templates/header.php'); ?>
<div class="profile-container">
    <h1>Bienvenue, <?= isset($user['user_name']) ? htmlspecialchars($user['user_name']) : 'Utilisateur' ?></h1>
    <div class="profile-actions">
        <a href="/project/public/hero/create" class="button">Créer un Héros</a>
        <a href="/project/public/logout" class="button danger">Déconnexion</a>
    </div>
    <h2>Vos Héros</h2>
    <table class="heroes-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Classe</th>
                <th>Niveau</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($heroes) && !empty($heroes)): ?>
                <?php foreach ($heroes as $hero): ?>
                    <tr>
                        <td><?= htmlspecialchars($hero->name ?? 'Nom non disponible') ?></td>
                        <td><?= htmlspecialchars($hero->class_id == 1 ? 'Guerrier' : ($hero->class_id == 2 ? 'Voleur' : 'Magicien')) ?></td>
                        <td><?= htmlspecialchars($hero->current_level ?? 'Niveau non disponible') ?></td>
                        <td>
                            <a href="/project/public/hero/stats/<?= htmlspecialchars($hero->hero_id ?? 0) ?>" class="button info">Voir</a>
                            <?php if (Quest::isActive($hero->hero_id)): ?>
                                <a href="/project/public/quest/progress?quest_id=<?= htmlspecialchars(Quest::getActiveQuestId($hero->hero_id)) ?>" class="button secondary">Continuer la Quête</a>
                            <?php else: ?>
                                <a href="/project/public/quest/start?hero_id=<?= htmlspecialchars($hero->hero_id ?? 0) ?>" class="button primary">Commencer une Quête</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Pas de héros trouvés</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>
