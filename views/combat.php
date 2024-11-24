<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
</head>
<body>
    <h1>Affichage des données</h1>

    <div class="container">
        <!-- Affichage des données du personnage -->
        <div class="card">
            <h2>Héros : <?= htmlspecialchars($personnage['name']) ?></h2>
            <p><strong>PV :</strong> <?= htmlspecialchars($personnage['pv']) ?></p>
            <p><strong>Mana :</strong> <?= $personnage['mana'] ?></p>
            <p><strong>Force :</strong> <?= $personnage['strength'] ?></p>
            <p><strong>Initiative :</strong> <?= $personnage['initiative'] ?></p>
        </div>

        <!-- Affichage des données du monstre -->
        <div class="card">
            <h2>Monstre : <?= htmlspecialchars($monstre['name']) ?></h2>
            <p><strong>PV :</strong> <?= htmlspecialchars($monstre['pv']) ?></p>
            <p><strong>Mana :</strong> <?= $monstre['mana'] ?></p>
            <p><strong>Force :</strong> <?= $monstre['strength'] ?></p>
            <p><strong>Initiative :</strong> <?= $monstre['initiative'] ?></p>
        </div>
    </div>
</body>
</html>
