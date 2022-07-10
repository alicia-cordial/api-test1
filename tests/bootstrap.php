<?php

namespace App\Tests\Entity;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class User extends \PHPUnit\Framework\TestCase
{
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

}