@extends('layouts.backend.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Contact</h3>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                <tr>
                                    <td>{{ $items->count() * ($items->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a href="{{ route('contact.show', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Empty</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection