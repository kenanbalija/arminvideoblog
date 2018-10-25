<?php
/*
 *
 * OVO JE VALIDACIJA INPUT FIELDOVA IZ FORME
 *
 * */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckCommentRequest extends FormRequest
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
            'post_id' => 'required',
            'comment' => 'required|max:255',
        ];
    }
}
