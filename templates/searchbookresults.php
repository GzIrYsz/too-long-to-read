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
            <option value="book" selected>Livre</option>
            <option value="author">Auteur</option>
            <option value="theme">Thème</option>
        </select>
    </form>
</div>
<section>
    <h2>Résulats pour "<?=$currentSearch?>"</h2>
    <div>
        <?php foreach ($books as $book): ?>
            <div class="bookSearch">
                <a href="book/<?=$book->getGId()?>">
                    <img src="<?= $book->getCoverUrl() ?>"/>
                </a>
                <div>
                    <a href="book/<?= $book->getGId() ?>"><?= $book->getTitle() ?></a>
                    <?php foreach ($book->getAuthors() as $author): ?>
                        <a href="author/<?= $author ?>"><?= $author ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>