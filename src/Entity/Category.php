<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="App\Repository\ORM\CategoryRepository")
 */
class Category
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=255)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean", length=1, nullable=false)
     */
    private $deleted;

    /**
     * Category constructor.
     * @param string $id
     * @param string $name
     * @param bool $deleted
     */
    public function __construct(string $id, string $name,bool $deleted)
    {
        $this->id = $id;
        $this->name = $name;
        $this->deleted = $deleted;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function changeName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @throws \Exception
     */
    public function delete(): void
    {
        if (!$this->deleted) {
            $this->deleted = 1;
        } else {
            throw new \Exception('You try delete deleted object');
        }
    }
}
