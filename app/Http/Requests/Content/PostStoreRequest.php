<?php

namespace App\Http\Requests\Content;

use App\Services\Util\HashIdService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'category' => $this->category ? (new HashIdService())->decode($this->category) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:300'],
            'content' => ['nullable', 'string'],
            'category' => ['nullable', 'exists:App\Models\Category,id'],
            'url' => ['nullable', 'url', 'string'],
            'urlImages.*' => ['nullable', 'url', 'string'],
            'images.*' => [
                'nullable',
                'image',
                'mimes:' . config('uploads.images.mime_types'),
                File::image()
                    ->max(config('uploads.images.maximum_size'))
                    ->dimensions(
                        Rule::dimensions()
                            ->maxWidth(config('uploads.images.max_width_dimensions'))
                            ->maxHeight(config('uploads.images.max_height_dimensions'))
                    )
            ],
        ];
    }
}
