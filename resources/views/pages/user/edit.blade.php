@extends('layouts.backend.app')
@push('addon-script')
<!-- bs-custom-file-input -->
<script src="/template/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
    });

    var is_admin = '{{ auth()->user()->is_admin }}';
    if (is_admin == 'N') {
        $('.fg-role').hide();
    }
</script>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Change User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {!! Form::model($item, ['method' => 'PATCH','route' => ['user.update', $item->id]]) !!}
                    @method('PUT')
                    <!-- @csrf -->
                    @include('pages.user.partials.form-control', ['submit' => 'Update'])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection