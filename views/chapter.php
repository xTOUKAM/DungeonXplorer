<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Chapitre <?php echo $chapter['id']; ?></title>
</head>
<body>
    <h2>Chapitre <?php echo $chapter['id']; ?></h2>
    <p><?php echo nl2br($chapter['content']); ?></p>
    <?php if ($chapter['image']): ?>
        <img src="images/<?php echo htmlspecialchars($chapter['image']); ?>" alt="Illustration du chapitre">
    <?php endif; ?>

    <!-- Boutons de choix -->
    <form method="POST" action="/DungeonXplorer/ChapterController/choose">
        <input type="hidden" name="currentChapterId" value="<?php echo $chapter['id']; ?>">
        <button type="submit" name="choice" value="choix1">Choix 1</button>
        <button type="submit" name="choice" value="choix2">Choix 2</button>
    </form>
</body>
</html>
