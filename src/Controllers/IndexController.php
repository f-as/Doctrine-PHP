<?php
namespace Controllers;

use Entities\Tag;
use Entities\Article;

class IndexController extends AbstractBase {

    public function indexAction() {

        $em = $this->getEntityManager();

        // $articles = $em
        //     ->getRepository('Entities\Article')
        //     ->findAll();

        // DQL
        //$query = $em->createQuery('SELECT a, u FROM Entities\Article a LEFT JOIN a.user u');

        // QueryBuilder
        $query = $em
            ->createQueryBuilder()
            ->select('a, u, t')
            ->from('Entities\Article', 'a')
            ->leftJoin('a.tags', 't')
            ->leftJoin('a.user', 'u')
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery();

        $articles = $query->getResult();

        $this->addContext('articles', $articles);

/*
        $tag = $em
            ->getRepository('Entities\Tag') // lädt Tabelleninformationen
            ->find(3); // SELECT * FROM <tabelle> WHERE id = <argument(find)>
        $this->addContext('tag', $tag);

        $tags = $em
            ->getRepository('Entities\Tag')
            ->findByTitle('PHP'); // dynamische Abfrage findBy+<Attribut>
            // SELECT * FROM <tabelle> WHERE <attribut> = <argument(findBy)>
        $this->addContext('tags', $tags);

        $tagOne = $em
            ->getRepository('Entities\Tag')
            ->findOneByTitle('HTML'); // SELECT * FROM <tabelle> WHERE <attribut> = <argument(findOneBy)
            // ABER: nur erster Ergebnis-Datensatz
        $this->addContext('tagOne', $tagOne);

        $tagsAll = $em
            ->getRepository('Entities\Tag')
            ->findAll(); // SELECT * FROM <tabelle>
        $this->addContext('tagsAll', $tagsAll);
*/
    }


    public function  addAction() {

        $em = $this->getEntityManager();
        $article = new Article();

        $tags = $em
            ->getRepository('Entities\Tag')
            ->findAll();

        if($_POST) {
            $article->mapFromArray($_POST);
            $article->setUser($em->getRepository('Entities\User')->find(1));
            $tag_ids = $_POST['tags_id'] ?? [];
            foreach($tag_ids as $id) {
                $article->addTag($em->getRepository('Entities\Tag')->find($id));
            }

            $em->persist($article);
            $em->flush();

            $this->setMessage('Artikel wurde gespeichert');
            $this->redirect();
        }

        $this->addContext('tags', $tags);
        $this->addContext('article', $article);
        $this->setTemplate('editAction');
    }

    public function readAction() {

        $em = $this->getEntityManager();
        $article = $em
            ->getRepository('Entities\Article')
            ->find($_GET['id']);

        $this->addContext('article', $article);

    }

    public function editAction() {

        $em = $this->getEntityManager();
        $article = $em
            ->getRepository('Entities\Article')
            ->find($_REQUEST['id']);

        $tags = $em
            ->getRepository('Entities\Tag')
            ->findAll();

        if($_POST) {
            $article->mapFromArray($_POST);

            $article->clearTags();
            $tag_ids = $_POST['tags_id'] ?? [];

            foreach($tag_ids as $id) {
                $article->addTag($em->getRepository('Entities\Tag')->find($id));
            }

            $em->persist($article);
            $em->flush();

            $this->setMessage('Artikel wurde aktualisiert.');
            $this->redirect();
        }

        $this->addContext('tags', $tags);
        $this->addContext('article', $article);
    }

    public function deleteAction() {

        $em = $this->getEntityManager();
        $article = $em
            ->getRepository('Entities\Article')
            ->find($_GET['id']);

        $em->remove($article);
        $em->flush();

        $this->setMessage('Artikel wurde gelöscht.');
        $this->redirect();

    }








    public function searchAction() {

        $em = $this->getEntityManager();

        /* Ü18
        $query = $em->createQuery('SELECT t FROM Entities\Tag t WHERE t.id BETWEEN :f AND :t');
        $query->setParameter('f', 1);
        $query->setParameter('t', 3);
        /* */

        /* Ü19 */
        $query = $em->createQuery('SELECT t FROM Entities\Tag t WHERE t.title LIKE :lke ORDER BY t.title ASC');
        $query->setParameter('lke', '%h%');
        /* */

        $tags = $query->getResult();

        $this->addContext('tags', $tags);
        $this->setTemplate('editAction', 'TagController');
    }

    public function datetimeAction() {

        $datetime = new \DateTime();
        $datetime2 = new \DateTime('1970-01-01'); // JJJJ-MM-TT ISO 8601

        //echo $datetime->format('d.m.Y');
        //echo $datetime->format('H:i:s');
        //echo '<hr>';
        //echo $datetime2->format('d.m.Y');
        //echo '<br>';
        //$datetime2->modify('+2 weeks');
        //echo $datetime2->format('d.m.Y');

        $differenz = $datetime->diff($datetime2);
        echo $differenz->format('%a');

        //$entry= ['publish_at'=>'1970-01-01'];
        //$article= new \Entities\Article($entry);
        //echo $article->getPublishAt()->format('d.m.Y');

    }

}
