<?php declare(strict_types = 1);

namespace Runroom\GildedRose;

class Item
{
    private string $name;
    private int $sellIn;
    private int $quality;

    public function __construct(string $name, int $sellIn, int $quality)
    {
        $this->name = $name;
        $this->sellIn = $sellIn;
        $this->quality = $quality;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    public function setSellIn(int $sellIn): self
    {
        $this->sellIn = $sellIn;

        return $this;
    }

    public function decreaseSellIn(): void
    {
        --$this->sellIn;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function setQuality(int $quality): self
    {
        $this->quality = $quality;

        return $this;
    }

    public function decreaseQuality(): void
    {
        --$this->quality;
    }

    public function increaseQuality(): void
    {
        ++$this->quality;
    }

    public function resetQuality(): void
    {
        $this->quality = 0;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}
