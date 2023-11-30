<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelRepository::class)]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'models')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brand $brand_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name_rus = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'model_id', targetEntity: Submodel::class, orphanRemoval: true)]
    private Collection $submodels;

    #[ORM\OneToMany(mappedBy: 'model', targetEntity: Content::class)]
    private Collection $submodel;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $menu_name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $show_in_menu = null;

    #[ORM\Column(nullable: true)]
    private ?int $menu_order = null;

    public function __construct()
    {
        $this->submodels = new ArrayCollection();
        $this->submodel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrandId(): ?Brand
    {
        return $this->brand_id;
    }

    public function setBrandId(?Brand $brand_id): static
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    public function getNameRus(): ?string
    {
        return $this->name_rus;
    }

    public function setNameRus(?string $name_rus): static
    {
        $this->name_rus = $name_rus;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Submodel>
     */
    public function getSubmodels(): Collection
    {
        return $this->submodels;
    }

    public function addSubmodel(Submodel $submodel): static
    {
        if (!$this->submodels->contains($submodel)) {
            $this->submodels->add($submodel);
            $submodel->setModelId($this);
        }

        return $this;
    }

    public function removeSubmodel(Submodel $submodel): static
    {
        if ($this->submodels->removeElement($submodel)) {
            // set the owning side to null (unless already changed)
            if ($submodel->getModelId() === $this) {
                $submodel->setModelId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Content>
     */
    public function getSubmodel(): Collection
    {
        return $this->submodel;
    }

    public function getMenuName(): ?string
    {
        return $this->menu_name;
    }

    public function setMenuName(?string $menu_name): static
    {
        $this->menu_name = $menu_name;

        return $this;
    }

    public function isShowInMenu(): ?bool
    {
        return $this->show_in_menu;
    }

    public function setShowInMenu(?bool $show_in_menu): static
    {
        $this->show_in_menu = $show_in_menu;

        return $this;
    }

    public function getMenuOrder(): ?int
    {
        return $this->menu_order;
    }

    public function setMenuOrder(?int $menu_order): static
    {
        $this->menu_order = $menu_order;

        return $this;
    }
}
