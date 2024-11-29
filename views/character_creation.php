<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un personnage</title> <!-- TODO : custom le titre de la page en fonction de la campagne choisie -->
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <!-- TODO : ajouter des controles en fonction de si utilisateur connecté ou non et si campagne déjà rejointe ou non -->
    <h2>Créez votre personnage !</h2>

    <!-- Formulaire de choix des informations -->
    <form method="GET" action="/DungeonXplorer/index.php">
        <label for="name">Nom de votre personnage :</label>
        <input type="hidden" name="controller" value="ChapterController">
        <input type="text" id="name" name="name" required minlength="1" maxlength="50" size="50" />
        
        <!-- TODO : ajouter un système de choix d'image après implémentation des BLOB pour les images -->

        <label for="class">Classe :</label>
        <select id="class" name="class">
            <option value="">CACA LOL</option> 
            <!-- TODO : remplir la liste avec l'ensemble des classes disponibles, éventuellement afficher des statistiques de classe -->
        </select>
        
        <label for="bio">Histoire :</label>
        <textarea id="bio" name="bio" rows="20" cols="50" placeholder="Par une nuit d'hiver, le jeune nain Pepito a décidé d'aller héradiquer les elfes pour voler tout leur or..."></textarea>

        
        <!-- Boutons de choix pour les options -->
        <button type="submit" name="choice" value="">Valider la création de votre personnage</button>
    </form>
    <p>Statistiques du CLASS_NAME au niveau 1 : X PV | Y Mana | Z Initiative | T Force</p>
    <!-- TODO : modifier la visibilité et les informations en fonction de la classe choisie dans la liste -->
</body>
</html>
