@extends('layouts.backend.app')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                Hai, {{ auth()->user()->name }}
            </div>
        </div>
        <!-- /.row -->
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection