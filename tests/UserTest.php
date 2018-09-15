<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\UserBundle\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class UserTest extends KernelTestCase
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

  public function testGetExistingUser()
  {
    $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

    $this->assertSame(1, $user->getId());
  }

  public function testGetNonExistingUser()
  {
    $user = $this->entityManager->getRepository('p6UserBundle:User')->find(99999);

    $this->assertNull($user);
  }

  public function testGetUsername()
  {
    $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

    $this->assertSame('admin', $user->getUsername());
  }

  public function testEmailFormat()
  {
    $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

    $this->assertSame($user->getEmail(), filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL));
  }

  public function testGetEmail()
  {
    $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

    $this->assertSame('admin@admin.com', $user->getEmail());
  }

  public function testGetRoles()
  {
      $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

      $this->assertContains('ROLE_USER', $user->getRoles());
  }

  public function testGetIsActive()
  {
      $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

      $this->assertSame(TRUE, $user->getIsActive());
  }

}
