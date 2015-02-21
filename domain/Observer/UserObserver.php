<?php namespace Domain\Observer;

use Domain\Model\User;

/**
 * User model observer.
 *
 * @package Domain\Observer
 */
class UserObserver {

    public function creating(User $user){
        return $user;
    }

}
