<?php

namespace App\Entity;

use App\Repository\UrlCodePairEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use http\Exception\InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: UrlCodePairEntityRepository::class)]
#[ORM\Table(name: 'url_codes')]
class UrlCodePairEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    public function __construct(
        #[ORM\Column(length: 255)]
        protected string $url,
        #[ORM\Column(length: 255)]
        protected string $code)
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    public static function createFromArray(array $data): static
    {
        if (!isset($data['url']) || !isset($data['code'])){
            throw new InvalidArgumentException();
        }
        return new static($data['url'], $data['code']);
    }

 }
