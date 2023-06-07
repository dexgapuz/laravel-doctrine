<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class Employee implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $firstName;

    /**
     * @ORM\Column(type="string")
     */
    protected string $lastName;

    public function jsonSerialize(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName
        ];
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
}
