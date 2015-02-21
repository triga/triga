<?php namespace Source\SiteUser\Command;

use Renuval\Commands\Command;
use Source\ValueObject\Email;

/**
 * CreateUser command.
 *
 * @package Source\SiteUser\Command
 */
class CreateUserCommand extends Command
{

    /**
     * @var Email Email adress.
     */
    private $email;

    /**
     * @var string First name.
     */
    private $firstName;

    /**
     * @var string Password.
     */
    private $password;

    public function __construct(Email $email, $firstName, $password = null)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->password = $password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getPassword(){
        return $this->password;
    }

}
