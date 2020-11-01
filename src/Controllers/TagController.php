<?php
namespace Controllers;

use Entities\Tag;

class TagController extends AbstractBase {

    public function addAction() {

        $em = $this->getEntityManager();

        $tag = new Tag();

        $tags = $em
            ->getRepository('Entities\Tag')
            ->findAll();

        if($_POST) {
            $tag->mapFromArray($_POST);

            $validator = $em->getValidator($tag);
            if ($validator->isValid()) {

                $em->persist($tag);
                $em->flush();

                $this->setMessage('Tag wurde gespeichert.');
                $this->redirect('add', 'tag');

              }
                $this->addContext('errors', $validator->getErrors());

        }

        $this->addContext('tag', $tag);
        $this->addContext('tags', $tags);
        $this->setTemplate('editAction');
    }

}
