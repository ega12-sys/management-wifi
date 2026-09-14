<?php

namespace App\Http\Requests\Customer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
      'code' => 'required|string|max:4|' . Rule::unique('customers', 'code')->ignore($this->customer), //menghindari duplikasi kode
      'name' => 'required|string',
      'phone' => 'required|string|max:20',
      'email' => 'nullable|string',
      'address' => 'required|string',
      'status' => 'required|string',
      'installation_date' => 'required|date'
    ];
  }
}
