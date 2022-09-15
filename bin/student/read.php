<?php


use App\Entity\Phone;
use App\Entity\Student;
use App\Entity\Course;
use App\Factory\EntityManagerFactory;


require_once __DIR__ . '/../../vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();

/** @var Student[] $studentEntities */
$studentEntities = $entityManager->getRepository(Student::class)->findWithCourses();

foreach ($studentEntities as $studentEntity) {
    var_dump($studentEntity->getName());

    $phones = $studentEntity->phones()
        ->map(fn (Phone $phone) => $phone->getNumber())
        ->toArray();

    var_dump($phones);

    $courses = $studentEntity->courses()
        ->map(fn (Course $course) => $course->getName())
        ->toArray();

    var_dump($courses);
}
