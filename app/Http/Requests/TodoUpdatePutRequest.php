<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TodoUpdatePutRequest extends FormRequest
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
            'title' => ['string','max:255'],
            'priority' => ['string','in:Low,Medium,High'],
            'description' => 'string',
            'is_checked' => 'boolean',
            'due_date' => 'date'
        ];
    }
}
