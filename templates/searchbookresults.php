<h1>Recherche</h1>
<div class="content-centered large centered">
    <p class="centered">
        Plongez dans notre univers littéraire et découvrez une sélection de livres captivants pour tous les goûts.
        Utilisez notre fonction de recherche intuitive pour trouver rapidement votre prochaine lecture préférée.
    </p>
    <form>
        <input type="search" name="q" placeholder="Rechercher" value="<?=htmlspecialchars($currentSearch)?>" class="big-search-bar"/>
        <select name="mode" class="big-search-select">
            <option value="all">Tout</option>
            <option value="book" selected="selected">Livre</option>
            <option value="author">Auteur</option>
            <option value="theme">Thème</option>
        </select>
    </form>
</div>
<section class="results books centered">
    <h2>Résulats pour "<?=htmlspecialchars($currentSearch)?>"</h2>
    <ul class="centered">
        <?php foreach ($books as $book): ?>
            <li class="bookSearch">
                <a href="book/<?=$book->getGId()?>">
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
            <a href="<?=htmlspecialchars($prev)?>" class="button">Page précédente</a>
        <?php endif; ?>
        <?php if (!empty($next)): ?>
            <a href="<?=htmlspecialchars($next)?>" class="button">Page suivante</a>
        <?php endif; ?>
    </div>
</section>