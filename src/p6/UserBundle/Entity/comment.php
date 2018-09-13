<?php

namespace p6\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Comment
*
* @ORM\Table(name="comment")
* @ORM\Entity(repositoryClass="p6\UserBundle\Repository\CommentRepository")
*/
class Comment
{
  /**
  * @var int
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  */
  private $id;

  /**
  * @var \DateTime
  *
  * @ORM\Column(name="datetime", type="datetime")
  */
  private $datetime;

  /**
  * @var string
  *
  * @ORM\Column(name="content", type="text")
  */
  private $content;

  /**
  * @ORM\ManyToOne(targetEntity="p6\CoreBundle\Entity\Trick")
  * @ORM\JoinColumn(nullable=false)
  */
  private $trick;

  public function __construct()
  {
    $this->date = new \Datetime();
  }

  /**
  * @ORM\ManyToOne(targetEntity="p6\UserBundle\Entity\User", cascade={"persist"})
  * @ORM\JoinColumn(nullable=false)
  */
  private $user;

  /**
  * Get id.
  *
  * @return int
  */
  public function getId()
  {
    return $this->id;
  }

  /**
  * Set datetime.
  *
  * @param \DateTime $datetime
  *
  * @return comment
  */
  public function setDatetime($datetime)
  {
    $this->datetime = $datetime;

    return $this;
  }

  /**
  * Get datetime.
  *
  * @return \DateTime
  */
  public function getDatetime()
  {
    return $this->datetime;
  }

  /**
  * Set content.
  *
  * @param string $content
  *
  * @return comment
  */
  public function setContent($content)
  {
    $this->content = $content;

    return $this;
  }

  /**
  * Get content.
  *
  * @return string
  */
  public function getContent()
  {
    return $this->content;
  }

  /**
  * Set userId.
  *
  * @param int $userId
  *
  * @return comment
  */
  public function setUser($user)
  {
    $this->user = $user;

    return $this;
  }

  /**
  * Get userId.
  *
  * @return int
  */
  public function getUser()
  {
    return $this->user;
  }


  /**
  * Set trickId.
  *
  * @param int $trick
  *
  * @return comment
  */
  public function setTrick($trick)
  {
    $this->trick = $trick;

    return $this;
  }

  /**
  * Get trickId.
  *
  * @return int
  */
  public function getTrick()
  {
    return $this->trick;
  }
}
