<?php

namespace App\Entity;

use App\Repository\CiudadesRepository;
use Symfony\component\Validator\Constraint as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CiudadesRepository::class)
 */
#[ORM\Entity(repositoryClass: CiudadesRepository::class)]
class Ciudades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * (message="El nombre es obligatorio")
     */
    private ?string $nombre = null;
    
    #[ORM\Column(length: 255)]
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * (message="El numero de habitantes es obligatorio")
     */
    private ?string $habitantes = null;

    #[ORM\Column(length: 100)]
    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * (message="El nombre del alcalde es obligatorio")
     */
    private ?string $alcalde = null;

    #[ORM\ManyToOne(inversedBy: 'ciudades')]
    /**
     * @ORM\ManyToOne(targetEntity=Pais::class)
     */
    private ?Pais $pais = null;

    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getHabitantes(): ?string
    {
        return $this->habitantes;
    }

    public function setHabitantes(string $habitantes): self
    {
        $this->habitantes = $habitantes;

        return $this;
    }

    public function getAlcalde(): ?string
    {
        return $this->alcalde;
    }

    public function setAlcalde(string $alcalde): self
    {
        $this->alcalde = $alcalde;

        return $this;
    }

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

}
