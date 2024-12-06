<?php include('../templates/header.php'); ?>
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <h1>Résultat du Combat</h1>
        <p>Le combat est terminé. <?= htmlspecialchars($battle->result) ?></p>
        <a href="/profile" class="btn btn-primary">Retour au Profil</a>
        <a href="/quest/progress?quest_id=<?= htmlspecialchars($battle->quest_id) ?>" class="btn btn-secondary">Continuer la Quête</a>
    </div>
</div>
<?php include('../templates/footer.php'); ?>
