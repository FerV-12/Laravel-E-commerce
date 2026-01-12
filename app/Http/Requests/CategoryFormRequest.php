<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryFormRequest extends FormRequest
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
            'slug'=>['required'],
            'description'=>['required'],
            'status'=>['required'],
            'popular'=>['nullable'],
            'image'=>['nullable'],
        ];
    }
    protected function prepareForValidation(): void
    {
    $this->merge([
        'uuid' => Str::uuid(),
        'slug' => Str::slug($this->name),
        'popular' => $this->popular == true ? 1 : 0,
    ]);
}
}
