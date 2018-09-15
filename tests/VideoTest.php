<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\CoreBundle\Entity\Video;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class VideoTest extends KernelTestCase
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

  public function testGetExistingVideo()
  {
    $video = $this->entityManager->getRepository('p6CoreBundle:Video')->find(3);

    $this->assertSame(3, $video->getId());
  }

  public function testGetNonExistingVideo()
  {
    $video = $this->entityManager->getRepository('p6CoreBundle:Video')->find(99999);

    $this->assertNull($video);
  }

}
