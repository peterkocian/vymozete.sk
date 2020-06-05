<?php

namespace KornerBI\UserManagement\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * User model.
     *
     * @var object
     */
    private $user;

    /**
     * Create a new command instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $details = $this->getDetails();

        $user = $this->createUser($details);

        $this->display($user);
    }

    /**
     * Ask for user details.
     *
     * @return array
     */
    private function getDetails() : array
    {
        $details['name']    = $this->ask('Enter name', 'Admin');
        $details['surname'] = $this->ask('Enter surname', 'Korner');
        $details['email']   = $this->ask('Enter email/login', 'admin@korner.bi');
        $details['password'] = $this->secret('Enter '.$details["email"].' password');
        $details['confirm_password'] = $this->secret('Confirm password');

        while (!$this->isValidPassword($details['password'], $details['confirm_password'])) {
            if (!$this->isRequiredLength($details['password'])) {
                $this->error('Password must be longer or equals to 6 characters');
            }

            if (! $this->isMatch($details['password'], $details['confirm_password'])) {
                $this->error('Password and Confirm password do not match');
            }

            $details['password'] = $this->secret('Enter password again');
            $details['confirm_password'] = $this->secret('Confirm password');
        }

        return $details;
    }

    /**
     * Save user to DB
     *
     * @param array $details
     * @return User|bool
     */
    private function createUser(array $details)
    {
        $user = new User($details);
        $user->password = bcrypt($details['password']);

        if (!$user->save()) {
            $this->error('Something went wrong!');
            return false;
        }

        return $user;
    }

    /**
     * Display created user.
     *
     * @param User $user
     * @return void
     */
    private function display(User $user) : void
    {
        $headers = ['Name', 'Surname', 'Email/Login'];

        $fields = [
            'name'      => $user->name,
            'surname'   => $user->surname,
            'email'     => $user->email
        ];

        $this->info('User created successfully');
        $this->table($headers, [$fields]);
    }

    /**
     * Check if password is valid
     *
     * @param string $password
     * @param string $confirmPassword
     * @return boolean
     */
    private function isValidPassword(string $password, string $confirmPassword) : bool
    {
        return $this->isRequiredLength($password) && $this->isMatch($password, $confirmPassword);
    }

    /**
     * Check if password and confirm password matches.
     *
     * @param string $password
     * @param string $confirmPassword
     * @return bool
     */
    private function isMatch(string $password, string $confirmPassword) : bool
    {
        return Hash::check($confirmPassword, bcrypt($password));
    }

    /**
     * Checks if password is longer or equals to 6 characters.
     *
     * @param string $password
     * @return bool
     */
    private function isRequiredLength(string $password) : bool
    {
        return strlen($password) >= 6;
    }
}
