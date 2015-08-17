<?php

namespace parrainnage\parrainnageBundle\Controller;
use parrainnage\parrainnageBundle\Entity\User;
use parrainnage\parrainnageBundle\Entity\Invitation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use parrainnage\parrainnageBundle\Entity\InvitationRepository;
class InvitationController extends Controller
{  
     /**
     * Lists all Image entities.
     *
     */
    public function indexAction($id)
    {   $user=new User();
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('parrainnageBundle:Invitation')->findInvitationBy($id);

        return $this->render('parrainnageBundle:Invitation:index.html.twig', array(
            'entities' => $entities,
            'user' => $user,
        ));
    }
   public function redAction()
    {
        return $this->render('parrainnageBundle:Invitation:formMail.html.twig');
    }
    public function sendMailAction($email,$id)
    {   $em = $this->getDoctrine()->getManager();
        $invitation = new Invitation();
        $user= new User();
   
        $url = $this->generateUrl('fos_user_registration_register', array('token' => $user->getConfirmationToken()), true);
        $Request = $this->getRequest();
        if($Request->getMethod()=="POST"){
            $recu=$Request->get("recu");
            $sujet="INVITATION A PARRAINAGE";
              $mailer=$this->container->get('mailer');
   
          
         $message = \Swift_Message::newInstance() 
        ->setSubject($sujet)        
        ->setFrom($email)
        ->setTo($recu)
        ->setBody($this->renderView('parrainnageBundle:Invitation:mail.html.twig', array(
            'email'=>$email,
            'user' => $user,
            'confirmationUrl' =>  $url)))  
    ;
        $users = $em->getRepository('parrainnageBundle:User')
                  ->find($id);
        $invitation->setEmail($recu);
    $invitation->setUser($users);
         $em->persist($invitation);
       $em->flush(); 
    $this->get('mailer')->send($message);
    }
       
         return $this->render('parrainnageBundle:Invitation:formMail.html.twig', array(
            'email'=>$email,
           ));
        
    }
    public function AvoirAction($id) {
        $users=new User();
        $em = $this->getDoctrine()->getManager();
         $user = $em->getRepository('parrainnageBundle:User')->find($id);
         $u= $em->getRepository('parrainnageBundle:User')->findAll();
                   $cadeau=0;
                   $cadeaux=0;
         $invitation = $em->getRepository('parrainnageBundle:Invitation')->findby(array('user' => $id));        
    $invitationAll=$em->getRepository('parrainnageBundle:Invitation')->findAll(); 
          foreach($u as $us)
     {   
     $i=$us->getInvite();
    $e=$user->getEmail();
                  if(($e==$i)){
          $cadeau+=1; 
           }
      
     } 
    $email=array();
    $idUser=array();
    //reamplir tableau par unique id
      foreach($invitationAll as $invites)
     {   $idUser[]=$invites->getUser()->getId();
         $idUser=  array_unique($idUser);  
     }
     //reamplir tableau par unique email
     foreach($invitation as $invites)
     {   $idUser[]=$invites->getUser()->getId();
         $idUser=  array_unique($idUser);  
         
         $email[]=$invites->getEmail();
         $email=  array_unique($email);
     }
     //parcourir tous les email  users    et email d'invitations 
     //foreach($u as $us){
     //$e=$us->getEmail();
     //$c=$invites->getCreated();
     //$cu=$us->getCreated();
     //foreach($email as $emails)
     //{              //Verifier si email invité et égale a email inscri 
     //             et date d'envoie d'invitation et inferieur au date d'inscription
                 // if(($emails==$e)&&($c<$cu)){
          //$cadeaux+=1; 
           //}
     
      
      
     //foreach($idUser as $idUsers)
     //{  
       //return  $this->AvoirAction($idUsers)  ;
     //}
     //affichage 
     return  $this->render('parrainnageBundle:Invitation:cadeau.html.twig', array(
            'cadeau'=>$cadeau,
          'cadeaux'=>$cadeaux,
          'invitation'=>$invitation,
          'email'=>$email,
          'idUser'=>$idUser,
           'u'=>$u
      ));
      
    }
    public function InvitAction($id) {
        $em = $this->getDoctrine()->getManager();
         $user = $em->getRepository('parrainnageBundle:User')->find($id);
         $u= $em->getRepository('parrainnageBundle:User')->findAll();
                   $cadeau=0;
                    $email=array();
                    $ui=array();
               foreach($u as $us)
     {   
     $i=$us->getInvite();//recuperer les email des personnes qui ont envoyer des invites acceptés
    $e=$user->getEmail();//recuperer email du client
    $es=$us->getEmail();//recuperer les emails de tous les users
                  if(($e==$i)){
                      
                   $email[]=$us->getEmail(); 
                   $cadeau+=1;
           
                  }
                  foreach($email as $emails)
     {
                      if($i==$emails){
                          $ui[]=$us->getEmail();
                          $cadeau+=1;
                      }
     }
      
     }
     return  $this->render('parrainnageBundle:Invitation:index.html.twig', array(
            'email'=>$email,
         'cadeau'=>$cadeau,
         'ui'=>$ui));
    }
    function recersive($i) {
        $em = $this->getDoctrine()->getManager();
     $u= $em->getRepository('parrainnageBundle:User')->findAll(); 
      $email=array();
      $i=1;
      $i=$i*$this->recersive($i);
      return recersive($i) ;
}
}
