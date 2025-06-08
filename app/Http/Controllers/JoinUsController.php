<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JoinUsRequest;

class JoinUsController extends Controller
{
    public function index(JoinUsRequest $request)
    {
        $data = $request->getJoinUs();

        return view('panel.joinus', [
            'data' => $data,
        ]);
    }

    public function update(JoinUsRequest $request)
    {
        $request->updateJoinUs();

        return redirect()->back()->with('success', 'Join Us information updated successfully.');
    }
}
