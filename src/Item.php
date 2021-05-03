<?php

namespace Runroom\GildedRose;

class Item
{
    private string $name;
    public int $sell_in;
    private int $quality;

    public function __construct(string $name, int $sellIn, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sellIn;
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
        return $this->sell_in;
    }

    public function setSellIn(int $sellIn): self
    {
        $this->sell_in = $sellIn;

        return $this;
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

    public function checkAndIncreaseQuality(): void
    {
        if ($this->getQuality() < 50) {
            $this->increaseQuality();
        }
    }

    public function checkAndDecreaseQuality(): void
    {
        if ($this->getQuality() > 0) {
            $this->decreaseQuality();
        }
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}
