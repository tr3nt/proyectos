<?php

namespace App\Livewire\Project;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Livewire\Component;

class Index extends Component
{
    public Collection $projects;

    public function render()
    {
        if (Auth::check()) {
            $this->projects = Project::where('users_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $this->projects = Project::where('public', 1)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('livewire.project.index')
            ->extends('layouts.layout')
            ->section('content');
    }
}
