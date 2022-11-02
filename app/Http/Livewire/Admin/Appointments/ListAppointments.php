<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;

class ListAppointments extends AdminComponent
{
    protected $listeners = ['deleteConfirmed' => 'deleteAppointment'];

    public $appointmentIdBeingRemoved = null;

    public $status = null;

    protected $queryString = ['status'];

    public $selectedRows = [];

    public $selectPageRows = false;

    public function confirmAppointmentRemoval($appointmentId)
    {
        $this->appointmentIdBeingRemoved = $appointmentId;

        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteAppointment()
    {
        $appointment = Appointment::findOrFail($this->appointmentIdBeingRemoved);

        $appointment->delete();

        $this->dispatchBrowserEvent('deleted',['message' => 'Appointment Deleted Successfully!']);

    }

    public function filterAppointmentsByStatus($status = 'null')
    {
        $this->resetPage(); //restes page after selecting scheduled or closed option
        $this->status = $status;
    }

    // bulk appointment selection
    public function updatedselectPageRows($value)
    {

        if($value){
            $this->selectedRows = $this->appointments->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        }else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }

    }


    public function getAppointmentsProperty()
    {
        return Appointment::with('client')
            ->when($this->status, function($query, $status){
                return $query->where('status', $status);
            })
            ->latest()->paginate(5);
    }

    public function markAllAsScheduled()
    {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'SCHEDULED']);
        $this->dispatchBrowserEvent('updated', ['message' => 'All selected appointments marked as Scheduled.']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }

    public function markAllAsClosed()
    {
        Appointment::whereIn('id', $this->selectedRows)->update(['status' => 'CLOSED']);
        $this->dispatchBrowserEvent('updated', ['message' => 'All selected appointments marked as Closed.']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }

    //delete selected appointments
    public function deleteSelectedRows()
    {
        Appointment::whereIn('id', $this->selectedRows)->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'All selected appointments deleted successfully!']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }

    public function render()
    {
        $appointments = $this->appointments;

        $appointmentsCount = Appointment::count();
        $scheduledAppointmentCount = Appointment::where('status', 'scheduled')->count();
        $closedAppointmentCount = Appointment::where('status', 'closed')->count();

        return view('livewire.admin.appointments.list-appointments',[

            'appointments'=>$appointments,
            'appointmentsCount' => $appointmentsCount,
            'scheduledAppointmentCount' => $scheduledAppointmentCount,
            'closedAppointmentCount' => $closedAppointmentCount,
            ]);
    }
}
