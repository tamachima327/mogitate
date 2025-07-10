<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $actionMethod = $this->route()->getActionMethod();

        $rules = [
            'name' => 'required',
            'price' => 'required|integer|between:0,10000',
            'image' => 'required|image|mimes:jpeg,png',
            'description' => 'required|max:120',
            'seasons' => 'required|array',
        ];

        if ($actionMethod == 'update') {
            $rules['image'] = 'nullable|image|mimes:jpeg,png';
        }

        return $rules;
    }

    /**
     * Set messages when validated.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attributeを入力してください',
            'seasons.required' => ':attributeを選択してください',
            'image.required' => ':attributeを登録してください',
            'image.image' => ':attributeは画像で登録してください',
            'price.integer' => '数値で入力してください',
            'price.between' => ':minから:max円以内で入力してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'description.max' => ':max文字以内で入力してください',
        ];
    }

    /**
     * Set attributed of fields.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '商品名',
            'price' => '値段',
            'image' => '商品画像',
            'description' => '商品説明',
            'seasons' => '季節',
        ];
    }
}
