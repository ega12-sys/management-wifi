<?php

namespace App\Http\Requests\Package;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'code' => 'required|string|max:5|unique:packages,code',
      'name' => 'required|string|max:100',
      'package_type_code' => 'required|string|exists:package_types,code',
      'speed' =>  'required|string|max:20',
      'price' => 'required|numeric|min:0',
      'description' => 'nullable|string',
      'status' => 'required|in:1,0'
    ];
  }
}
