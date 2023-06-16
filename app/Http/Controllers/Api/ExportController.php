<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\Services\RegistryService;
use Illuminate\Http\Request;

class ExportController {

    private RegistryService $registryService;
	
	public function __construct( RegistryService $registryService ) {
		$this->registryService = $registryService;
	}

    public function index( Request $request, string $type ) {
        if ( $type === 'json' ) {
            $request->headers->set( 'Accept', 'application/json' );
        } else if ( $type === 'wiki' ) {
            $request->headers->set( 'Accept', 'text/html' );
        } else {
            return abort( 404, trans('API resource not found') );
        }

        if ( $type === 'json' ) {
            $this->asJson();
        } else {
            $this->asWiki();
        }

    }

    private function asJson() {
        echo json_encode(
             $this->registryService->getAll(
                config('feedregistry.api.json.columns')
             ) 
            );
    }

    private function asWiki() {
        $advisories = $this->registryService->getAll();

        if ( count ( $advisories ) === 0 ) {
            return;
        }

        $output = "{| class=\"wikitable sortable\"" . PHP_EOL;
        $output .= sprintf( "! %s || %s || %s || %s || %s || %s || " . PHP_EOL, trans('NCSC ID' ), trans('Title'), trans('Version'), trans('Chance / Damage' ), trans('Impact'), trans('Measure') );
        $output .= "|-" . PHP_EOL;
        foreach ( $advisories as $advisory ) {
            $output .= sprintf( "|%s", "[{$advisory->url} {$advisory->ncsc_id}]" ) . PHP_EOL;
            $output .= sprintf( "|%s", $advisory->title . PHP_EOL );
            $output .= sprintf( "|%s", $advisory->version . PHP_EOL );
            $output .= sprintf( "|%s", getChanceDamageLevel($advisory->chance, $advisory->damage ) ) . PHP_EOL;
            $output .= sprintf( "|%s", $advisory->registration->impact ) . PHP_EOL;
            $output .= sprintf( "|%s", $advisory->registration->measure ) . PHP_EOL;
            $output .= sprintf( "|[%s %s]", route('frontend.user.registry.view', $advisory->id), trans("See details") ) . PHP_EOL;
            $output .= "|-" . PHP_EOL;
        }
        $output .= "|}";

        echo nl2br( $output );
    }


}