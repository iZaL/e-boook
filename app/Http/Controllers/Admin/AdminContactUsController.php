<?php

namespace App\Http\Controllers\Admin;

use App\Src\Contactus\Contactus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminContactUsController extends Controller
{
    //
    public $contactus;
    public function __construct(Contactus $contactus) {
        $this->contactus = $contactus;
    }

    public function edit() {
        $contactInfo = $this->contactus->find(1)->first();
        return view('admin.modules.contactus.edit',['contactInfo' => $contactInfo]);
    }

    public function update(Request $request) {
        $this->contactus->update(Input::except('_token'));
        return redirect()->back()->with('success','Contact Us Information has been updated');

    }
}
