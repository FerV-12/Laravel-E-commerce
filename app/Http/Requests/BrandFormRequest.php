<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
class BrandFormRequest extends FormRequest
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
            'uuid'=>['required'],
            'name'=>['required'],
            'image'=>['nullable'],
            'is_active'=>['required'],
        ];
    }
     protected function prepareForValidation(): void
     {
        $this->merge([
        'uuid' => Str::uuid(),
        'is_active' => $this->is_active == true ? 1 : 0,
        ]);
    }

}
