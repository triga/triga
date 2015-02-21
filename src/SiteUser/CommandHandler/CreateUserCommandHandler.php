<?php namespace Source\SiteUser\CommandHandler;

use Illuminate\Database\QueryException;
use Source\SiteUser\Command\CreateUserCommand;
use Source\SiteUser\SiteUserRepository;

/**
 * CreateUser command handler.
 *
 * @package Source\SiteUser\CommandHandler
 */
class CreateUserCommandHandler
{

    /**
     * @var SiteUserRepository
     */
    private $siteUsers;

    public function __construct(SiteUserRepository $siteUsers)
    {
        $this->siteUsers = $siteUsers;
    }

    public function handle(CreateUserCommand $command)
    {
        try {
            return $this->siteUsers->createUser($command->getEmail(), $command->getFirstName(), $command->getPassword());
        } catch (QueryException $e) {
            return false;
        }
    }

}
