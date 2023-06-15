<?php

namespace App\Http\Livewire\Frontend;

use App\Domains\Auth\Models\Advisory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RegistrationTable extends DataTableComponent {

	/**
	 * @return Builder
	 */
	public function query(): Builder {
		Return Advisory::query();
	}

	/**
	 * @return array
	 */
	public function columns(): array {
		return [
			Column::make( __( 'ID' ) )->sortable(),
			Column::make( __('Action taken') )->sortable()
		];
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function rowView(): string {
		return 'frontend.registry.includes.row';
	}

}