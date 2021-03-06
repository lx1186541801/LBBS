<?php

namespace App\Http\Requests;


class TopicRequest extends Request
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'title' => 'required|min:2',
                        'body'  =>  'required|min:3',
                        'category_id'   =>  'required|numeric',
                    ];
                };


            case 'GET':
            case 'DELETE':
            default:
                {
                    return [];
                };
        }
        
    }

    public function messages()
    {
        return [
            'title.min'    =>  '标题至少两个字符',
            'body.min'    =>  '标题至少三个字符',
        ];
    }
}
