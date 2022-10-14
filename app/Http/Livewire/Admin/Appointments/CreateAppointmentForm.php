<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class CreateAppointmentForm extends Component
{
    public $state = [
        'status' => 'SCHEDULED',
    ];

    public function createAppointment()
    {
        Validator::make($this->state, [
            'client_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'note' => 'nullable',
            'status' => 'required|in:SCHEDULED,CLOSED',
        ],

        [
            'client_id.required' => 'The Client field is required'
        ])->validate();

        Appointment::create($this->state);


        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully!']);
    }

    public function render()
    {
        $clients = Client::all();

        return view('livewire.admin.appointments.create-appointment-form',[
            'clients' => $clients,
        ]);
    }
}
