<?php

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private static $container;

    /**
     * @var Response|null
     */
    private $response;

    /**
     * FeatureContext constructor.
     * @param KernelInterface $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        self::$container = $this->kernel->getContainer();
    }

    /**
     * @BeforeScenario
     */
    public function clearData()
    {
        $em = self::$container->get('doctrine')->getManager();
        $em->createQuery('DELETE FROM App\Entity\Category')->execute();
        $em->createQuery('DELETE FROM App\Entity\Comment')->execute();
        $em->createQuery('DELETE FROM App\Entity\Post')->execute();
        $em->createQuery('DELETE FROM App\Entity\User')->execute();
        $client = new \Predis\Client('tcp://cqrs-blog-redis:6379');
        $client->flushdb();
    }

    /**
     * @When I have category in Database with params ::arg1, :arg2
     */
    public function iHaveCategoryInDatabaseWithParams2($arg1, $arg2)
    {
        $em = self::$container->get('doctrine')->getConnection();
        $qb = $em->createQueryBuilder();
        $qb
            ->insert('category')
            ->setValue('id', '?')
            ->setValue('name', '?')
            ->setValue('deleted', '0')
            ->setParameter(0, $arg1)
            ->setParameter(1, $arg2)
            ->execute();
        $client = new \Predis\Client('tcp://cqrs-blog-redis:6379');
        $client->hmset('category:'.$arg1, [
            "id" => $arg1,
            "name" => $arg2,
            "deleted" => 0
        ]);
        $client->rpush('category', 'category:'.$arg1);
    }

    /**
     * @When In database name is changed
     */
    public function inDatabaseNameIsChanged()
    {
        $entityManager = self::$container->get('doctrine')->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
             FROM App\Entity\Category p
             WHERE p.id = :price
             '
        )->setParameter('price', 1);
        $category = $query->execute();
        $serializer = JMS\Serializer\SerializerBuilder::create()->build();
        $jsonContent = json_decode($serializer->serialize($category, 'json'), true);

        if ($jsonContent[0]['name'] != 'King') {
            throw new Exception();
        }
    }

    /**
     * @When In redis name is changed
     */
    public function inRedisNameIsChanged()
    {
        $client = new \Predis\Client('tcp://cqrs-blog-redis:6379');
        $category = $client->hgetall('category:1');

        if ($category['name'] != 'King') {
            throw new Exception();
        }
    }

    /**
     * @When In database category is delete
     */
    public function inDatabaseCategoryIsDelete()
    {
        $entityManager = self::$container->get('doctrine')->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
             FROM App\Entity\Category p
             WHERE p.id = :price
             '
        )->setParameter('price', 1);
        $category = $query->execute();
        $serializer = JMS\Serializer\SerializerBuilder::create()->build();
        $jsonContent = json_decode($serializer->serialize($category, 'json'), true);

        if ($jsonContent[0]['deleted'] != 1) {
            throw new Exception();
        }
    }

    /**
     * @When In redis category is delete
     */
    public function inRedisCategoryIsDelete()
    {
        $client = new \Predis\Client('tcp://cqrs-blog-redis:6379');
        $category = $client->hgetall('category:1');

        if ($category['deleted'] != 1) {
            throw new Exception();
        }
    }
}
