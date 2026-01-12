<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateProductFormRequest extends FormRequest
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
            'uuid' => ['required'],
            'category_id' => ['nullable'],
            'brand_id' => ['nullable'],
            'name' => [
                'required',
                'unique:products,name'
            ],
            'slug' => ['required'],
            'small_description' => ['required'],
            'description' => ['required'],
            'original_price' => ['required', 'integer'],
            'selling_price' => ['required', 'integer'],
            'image' => ['nullable'],
            'quantity' => [
                'required',
                'integer'
            ],
            'is_trending' => ['required'],
            'is_active' => ['required'],
        ];
    }

     protected function prepareForValidation(): void
    {
    $this->merge([
        'uuid' => Str::uuid(),
        'slug' => Str::slug($this->name),
        'is_trending' => $this->is_trending == true ? 1 : 0,
        'is_active' => $this->is_active == true ? 1 : 0,
    ]);
}
}
