<h1>Author</h1>
<section>
    <span><?=$foundAuthor->getName()?></span>
    <img src="<?=$foundAuthor->getPictureUrl()?>" alt="<?=$foundAuthor->getName()?>'s picture"/>
    <p><?=$foundAuthor->getBio()?></p>
</section>
<section>
    <h2>Livres suggérés</h2>
    <ul>
        <?php foreach ($foundAuthor->getTrendyBooks() as $trendyBook): ?>
        <li>
            <img src="<?=$trendyBook->getCoverUrl()?>" alt="<?=$trendyBook->getTitle()?>'s cover"/>
            <span><?=$trendyBook->getTitle()?></span>
        </li>
        <?php endforeach; ?>
    </ul>
</section>