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
            if (! in_array($item->name, [self::NAME_BRIE, self::NAME_BACKSTAGE], true)) {
                if ($item->quality > 0 && $item->name !== self::NAME_SULFURAS) {
                    $item->quality--;
                }
            } elseif ($item->quality < 50) {
                $item->quality++;
                if ($item->name === self::NAME_BACKSTAGE && $item->quality < 50) {
                    if ($item->sell_in < 11) {
                        $item->quality++;
                    }
                    if ($item->sell_in < 6) {
                        $item->quality++;
                    }
                }
            }

            if ($item->name !== self::NAME_SULFURAS) {
                $item->sell_in--;
            }

            if ($item->sell_in >= 0) {
                continue;
            }

            if ($item->name === self::NAME_BACKSTAGE) {
                $item->quality = 0;
                continue;
            }

            if ($item->name === self::NAME_BRIE) {
                if ($item->quality < 50) {
                    $item->quality++;
                }

                continue;
            }

            if ($item->quality > 0 && $item->name !== self::NAME_SULFURAS) {
                $item->quality--;
                continue;
            }
        }
    }
}
