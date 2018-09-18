<?php

namespace p6\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
* Image
*
* @ORM\Table(name="image")
* @ORM\Entity(repositoryClass="p6\CoreBundle\Repository\ImageRepository")
* @ORM\HasLifecycleCallbacks
*/
class Image
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
  * @return image
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

  /**
   * @var UploadedFile
   */
  private $file;

  private $tempFilename;

  public function getFile()
  {
    return $this->file;
  }

  public function setFile(UploadedFile $file)
  {
    $this->file = $file;

    if (null !== $this->url) {
      $this->tempFilename = $this->url;

      $this->url = null;
    }
  }

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    if (null === $this->file) {
      return;
    }

    $genUrl = md5(random_bytes(6));
    $this->url = $genUrl.'.'.$this->file->guessExtension();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    if (null === $this->file) {
      return;
    }

    $this->file->move(
      $this->getUploadRootDir(),
      $this->url
    );
  }

/**
 * @ORM\PreRemove()
 */
  public function preRemoveUpload()
  {
    $this->tempFileName = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    if (file_exists($this->tempFilename)) {
      unlink($this->temFilename);
    }
  }

  public function getUploadDir()
  {
    return 'images/upload';
  }

  protected function getUploadRootDir()
  {
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }
}
