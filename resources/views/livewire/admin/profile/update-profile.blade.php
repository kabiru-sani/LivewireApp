<div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center" x-data="{  imagePreview: '{{ auth()->user()->avatar_url }}' }">
                                <input wire:model="image" class="d-none" type="file" x-ref="image"
                                x-on:change="
                                const reader = new FileReader();
                                reader.onload = (event) => {
                                    imagePreview = event.target.result;
                                    document.getElementById('profileImage').src = '${imagePreview}';
                                };
                                reader.readAsDataURL($refs.image.files[0]);
                                "
                                >
                                <img x-on:click="$refs.image.click()" class="profile-user-img img-circle" x-bind:src="imagePreview ? imagePreview : '/backend/dist/img/user4-128x128.jpg'" alt="">
                            </div>

                            <h3 class="profile-user text-center">Aisha Shuaib</h3>

                            <p class="text-muted text-center">Admin</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Setting</a></li>
                                <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings">
                                    <form action="" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="changePassword">
                                    <form action="" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="currentPassword" class="col-sm-3 col-form-label">Current Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="currentPassword" placeholder="Current Password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="newPassword" placeholder="New Password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="passwordConfirmation" placeholder="Confirm New Password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@push('styles')
    <style>
        .profile-user-img:hover {
            background-color: blue;
            cursor: pointer;
        }
    </style>
@endpush
