<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\CoreBundle\Entity\Category;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class CategoryTest extends KernelTestCase
{
  /**
   * @var \Doctrine\ORM\EntityManager
   */
  private $entityManager;

  protected function setUp()
  {
    $kernel = self::bootKernel();
    $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
  }

  public function testGetExistingCategory()
  {
    $category = $this->entityManager->getRepository('p6CoreBundle:Category')->find(1);

    $this->assertSame(1, $category->getId());
  }

  public function testGetNonExistingCategory()
  {
    $category = $this->entityManager->getRepository('p6CoreBundle:Category')->find(99999);

    $this->assertNull($category);
  }

  public function testGetName()
  {
    $category = $this->entityManager->getRepository('p6CoreBundle:Category')->find(1);

    $this->assertSame('Grabs', $category->getName());
  }

}
