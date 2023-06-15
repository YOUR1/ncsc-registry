<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Registry;

use App\Domains\Auth\Models\Registration;
use App\Domains\Auth\Services\RegistryService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class RegistryController {
	
	private RegistryService $registryService;
	
	public function __construct( RegistryService $registryService ) {
		$this->registryService = $registryService;
	}

	/**
	 * @param Request $request 
	 * @param int $id 
	 * 
	 * @return View|Factory 
	 * 
	 * @throws ModelNotFoundException 
	 * @throws BindingResolutionException 
	 */
	public function view( Request $request, int $id ) {
		$advisory = $this->registryService->getById( $id );
		$registration = Registration::find($advisory->registration_id);

		return view("frontend.registry.view", [
			"advisory" => $advisory,
			'registration' => $registration
		]);
	}

	/**
	 * @param Request $request 
	 * @param int $id 
	 * 
	 * @return RedirectResponse 
	 * 
	 * @throws Throwable 
	 * @throws BindingResolutionException 
	 * @throws RouteNotFoundException 
	 */
	public function update( Request $request, int $id ) {
		$request->validate([
			'impact' => 'required',
			'measure' => 'required'
		]);

		$this->registryService->update(
			(int) $id,
			$request->input('impact'),
			$request->input('measure')
		);
		
		session()->flash('flash_success', __('The advisory was successfully updated.'));
		
		return redirect()->route('frontend.user.registry.view', $id);
	}
	
}