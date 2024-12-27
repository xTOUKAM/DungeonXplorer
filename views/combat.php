<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>
    <link rel="stylesheet" href="../style/styleCombat.css">
</head>
<body>
    <h1>Affichage des données</h1>

    <main>
        <div id="perso"></div>
        <div id="monstre"></div>
    </main>

    <!-- Barre en bas avec les boutons -->
    <div class="actions-bar">
        <button id="bouton-phy">Physique</button>
        <button id="bouton-mag">Magique</button>
        <button id="bouton-popo">Potion</button>
    </div>

    <!-- menu pour la sélection des sorts -->
    <div id="spell-menu" class="menu">
        <div class="menu-content">
            <span class="close-button">&times;</span>
            <h3>Choisissez un sort</h3>
            <ul id="spell-list">
                <!-- Les sorts seront injectés ici dynamiquement -->
            </ul>
        </div>
    </div>


    <script src="../scripts/classes.js"></script>
    <script defer src="../scripts/combat.js"></script>
</body>
</html>

