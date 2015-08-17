<?php

namespace parrainnage\parrainnageBundle\Entity;
use Doctrine\ORM\EntityRepository;
class InvitationRepository extends EntityRepository{
    
    public function findInvitationBy($id)
{
    $query = $this->getEntityManager()
        ->createQuery(
            'SELECT email FROM parrainnageBundle:Invitation i
            WHERE i.user = :id'
        )->setParameter('id', $id);

    
}
public function findAllOrderedByName($id)
    {
        $query = $this->getEntityManager()
        ->createQuery(
            'SELECT DISTINCT email FROM parrainnageBundle:Invitation i
            
        WHERE i.user = :id'
        )->setParameter('id', $id);


           
    }
    
    
}
