<?php

namespace App\Http\Requests\Package;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
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
      'code' => [
        'required',
        'string',
        'max:10',
        Rule::unique('packages', 'code')->ignore($this->package), //agar tidak terjadi duplicate
      ],
      'name' => 'required|string',
      'package_type_code' => 'required|accepted|exists:package_types,code',
      'speed' => 'required|string',
      'price' => 'required|numeric|min:0',
      'description' => 'nullable|string',
      'status' => 'required|in:1,0',
    ];
  }
}
