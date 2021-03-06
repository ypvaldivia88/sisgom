<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\UsuariosRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("username", message="Este Nombre de Usuario ya está en uso")
 */
class Usuarios implements AdvancedUserInterface, \Serializable
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
     * @Assert\NotBlank(message="Ingrese un Nombre de Usuario")
     * @ORM\Column(name="username", type="string", length=50)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * @var string
     * @Assert\Choice(choices = {"ROLE_ADMINISTRADOR", "ROLE_OPERADOR", "ROLE_CONSULTANTE"}, message = "Escoja una opción válida")
     * @ORM\Column(name="role", type="string", columnDefinition="ENUM('ROLE_ADMINISTRADOR', 'ROLE_OPERADOR', 'ROLE_CONSULTANTE')", length=50)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="movil", type="string", length=15, nullable=true)
     *
     */
    private $movil;

    /**
     * @var string
     *
     * @ORM\Column(name="imei", type="string", length=25, nullable=true)
     *
     */
    private $imei;
    
    /**
     * @var bool
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var bool
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo=false;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creado", type="datetime")
     */
    private $creado;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actualizado", type="datetime")
     */
    private $actualizado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultimo_logueo", type="datetime", nullable=true)
     */
    private $ultimoLogueo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ultimo_deslogueo", type="datetime", nullable=true)
     */
    private $ultimoDeslogueo;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Ingrese un Nombre")
     * @ORM\Column(name="nombre_completo", type="string", length=255)
     */
    private $nombreCompleto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string")
     */
    private $avatar;

    
    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set imei
     *
     * @param string $imei
     *
     * @return Usuarios
     */
    public function setImei($imei)
    {
        $this->imei = $imei;

        return $this;
    }

    /**
     * Get imei
     *
     * @return string
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set movil
     *
     * @param string $movil
     *
     * @return Usuarios
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return string
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set role
     *
     * @param string $role
     *
     * @return Usuarios
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Usuarios
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    /**
     * Set creado
     *
     * @param \DateTime $creado
     * @return Usuarios
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime 
     */
    public function getCreado()
    {
        return $this->creado;
    }
    
    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     *
     * @return Usuarios
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->creado = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->actualizado = new \DateTime();
    }
    
    public function getRoles()
    {
        return array($this->role);
    }
    
    public function getSalt()
    {
        return null;//CarlosRafaelBécquerRodríguez
    }
    
    public function eraseCredentials(){
        
    }
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
        ) = unserialize($serialized);
    }   
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    /**
     * Set nombreCompleto
     *
     * @param string $nombreCompleto
     *
     * @return Usuarios
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }

    /**
     * Get nombreCompleto
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Usuarios
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

 
    /**
     * Set ultimoLogueo
     *
     * @param \DateTime $ultimoLogueo
     *
     * @return Usuarios
     */
    public function setUltimoLogueo($ultimoLogueo)
    {
        $this->ultimoLogueo = $ultimoLogueo;

        return $this;
    }

    /**
     * Get ultimoLogueo
     *
     * @return \DateTime
     */
    public function getUltimoLogueo()
    {
        return $this->ultimoLogueo;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Usuarios
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set ultimoDeslogueo
     *
     * @param \DateTime $ultimoDeslogueo
     *
     * @return Usuarios
     */
    public function setUltimoDeslogueo($ultimoDeslogueo)
    {
        $this->ultimoDeslogueo = $ultimoDeslogueo;

        return $this;
    }

    /**
     * Get ultimoDeslogueo
     *
     * @return \DateTime
     */
    public function getUltimoDeslogueo()
    {
        return $this->ultimoDeslogueo;
    }

}