<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @return array
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    // public function getCredentials()
    // {
    //     // The form field for providing username or password
    //     // have name of "username", however, in order to support
    //     // logging users in with both (username and email)
    //     // we have to check if user has entered one or another
    //     $name = $this->get('name');

    //     if ($this->isEmail($name)) {
    //         return [
    //             'email' => $name,
    //             'password' => $this->get('password')
    //         ];
    //     }

    //     return $this->only('username', 'password');
    // }

    /**
     * Validate if provided parameter is valid email.
     *
     * @param $param
     * @return bool
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    // private function isEmail($param)
    // {
    //     $factory = $this->container->make(ValidationFactory::class);

    //     return ! $factory->make(
    //         ['username' => $param],
    //         ['username' => 'email']
    //     )->fails();
    // }
}
