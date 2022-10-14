<div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users Module</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Users Module</li>
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
                <button class="btn btn-primary" wire:click.prevent="addNewUser"><i class="fa fa-plus-circle mr-1"></i> Add New User</button>
            </div>
            <div class="card">
              <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="#" wire:click.prevent="edit({{ $user }})">
                                            <i class="fa fa-edit mr-2"></i>
                                        </a>

                                        <a href="#" wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
              </div>
              <div class="card-footer d-flex justify-content-end">
                {{ $users->links() }}
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self >
    <div class="modal-dialog" role="document">
        <form autocomplete="off" wire:submit.prevent="{{ $showEditModal? 'updateUser' : 'createUser' }}">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @if($showEditModal)
                        <span>Edit User</span>
                    @else
                        <span>Add New User</span>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Full Name" aria-describedby="nameHelp">
                @error('name')
                     <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                @error('email')
                     <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password">
                @error('password')
                     <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                <input type="password" wire:model.defer="state.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="Confirm Password">
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times mr-1"></i>Cancel</button>
                <button type="submit" class="btn btn-primary"> <i class="fa fa-save mr-1"></i>
                @if ($showEditModal)
                    <span>Save Changes</span>
                @else
                     <span>Save</span>
                @endif
                </button>
            </div>
            </div>
        </form>
    </div>
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
