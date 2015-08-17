<?php

namespace parrainnage\parrainnageBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @var string
     *
     * @ORM\Column(name="invite", type="string", length=255)
     */
    protected $invite;
 
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
    public function getInvite() {
        return $this->invite;
    }

    public function setInvite($invite) {
        $this->invite = $invite;
    }

            /**
     * @ORM\OneToMany(targetEntity="parrainnage\parrainnageBundle\Entity\Invitation", mappedBy="user")
     */
    protected $invitation;

   


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
    

    /**
     * Add invitation
     *
     * @param \parrainnage\parrainnageBundle\Entity\Invitation $invitation
     * @return User
     */
    public function addInvitation(\parrainnage\parrainnageBundle\Entity\Invitation $invitation)
    {
        $this->invitation[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \parrainnage\parrainnageBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\parrainnage\parrainnageBundle\Entity\Invitation $invitation)
    {
        $this->invitation->removeElement($invitation);
    }

    /**
     * Get invitation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInvitation()
    {
        return $this->invitation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

}
