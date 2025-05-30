<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\FileUpload;
use App\Models\websiteInformation as WebsiteInformationModel;
use Database\Seeders\websiteInformation;
use Illuminate\Support\Facades\DB;

class websiteInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:512',
            'description' => 'nullable|string',
            'keywords' => 'nullable',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.string' => 'The title must be a string.',

            'logo.string' => 'The logo must be a string.',
            'logo.image' => 'The logo must be an image file.',
            'logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg, svg.',
            'logo.max' => 'The logo must not be greater than 1MB.',
            
            'thumbnail.string' => 'The thumbnail must be a string.',
            'thumbnail.image' => 'The thumbnail must be an image file.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, svg.',
            'thumbnail.max' => 'The thumbnail must not be greater than 2MB.',

            'favicon.string' => 'The favicon must be a string.',
            'favicon.image' => 'The favicon must be an image file.',
            'favicon.mimes' => 'The favicon must be a file of type: jpeg, png, jpg, svg.',
            'favicon.max' => 'The favicon must not be greater than 512KB.',

            'description.string' => 'The description must be a string.',
            'keywords.string' => 'The keywords must be a string.',
            'url.url' => 'The URL must be a valid URL.',
        ];
    }

    /**
     * Update the website information in the database.
     * 
     */

     public function updateWebsiteInformation(): void
     {

        $data = $this->validated();


        try{
            DB::beginTransaction();
            
            // find the key from $data and update the value in the database
            foreach ($data as $key => $value) {
                if (in_array($key, ['logo', 'thumbnail', 'favicon'])) {


                    // fetch existing record of logo, thumbnail, favicon
                    $existingRecord = WebsiteInformationModel::where('key', $key)->first();
                    
                    $value = FileUpload::update($key, $existingRecord, 'value', 'website_information');
                }

                WebsiteInformationModel::updateOrCreate(
                    ['key' => $key],
                    ['value' => is_array($value) ? json_encode($value) : $value]
                );
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            // Handle the exception
            throw new \Exception('Error updating website information: ' . $e->getMessage());
        }

         
     }

     public function getWebsiteInformation(): array
     {
         $websiteInformation = WebsiteInformationModel::all()->pluck('value', 'key')->toArray();
         return $websiteInformation;
     }


}
