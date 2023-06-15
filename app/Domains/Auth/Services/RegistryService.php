<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Advisory;
use App\Domains\Auth\Models\Registration;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Exception;

class RegistryService extends BaseService {
	
	public function __construct( Advisory $advisory ) {
		$this->model = $advisory;
	}

	public function getAll( array $columns = ['*'] ) {
		return $this->model->with('registration')
			->where('registration_id', '!=', 'null')
			->get( $columns );
	}
	
	public function update( int $id, string $impact, string $measure ): Advisory {
	
		DB::beginTransaction();
		
		try {
			$registration = new Registration();
			$registration->impact = $impact;
			$registration->measure = $measure;
			$registration->save();

			$advisory = Advisory::find($id);
			$advisory->registration_id = $registration->id;
			$advisory->save();
		} catch( Exception $e ) {
			DB::rollBack();
		}
		
		DB::commit();
		
		return $this->model;
	
	}
	
}