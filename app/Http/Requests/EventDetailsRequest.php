<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\EventDetails as EventDetailsModel;
use App\Services\FileUpload;

class EventDetailsRequest extends FormRequest
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
            'countdown_to' => 'nullable|date',
            'event_date' => 'nullable|string',
            'event_title' => 'nullable|string',
            'location_link' => 'nullable|url',
            'location_name' => 'nullable|string',
            'location_desc' => 'nullable|string',
            'hero_bg' => 'nullable|image|max:1024',
            'sponsors' => 'nullable|image|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'countdown_to.date' => 'The countdown to date must be a valid date.',
            'event_date.string' => 'The event date must be a valid date.',
            'event_title.string' => 'The event title must be a string.',
            'location_link.url' => 'The location link must be a valid URL.',
            'location_name.string' => 'The location name must be a string.',
            'location_desc.string' => 'The location description must be a string.',
            'hero_bg.image' => 'The hero background must be an image file.',
            'hero_bg.max' => 'The hero background image must not exceed 1MB.',
            'sponsors.image' => 'The sponsors image must be an image file.',
            'sponsors.max' => 'The sponsors image must not exceed 1MB.',
        ];
    }

    public function updateEventDetails(): void
    {
        $data = $this->validated();

        foreach ($data as $key => $value) {
            if(in_array($key, ['hero_bg', 'sponsors'])) {
                $existingRecord = EventDetailsModel::where('key', $key)->first();
                $value = FileUpload::update($key, $existingRecord, 'value', 'event_details');
            }

            EventDetailsModel::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }

    public function getEventDetails(): array
    {
        $eventDetails = EventDetailsModel::all()->pluck('value', 'key')->toArray();
        return $eventDetails;
    }
}
