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
                case self::NAME_BRIE:
                    $this->updateBrie($item);
                    break;
                case self::NAME_BACKSTAGE:
                    $this->updateBackstage($item);
                    break;
                case self::NAME_SULFURAS:
                    break;
                default:
                    $this->updateCommon($item);
                    break;
            }
        }
    }

    private function updateBrie(Item $item): void
    {
        $item->checkAndIncreaseQuality();
        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->checkAndIncreaseQuality();
        }
    }

    private function updateBackstage(Item $item): void
    {
        $item->checkAndIncreaseQuality();

        if ($item->getQuality() < 50) {
            if ($item->getSellIn() < 11) {
                $item->increaseQuality();
            }

            if ($item->getSellIn() < 6) {
                $item->increaseQuality();
            }
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->resetQuality();
        }
    }

    private function updateCommon(Item $item): void
    {
        $item->checkAndDecreaseQuality();
        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->checkAndDecreaseQuality();
        }
    }
}
