<?php
class UserManager {
    private $users = [];

    public function __construct(array $users = []) {
        $this->users = $users;
    }

    public function register(string $username, string $password, string $email): bool {
        if (isset($this->users[$username])) {
            return false; // user exists
        }
        $this->users[$username] = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email' => $email
        ];
        return true;
    }

    public function login(string $username, string $password): bool {
        if (!isset($this->users[$username])) {
            return false;
        }
        return password_verify($password, $this->users[$username]['password']);
    }

    public function resetPassword(string $username, string $email, string $newPassword): bool {
        if (!isset($this->users[$username])) {
            return false;
        }
        if ($this->users[$username]['email'] !== $email) {
            return false;
        }
        $this->users[$username]['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        return true;
    }

    public function getUsers(): array {
        return $this->users;
    }
}
