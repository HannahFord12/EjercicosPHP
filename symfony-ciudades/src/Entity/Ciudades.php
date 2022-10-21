<?php

namespace App\Entity;

use App\Repository\CiudadesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CiudadesRepository::class)]
class Ciudades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $habitantes = null;

    #[ORM\Column(length: 100)]
    private ?string $alcalde = null;

    #[ORM\Column(length: 255)]
    private ?string $pais = null;

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

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }
}
