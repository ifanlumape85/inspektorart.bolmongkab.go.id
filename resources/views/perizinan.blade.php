@extends('layouts.frontend.app-detail')
@section('page-title', $breadcrumb_title ?? null)
@section('page', $breadcrumb_h1 ?? null)
@section('page-active', $breadcrumb_title ?? null)
@section('content')

<article class="entry entry-single">

    <h2 class="entry-title">
        <a href="#">{{ $breadcrumb_h1 ?? null}}</a>
    </h2>

    <div class="entry-content">
        <table class="table">
            <tr>
                <th>Perizinan</th>
                <th>Waktu</th>
                <th></th>
            </tr>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->nama_perizinan ?? null }}</td>
                <td>{{ $item->waktu ?? 0 }} hari kerja</td>
                <td><a href="{{ route('detail-perizinan', $item) }}" class="text-primary">Detail</a></td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="entry-footer clearfix">

    </div>
</article><!-- End blog entry -->

@endsection