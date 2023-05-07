<h1>Statistiques</h1>
<section class="large centered">
    <h2>Livres les plus consultés</h2>
    <figure>
        <svg viewBox="0 0 1000 500" class="chart">
            <?php for ($i = 0; $i < $barChart->getNbBars(); $i++): ?>
                <a href="/book/<?=$barChart->getBar($i)->getInfo()?>">
                    <rect x="<?=$i*((1000-(($barChart->getNbBars()+1)*10))/$barChart->getNbBars())+($i+1)*10?>"
                          y="<?=450-((450*$barChart->getBar($i)->getValue())/$barChart->getMaxValue())?>"
                          width="<?=(1000-(($barChart->getNbBars()+1)*10))/$barChart->getNbBars()?>"
                          height="<?=(450*$barChart->getBar($i)->getValue())/$barChart->getMaxValue()?>"
                          style="background-color: #0A0A0A"/>
                    <text x="<?=$i*((1000-(($barChart->getNbBars()+1)*10))/$barChart->getNbBars())+($i+1)*10?>"
                          y="480"
                          style="font-size: 1rem; text-overflow: ellipsis"><?=$barChart->getBar($i)->getLabel()?></text>
                </a>
            <?php endfor; ?>
        </svg>
        <figcaption>Graphique représentant le top 5 des livres les plus consultés sur le site</figcaption>
    </figure>
</section>
<section class="content-centered large centered">
    <h2>Nombre de visites du site</h2>
    <span>Jusqu'à ce jour, le site à été visité <?=$nbVisit?> fois.</span>
</section>