<?php
require_once('inc/bootstrap.inc.php');

// use Entities\Tag;
// use Entities\User;
// use Entities\Article;

//use Entities\Tag, Entities\User, Entities\Article;

use Entities\{Tag, User, Article};

try {

    $em->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
    $em->getConnection()->query('TRUNCATE TABLE tags');
    $em->getConnection()->query('TRUNCATE TABLE users;');
    $em->getConnection()->query('TRUNCATE TABLE articles;');
    $em->getConnection()->query('TRUNCATE TABLE tagging;');
    $em->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');


    // Tags
    $tags = [
        new Tag(['title' => 'HTML']),
        new Tag(['title' => 'JavaScript']),
        new Tag(['title' => 'PHP'])
    ];

    foreach($tags as $t) $em->persist($t);

    // Users
    $user = new User(['email' => 'admin@localhost.de', 'passwort' => '123456']);
    $em->persist($user);

    $em->flush();

    $query = $em->createQuery('SELECT t FROM Entities\Tag t WHERE t.title = :t1 OR t.title = :t2');
    $query->setParameter('t1', 'HTML');
    $query->setParameter('t2', 'PHP');

    $tags = $query->getResult();

    //Articles
    $entry = [
        'title' => 'Test',
        'teaser' => 'Dies ist nur ein Test ...',
        'news' => 'Das ist eine Testnews',
        'publish_at' => 'now',
    ];
    $article = new Article($entry);

    $user->addArticle($article);
    $article->setUser($user);

    foreach($tags as $tag) {
        $tag->addArticle($article);
        $article->addTag($tag);
    }

    //$em->persist($user);
    $em->persist($article);

    $em->flush();

} catch(Exception $ex) {
    echo $ex->getMessage();
    //die('Ein Fehler ist aufgetreten');
}
?>
Beispieldaten wurden angelegt.
