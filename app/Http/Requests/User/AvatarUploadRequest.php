<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;

class AvatarUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => [
                'required',
                'mimes:' . config('uploads.images.mime_types'),
                File::image()
                    ->max(config('uploads.images.maximum_size'))
                    ->dimensions(
                        Rule::dimensions()
                            ->maxWidth(config('uploads.images.max_width_dimensions'))
                            ->maxHeight(config('uploads.images.max_height_dimensions'))
                    ),
            ]
        ];
    }
}
