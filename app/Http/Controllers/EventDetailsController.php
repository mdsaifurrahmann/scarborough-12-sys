<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventDetailsRequest;
use Illuminate\Http\Request;

class EventDetailsController extends Controller
{
    public function index(EventDetailsRequest $request)
    {
        $data = $request->getEventDetails();
        return view('panel.event-details', [
            'data' => $data,
        ]);
    }

    public function update(EventDetailsRequest $request)
    {
        $request->updateEventDetails();

        return redirect()->back()->with('success', 'Event details updated successfully.');
    }

}
