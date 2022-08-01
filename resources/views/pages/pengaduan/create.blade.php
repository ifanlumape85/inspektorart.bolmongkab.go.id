@extends('layouts.backend.app')
@push('addon-script')
<!-- bs-custom-file-input -->
<script src="/template/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function() {
        bsCustomFileInput.init();
        //Initialize Select2 Elements
        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        var idx_item = 0;

        $(document).on('click', '.btn-delete-row', function(e) {
            $(this).parent().parent().remove();
        });

        $(document).on('click', '.btn-add-item-manual', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/admin/pengaduan/list_pihak_terkait/' + idx_item,
                type: "GET",
                dataType: "text",
                success: function(data) {
                    $('.table-item-manual').append(data);
                    $('.select2').select2();
                    idx_item++;
                }
            });
        });
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
                        <h3 class="card-title">Create Pengaduan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('pages.pengaduan.partials.form-control')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection