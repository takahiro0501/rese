<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopMakeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'overview' => ['required', 'string', 'max:250'],
            'file' => ['required', 'max:10240', 'mimes:jpg,jpeg,png,gif']
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '50文字以内で入力してください',
            'name.string' => '文字で入力してください',
            'overview.required' => '店舗詳細説明を入力してください',
            'overview.max' => '250文字以内で入力してください',
            'overview.string' => '文字で入力してください',
            'file.required' => 'ファイルを指定してください',
            'file.max' => 'ファイルサイズ上限(10MB)を超えています',
            'file.mimes' => 'ファイル拡張子は、「jpg」「jpeg」「png」「gif」を指定してください',
            'update.max' => 'ファイルサイズ上限(10MB)を超えています',
            'update.mimes' => 'ファイル拡張子は、「jpg」「jpeg」「png」「gif」を指定してください'
        ];
    }
}
