<?php namespace Source\SiteUser;

use Domain\Model\SiteUser;
use Source\ValueObject\Email;

/**
 * Class SiteUserRepository
 * @package Source\SiteUser
 */
class SiteUserRepository
{

    /**
     * @var Hashing
     */
    private $hasher;

    public function __construct()
    {
        $this->hasher = app('hash');
    }

    /**
     * Creates a user account.
     *
     * @param Email $email
     * @param string $firstName
     * @param string $password
     * @return SiteUser
     */
    public function createUser(Email $email, $firstName, $password = null)
    {
        $user = new SiteUser();

        $user->email = $email->getEmail();
        $user->firstname = $firstName;

        if ($password) {
            $user->password = $this->hasher->make($password);
        }

        $user->save();

        return $user;
    }

}
