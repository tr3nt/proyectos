<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use App\Livewire\Project\Show;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Login extends Component
{
    public string $email;
    public string $password;
    protected array $rules = [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8'
    ];

    public function mount() : void
    {
        // Fill login with username after Register
        if (@session('username')) {
            $this->email = @session('username');
        }
    }

    public function login()
    {
        // Validate login values with Validator
        $this->validate();
        // If all values are valid, then try to login
        $params = [
            'email' => $this->email,
            'password' => $this->password
        ];
        if (Auth::attempt($params)) {
            $this->redirect(Show::class);
        }
        // Not logged
        session()->flash('message', 'Bad Credentials');
    }

    public function render() : View
    {
        return view('livewire.auth.login')
            ->extends('layouts.layout')
            ->section('content');
    }
}
