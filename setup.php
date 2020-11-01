<?php
require_once('inc/bootstrap.inc.php');

$schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);

$factory = $em->getMetadataFactory();
$metadata = $factory->getAllMetadata();

try {
    $schemaTool->updateSchema($metadata);
} catch(PDOException $e) {
    echo 'Achtung: Bei der Aktualisierung des Schema gab es ein Problem: ';
    echo $e->getMessage().'<br>';
    if(preg_match("/Unknown database '(.*)'/", $e->getMessage(), $matches)) {
        die(
            sprintf('Erstellen der Datenbank %s mit der Kollation utf-8_general_ci', $matches[1])
        );
    }
}
?>
Das Schema-Tool wurde durchlaufen.
