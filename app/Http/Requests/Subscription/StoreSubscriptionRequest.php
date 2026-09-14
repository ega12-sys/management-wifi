<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends FormRequest
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
      'code' => 'required|string|max:255|unique:subscriptions,code',
      'customer_code' => 'required|string|exists:customers,code',
      'package_code' => 'required|string|exists:packages,code',
      'tgl_mulai' => 'required|date',
      'tgl_akhir' => 'required|date|after:tgl_mulai',
      'price' => 'required|numeric|min:0',
      'status' => 'required|string|in:active,inactive',
    ];
  }
}
