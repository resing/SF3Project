<?php
/**
 * Created by PhpStorm.
 * User: frup64362
 * Date: 15/07/2016
 * Time: 15:03
 */

namespace BackBundle\Event;


use Symfony\Component\EventDispatcher\Event;
use UtilisateursBundle\Entity\Utilisateurs;

class EmailAvailableEvent extends Event
{
    protected $email;
    public function __construct(Utilisateurs $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}