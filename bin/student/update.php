<?php


use App\Entity\Student;
use App\Factory\EntityManagerFactory;


require_once __DIR__ . '/../../vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();
/** @var Student $studentEntity */
$studentEntity = $entityManager->find(Student::class, $argv[1]);
$studentEntity->setName($argv[2]);

try {
    $entityManager->flush();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
