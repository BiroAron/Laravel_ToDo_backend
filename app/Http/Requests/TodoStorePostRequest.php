<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TodoStorePostRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255'],
            'user_id' => ['required','integer'],
            'priority' => ['string','in:Low,Medium,High'],
            'description' => 'string',
            'is_checked' => 'boolean',
            'due_date' => 'date'
        ];
    }
}
