<?php

namespace App\Observers;

use App\Jobs\SendMailJob;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        // Send mail delayed 10 minutes (commented for needing a mailer server)
        SendMailJob::dispatch($project->title, $project->public)->delay(600);
        session()->flash('message', "Project {$project->title} updated successfully");
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        // Delete project image
        if ($project->image !== 'nopic.jpg') {
            Storage::disk('public')->delete($project->image);
        }
        session()->flash('message', "Project {$project->title} deleted successfully");
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        //
    }
}
