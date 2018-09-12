<?php

namespace p6\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* Trick
*
* @ORM\Table(name="trick")
* @ORM\Entity(repositoryClass="p6\CoreBundle\Repository\TrickRepository")
* @ORM\Entity
* @UniqueEntity(
 *     fields={"name"},
 *     message="Ce Trick existe déjà."
 * )
*/
class Trick
{
  /**
  * @var int
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  *
  */
  private $id;

  /**
  * @var string
  *
  * @ORM\Column(name="name", type="string", length=255, unique=true)
  *
  */
  private $name;

  /**
  * @var string
  *
  * @ORM\Column(name="description", type="text")
  */
  private $description;

  /**
  * @var \DateTime
  *
  * @ORM\Column(name="creaDate", type="datetime", nullable=true)
  *
  */
  private $creaDate;

  /**
  * @var \DateTime
  *
  * @ORM\Column(name="editDate", type="datetime", nullable=true)
  *
  */
  private $editDate;

  /**
  * @var int
  *
  * @ORM\Column(name="published", type="integer")
  *
  */
  private $published;


  /**
  * @ORM\ManyToOne(targetEntity="p6\CoreBundle\Entity\Category")
  * @ORM\JoinColumn(nullable=false)
  */
  private $category;

  /**
  * @ORM\ManyToMany(targetEntity="p6\CoreBundle\Entity\Image", cascade={"persist"})
  */
  private $images;

  /**
  * @ORM\ManyToMany(targetEntity="p6\CoreBundle\Entity\Video", cascade={"persist"})
  */
  private $videos;

  public function __construct()
  {
    $this->creaDate = new \Datetime();
    $this->images = new ArrayCollection();
    $this->videos = new ArrayCollection();
  }

  public function addImage(image $image)
  {
    $this->images[] = $image;
  }

  public function removeImage(image $image)
  {
    $this->images->removeElement($image);
  }

  public function getImages()
  {
    return $this->images;
  }

  public function addVideo(video $video)
  {
    $this->videos[] = $video;
  }

  public function removeVideo(video $video)
  {
    $this->videos->removeElement($video);
  }

  /**
   * @return ArrayCollection
   */
  public function getVideos()
  {
    return $this->videos;
  }

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
  * Set name.
  *
  * @param string $name
  *
  * @return trick
  */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
  * Get name.
  *
  * @return string
  */
  public function getName()
  {
    return $this->name;
  }

  /**
  * Set description.
  *
  * @param string $description
  *
  * @return trick
  */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
  * Get description.
  *
  * @return string
  */
  public function getDescription()
  {
    return $this->description;
  }

  /**
  * Set creaDate.
  *
  * @param \DateTime $creaDate
  *
  * @return trick
  */
  public function setCreaDate($creadate)
  {
    $this->creaDate = $creadate;

    return $this;
  }

  /**
  * Get creaDate.
  *
  * @return \DateTime
  */
  public function getCreaDate()
  {
    return $this->creaDate;
  }

  /**
  * Set editDate.
  *
  * @param \DateTime $editDate
  *
  * @return trick
  */
  public function setEditDate($editdate)
  {
    $this->editDate = $editdate;

    return $this;
  }

  /**
  * Get editDate.
  *
  * @return \DateTime
  */
  public function getEditDate()
  {
    return $this->editDate;
  }




  /**
  * Set category
  *
  * @param int
  *
  */
  public function setCategory(category $category = null)
  {
    $this->category = $category;
  }

  /**
  *  Get category
  *
  * @return int
  */
  public function getCategory()
  {
    return $this->category;
  }

  /**
  * Set published
  *
  * @param int
  *
  */
  public function setPublished($published)
  {
    $this->published = $published;
  }

  /**
  *  Get published
  *
  * @return int
  */
  public function getPublished()
  {
    return $this->published;
  }

}
