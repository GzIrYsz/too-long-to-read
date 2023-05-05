<h1>Recherche</h1>
<div>
    <p>
        Plongez dans notre univers littéraire et découvrez une sélection de livres captivants pour tous les goûts.
        Utilisez notre fonction de recherche intuitive pour trouver rapidement votre prochaine lecture préférée.
    </p>
    <form>
        <input type="search" name="q" id="q" placeholder="Rechercher" value="<?=$currentSearch?>">
        <select name="mode" id="mode">
            <option value="all">Tout</option>
            <option value="book">Livre</option>
            <option value="author">Auteur</option>
            <option value="theme" selected>Thème</option>
        </select>
    </form>
</div>
<section>
    <h2>Résulats pour "<?=htmlspecialchars($currentSearch)?>"</h2>
    <ul>
        <?php foreach ($books as $book): ?>
            <li class="bookSearch">
                <a href="book/<?=$book->getGId()?>">
                    <img src="<?=$book->getCoverUrl()?>"/>
                </a>
                <div>
                    <a href="book/<?=$book->getGId()?>"><?=$book->getTitle()?></a>
                    <?php foreach ($book->getAuthors() as $author): ?>
                        <a href="author/<?=$author?>"><?=$author?></a>
                    <?php endforeach; ?>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
    <div>
        <?php if (!empty($prev)): ?>
            <a href="<?=$prev?>">Page précédente</a>
        <?php endif; ?>
        <?php if (!empty($next)): ?>
            <a href="<?=$next?>">Page suivante</a>
        <?php endif; ?>
    </div>
</section>