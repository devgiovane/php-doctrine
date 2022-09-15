<?php


use App\Entity\Student;
use App\Factory\EntityManagerFactory;


require_once __DIR__ . '/../../vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();

$studentEntity = $entityManager->find(Student::class, $argv[1]);

try {
    $entityManager->remove($studentEntity);
    $entityManager->flush();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
