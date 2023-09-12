<?php

namespace App\Livewire\Project;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Livewire\Component;

class Show extends Component
{
    public Collection $projects;

    // Set in $projects depending on auth and guest
    public function mount() : void
    {
        if (Auth::check())
            $this->getProjects();
        else
            $this->getPublicProjects();
    }

    // Get all projects by user logged id
    private function getProjects() : void
    {
        $this->projects = Project::where('id_created_by', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Get all public projects (except draft projects)
    private function getPublicProjects() : void
    {
        $this->projects = Project::where('public', 1)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render() : View
    {
        return view('livewire.project.show')
            ->extends('layouts.layout')
            ->section('content');
    }
}
