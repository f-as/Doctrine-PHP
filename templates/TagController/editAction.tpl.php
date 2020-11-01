<form action="index.php?controller=tag&amp;action=<?= $action ?>" method="post">
    <input name="id" type="hidden" value="<?= $tag->getId() ?>"/>
    <label for="title">Title*</label>
    <input name="title" id="title" type="text" maxlength="80" value="<?= $tag->getTitle() ?>"/>
    <input type="submit" class="button" value="Abschicken" />
</form>


<ul>
<?php foreach($tags as $t) : ?>
    <li><?= $t->getTitle(); ?></li>
<?php endforeach; ?>
</ul>
