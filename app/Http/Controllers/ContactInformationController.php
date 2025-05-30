<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactInformationRequest;

class ContactInformationController extends Controller
{
    public function index(ContactInformationRequest $request)
    {

        $data = $request->getContactInformation();

        return view('panel.contact-information', [
            'data' => $data,
        ]);

    }

    public function update(ContactInformationRequest $request)
    {
        $request->updateContactInformation();

        return redirect()->back()->with('success', 'Contact information updated successfully.');
    }

}
