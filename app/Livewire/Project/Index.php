<?php

namespace App\Livewire\Project;

use Illuminate\Contracts\View\View;
use App\Models\Project;
use Livewire\Component;
use PDOException;
use Exception;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $project;
    public $public;
    public $response;

    public function render() : View
    {
        return view('livewire.project.index')
            ->extends('layouts.layout')
            ->section('content');
    }

    public function mount(mixed $id) : void
    {
        $this->byId((int)$id);
    }

    public function update()
    {
        if (Auth::check()) {
            try {
                $this->project->public = $this->public;
                $this->project->save();
                $this->response = "Project {$this->project->title} updated successfully";
            } catch (PDOException $e) {
                $this->response = json_encode($e->getMessage());
            } catch (Exception $e) {
                $this->response = json_encode($e->getMessage());
            }
        } else {
            $this->response = "Unauthorized";
        }
    }

    // Get a project by id
    private function byId(int $id) : void
    {
        try {
            $this->project = Project::find($id);
            $this->public = $this->project->public;
            $this->response = "";
        } catch (PDOException $e) {
            $this->response = json_encode($e->getMessage());
        } catch (Exception $e) {
            $this->response = json_encode($e->getMessage());
        }
    }
}
