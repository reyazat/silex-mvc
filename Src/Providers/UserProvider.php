<?php
namespace Providers;
 
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;

class UserProvider implements UserProviderInterface
{
    protected $app;
	
	public function __construct($app){
		$this->app = $app;
    }
    public function loadUserByUsername($username)
    {	
	
		if($this->app['helper']('Utility')->notEmpty($username)){
		
			$user = $this->app['load']('Models_Users')->existUsername($username);

			if ($this->app['helper']('Utility')->notEmpty($user)) {

				return new User($user['username'], $user['password'], explode(',', $user['roles']), true, true, true, true);
			}else{
				$this->app->abort(404,sprintf('Username "%s" does not exist.', $username));
			}
		}else{
			
			$this->app->abort(404,sprintf('Username "%s" does not exist.', $username));
		}

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
}