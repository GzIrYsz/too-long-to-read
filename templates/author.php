<div class="left-illustration">
    <img src="<?=$foundAuthor->getPictureUrl()?>" alt="<?=$foundAuthor->getName()?>'s picture" class="rounded"/>

    <div>
        <h1><?= $foundAuthor->getName() ?></h1>
        <p><?= $foundAuthor->getBio() ?></p>
    </div>
</div>
<section class="results centered large">
    <h2>Livres suggérés</h2>
    <ul>
        <?php foreach ($foundAuthor->getTrendyBooks() as $trendyBook): ?>
        <li class="vertical">
            <a href="/book/<?=$trendyBook->getGId()?>">
                <img src="<?= $trendyBook->getCoverUrl() ?>" alt="<?= $trendyBook->getTitle() ?>'s cover"/>
            </a>
            <a href="/book/<?=$trendyBook->getGId()?>"><?=$trendyBook->getTitle()?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>