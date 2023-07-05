<?php

namespace App\Jobs;

use App\Domains\Auth\Models\Advisory;
use App\Registry\Feed\Reader;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Vedmant\FeedReader\FeedReader;

class RetrieveFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const FEED_URL = 'https://advisories.ncsc.nl/rss/advisories';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle( FeedReader $feedReader )
    {
        $reader = new Reader( $feedReader );
        $skipped = 0;
        $inserted = 0;
        $softwareUsed = config('feedregistry.used_software');
        foreach( $reader->getItems() as $feedItem ) {
            list( $chance, $damage ) = $feedItem->getDamage();
            $hasChangeOrDamageLevel = $chance >= config('feedregistry.min_chance_level') && $damage >= config('feedregistry.min_damage_level');
            $hasSoftwareInTitle = count( array_filter( $softwareUsed, function( $package ) use ( $feedItem ) { return strstr( strtolower( $feedItem->getTitle() ), $package ); } ) );
            if ( $hasSoftwareInTitle == 0 && !$hasChangeOrDamageLevel ) {
                ++$skipped;
                continue;
            }

            $advisory = Advisory::firstOrCreate(
                [
                    'ncsc_id' => $feedItem->getId(),
                    'version' => $feedItem->getVersion(),
                    'title' => $feedItem->getTitle()
                ],
                [
                    'url' => $feedItem->getUrl(),
                    'chance' => $chance,
                    'damage'=> $damage,
                    'desc' => $feedItem->getDesc()
                ]
            );
            $advisory->save();
            ++$inserted;
        }
        Log::info("Retrieve feed result", [ "skipped" => $skipped, "inserted" => $inserted ] );
    }
}
