<?php

namespace App\Http\Requests;

use App\Models\ContactSubmission;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreContactSubmissionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email:rfc', 'max:254'],
            'listing_url' => ['nullable', 'url:http,https', 'max:2048'],
            'category' => ['nullable', Rule::in(array_keys(ContactSubmission::categoryOptions()))],
            'service' => ['nullable', Rule::in(array_keys(ContactSubmission::serviceOptions()))],
            'message' => ['nullable', 'string', 'max:5000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $listingUrl = $this->string('listing_url')->trim()->toString();

        if (filled($listingUrl) && ! Str::startsWith($listingUrl, ['http://', 'https://'])) {
            $this->merge(['listing_url' => 'https://'.$listingUrl]);
        }
    }
}
