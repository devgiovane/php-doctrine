<?php


use App\Factory\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;


require_once 'vendor/autoload.php';


$entityManager = EntityManagerFactory::createEntityManager();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
);
