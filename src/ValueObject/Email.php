<?php namespace Source\ValueObject;

/**
 * Email value object.
 *
 * @package Source\ValueObject
 */
class Email {

    /**
     * @var string Email address.
     */
    protected $email;

    public function __construct($email)
    {
        if (false === filter_var((string) $email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid email address.', $email));
        };

        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function __toString(){
        return $this->email;
    }

}
