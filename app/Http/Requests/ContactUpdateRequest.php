<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactUpdateRequest extends FormRequest
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
        $contactId = Contact::first()?->id;

        return [
            'whatsapp'  => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'whatsapp')->ignore($contactId)],
            'phone1'    => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'phone1')->ignore($contactId), 'different:phone2', 'different:phone3'],
            'phone2'    => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'phone2')->ignore($contactId), 'different:phone1', 'different:phone3'],
            'phone3'    => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'phone3')->ignore($contactId), 'different:phone1', 'different:phone2'],
            'email'     => ['nullable', 'max:255', 'email', Rule::unique('contacts', 'email')->ignore($contactId)],
            'facebook'  => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'facebook')->ignore($contactId)],
            'tiktok'    => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'tiktok')->ignore($contactId)],
            'instagram' => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'instagram')->ignore($contactId)],
            'youtube'   => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'youtube')->ignore($contactId)],
        ];
    }

    public function messages(): array
    {
        return [
            'whatsapp.unique'  => 'رقم الواتساب موجود مسبقا',
            'whatsapp.digits_between'  => 'يجب ألا يتجاوز رقم الواتساب 15 رقماً',
            'phone1.unique'    => 'رقم الهاتف الأول موجود مسبقا',
            'phone1.digits_between'       => 'يجب ألا يتجاوز رقم الهاتف الأول 15 رقماً',
            'phone1.different' => 'رقم الهاتف الأول يجب ألا يتطابق مع الهاتف الثاني أو الثالث',
            'phone2.unique'    => 'رقم الهاتف الثاني موجود مسبقا',
            'phone2.digits_between'       => 'يجب ألا يتجاوز رقم الهاتف الثاني 15 رقماً',
            'phone2.different' => 'رقم الهاتف الثاني يجب ألا يتطابق مع الهاتف الأول أو الثالث',
            'phone3.unique'    => 'رقم الهاتف الثالث موجود مسبقاً',
            'phone3.digits_between'       => 'يجب ألا يتجاوز رقم الهاتف الثالث 15 رقماً',
            'phone3.different' => 'رقم الهاتف الثالث يجب ألا يتطابق مع الهاتف الأول أو الثاني',
            'email.unique'     => 'البريد الإلكتروني موجود مسبقاً',
            'email.email'      => 'يجب أن يكون البريد الإلكتروني بصيغة صحيحة',
            'email.max'        => 'يجب ألا يتجاوز البريد الإلكتروني 255 حرفاً',
            'facebook.unique'  => 'رابط الفيسبوك موجود مسبقاً',
            'facebook.max'     => 'يجب ألا يتجاوز رابط الفيسبوك 255 حرفاً',
            'tiktok.unique'    => 'رابط التيك توك موجود مسبقاً',
            'tiktok.max'       => 'يجب ألا يتجاوز رابط التيك توك 255 حرفاً',
            'instagram.unique' => 'رابط الإنستغرام موجود مسبقاً',
            'instagram.max'    => 'يجب ألا يتجاوز رابط الإنستغرام 255 حرفاً',
            'youtube.unique'   => 'رابط اليوتيوب موجود مسبقاً',
            'youtube.max'      => 'يجب ألا يتجاوز رابط اليوتيوب 255 حرفاً',
        ];
    }
}
