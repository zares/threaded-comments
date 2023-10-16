<?php

namespace App\Http\Requests;

use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Support\Utils;

class CommentRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            'id'         => 'nullable|exists:comments,id',
            'parent_id'  => 'nullable|exists:comments,id',
            'user_name'  => 'required|min:3|max:255|regex:/^[a-zA-Z0-9_]+$/',
            'email'      => 'required|email|max:255',
            'home_page'  => 'nullable|url|max:255',
            'captcha'    => 'required|regex:/^[a-zA-Z0-9]+$/',
            'text'       => 'required|max:1024|min:3',
            'image'      => 'nullable',
            'file'       => 'nullable',
            'token'      => 'nullable|ulid',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.exists'        => 'The comment you are trying to edit was not found!',
            'parent_id.exists' => 'The comment you are replying to was not found!',
            'token.ulid'       => 'You do not have access to edit this message!',
            'captcha.regex'    => 'Wrong answer in captcha field!',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     * @return array
     */
    public function after(): array
    {
        return [
            function (\Illuminate\Validation\Validator $validator) {
                if (! app('captcha')->verify($this->input('captcha'))) {
                    $validator->errors()->add(
                        'captcha',
                        'Wrong answer in captcha field!'
                    );
                }
            },
            function (\Illuminate\Validation\Validator $validator) {
                $id = $this->input('id');
                $token = $this->input('token');
                if (($id && $token) && ! Utils::verifyToken($id, $token)) {
                    $validator->errors()->add(
                        'token',
                        'You do not have access to edit this message!'
                    );
                }
            }
        ];
    }

    /**
     * Return exception as json.
     * @param  Validator $validator
     * @return Exception
     */
    protected function failedValidation(Validator $validator)
    {
        // We should show only the first errors
        $errors = $this->fistErrors($validator->errors());

        throw new HttpResponseException(response()->json($errors, 422));
    }

    /**
     * Returns only first errors for each field.
     * @param  MessageBag $messageBag
     * @return array
     */
    private function fistErrors(MessageBag $messageBag)
    {
        $errors = [];
        foreach ($messageBag->keys() as $key){
            $errors[$key] = $messageBag->first($key);
        }

        return $errors;
    }

}
