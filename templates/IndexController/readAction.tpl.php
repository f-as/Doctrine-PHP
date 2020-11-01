<article>
    <header>
        <h1><?= $article->getTitle(); ?></h1>
    </header>
    <div class="text"><?= nl2br($article->getNews()); ?></div>
    <div class="links">
        [<a href="index.php?action=edit&id=<?= $article->getId(); ?>">Edit</a>]
        [<a href="index.php?action=delete&id=<?= $article->getId(); ?>">Delete</a>]
    </div>
    <footer>
        Erstellt am
        <time><?= $article->getCreatedAt()->format('d.m.Y H:i'); ?></time>
        von <?= $article->getUser(); ?><br>
        Tags:
        <?php foreach($article->getTags() as $tag) : ?>
            <a href="index.php?controller=tag&action=read&id=<?= $tag->getId(); ?>"><?= $tag; ?></a>
        <?php endforeach; ?>
    </footer>
</article>
