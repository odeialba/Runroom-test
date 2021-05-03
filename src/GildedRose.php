<?php

namespace Runroom\GildedRose;

class GildedRose
{
    private CONST NAME_BRIE = 'Aged Brie';
    private CONST NAME_BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';
    private CONST NAME_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case self::NAME_BRIE:
                    $this->updateBrie($item);
                    break;
                case self::NAME_BACKSTAGE:
                    $this->updateBackstage($item);
                    break;
                case self::NAME_SULFURAS:
                    $this->updateSulfuras($item);
                    break;
                default:
                    $this->updateCommon($item);
                    break;
            }
        }
    }

    private function updateBrie(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality++;
        }

        if (--$item->sell_in >= 0) {
            return;
        }

        if ($item->quality < 50) {
            $item->quality++;
        }
    }

    private function updateBackstage(Item $item): void
    {
        if ($item->quality < 50) {
            if (++$item->quality < 50) {
                if ($item->sell_in < 11) {
                    $item->quality++;
                }
                if ($item->sell_in < 6) {
                    $item->quality++;
                }
            }
        }

        if (--$item->sell_in >= 0) {
            return;
        }

        $item->quality = 0;
    }

    private function updateSulfuras(Item $item): void
    {
    }

    private function updateCommon(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality--;
        }

        if (--$item->sell_in >= 0) {
            return;
        }

        if ($item->quality > 0) {
            $item->quality--;
        }
    }
}
