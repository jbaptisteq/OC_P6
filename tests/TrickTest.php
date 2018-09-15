<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\CoreBundle\Entity\Trick;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class TrickTest extends KernelTestCase
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

  public function testGetExistingTrick()
  {
    $trick = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(1);

    $this->assertSame(1, $trick->getId());
  }

  public function testGetNonExistingTrick()
  {
    $trick = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(99999);

    $this->assertNull($trick);
  }

  public function testGetName()
  {
    $trick = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(1);

    $this->assertSame('Mute', $trick->getName());
  }

  public function testGetDescription()
  {
    $trick = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(1);

    $this->assertSame('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.', $trick->getDescription());
  }

  public function testGetPublished()
  {
    $trick = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(1);

    $this->assertSame(1, $trick->getPublished());
  }

}
