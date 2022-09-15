<?php


namespace App\Factory;


use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;


final class EntityManagerFactory
{
    /**
     * @throws ORMException
     */
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [ __DIR__ . "/.." ],
            isDevMode: true
        );
        $consoleOutput = new ConsoleOutput(OutputInterface::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $config->setMiddlewares([
            new Middleware($consoleLogger)
        ]);
        $config->setMetadataCache(new PhpFilesAdapter(
            namespace: 'metadata',
            directory:  __DIR__ . '/../../var/cache'
        ));
        $config->setQueryCache(new PhpFilesAdapter(
            namespace: 'query',
            directory: __DIR__ . '/../../var/cache'
        ));
        $redisConnection = RedisAdapter::createConnection(
            'redis://:kgb8y2kk@localhost:6379/0'
        );
        $config->setResultCache(new RedisAdapter(
            redis: $redisConnection,
            namespace: 'result'
        ));
        $conn = [
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'doctrine',
            'user' => 'giovane',
            'password' => 'giovane'
        ];
        return EntityManager::create($conn, $config);
    }
}
