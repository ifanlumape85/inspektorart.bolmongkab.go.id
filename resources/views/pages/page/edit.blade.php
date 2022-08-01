@extends('layouts.backend.app')
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
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
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
                        <h3 class="card-title">Edit Page</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('page.update', $item->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @include('pages.page.partials.form-control', ['submit' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection