<?php

namespace tests;

use Doctrine\ORM\EntityManager;
use p6\UserBundle\Entity\Comment;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class CommentTest extends KernelTestCase
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

  public function testGetExistingComment()
  {
    $comment = $this->entityManager->getRepository('p6UserBundle:Comment')->find(1);

    $this->assertSame(1, $comment->getId());
  }

  public function testGetNonExistingComment()
  {
    $comment = $this->entityManager->getRepository('p6UserBundle:Comment')->find(99999);

    $this->assertNull($comment);
  }

  public function testGetContent()
  {
    $comment = $this->entityManager->getRepository('p6UserBundle:Comment')->find(1);

    $this->assertSame('test', $comment->getContent());
  }

  public function testGetUser()
  {
    $comment = $this->entityManager->getRepository('p6UserBundle:Comment')->find(1);
    $user = $this->entityManager->getRepository('p6UserBundle:User')->find(1);

    $this->assertSame($user, $comment->getUser());
  }

  public function testGetTrick()
  {
    $comment = $this->entityManager->getRepository('p6UserBundle:Comment')->find(1);
    $trick = $this->entityManager->getRepository('p6CoreBundle:Trick')->find(1);

    $this->assertSame($trick, $comment->getTrick());
  }

}
