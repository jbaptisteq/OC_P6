<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\CoreBundle\Entity\Image;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class ImageTest extends KernelTestCase
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

  public function testGetExistingImage()
  {
    $image = $this->entityManager->getRepository('p6CoreBundle:Image')->find(1);

    $this->assertSame(1, $image->getId());
  }

  public function testGetNonExistingImage()
  {
    $image = $this->entityManager->getRepository('p6CoreBundle:Image')->find(99999);

    $this->assertNull($image);
  }

}
