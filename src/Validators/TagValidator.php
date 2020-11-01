<?php
namespace Validators;

use Webmasters\Doctrine\ORM\EntityValidator;

class TagValidator extends EntityValidator {

    public function validateTitle($title) {

      $tag = $this->getEntity();

        if(empty($title)) {
            $this->addError('Das Feld Title ist leer');
        } elseif (strlen($title) < 3) {
              $this->addError('Der Title sollte mindestens 3 zeichen lang sein.');
        } elseif ($this->getRepository()->findDuplicates($tag)) {
          $this->addError('Der Titel existiert bereits.');

        }
    }
}
