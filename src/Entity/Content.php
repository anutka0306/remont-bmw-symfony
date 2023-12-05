<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $page_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $path = null;

    #[ORM\ManyToOne(targetEntity: self::class)]
    private ?self $parent_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $h1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meta_title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $meta_description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\Column]
    private ?bool $published = null;

    #[ORM\Column(nullable: true)]
    private ?int $sort = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'contents')]
    private ?Brand $brand = null;

    #[ORM\ManyToOne(inversedBy: 'submodel')]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'contents')]
    private ?Submodel $submodel = null;

    #[ORM\ManyToOne(inversedBy: 'contents')]
    private ?Service $service = null;

    #[ORM\Column(nullable: true)]
    private ?bool $in_header_nav = null;

    #[ORM\Column(nullable: true)]
    private ?bool $in_footer_nav = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $menu_name = null;

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

    public function getPageType(): ?string
    {
        return $this->page_type;
    }

    public function setPageType(?string $page_type): static
    {
        $this->page_type = $page_type;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getParentId(): ?self
    {
        return $this->parent_id;
    }

    public function setParentId(?self $parent_id): static
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    public function getH1(): ?string
    {
        return $this->h1;
    }

    public function setH1(?string $h1): static
    {
        $this->h1 = $h1;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->meta_title;
    }

    public function setMetaTitle(?string $meta_title): static
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(?string $meta_description): static
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): static
    {
        $this->sort = $sort;

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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getSubmodel(): ?Submodel
    {
        return $this->submodel;
    }

    public function setSubmodel(?Submodel $submodel): static
    {
        $this->submodel = $submodel;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function isInHeaderNav(): ?bool
    {
        return $this->in_header_nav;
    }

    public function setInHeaderNav(?bool $in_header_nav): static
    {
        $this->in_header_nav = $in_header_nav;

        return $this;
    }

    public function isInFooterNav(): ?bool
    {
        return $this->in_footer_nav;
    }

    public function setInFooterNav(?bool $in_footer_nav): static
    {
        $this->in_footer_nav = $in_footer_nav;

        return $this;
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
}
