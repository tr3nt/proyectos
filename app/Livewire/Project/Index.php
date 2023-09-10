<?php

namespace App\Livewire\Project;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use App\Jobs\SendMailJob;
use App\Models\Project;
use Livewire\Component;
use PDOException;
use Exception;

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
                // Update status from draft to public and viceversa
                $this->project->public = $this->public;
                $this->project->save();
                // Send mail delayed 10 minutes (commented for needing a mailer server)
                SendMailJob::dispatch($this->form['title'], auth()->user()->name)->delay(600);
                // Response in an alert box
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
