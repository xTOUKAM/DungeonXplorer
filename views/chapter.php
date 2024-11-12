<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chapitre <?php echo isset($chapter['id']) ? htmlspecialchars($chapter['id']) : 'Inconnu'; ?></title>
</head>
<body>
    <?php if ($chapter): ?>
        <h2>Chapitre <?php echo htmlspecialchars($chapter['id']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($chapter['content'])); ?></p>
        
        <?php if (!empty($chapter['image'])): ?>
            <img src="images/<?php echo htmlspecialchars($chapter['image']); ?>" alt="Illustration du chapitre <?php echo htmlspecialchars($chapter['id']); ?>">
        <?php endif; ?>

        <!-- Boutons de choix dynamiques -->
        <form method="GET" action="/DungeonXplorer/index.php">
            <input type="hidden" name="controller" value="ChapterController">
            <input type="hidden" name="action" value="choose">
            <input type="hidden" name="currentChapterId" value="<?php echo htmlspecialchars($chapter['id']); ?>">
            
            <!-- Boutons de choix pour les options -->
            <button type="submit" name="choice" value="1">Choix 1</button>
            <button type="submit" name="choice" value="2">Choix 2</button>
        </form>
    <?php else: ?>
        <p>Chapitre introuvable.</p>
    <?php endif; ?>
</body>
</html>
