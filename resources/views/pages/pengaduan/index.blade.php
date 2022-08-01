@extends('layouts.backend.app')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            @can('pengaduan-create')
                            <h3 class="card-title">Pengaduan</h3>
                            <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create
                            </a>
                            @endcan
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
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Lokasi</th>
                                    <th>Waktu</th>
                                    <th>User</th>
                                    <th>--</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                <tr>
                                    <td>{{ $items->count() * ($items->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $item->judul}}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <a href="{{ route('pengaduan.edit', $item->id) }}" class="btn btn-info">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <form action="{{route('pengaduan.destroy', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Empty</td>
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