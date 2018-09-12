<?php

namespace p6\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Avatar
*
* @ORM\Table(name="avatar")
* @ORM\Entity(repositoryClass="p6\UserBundle\Repository\avatarRepository")
*/
class Avatar
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
  * @var string
  *
  * @ORM\Column(name="url", type="string", length=255)
  */
  private $url;

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
  * Set url.
  *
  * @param string $url
  *
  * @return avatar
  */
  public function setUrl($url)
  {
    $this->url = $url;

    return $this;
  }

  /**
  * Get url.
  *
  * @return string
  */
  public function getUrl()
  {
    return $this->url;
  }
}
