<?php


namespace App\Registry\Feed;

use Vedmant\FeedReader\FeedReader;

class Reader
{
    private const FEED_URL = 'https://advisories.ncsc.nl/rss/advisories';

    private array $items = [];

    public function __construct( FeedReader $reader ) {
        $f = $reader->read( self::FEED_URL );
        foreach ( $f->get_items() as $item ) {
            $this->items[] = new Item( $item );
        }
    }

    /**
     * Returns all the items
     *
     * @return Item[]
     */
    public function getItems(): array {
        return $this->items;
    }

}