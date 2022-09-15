<?php


require 'vendor/autoload.php';


use App\Factory\EntityManagerFactory;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;

$config = new PhpFile(__DIR__ . '/config/migrations.php');

$entityManager = EntityManagerFactory::createEntityManager();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
