<?php include(__DIR__ . '/../templates/header.php'); ?>
<div class="hero-details-container">
    <h1 class="hero-name"><?= htmlspecialchars($hero->name) ?></h1>
    <div class="hero-stats">
        <p><strong>Classe :</strong> <?= htmlspecialchars($hero->class_id == 1 ? 'Guerrier' : ($hero->class_id == 2 ? 'Voleur' : 'Magicien')) ?></p>
        <p><strong>Niveau :</strong> <?= htmlspecialchars($hero->current_level) ?></p>
        <p><strong>Points de vie :</strong> <?= htmlspecialchars($hero->pv) ?></p>
        <p><strong>Mana :</strong> <?= htmlspecialchars($hero->mana) ?></p>
        <p><strong>Force :</strong> <?= htmlspecialchars($hero->strength) ?></p>
        <p><strong>Initiative :</strong> <?= htmlspecialchars($hero->initiative) ?></p>
        <p><strong>Armure :</strong> <?= htmlspecialchars($hero->armor ?? 'Aucune') ?></p>
        <p><strong>Arme principale :</strong> <?= htmlspecialchars($hero->primary_weapon ?? 'Aucune') ?></p>
        <p><strong>Arme secondaire :</strong> <?= htmlspecialchars($hero->secondary_weapon ?? 'Aucune') ?></p>
        <p><strong>Bouclier :</strong> <?= htmlspecialchars($hero->shield ?? 'Aucun') ?></p>
        <p><strong>Liste des sorts :</strong> <?= htmlspecialchars($hero->spell_list ?? 'Aucune') ?></p>
        <p><strong>Biographie :</strong> <?= htmlspecialchars($hero->biography ?? 'Pas de biographie') ?></p>
        <p><strong>XP :</strong> <?= htmlspecialchars($hero->xp) ?></p>
        <p><strong>Niveau actuel :</strong> <?= htmlspecialchars($hero->current_level) ?></p>
    </div>
    <a href="/project/public/profile" class="button secondary">Retour au profil</a>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>
