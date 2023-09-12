<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use App\Jobs\SendMailJob;
use App\Models\Project;

class ProjectObserver
{
    public function updated(Project $project): void
    {
        if ($project->isDirty('image')) {
            $oldImage = $project->getOriginal('image');
            if ($oldImage && Storage::disk('public')->exists($oldImage) && $oldImage !== 'nopic.jpg') {
                Storage::disk('public')->delete($oldImage);
            }
        }
        if ($project->isDirty('public')) {
            SendMailJob::dispatch($project->title, $project->public)->delay(600);
        }
    }

    public function deleted(Project $project): void
    {
        if ($project->image !== 'nopic.jpg') {
            Storage::disk('public')->delete($project->image);
        }
    }
}
