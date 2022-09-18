<?php

namespace App\Entity;

use App\Repository\ApiUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ApiUserRepository::class)
 */
class ApiUser implements UserInterface
{
    /**
     * @var string
     */
    public final const ROLE_DEFAULT = 'ROLE_USER';

    /**
     * @var string
     */
    public final const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    public function __construct()
    {
        $this->apiToken = $this->generateToken();
    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private string $apiToken;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $description = "";


    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private array $roles = [];

    public function getUserIdentifier(): string
    {
        return "apiToken";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }


    public function setApiToken(string $apiToken): self
    {
        $this->apiToken = $apiToken;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    protected function generateToken(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * @return mixed[]
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_API';

        return array_unique($roles);
    }

    public function addRole(string $role): void
    {
        $role = strtoupper($role);

        if ($role === static::ROLE_DEFAULT) {
            return;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
    }

    public function removeRole(string $role): void
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }
    }


    public function setRoles(array $roles): void
    {
        $this->roles = [];

        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    public function eraseCredentials(): void
    {
        $this->setApiToken($this->generateToken());
    }

    public function getPassword(): void
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt(): void
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername(): void
    {
    }
}
