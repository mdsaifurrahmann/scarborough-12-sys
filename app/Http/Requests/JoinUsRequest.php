<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\websiteInformation as WebsiteInformationModel;
use Illuminate\Support\Facades\DB;

class JoinUsRequest extends FormRequest
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
            'join_us_description' => 'nullable|string',
            'careers_description' => 'nullable|string',
            'artists_text' => 'nullable|string',
            'volunteers_text' => 'nullable|string',
            'vendors_text' => 'nullable|string',
            'sponsors_text' => 'nullable|string',
        ];
    }


    public function message(): array
    {
        return [
            'join_us_description.string' => 'The join us description must be a string.',
            'careers_description.string' => 'The careers description must be a string.',
            'artists_text.string' => 'The artists text must be a string.',
            'volunteers_text.string' => 'The volunteers text must be a string.',
            'vendors_text.string' => 'The vendors text must be a string.',
            'sponsors_text.string' => 'The sponsors text must be a string.',
        ];
    }

    public function updateJoinUs()
    {
        $data = $this->validated();

        try{

            DB::beginTransaction();

            foreach ($data as $key => $value) {
                // Assuming you have a model to handle the join us information
                // Update or create the record in the database
                WebsiteInformationModel::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            // Handle the exception, log it, or rethrow it
            throw new \Exception('Error updating join us information: ' . $e->getMessage());
        }   
    }


    public function getJoinUs(): array
    {
        $data = WebsiteInformationModel::whereIn('key', [
            'join_us_description',
            'careers_description',
            'artists_text',
            'volunteers_text',
            'vendors_text',
            'sponsors_text'
        ])->pluck('value', 'key')->toArray();

        return $data;
    }
}
