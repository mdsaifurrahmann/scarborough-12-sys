<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\websiteInformationRequest;

class WebsiteInformationController extends Controller
{

    public function index(websiteInformationRequest $request)
    {

        $data = $request->getWebsiteInformation();

        $keywords = json_decode($data['keywords'], true);
        if (is_array($keywords)) {
            $keywords = array_map(function ($item) {
                return $item['value'];
            }, $keywords);
            $keywords = implode(', ', $keywords);
        } else {
            $keywords = '';
        }


        return view('panel.information', [
            'websiteInformation' => $data,
            'keywords' => $keywords,
        ]);

    }

    public function update(websiteInformationRequest $request)
    {
        // Validate and update the website information
        $request->updateWebsiteInformation();

        return redirect()->back()->with('success', 'Website information updated successfully.');
    }

}
