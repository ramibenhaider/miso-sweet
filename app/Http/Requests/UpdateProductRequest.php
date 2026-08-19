<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Set dynamic error bag for the specific product being updated.
     */
    protected function prepareForValidation(): void
    {
        $product = $this->route('product');
        $id = is_object($product) ? $product->id : $product;
        if ($id) {
            $this->errorBag = 'update_' . $id;
        } else {
            $this->errorBag = 'updateProduct';
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:999999',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:10',
            'is_available' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'other_photos' => 'nullable|array',
            'other_photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم المنتج مطلوب',
            'name.string' => 'اسم المنتج يجب أن يكون نصاً',
            'name.max' => 'اسم المنتج يجب ألا يتجاوز 255 حرفاً',
            'price.required' => 'سعر المنتج مطلوب',
            'price.numeric' => 'سعر المنتج يجب أن يكون رقماً',
            'price.min' => 'سعر المنتج لا يمكن أن يكون أقل من 0',
            'price.max' => 'سعر المنتج لا يمكن أن يتجاوز 999999',
            'category_id.required' => 'قسم المنتج مطلوب',
            'category_id.exists' => 'القسم المحدد غير موجود',
            'description.required' => 'وصف المنتج مطلوب',
            'description.string' => 'وصف المنتج يجب أن يكون نصاً',
            'description.min' => 'وصف المنتج يجب أن يكون 10 أحرف على الأقل',
            'is_available.boolean' => 'حالة التوفر غير صحيحة',
            'image.image' => 'صورة المنتج الرئيسية يجب أن تكون صورة',
            'image.mimes' => 'صورة المنتج الرئيسية يجب أن تكون بصيغة: jpeg, png, jpg, gif',
            'image.max' => 'حجم صورة المنتج الرئيسية يجب ألا يتجاوز 2 ميجابايت',
            'other_photos.*.image' => 'الصور الإضافية يجب أن تكون صوراً',
            'other_photos.*.mimes' => 'الصور الإضافية يجب أن تكون بصيغة: jpeg, png, jpg, gif',
            'other_photos.*.max' => 'حجم الصورة الإضافية يجب ألا يتجاوز 2 ميجابايت',
        ];
    }
}
