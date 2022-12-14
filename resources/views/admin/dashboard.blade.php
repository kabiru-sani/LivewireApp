<x-admin-layout>
    <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <livewire:admin.dashboard.appointment-count />

        <livewire:admin.dashboard.users-count />
    </div>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
</x-admin-layout>
