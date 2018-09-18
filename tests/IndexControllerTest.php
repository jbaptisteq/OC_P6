<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\CoreBundle\Entity\Trick;
use p6\CoreBundle\Controller\IndexController;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;



class IndexControllerTest extends KernelTestCase
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

  public function testIndexActionExistingTrick()
  {
    $tricklist = $this->entityManager->getRepository('p6CoreBundle:Trick')->findBy(
      array('published' => '1' ),
      array('creaDate' => 'ASC'),
      5,
      0
    );

    $array = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(5);

    $this->assertContains($array, $tricklist);
  }

  public function testIndexActionNotInArrayTrick()
  {
    $tricklist = $this->entityManager->getRepository('p6CoreBundle:Trick')->findBy(
      array('published' => '1' ),
      array('creaDate' => 'ASC'),
      5,
      0
    );

    $array = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(6);

    $this->assertNotContains($array, $tricklist);
  }


}
