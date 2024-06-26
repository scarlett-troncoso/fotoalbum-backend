<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePhotoRequest extends FormRequest
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
            'title' => ['required', Rule::unique('photos')->ignore($this->photo?->id)], //l'unico della tabella 'photos';  controllare che sia l'unico con eccezione di se stesso
            'category_id' => 'nullable|exists:categories,id', // verificare che quella category esiste nella table categories colonna id
            'upload_image' => 'nullable|image|max:200',
            'description' => 'nullable',
            'in_evidence' => 'boolean'
        ];
    }
}
