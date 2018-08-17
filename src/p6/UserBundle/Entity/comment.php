<?php

namespace p6\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="p6\UserBundle\Repository\commentRepository")
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="avatar_id", type="integer")
     */
    private $avatarId;

    /**
     * @var int
     *
     * @ORM\Column(name="trick_id", type="integer")
     */
    private $trickId;


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
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set avatarId.
     *
     * @param int $avatarId
     *
     * @return comment
     */
    public function setAvatarId($avatarId)
    {
        $this->avatarId = $avatarId;

        return $this;
    }

    /**
     * Get avatarId.
     *
     * @return int
     */
    public function getAvatarId()
    {
        return $this->avatarId;
    }

    /**
     * Set trickId.
     *
     * @param int $trickId
     *
     * @return comment
     */
    public function setTrickId($trickId)
    {
        $this->trickId = $trickId;

        return $this;
    }

    /**
     * Get trickId.
     *
     * @return int
     */
    public function getTrickId()
    {
        return $this->trickId;
    }
}
