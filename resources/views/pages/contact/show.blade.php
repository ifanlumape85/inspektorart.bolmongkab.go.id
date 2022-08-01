@extends('layouts.backend.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-text-width"></i>
                Contact
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <dl class="row">
                <dt class="col-sm-4">Name</dt>
                <dd class="col-sm-8">{{ $item->first_name }} {{ $item->last_name }}</dd>
                <dt class="col-sm-4">Phone</dt>
                <dd class="col-sm-8">{{ $item->phone }}</dd>
                <dt class="col-sm-4">Email</dt>
                <dd class="col-sm-8"><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></dd>
                <dt class="col-sm-4">Message</dt>
                <dd class="col-sm-8">{{ $item->message }}</dd>
            </dl>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection