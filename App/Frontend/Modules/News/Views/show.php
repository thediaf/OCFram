<p>Par <em><?= $new['author']?></em>, le <?= $news['dateAdd']->format('d/m/Y') ?></p>
<h2><?= $news['title'] ?></h2>
<p><?= nl2br($news['content']) ?></p>

<?php
    if ($news['dateAdd'] != $news['dateModif']) {?>
        <p style="text-align: right;"><small><em>Modifié le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
    <?php } ?>