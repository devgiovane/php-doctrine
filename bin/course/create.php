<?php


use App\Entity\Course;
use App\Factory\EntityManagerFactory;


require_once __DIR__ . '/../../vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();


$course = new Course($argv[1]);

try {
    $entityManager->persist($course);
    $entityManager->flush();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}

