<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubscriptionRequest extends FormRequest
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
      'code' => 'sometimes|required|string|max:255|' . Rule::unique('subscriptions', 'code')->ignore($this->subscription),
      'customer_code' => 'sometimes|required|string|exists:customers,code',
      'package_code' => 'sometimes|required|string|exists:packages,code',
      'tgl_mulai' => 'sometimes|required|date',
      'tgl_akhir' => 'sometimes|required|date|after:tgl_mulai',
      'price' => 'sometimes|required|numeric|min:0',
      'status' => 'sometimes|required|string|in:active,inactive',
    ];
  }
}
