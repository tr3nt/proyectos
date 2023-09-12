<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class Delete extends Component
{
    public function mount(Project $project)
    {
        $project->delete();
        session()->flash('message', "Project {$project->title} deleted successfully");
        return redirect(route('home'));
    }

    public function render()
    {
        return view('livewire.project.delete');
    }
}
