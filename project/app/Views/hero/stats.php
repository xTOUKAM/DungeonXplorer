<?php include('../templates/header.php'); ?>
<h1>Statistiques de <?= htmlspecialchars($hero->name) ?></h1>
<p>Classe : <?= htmlspecialchars($hero->class_id) == 1 ? 'Guerrier' : (htmlspecialchars($hero->class_id) == 2 ? 'Voleur' : 'Magicien') ?></p>
<p>PV : <?= htmlspecialchars($hero->pv) ?></p>
<p>Mana : <?= htmlspecialchars($hero->mana) ?></p>
<p>Force : <?= htmlspecialchars($hero->strength) ?></p>
<p>Initiative : <?= htmlspecialchars($hero->initiative) ?></p>
<a href="/quest/start" class="btn btn-primary">Commencer une Quête</a>
<?php include('../templates/footer.php'); ?>
