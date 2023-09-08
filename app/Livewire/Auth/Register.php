<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use PDOException;
use Exception;

class Register extends Component
{
    public $prueba = '';
    public $form = [
        'name' => '',
        'email' => '',
        'password' => ''
    ];
    public $response;

    public function render()
    {
        return view('livewire.auth.register')
            ->extends('layouts.layout')
            ->section('content');
    }

    public function register()
    {
        // Validate new user values with Validator
        $validator = Validator::make($this->form, [
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8"
        ]);
        if ($validator->fails()) {
            $this->response =  $this->errorList($validator);
        } else {
            // If all values are valid, then insert new User
            try {
                $this->form['password'] = Hash::make($this->form['password']);
                User::create($this->form);
                $this->cleanForm();
                $this->response = "User created successfully. Go to Login";
            } catch (PDOException $e) {
                $this->response = json_encode($e->getMessage());
            } catch (Exception $e) {
                $this->response = json_encode($e->getMessage());
            }
        }
    }

    public function cleanForm()
    {
        $this->form['name'] = '';
        $this->form['email'] = '';
        $this->form['password'] = '';
    }

    public function errorList(ValidationValidator $validator) : string
    {
        $errors = [];
        $err = $validator->errors();
        foreach($err->all() as $e) {
            $errors[] = $e;
        }
        return implode('<br>', $errors);
    }
}
