<h1>Recherche</h1>
<div class="content-centered large centered">
    <p class="centered">
        Plongez dans notre univers littéraire et découvrez une sélection de livres captivants pour tous les goûts.
        Utilisez notre fonction de recherche intuitive pour trouver rapidement votre prochaine lecture préférée.
    </p>
    <form>
        <input type="search" name="q" placeholder="Rechercher" value="<?=htmlspecialchars($currentSearch)?>" class="big-search-bar">
        <select name="mode" class="big-search-select">
            <option value="all">Tout</option>
            <option value="book">Livre</option>
            <option value="author" selected>Auteur</option>
            <option value="theme">Thème</option>
        </select>
    </form>
</div>
<section class="results authors centered">
    <h2>Résulats pour "<?=htmlspecialchars($currentSearch)?>"</h2>
    <ul class="centered">
        <?php foreach ($authors as $bookAuthor): ?>
            <li class="vertical">
                <a href="author/<?=$bookAuthor->getName()?>">
                    <img src="<?= $bookAuthor->getPictureUrl() ?>"/>
                </a>
                <a href="author/<?=$bookAuthor->getName()?>"><?=$bookAuthor->getName()?></a>
            </li>
        <?php endforeach ?>
    </ul>
</section>