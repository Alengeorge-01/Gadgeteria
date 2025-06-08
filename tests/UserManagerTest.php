<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../public/controllers/UserManager.php';

class UserManagerTest extends TestCase {
    public function testRegister() {
        $um = new UserManager();
        $this->assertTrue($um->register('alice', 'secret', 'alice@example.com'));
        $this->assertFalse($um->register('alice', 'other', 'alice@example.com'));
    }

    public function testLogin() {
        $um = new UserManager();
        $um->register('bob', 'pwd', 'bob@example.com');
        $this->assertTrue($um->login('bob', 'pwd'));
        $this->assertFalse($um->login('bob', 'wrong'));
    }

    public function testPasswordReset() {
        $um = new UserManager();
        $um->register('carol', 'pass', 'carol@example.com');
        $this->assertTrue($um->resetPassword('carol', 'carol@example.com', 'new')); 
        $this->assertTrue($um->login('carol', 'new'));
        $this->assertFalse($um->resetPassword('carol', 'bad@example.com', 'x'));
    }
}
