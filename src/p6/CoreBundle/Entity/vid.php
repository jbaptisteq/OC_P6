<?php

namespace p6\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vid
 *
 * @ORM\Table(name="vid")
 * @ORM\Entity(repositoryClass="p6\CoreBundle\Repository\VidRepository")
 */
class Vid
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
     * @ORM\Column(name="link", type="text")
     */
    private $link;


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
     * Set link.
     *
     * @param string $link
     *
     * @return vid
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}
