@extends('layouts.backend.app')
@push('addon-script')
<!-- bs-custom-file-input -->
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
        var idx_item = 0;
        var id_pengaduan = '{{ $item->id_pengaduan ?? null }}';

        $(document).on('click', '.btn-delete-row', function(e) {
            var value = $(this).attr('data-value');
            if (value != "") {
                $.ajax({
                    url: '/admin/pihak_terkait/delete_pihak_terkait/' + value,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data.status) {
                            // alert('Item telah dihapus')
                        }
                    }
                });
            }

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
                        <h3 class="card-title">Change Pengaduan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('pengaduan.update', $item->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @include('pages.pengaduan.partials.form-control', ['submit' => 'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection