<?php

namespace App\Http\Requests\Payment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'code' => 'required|string|max:15|' . Rule::unique('payments', 'code')->ignore($this->payment), //agar tidak terjadi duplicate
      'invoice_code' => 'required|string',
      'tgl_bayar' => 'required|date',
      'amount' => 'required|numeric',
      'metode_pembayaran' => 'required|string',
      'notes' => 'nullable|string'
    ];
  }
}
