<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisionRequest;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    public function index(VisionRequest $request)
    {

        $data = $request->getVision();

        return view('panel.vision', [
            'data' => $data,
        ]);

    }

    public function update(VisionRequest $request)
    {
        $request->updateVision();

        return redirect()->back()->with('success', 'Vision information updated successfully.');
    }
}
