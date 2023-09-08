<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PDOException;
use Exception;

class Login extends Component
{
    public $form = [
        'email' => '',
        'password' => ''
    ];
    public $response;

    public function render()
    {
        return view('livewire.auth.login')
            ->extends('layouts.layout')
            ->section('content');
    }

    public function login()
    {
        // Validate login values with Validator
        $validator = Validator::make($this->form, [
            "email" => "required|string|email|max:255",
            "password" => "required|string|min:8"
        ]);
        if ($validator->fails()) {
            $this->response = $this->errorList($validator);
        } else {
            // If all values are valid, then try to login
            try {
                if (!Auth::attempt($this->form)) {
                    $this->response = "Bad Credentials";
                } else {
                    return redirect(route('show'));
                }
            } catch (PDOException $e) {
                $this->response = json_encode($e->getMessage());
            } catch (Exception $e) {
                $this->response = json_encode($e->getMessage());
            }
        }
    }

    // Get all errors and convert them into a string
    private function errorList(ValidationValidator $validator) : string
    {
        $errors = [];
        $err = $validator->errors();
        foreach($err->all() as $e) {
            $errors[] = $e;
        }
        return implode('<br>', $errors);
    }
}
