@extends('layouts.backend.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Event</h3>
                            <a href="{{ route('event.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create
                            </a>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th style="width: 120px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                <tr>
                                    <td>{{ $items->count() * ($items->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->event_date }}</td>
                                    <td>{{ $item->event_time }}</td>
                                    <td>{{ $item->location }}</td>
                                    <td>
                                        <a href="{{ route('event.edit', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{route('event.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Empty</td>
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