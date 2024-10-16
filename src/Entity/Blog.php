<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    const SUBMODEL_SERVICES = [2,3,4,5,6,68,75,580,4750];
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $published = null;

    #[ORM\Column(length: 511)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $short_descr = null;

    #[ORM\Column(length: 511, nullable: true)]
    private ?string $slug = null;
	
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $gallery;
	
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private $content_img;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meta_title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $meta_descr = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $meta_keywords = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $table_content = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;
	
    /*#[ORM\Column(length: 11, nullable: true)]
    private ?int $model_id = null;*/
	
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $engine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $car_body = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mileage = null;
	
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'submodel')]
    private ?Model $model = null;

    #[ORM\ManyToOne(inversedBy: 'contents')]
    private ?Submodel $submodel = null;

    public function __toString():string
    {
        return $this->id .' - ' .$this->name;
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

    public function getShortDescr(): ?string
    {
        return $this->short_descr;
    }

    public function setShortDescr(?string $short_descr): static
    {
        $this->short_descr = $short_descr;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }


    public function getGallery(): ?array
    {
        if($this->gallery) {
            return explode('|', $this->gallery);
        }else{
            return array();
        }
    }

    public function setGallery(?array $gallery): self
    {
        if($gallery == ''){
            $this->gallery = '';
        }else{
            $this->gallery = implode('|',$gallery);
        }

        return $this;
    }


    public function getContentImg(): ?array
    {
        if($this->content_img) {
            return explode('|', $this->content_img);
        }else{
            return array();
        }
    }

    public function setContentImg(?array $content_img): self
    {
        if($content_img == ''){
            $this->content_img = '';
        }else{
            $this->content_img = implode('|',$content_img);
        }

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

    public function getMetaDescr(): ?string
    {
        return $this->meta_descr;
    }

    public function setMetaDescr(?string $meta_descr): static
    {
        $this->meta_descr = $meta_descr;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->meta_keywords;
    }

    public function setMetaKeywords(?string $meta_keywords): static
    {
        $this->meta_keywords = $meta_keywords;

        return $this;
    }

    public function getTableContent(): ?string
    {
        return $this->table_content;
    }

    public function setTableContent(?string $table_content): static
    {
        $this->table_content = $table_content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

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

    /*public function getModelId(): ?int
    {
        return $this->model_id;
    }

    public function setModelId(?int $model_id): static
    {
        $this->model_id = $model_id;

        return $this;
    }*/
	
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

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(?string $engine): static
    {
        $this->engine = $engine;

        return $this;
    }

    public function getCarBody(): ?string
    {
        return $this->car_body;
    }

    public function setCarBody(?string $car_body): static
    {
        $this->car_body = $car_body;

        return $this;
    }

    public function getMileage(): ?string
    {
        return $this->mileage;
    }

    public function setMileage(?string $mileage): static
    {
        $this->mileage = $mileage;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

}
