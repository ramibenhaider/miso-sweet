<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class registerationRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'email' => 'required|string|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
                function ($attribute, $value, $fail) {
                    if ($value && !preg_match('/[A-Z]/', $value)) {
                        $fail('يجب أن تحتوي كلمة المرور على حرف كبير واحد على الأقل (A-Z)');
                    }
                    if ($value && !preg_match('/[^\w\s]|_/', $value)) {
                        $fail('يجب أن تحتوي كلمة المرور على رمز خاص واحد على الأقل (مثل @#$%)');
                    }
                },
            ],
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'يجب أن يكون الاسم من حروف',
            'name.max' => 'يجب ألا يتجاوز الاسم 150 حرفاً',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.string' => 'يجب أن يكون البريد الإلكتروني نصاً',
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح',
            'email.unique' => 'البريد الإلكتروني مُستخدم من قبل',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.string' => 'يجب أن تكون كلمة المرور نصاً',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين',
            'password.min' => 'يجب ألا تقل كلمة المرور عن 8 خانات',
            'picture.image' => 'يجب أن يكون الملف المرفق صورة',
            'picture.mimes' => 'صيغ الصور المسموح بها هي: jpeg, png, jpg, gif, svg, webp',
            'picture.max' => 'يجب ألا يتجاوز حجم الصورة 2 ميجابايت',
        ];
    }
}
