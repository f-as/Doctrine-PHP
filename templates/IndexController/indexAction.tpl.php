<?php
// var_dump($tag);
// echo '<hr>';
// var_dump($tags);
// echo '<hr>';
// var_dump($tagOne);
// echo '<hr>';
// var_dump($tagsAll);

foreach($articles as $a) : ?>
<article>
    <h1><?= $a->getTitle(); ?></h1>
    <div class="teaser"><?= $a->getTeaser(); ?></div>
    <div class="links">
        [<a href="index.php?action=read&id=<?= $a->getId(); ?>">Details</a>]
        [<a href="index.php?action=edit&id=<?= $a->getId(); ?>">Edit</a>]
        [<a href="index.php?action=delete&id=<?= $a->getId(); ?>">Delete</a>]
    </div>
    <footer>
        Erstellt am
        <time><?= $a->getCreatedAt()->format('d.m.Y H:i'); ?></time>
        von <?= $a->getUser(); ?> <br>
        Tags: <?= implode(' ', $a->getTags()->toArray()); ?>
    </footer>
</article>
<hr>
<?php endforeach; ?>
