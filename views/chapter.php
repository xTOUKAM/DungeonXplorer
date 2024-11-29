<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chapitre <?php echo isset($chapter['chapter_id']) ? htmlspecialchars($chapter['chapter_id']) : 'Inconnu'; ?></title>
</head>
<body>
    <?php if ($chapter): ?>
        <h2>Chapitre <?php echo htmlspecialchars($chapter['chapter_id']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($chapter['content'])); ?></p>
        
        <?php if (!empty($chapter['image'])): ?>
            <img src="images/<?php echo htmlspecialchars($chapter['image']); ?>" alt="Illustration du chapitre <?php echo htmlspecialchars($chapter['chapter_id']); ?>">
        <?php endif; ?>

        <!-- Affichage des choix dynamiques pour ce chapitre -->
        <?php if (!empty($links)): ?>
            <form method="GET" action="/DungeonXplorer/index.php">
                <input type="hidden" name="controller" value="ChapterController">
                <input type="hidden" name="action" value="choose">
                <input type="hidden" name="currentChapterId" value="<?php echo htmlspecialchars($chapter['chapter_id']); ?>">

                <?php foreach ($links as $link): ?>
                    <button type="submit" name="link" value="<?php echo htmlspecialchars($link['links_id']); ?>">
                        <?php echo htmlspecialchars($link['description']); ?>
                    </button>
                <?php endforeach; ?>
            </form>
        <?php else: ?>
            <p>Aucun lien disponible pour ce chapitre.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Chapitre introuvable.</p>
    <?php endif; ?>
</body>
</html>
