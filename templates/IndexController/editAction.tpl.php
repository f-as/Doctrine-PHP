<form action="index.php?action=<?= $action; ?>" method="post">
    <input type="hidden" name="id" value="<?= $article->getId(); ?>">
    <label for="title">Titel*</label>
    <input type="text" name="title" id="title" maxlength="80" value="<?= $article->getTitle(); ?>">
    <label for="tags">Tagging*</label>
    <select name="tags_id[]" id="tags" multiple="mulitple">
        <?php foreach($tags as $tag) : ?>
            <option value="<?= $tag->getId(); ?>"
            <?php if($article->hasTag($tag)): ?>
                selected="selected"
            <?php endif; ?>
                ><?= $tag; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="teaser">Teaser*</label>
    <input type="text" name="teaser" id="teaser" maxlength="255" value="<?= $article->getTeaser(); ?>">
    <label for="news">News*</label>
    <textarea name="news" id="news"><?= $article->getNews(); ?></textarea>
    <label for="publish_at">PublishAt</label>
    <input type="text" name="publish_at" id="publish_at" value="<?= $article->getPublishAt()->format('Y-m-d H:i:s'); ?>">
    <input type="submit" value="Abschicken">
</form>
