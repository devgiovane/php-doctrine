<?php

namespace App\Repository;


use App\Entity\Student;
use Doctrine\ORM\EntityRepository;


final class StudentRepository extends EntityRepository
{
    /**
     * @return Student[]
     */
    public function findWithCourses(): array
    {
       return $this->createQueryBuilder('student')
            ->addSelect('phone', 'course')
            ->leftJoin('student.phones', 'phone')
            ->leftJoin('student.courses', 'course')
            ->getQuery()
            ->enableResultCache(120)
            ->getResult();
    }

//    /**
//     * @return Student[]
//     */
//    public function findWithCourses(): array
//    {
//
//        $dql = <<<DQL
//            SELECT student, phone, course
//            FROM App\Entity\Student student
//            LEFT JOIN student.phones phone
//            LEFT JOIN student.courses course
//        DQL;
//
//        return $this->getEntityManager()->createQuery($dql)->getResult();
//    }
}
