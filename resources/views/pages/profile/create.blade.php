@extends('layouts.backend.app',['breadcrumb' => 'Profile', 'title' => 'Create Profile'])
@push('addon-style')
<!-- summernote -->
<link rel="stylesheet" href="/template/backend/plugins/summernote/summernote-bs4.min.css">
@endpush
@push('addon-script')
<!-- Summernote -->
<script src="/template/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/template/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
        $('#summernote').summernote();
    });
</script>
@endpush
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.profile.partials.form-control')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection