<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateProfileRequest extends FormRequest
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
        $user = $this->route('user') ?? $this->user();

        return [
            'name' => 'required|string|max:150',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'delete_picture' => 'nullable|boolean',
            'current_password' => ['nullable', 'required_with:password', function ($attribute, $value, $fail) use ($user) {
                if ($value && !Hash::check($value, $user->password)) {
                    $fail('كلمة المرور الحالية غير صحيحة');
                }
            }],
            'password' => 'nullable|required_with:current_password|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'يجب أن يكون الاسم من حروف',
            'name.max' => 'يجب ألا يتجاوز الاسم 150 حرفاً',
            'picture.image' => 'يجب أن يكون الملف المرفق صورة',
            'picture.mimes' => 'صيغ الصور المسموح بها هي: jpeg, png, jpg, gif, svg, webp',
            'picture.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميجابايت',
            'current_password.required_with' => 'يرجى إدخال كلمة المرور الحالية لتغيير كلمة المرور',
            'password.required_with' => 'يرجى إدخال كلمة المرور الجديدة',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 خانات',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
        ];
    }
}
