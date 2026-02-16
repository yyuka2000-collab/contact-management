<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email'],
            'tel_first' => ['required', 'numeric', 'digits_between:1,5'],
            'tel_second' => ['required', 'numeric', 'digits_between:1,5'],
            'tel_third' => ['required', 'numeric', 'digits_between:1,5'],
            'address' => ['required', 'string'],
            'building' => ['nullable', 'string'],
            'categry_id' => ['required'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    // バリデーションメッセージ
    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.max' => '姓は8文字以内で入力してください',
            'first_name.required' => '名を入力してください',
            'first_name.max' => '名は8文字以内で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel_first.required' => '電話番号を入力してください',
            'tel_first.numeric' => '電話番号は半角英数字で入力してください',
            'tel_first.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_second.required' => '電話番号を入力してください',
            'tel_second.numeric' => '電話番号は半角英数字で入力してください',
            'tel_second.digits_between' => '電話番号は5桁まで数字で入力してください',
            'tel_third.required' => '電話番号を入力してください',
            'tel_third.numeric' => '電話番号は半角英数字で入力してください',
            'tel_third.digits_between' => '電話番号は5桁まで数字で入力してください',
            'address.required' => '住所を入力してください',
            'categry_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    // バリデーション後に電話番号を結合
    protected function prepareForValidation()
    {
        // バリデーション前の処理は不要
    }

    // バリデーション成功後にデータを加工
    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        // 電話番号を結合
        if (isset($data['tel_first']) && isset($data['tel_second']) && isset($data['tel_third'])) {
            $data['tel'] = $data['tel_first'] . $data['tel_second'] . $data['tel_third'];
            unset($data['tel_second'], $data['tel_third']);
        }

        return $data;
    }
}
