<?php


use App\Entity\Course;
use App\Entity\Student;
use App\Factory\EntityManagerFactory;


require_once __DIR__ . '/../../vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();

$studentEntity = $entityManager->find(Student::class, $argv[1]);
$courseEntity = $entityManager->find(Course::class, $argv[2]);

$studentEntity->enrollInCourse($courseEntity);

try {
    $entityManager->flush();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
