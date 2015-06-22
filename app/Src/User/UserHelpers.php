<?php
/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 6/4/15
 * Time: 2:22 PM
 */

namespace App\Src\User;


/**
 * Class UserHelpers
 * @package App\Src\User
 */
trait UserHelpers
{

    /**
     * @return the first role of a user
     */
    public function getUserRole()
    {
        return $this->roles()->get()->first()->name;
    }

    public function isAdmin()
    {
        if ($this->getUserRole() === 'Admin') {
            return true;
        }
        return false;
    }

    public function isEditor()
    {
        if ($this->getUserRole() === 'Editor') {
            return true;
        }
        return false;
    }

    public function isSubscriber()
    {
        if ($this->getUserRole() === 'Subscriber') {
            return true;
        }
        return false;
    }

    public function isActive()
    {
        if ($this->getActiveStatusForUser()->active === 1) {
            return true;
        }
        return false;
    }

}