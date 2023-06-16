<?php

namespace App\Http\Livewire\Frontend;

use App\Domains\Auth\Models\Advisory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RegistrationTable extends DataTableComponent {

	public $columnSearch = [
		'ID' => 'ncsc_id',
		'Title' => 'title'
	];

	/**
	 * @return Builder
	 */
	public function query(): Builder {
		Return Advisory::query()->orderBy( 'ncsc_id', 'desc' )->orderBy( 'version', 'desc' )->limit( 100 );
	}

	/**
	 * @return array
	 */
	public function columns(): array {
		return [
			Column::make( __( 'ID' ) ),
			Column::make( __( 'Title' ) ),
			Column::make( __( 'Version') ),
			Column::make( __( 'Action taken' ) )
		];
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function rowView(): string {
		return 'frontend.registry.includes.row';
	}

}