<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
      'code' => 'required|string|unique:invoices,code',
      'customer_code' => 'required|string|exists:customers,code',
      'subscription_code' => 'required|string|exists:subscriptions,code',
      'tgl' => 'required|date',
      'invoice_number' => 'required|string|unique:invoices,invoice_number',
      'periode_tagihan' => 'required|string',
      'tgl_jatuh_tempo' => 'required|date',
      'amount' => 'required|numeric',
      'status' => 'required|in:unpaid,paid,overdue',
    ];
  }
}
