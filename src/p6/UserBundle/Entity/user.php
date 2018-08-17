<?php

namespace p6\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* Step 1: Lors de la validation du formulaire register :
*     -> Je créé un Token Unique et je met user->token = token créé
*     -> Je met mon user->validated = 0
*     -> J'enregistre mon nouvel user en bdd
*     -> J'envoie un mail à l'user->email avec un lien du type : mon-site.com/confirm-registration?token=$user->token
* Step 2: Mon user clique sur le lien dans le mail
*     -> Mon controller récupère le user en bdd associé au $request->get('token')
*     -> Si un user est bien récupéré $user->validated = 1
*     -> J'affiche un message à l'utilisateur ou je le redirige au login (voire wireframes)
*/


/**
* User
*
* @ORM\Table(name="user")
* @ORM\Entity(repositoryClass="p6\UserBundle\Repository\UserRepository")
* @UniqueEntity(fields="email", message="Cet email est déjà utilisé.")
* @UniqueEntity(fields="username", message="Nom d'utilisateur est déjà utilisé.")
*/
class User implements UserInterface, \Serializable
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
    * @ORM\Column(name="username", type="string", length=25, unique=true)
    * @Assert\NotBlank()
    */
    private $username;

    /**
    * @var string
    *
    * @ORM\Column(name="email", type="string", length=255, unique=true)
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    private $email;

    /**
    * @var string
    *
    * @ORM\Column(name="token", type="string", length=255)
    */
    private $token;

    /**
    * @var string
    *
    * @ORM\Column(name="validated", type="boolean")
    */
    private $validated;

    /**
    * @var string
    *
    * @ORM\Column(name="password", type="string", length=100)
    */
    private $password;

    /**
    * @var int
    *
    * @ORM\Column(name="id_avatar", type="integer", nullable=true)
    */
    private $idAvatar;

    /**
    * @ORM\Column(name="roles", type="array")
    */
    private $roles;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
    }

    /**
    * @ORM\Column(name="salt", type="string", length=255, nullable=true)
    */
    private $salt;


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
    * Set username.
    *
    * @param string $username
    *
    *
    */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
    * Get username.
    *
    * @return string
    */
    public function getUsername()
    {
        return $this->username;
    }

    /**
    * Set email.
    *
    * @param string $email
    *
    *
    */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
    * Get email.
    *
    * @return string
    */
    public function getEmail()
    {
        return $this->email;
    }


    /**
    * Set password.
    *
    * @param string $password
    *
    *
    */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
    * Get password.
    *
    * @return string
    */
    public function getPassword()
    {
        return $this->password;
    }

    /**
    * Set id_avatar.
    *
    * @param int $id_avatar
    *
    *
    */
    public function setId_avatar($id_avatar)
    {
        $this->idAvatar = $id_avatar;
    }

    /**
    * Get idAvatar.
    *
    * @return int
    */
    public function getId_avatar()
    {
        return $this->id_avatar;
    }


    /**
    * @return array
    */
    public function getRoles()
    {
        return $this->roles;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
    * Get token.
    *
    * @return string
    */
    public function getToken()
    {
        return $this->token;
    }

    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
    * Get validated.
    *
    * @return string
    */
    public function getValidated()
    {
        return $this->validated;
    }



    /**
    * Get salt.
    *
    * @return string
    */
    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }


    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }
    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
        }

    }
