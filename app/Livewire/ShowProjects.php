<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class ShowProjects extends Component
{
    public function render()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();

        return view('livewire.show-projects', [
            'projects' => $projects
        ]);
    }
}
