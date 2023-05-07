<h1>Recherche</h1>
<div class="content-centered large centered">
    <p class="centered">
        Plongez dans notre univers littéraire et découvrez une sélection de livres captivants pour tous les goûts.
        Utilisez notre fonction de recherche intuitive pour trouver rapidement votre prochaine lecture préférée.
    </p>
    <form>
        <input type="search" name="q" placeholder="Rechercher" value="<?=htmlspecialchars($currentSearch)?>" class="big-search-bar"/>
        <select name="mode" class="big-search-select">
            <option value="all" selected="selected">Tout</option>
            <option value="book">Livre</option>
            <option value="author">Auteur</option>
            <option value="theme">Thème</option>
        </select>
    </form>
</div>
<section class="results centered">
    <h2>Résulats pour "<?=htmlspecialchars($currentSearch)?>"</h2>
    <section class="results books centered">
        <h3>Livres</h3>
        <ul class="centered">
            <?php foreach ($books as $book): ?>
                <li>
                    <a href="book/<?=$book->getGId() ?>">
                        <img src="<?=htmlspecialchars($book->getCoverUrl())?>" alt="<?=$book->getTitle()?>'s cover"/>
                    </a>
                    <div class="vertical">
                        <a href="book/<?=$book->getGId()?>"><?=$book->getTitle()?></a>
                        <?php foreach ($book->getAuthors() as $author): ?>
                            <?php if (!empty($author)): ?>
                                <a href="author/<?=urlencode($author)?>"><?=$author?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="change-page">
            <?php if (!empty($prev)): ?>
                <a class="button" href="<?=htmlspecialchars($prev)?>">Page précédente</a>
            <?php endif; ?>
            <?php if (!empty($next)): ?>
                <a class="button" href="<?=htmlspecialchars($next)?>">Page suivante</a>
            <?php endif; ?>
        </div>
    </section>
    <section class="results authors centered">
        <h3>Auteurs</h3>
        <ul>
            <?php foreach ($booksAuthors as $bookAuthor): ?>
                <li class="vertical">
                    <a href="author/<?=urlencode($bookAuthor->getName())?>">
                        <img src="<?=htmlspecialchars($book->getCoverUrl())?>" alt="<?=$bookAuthor->getName()?>'s picture"/>
                    </a>
                    <a href="author/<?=urlencode($bookAuthor->getName())?>"><?=$bookAuthor->getName()?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </section>
</section>