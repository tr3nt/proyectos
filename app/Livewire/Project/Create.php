<?php

namespace App\Livewire\Project;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use App\Jobs\SendMailJob;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Project;
use PDOException;
use Exception;

class Create extends Component
{
    // Activate upload files
    use WithFileUploads;

    // Define Project parameters
    public $form = [
        "title" => "",
        "description" => "",
        "image" => "",
        "public" => 0,
        "id_created_by" => 0
    ];
    //Create string response
    public $response;
    public $content;

    public function render() : View
    {
        return view('livewire.project.create')
            ->extends('layouts.layout')
            ->section('content');
    }

    public function create()
    {
        // Retrieve WYSIWYG data
        $this->form['description'] = $this->content;
        // Create rules for new Project
        $validator = Validator::make($this->form, [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "image" => "required|image|mimes:jpg,png,jpeg|max:2048",
            "public" => "required",
            "id_created_by" => "required"
        ]);
        // Validate new Project values with Validator
        if ($validator->fails()) {
            $this->response = $this->errorList($validator);
        } else {
            try {
                // Save the image
                $imgRoute = $this->form['image']->store('images', 'public');
                // And insert new Project
                $this->form['image'] = $imgRoute;
                $this->form['id_created_by'] = auth()->user()->id;
                Project::create($this->form);
                // Send mail delayed 10 minutes (commented for needing a mailer server)
                SendMailJob::dispatch($this->form['title'], auth()->user()->name)->delay(600);
                // Redirect to Projects list
                return redirect(route('show'));
            } catch (PDOException $e) {
                $this->response = json_encode($e->getMessage());
            } catch (Exception $e) {
                $this->response = json_encode($e->getMessage());
            }
        }
    }

    // Get all errors and convert them into a string
    private function errorList(ValidationValidator $validator) : string
    {
        $errors = [];
        $err = $validator->errors();
        foreach($err->all() as $e) {
            $errors[] = $e;
        }
        return implode('<br>', $errors);
    }
}
