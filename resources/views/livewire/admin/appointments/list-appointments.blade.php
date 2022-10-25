<div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Appointments Module</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Appointments Module</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('admin.appointment.create') }}">
                    <button class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i> Add New Appointment</button>
                </a>
            </div>
            <div class="card">
              <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th scope="col">Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $appointment->client->name }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td><span class="badge badge-{{ $appointment->status_badge }}">{{ $appointment->status }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.appointments.edit', $appointment) }}">
                                            <i class="fa fa-edit mr-2"></i>
                                        </a>

                                        <a href="#" wire:click.prevent="confirmAppointmentRemoval({{ $appointment->id }})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
              </div>
              <div class="card-footer d-flex justify-content-end">
                {{ $appointments->links() }}
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


{{-- Delete confirmation modal --}}

<x-confirmation-alert />

</div>
