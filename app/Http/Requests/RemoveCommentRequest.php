<?php

namespace App\Http\Requests;

use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Support\Utils;

class RemoveCommentRequest extends FormRequest
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
            'id'    => 'required|integer|exists:comments,id',
            'token' => 'required|ulid',
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
                $id = $validator->validated()['id'];
                $token = $validator->validated()['token'];
                if (($id && $token) && ! Utils::verifyToken($id, $token)) {
                    $validator->errors()->add('token', 'Access denied!');
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
        foreach ($messageBag->keys() as $key) {
            $errors[$key] = $messageBag->first($key);
        }

        return $errors;
    }

}
