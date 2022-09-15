<?php


use App\Entity\Phone;
use App\Entity\Student;
use App\Factory\EntityManagerFactory;


require_once __DIR__ . '/../../vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();

$student = new Student($argv[1]);

for ($i = 2; $i < $argc; $i++) {
    $student->addPhone(new Phone($argv[$i]));
}

try {
    $entityManager->persist($student);
    $entityManager->flush();
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}
