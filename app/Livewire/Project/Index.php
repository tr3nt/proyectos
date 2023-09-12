<?php

namespace App\Livewire\Project;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Jobs\SendMailJob;
use App\Models\Project;
use Livewire\Component;

class Index extends Component
{
    public Project $project;
    public int $public;

    // Get a project by id
    public function mount(int $id)
    {
        $this->project = Project::find($id);
        $this->public = $this->project->public;
    }

    public function update() : void
    {
        if (Auth::check()) {
            // Update status from draft to public and viceversa
            $this->project->public = $this->public;
            $this->project->save();
            // Send mail delayed 10 minutes (commented for needing a mailer server)
            SendMailJob::dispatch($this->project->title, auth()->user()->name)->delay(600);
            session()->flash('message', "Project {$this->project->title} updated successfully");
            // Redirect to Project list
            $this->redirect(Show::class);
        }
        session()->flash('message', 'Unauthorized');
    }

    public function deleteById() : void
    {
        // Could not use $this->project because a persistency error after delete
        $project = Project::find($this->project->id);
        // Delete the picture from storage folder
        if ($project->image !== 'nopic.jpg') {
            Storage::disk('public')->delete($project->image);
        }
        // Delete project from database
        $project->delete();
        session()->flash('message', "Project {$this->project->title} deleted successfully");
        // Redirect to projects list
        $this->redirect(Show::class);
    }

    public function render() : View
    {
        return view('livewire.project.index')
            ->extends('layouts.layout')
            ->section('content');
    }
}
