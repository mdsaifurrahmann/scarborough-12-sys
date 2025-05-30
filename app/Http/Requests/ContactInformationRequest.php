<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\contactInformation as ContactInformationModel;
use Illuminate\Support\Facades\DB;

class ContactInformationRequest extends FormRequest
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
            'facebook_username' => 'nullable|string',
            'instagram_username' => 'nullable|string',
            'linkedin_username' => 'nullable|string',
            'youtube_username' => 'nullable|string',

            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'location' => 'nullable|string',

            'contact_form_email' => 'nullable|email',
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
            'facebook_username.string' => 'The Facebook username must be a string.',
            'instagram_username.string' => 'The Instagram username must be a string.',
            'linkedin_username.string' => 'The LinkedIn username must be a string.',
            'youtube_username.string' => 'The YouTube username must be a string.',

            'phone.string' => 'The phone number must be a string.',
            'email.email' => 'The email address must be a valid email format.',
            'location.string' => 'The location must be a string.',

            'contact_form_email.email' => 'The contact form email must be a valid email format.',
        ];
    }


    /*
    * Update the contact information.
    */
    public function updateContactInformation(): void
    {

        $data = $this->validated();

        try {

            DB::beginTransaction();

            foreach ($data as $key => $value) {
                if (in_array($key, ['facebook_username', 'instagram_username', 'linkedin_username', 'youtube_username', 'phone', 'email', 'location', 'contact_form_email'])) {
                    ContactInformationModel::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value]
                    );
                }
            }

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            throw new \Exception('Error updating contact information: ' . $e->getMessage());
        }
    }

    public function getContactInformation(): array
    {
        $contactInfo = ContactInformationModel::all()->pluck('value', 'key')->toArray();
        return $contactInfo;
    }
}
