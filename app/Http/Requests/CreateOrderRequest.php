<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest {
    public function authorize(): bool {
        // Any authenticated user can place an order
        return $this->user() !== null;
    }

    public function rules(): array {
        return [
            'staff_id' => 'required|exists:users,id',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1'
        ];
    }
}