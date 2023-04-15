<h1>Book</h1>
<section>
    <span><?=$book->getTitle()?></span>
    <img src="<?=$book->getCoverUrl()?>" alt="<?=$book->getTitle()?>'s cover"/>
    <p><?=$book->getSummary()?></p>
</section>