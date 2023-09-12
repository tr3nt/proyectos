<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public string $name;
    public string $email;
    public string $password;
    protected array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8'
    ];

    public function register()
    {
        // Validate new user values with Validator
        $this->validate();
        // Set params
        $params = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ];
        // If all values are valid, then insert new User
        User::create($params);
        // Set flash message
        session()->flash('message', 'User created successfully');
        session()->flash('username', $this->email);
        // Redirect to Login
        $this->redirect(Login::class);
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->extends('layouts.layout')
            ->section('content');
    }
}
