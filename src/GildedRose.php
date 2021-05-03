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
            if ($item->name !== self::NAME_BRIE and $item->name !== self::NAME_BACKSTAGE) {
                if ($item->quality > 0) {
                    if ($item->name !== self::NAME_SULFURAS) {
                        $item->quality--;
                    }
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                    if ($item->name === self::NAME_BACKSTAGE) {
                        if ($item->quality < 50) {
                            if ($item->sell_in < 11) {
                                $item->quality++;
                            }
                            if ($item->sell_in < 6) {
                                $item->quality++;
                            }
                        }
                    }
                }
            }

            if ($item->name !== self::NAME_SULFURAS) {
                $item->sell_in--;
            }

            if ($item->sell_in < 0) {
                if ($item->name !== self::NAME_BRIE) {
                    if ($item->name !== self::NAME_BACKSTAGE) {
                        if ($item->quality > 0) {
                            if ($item->name !== self::NAME_SULFURAS) {
                                $item->quality--;
                            }
                        }
                    } else {
                        $item->quality = 0;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality++;
                    }
                }
            }
        }
    }
}
