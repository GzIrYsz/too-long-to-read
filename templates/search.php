<section>
    <h1>Résulats : <?= $search ?></h1>
    <div>
        <?php foreach ($books as $book): ?>
        <div>
            <img src="<?= $book[''] ?>"/>
            <span><?= $book[] ?></span>
        </div>
        <?php endforeach ?>
    </div>
</section>