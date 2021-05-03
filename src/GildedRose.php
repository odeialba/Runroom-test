<?php

namespace Runroom\GildedRose;

class GildedRose
{
    private CONST NAME_BRIE = 'Aged Brie';
    private CONST NAME_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    private CONST NAME_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    /** @var Item[] $items */
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->getName()) {
                case self::NAME_SULFURAS:
                    break;
                case self::NAME_BRIE:
                    $this->updateBrie($item);
                    break;
                case self::NAME_BACKSTAGE:
                    $this->updateBackstage($item);
                    break;
                default:
                    $this->updateCommon($item);
                    break;
            }
        }
    }

    private function updateBrie(Item $item): void
    {
        $this->checkAndIncreaseQuality($item);

        if ($this->decreaseAndCheckSellIn($item)) {
            $this->checkAndIncreaseQuality($item);
        }
    }

    private function updateBackstage(Item $item): void
    {
        $this->checkAndIncreaseQuality($item);

        if ($item->getQuality() < 50) {
            $this->increaseQualityBySellIn($item);
        }

        if ($this->decreaseAndCheckSellIn($item)) {
            $item->resetQuality();
        }
    }

    private function updateCommon(Item $item): void
    {
        $this->checkAndDecreaseQuality($item);

        if ($this->decreaseAndCheckSellIn($item)) {
            $this->checkAndDecreaseQuality($item);
        }
    }

    private function checkAndIncreaseQuality(Item $item): void
    {
        if ($item->getQuality() < 50) {
            $item->increaseQuality();
        }
    }

    private function checkAndDecreaseQuality(Item $item): void
    {
        if ($item->getQuality() > 0) {
            $item->decreaseQuality();
        }
    }

    private function increaseQualityBySellIn(Item $item): void
    {
        if ($item->getSellIn() < 11) {
            $item->increaseQuality();
        }

        if ($item->getSellIn() < 6) {
            $item->increaseQuality();
        }
    }

    private function decreaseAndCheckSellIn(Item $item): bool
    {
        $item->decreaseSellIn();

        return $item->getSellIn() < 0;
    }
}
