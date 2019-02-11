<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Swagger\Annotations as SWG;

/**
 * @ORM\Entity()
 */
class Movie implements JsonSerializable
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @SWG\Property(description="The unique identifier of the movie.")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @SWG\Property(type="string", maxLength=255, description="Name")
     */
    private $name;

    /**
     * @var DateTime
     * @ORM\Column(type="date")
     * @SWG\Property(type="string", description="Release date")
     */
    private $releaseDate;

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'releaseDate' => $this->releaseDate,
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getReleaseDate(): ?DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param DateTime $releaseDate
     */
    public function setReleaseDate($releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }
}
