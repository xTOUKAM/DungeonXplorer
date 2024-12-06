<?php include(__DIR__ . '/../templates/header.php'); ?>
<div class="quest-progress-container">
    <h2 class="quest-title">Progression de la Quête</h2>
    <p class="quest-info"><strong>Chapitre actuel :</strong> <?= htmlspecialchars($quest->chapter_id) ?></p>
    <p class="quest-info"><strong>Contenu :</strong> <?= nl2br(htmlspecialchars($chapter->content ?? 'Contenu non disponible')) ?></p>
    <div class="next-chapters">
        <?php if (isset($nextChapters) && !empty($nextChapters)): ?>
            <?php foreach ($nextChapters as $nextChapter): ?>
                <a href="/project/public/quest/progress?chapter_id=<?= htmlspecialchars($nextChapter->next_chapter_id) ?>" class="button"><?= htmlspecialchars($nextChapter->description) ?></a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-next-chapter">Aucun chapitre suivant disponible.</p>
        <?php endif; ?>
    </div>
</div>
<?php include(__DIR__ . '/../templates/footer.php'); ?>
