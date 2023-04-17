<h1>Recherche</h1>
<div>
    <p>
        Plongez dans notre univers littéraire et découvrez une sélection de livres captivants pour tous les goûts.
        Utilisez notre fonction de recherche intuitive pour trouver rapidement votre prochaine lecture préférée.
    </p>
    <form>
        <input type="search" name="q" id="q" placeholder="Rechercher" value="<?=$currentSearch?>">
    </form>
</div>
<section>
    <h2>Résulats : <?=$search?></h2>
    <div>
        <?php foreach ($books as $book): ?>
        <div>
            <img src="<?=$book->getCoverUrl()?>"/>
            <span><?=$book->getTitle()?></span>
        </div>
        <?php endforeach ?>
    </div>
</section>