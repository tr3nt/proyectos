<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public array $form = [];
    protected array $rules = [
        'form.name' => 'required|string|max:255',
        'form.email' => 'required|string|email|max:255|unique:users',
        'form.password' => 'required|string|min:8'
    ];

    public function register()
    {
        $this->validate();
        $this->form['password'] = Hash::make($this->form['password']);
        User::create($this->form);
        session()->flash('message', 'User created successfully');
        return redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->extends('layouts.layout')
            ->section('content');
    }
}
