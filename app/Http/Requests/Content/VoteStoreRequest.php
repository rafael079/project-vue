<?php

namespace App\Http\Requests\Content;

use App\Services\Util\HashIdService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VoteStoreRequest extends FormRequest
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
            'post_id' => (new HashIdService())->decode($this->post_id),
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
            'post_id' => ['required', 'exists:App\Models\Post,id'],
            'vote' => ['required', 'in:up,down'],
            'current' => ['nullable', 'in:up,down'],
        ];
    }
}
