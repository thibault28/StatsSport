<?php

namespace App\Entity;

use App\Repository\MachinesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use DateTime;
use DateTimeZone;

/**
 * @ORM\Entity(repositoryClass=MachinesRepository::class)
 * @Vich\Uploadable
 */
class Machines
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="machines", fileNameProperty="image")
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Le fichier choisi ne correspond pas à un fichier valide format accepté : jpg,png",
     *     notFoundMessage = "Le fichier n'a pas été trouvé sur le disque",
     *     uploadErrorMessage = "Erreur dans l'upload du fichier"
     * )
     * @var File
     */

    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=MachineCategory::class, inversedBy="machines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $machineCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(File $image): self
    {
        $this->imageFile = $image;
        if ($image instanceof File) {
            $this->updatedAt = new DateTime('now', new DateTimeZone('Europe/Paris'));
        }
        return $this;
    }

    public function getmachineCategory(): ?machineCategory
    {
        return $this->machineCategory;
    }

    public function setmachineCategory(?machineCategory $machineCategory): self
    {
        $this->machineCategory = $machineCategory;

        return $this;
    }
}
