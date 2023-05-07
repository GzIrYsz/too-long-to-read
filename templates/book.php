<div class="two-cols">
    <img src="<?=$book->getCoverUrl()?>" alt="<?=$book->getTitle()?>'s cover" class="rounded centered"/>
    <div>
        <h1><?=$book->getTitle()?></h1>
        <div class="pad-large">
            <?php if (!empty($book->getSummary())): ?>
                <section>
                    <h2>Résumé</h2>
                    <p><?=$book->getSummary()?></p>
                </section>
            <?php endif; ?>
            <section>
                <h2>Caractéristiques</h2>
                <div class="features">
                    <?php if (!empty($book->getTheme(0))): ?>
                        <div class="vertical">
                            <span>Genre</span>
                            <span><?= $book->getTheme(0) ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($book->getReleaseDate())): ?>
                        <div class="vertical">
                            <span>Sortie</span>
                            <span><?= $book->getReleaseDate() ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($book->getPageCount())): ?>
                        <div class="vertical">
                            <span>Longueur</span>
                            <span><?= $book->getPageCount() ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($book->getLanguage())): ?>
                        <div class="vertical">
                            <span>Langue</span>
                            <span class="caps"><?= $book->getLanguage() ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
</div>