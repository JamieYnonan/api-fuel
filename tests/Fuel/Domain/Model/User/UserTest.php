<?php
namespace Tests\Fuel\Domain\Model\User;

use PHPUnit\Framework\TestCase;
use Fuel\Domain\Model\User\User;

class UserTest extends TestCase
{

    public function testUserOk()
    {
        $email = 'jamiea31@gmail.com';
        $name = 'Jamie';
        $lastName = 'Ynoñan';
        $password = '123456';
        $user = new User($email, $name, $lastName, $password);

        $this->assertEquals($email, $user->email());
        $this->assertEquals($name, $user->name());
        $this->assertEquals($lastName, $user->lastName());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUserEmailFail()
    {
        $email = 'jamiea31gmail.com';
        $name = 'Jamie';
        $lastName = 'Ynoñan';
        $password = '123456';
        $user = new User($email, $name, $lastName, $password);

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUserNameMinLengthFail()
    {
        $email = 'jamiea31@gmail.com';
        $name = 'Ja';
        $lastName = 'Ynoñan';
        $password = '123456';
        $user = new User($email, $name, $lastName, $password);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUserNameMaxLengthFail()
    {
        $email = 'jamiea31@gmail.com';
        $name = 'qwertyuiopasdfghjklzxcvbnmqwertyuiopasdfghjklz';
        $lastName = 'Ynoñan';
        $password = '123456';
        $user = new User($email, $name, $lastName, $password);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUserLastNameMinLengthFail()
    {
        $email = 'jamiea31@gmail.com';
        $name = 'Jamie';
        $lastName = 'Yn';
        $password = '123456';
        $user = new User($email, $name, $lastName, $password);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUserLastNameMaxLengthFail()
    {
        $email = 'jamiea31@gmail.com';
        $name = 'Jamie';
        $lastName = 'qwertyuiopasdfghjklzxcvbnmqwertyuiopasdfghjklz';
        $password = '123456';
        $user = new User($email, $name, $lastName, $password);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testUserPasswordMinLengthFail()
    {
        $email = 'jamiea31@gmail.com';
        $name = 'Jamie';
        $lastName = 'Ynoñan';
        $password = '12345';
        $user = new User($email, $name, $lastName, $password);
    }
}
