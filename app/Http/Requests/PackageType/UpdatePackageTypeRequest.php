<?php

namespace App\Http\Requests\PackageType;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageTypeRequest extends FormRequest
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
        Rule::unique('package_types', 'code')
          ->ignore($this->package_type->id), //agar tidak duplicate saat edit
      ],

      'description' => [
        'nullable',
        'string',
      ],
    ];
  }
}
