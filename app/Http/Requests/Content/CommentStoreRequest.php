<?php

namespace App\Http\Requests\Content;

use App\Services\Util\HashIdService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentStoreRequest extends FormRequest
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
            'parent_comment_id' => $this->parent_comment_id ? (new HashIdService())->decode($this->parent_comment_id) : null,
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
            'post_id' => ['required', 'integer', 'exists:App\Models\Post,id'],
            'parent_comment_id' => ['nullable', 'integer', 'exists:App\Models\Comment,id'],
            'message' => ['required', 'string'],
        ];
    }
}
