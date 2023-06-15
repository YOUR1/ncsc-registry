<?php

use App\Registry\Feed\Item;

if (! function_exists('getChanceDamageLevel')) {
    /**
     * Converts the chance and damage levels to a string.
     * 
     * @param int $chance
     * @param int $damage
     *
     * @return string
     */
    function getChanceDamageLevel( int $chance, int $damage ) {
        switch( $chance ) {
            case Item::CHANCE_LOW:
                $chance = "Low";
                break;
            case Item::CHANCE_MEDIUM:
                $chance = "Medium";
                break;
            case Item::CHANCE_HIGH:
                $chance = "High";
                break;
        }

        switch( $damage ) {
            case Item::DAMAGE_LOW:
                $damage = "Low";
                break;
            case Item::DAMAGE_MEDIUM:
                $damage = "Medium";
                break;
            case Item::DAMAGE_HIGH:
                $damage = "High";
                break;
        }

        return sprintf("%s / %s", $chance, $damage);
    }
}