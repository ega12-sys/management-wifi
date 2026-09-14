<?php

namespace App\Http\Requests\PackageType;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePackageTypeRequest extends FormRequest
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
    /* post request dari react */
    return [
      'code' => [
        'required',
        'string',
        'max:10',
        'unique:package_types,code',
      ],

      'description' => [
        'nullable',
        'string',
      ],
    ];
  }
}
