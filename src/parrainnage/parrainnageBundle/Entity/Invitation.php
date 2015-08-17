<?php
use Symfony\Component\Validator\Constraints as Assert;
namespace parrainnage\parrainnageBundle\Entity;
use parrainnage\parrainnageBundle\Entity\InvitationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="parrainnage\parrainnageBundle\Entity\InvitationRepository");
 * @ORM\HasLifecycleCallbacks
 */
class Invitation
{
   
/** @ORM\Id @ORM\Column(type="string", length=6) */
    protected $code;

    /** @ORM\Column(type="string", length=256) */
    protected $email;

    /**
     * @ORM\ManyToOne(targetEntity="parrainnage\parrainnageBundle\Entity\User" ,inversedBy="invitation",cascade={"persist"})
      * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
     /**
    * @ORM\Column(name="created", type="datetime")
    */

    protected $created;
     public function getCreated() {
        return $this->created;
    }

    public function setCreated(\DateTime $created) {
        $this->created = $created;
    }
/**
     * @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {  
        $this->created = new \DateTime( );
    }
    public function __construct()
    {
        // generate identifier only once, here a 6 characters length code
        $this->code = substr(md5(uniqid(rand(), true)), 0, 6);
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    

    

    /**
     * Set code
     *
     * @param string $code
     * @return Invitation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Set user
     *
     * @param \parrainnage\parrainnageBundle\Entity\User $user
     * @return Invitation
     */
    public function setUser(\parrainnage\parrainnageBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \parrainnage\parrainnageBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
