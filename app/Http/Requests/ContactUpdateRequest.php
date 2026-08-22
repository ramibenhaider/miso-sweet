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
            'phone1'    => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'phone1')->ignore($contactId), 'different:phone2', 'different:phone3'],
            'phone2'    => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'phone2')->ignore($contactId), 'different:phone1', 'different:phone3'],
            'phone3'    => ['nullable', 'digits_between:1,15', Rule::unique('contacts', 'phone3')->ignore($contactId), 'different:phone1', 'different:phone2'],
            'email'     => ['nullable', 'max:255', 'email', Rule::unique('contacts', 'email')->ignore($contactId)],
            'whatsapp'  => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'whatsapp')->ignore($contactId)],
            'facebook'  => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'facebook')->ignore($contactId)],
            'tiktok'    => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'tiktok')->ignore($contactId)],
            'instagram' => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'instagram')->ignore($contactId)],
            'youtube'   => ['nullable', 'max:255', 'string', Rule::unique('contacts', 'youtube')->ignore($contactId)],
            'hero_video_file'  => ['nullable', 'file', 'mimes:mp4,mov,ogg,qt,webm', 'max:51200'],
            'hero_video'       => ['nullable', 'string'],
            'hero_title'       => ['nullable', 'string', 'max:255'],
            'hero_subtitle'    => ['nullable', 'string'],
            'hero_button_text' => ['nullable', 'string', 'max:255'],
            'hero_button_link' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'whatsapp.unique'  => 'رقم الواتساب موجود مسبقا',
            'whatsapp.max'  => 'إما أن تكون هذه الخانة من رقم هاتف لا يتعدى 15 رقماً أو رابط واتساب',
            'whatsapp.string' => 'إما أن تكون هذه الخانة من رقم هاتف لا يتعدى 15 رقماً أو رابط واتساب',
            'phone1.unique'    => 'رقم الهاتف موجود مسبقا',
            'phone1.digits_between'       => 'يجب ألا يتجاوز رقم الهاتف 15 رقماً',
            'phone1.different' => 'رقم الهاتف موجود مسبقاً',
            'phone2.unique'    => 'رقم الهاتف موجود مسبقا',
            'phone2.digits_between'       => 'يجب ألا يتجاوز رقم الهاتف 15 رقماً',
            'phone2.different' => 'رقم الهاتف موجود مسبقاً',
            'phone3.unique'    => 'رقم الهاتف موجود مسبقاً',
            'phone3.digits_between'       => 'يجب ألا يتجاوز رقم الهاتف 15 رقماً',
            'phone3.different' => 'رقم الهاتف موجود مسبقاً',
            'email.unique'     => 'البريد الإلكتروني موجود مسبقاً',
            'email.email'      => 'البريد الإلكتروني غير صحيح',
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
