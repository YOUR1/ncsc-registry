<?php

namespace App\Domains\Auth\Http\Controllers\Backend\NCSC;


/**
 * Class RegistrationController.
 */
class RegistrationController
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.ncsc.index');
    }

}
