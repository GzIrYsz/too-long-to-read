<h1><?=$book->getTitle()?></h1>
<section>
    <img src="<?=$book->getCoverUrl()?>" alt="<?=$book->getTitle()?>'s cover"/>
    <h2>Résumé</h2>
    <p><?=$book->getSummary()?></p>
</section>