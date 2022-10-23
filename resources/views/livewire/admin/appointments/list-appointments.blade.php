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

                                        <a href="#" wire:click.prevent="confirmUserRemoval()">
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

<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Delete User</b><i class="fa fa-info-circle ml-2"></i></h5>
            </div>

            <div class="modal-body">
                <h4> Are you sure you want to delete this user?</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i>Cancel</button>
                <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"> <i class="fa fa-trash mr-1"></i>Delete</button>
            </div>
        </div>
    </div>
</div>

</div>
