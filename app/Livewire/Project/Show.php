<?php

namespace App\Livewire\Project;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Livewire\Component;
use PDOException;
use Exception;

class Show extends Component
{
    public $projects;
    public $response;

    public function render() : View
    {
        return view('livewire.project.show')
            ->extends('layouts.layout')
            ->section('content');
    }

    // Set in $projects depending on auth and guest
    public function mount() : void
    {
        if (Auth::check()) {
            $this->getProjects();
        } else {
            $this->getPublicProjects();
        }
    }

    // Get all projects by user logged id
    private function getProjects() : void
    {
        try {
            $this->projects = Project::where('id_created_by', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->get();
            $this->response = "";
        } catch (PDOException $e) {
            $this->response = json_encode($e->getMessage());
        } catch (Exception $e) {
            $this->response = json_encode($e->getMessage());
        }
    }

    // Get all public projects (except draft projects)
    private function getPublicProjects() : void
    {
        try {
            $this->projects = Project::where('public', 1)
                ->orderBy('created_at', 'desc')
                ->get();
            $this->response = "";
        } catch (PDOException $e) {
            $this->response = json_encode($e->getMessage());
        } catch (Exception $e) {
            $this->response = json_encode($e->getMessage());
        }
    }
}
