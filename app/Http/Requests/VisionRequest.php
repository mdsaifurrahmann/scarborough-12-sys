<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\websiteInformation as WebsiteInformationModel;
use App\Services\FileUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class VisionRequest extends FormRequest
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
            'vision_desc' => 'nullable|string',
            'vision_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'vision_desc.string' => 'The vision description must be a string.',
            'vision_image.image' => 'The vision image must be an image file.',
            'vision_image.mimes' => 'The vision image must be a file of type: jpeg, png, jpg, svg.',
            'vision_image.max' => 'The vision image may not be greater than 1024 kilobytes.',
        ];
    }

    public function updateVision()
    {
        $data = $this->validated();

        try {

            DB::beginTransaction();

            foreach ($data as $key => $value) {

                if (in_array($key, ['vision_image'])) {
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
            throw new \Exception('Error updating Vision information: ' . $e->getMessage());
        }

        if ($this->hasFile('vision_image')) {
            $data['vision_image'] = $this->file('vision_image')->store('visions', 'public');
        }
    }


    public function getVision()
    {
        // Fetch the vision description and image from the database within a single query
        $vision = WebsiteInformationModel::whereIn('key', ['vision_desc', 'vision_image'])->pluck('value', 'key');

        // dd($vision);

        return $vision;

    }
}
