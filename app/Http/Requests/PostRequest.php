<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return true;
    // return false;のままだと403エラー
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'post.title' => 'required|max:50',
            'post.body' => 'nullable|max:200',
            'post.category_id' => 'nullable',
            'post.priority_id' => 'nullable',
            'post.deadline' => 'nullable|date',
            
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'post.title' => 'Title',
            'post.body' => 'To Do details',
            'post.category_id' => 'Category',
            'post.priority_id' => 'Priority',
            'post.deadline' => 'Deadline'
        ];
    }
}