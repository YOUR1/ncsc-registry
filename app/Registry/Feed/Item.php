<?php

namespace App\Registry\Feed;

use SimplePie\Item as SimplePieItem;

class Item
{
    private $id;

    private $ver;

    private $damage;

    private $title;

    private $desc;

    private $url;

    private $updated_date;

    public const CHANCE_LOW = 1;
    public const CHANCE_MEDIUM = 2;
    public const CHANCE_HIGH = 3;

    public const DAMAGE_LOW = 1;
    public const DAMAGE_MEDIUM = 2;
    public const DAMAGE_HIGH = 3;

    public function __construct( SimplePieItem $item ) {
        $this->parseTitle( $item->get_title() );
        $this->desc = $item->get_description();
        $this->url = $item->get_link();
        $this->updated_date = $item->data['child'][""]["pubDate"][0]["data"] ?? null;
    }

    /**
     * Parses the title attribute 
     *
     * @param string $title
     * @return void
     */
    private function parseTitle( string $title ) {
        $values = explode( ' ', $title );
        $this->id = array_shift( $values );
        $this->ver = str_replace( [ '[', ']' ], '', array_shift( $values ) );
        $this->damage = str_replace( [ '[', ']' ], '', array_shift( $values ) );
        $this->title = implode(  ' ', $values );
    }

    /**
     * Returns the NCSC ID 
     *
     * @return string|null
     */
    public function getId(): ?string {
        return $this->id;
    }

    /**
     * Returns the version of this item
     *
     * @return string|null
     */
    public function getVersion(): ?string {
        return $this->ver;
    }

    /**
     * Returns the damage, first value is chance, and second value is damage 
     *
     * @return array
     */
    public function getDamage(): array {
        $damageValues = explode( '/', $this->damage );
        $chance = $damageValues[0];
        switch ( $chance ) {
            case 'L':
                $chance = self::CHANCE_LOW;
                break;
            case 'M':
                $chance = self::CHANCE_MEDIUM;
                break;
            case 'H':
                $chance = self::CHANCE_HIGH;
        }
        $damage = $damageValues[1];
        switch ( $damage ) {
            case 'L':
                $damage = self::DAMAGE_LOW;
                break;
            case 'M':
                $damage = self::DAMAGE_MEDIUM;
                break;
            case 'H': 
                $damage = self::DAMAGE_HIGH;
                break;
        }
        return [ $chance, $damage ];
    }

    /**
     * Returns the title of this item
     *
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * Returns the description of 
     *
     * @return string|null
     */
    public function getDesc(): ?string {
        return $this->desc;
    }

    /**
     * Returns the URL of this item
     *
     * @return string|null
     */
    public function getUrl(): ?string {
        return $this->url;
    }

    /**
     * Returns the updated string of this item (in DateTime)
     *
     * @return DateTime
     */
    public function getUpdatedDate(): \DateTime {
        return new \DateTime( $this->updated_date );
    }

}
