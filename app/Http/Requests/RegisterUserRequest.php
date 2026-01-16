<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest {
    public function authorize(): bool {
        // Only Admin can create/update products
        return $this->user()->isAdmin();
    }

    public function rules(): array {
        $productId = $this->route('product')?->id ?? null;

        return [
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed',
        ];
    }
}