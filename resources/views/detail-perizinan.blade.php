@extends('layouts.frontend.app-detail')
@section('page-title', 'Detail Perizinan')
@section('page', 'Perizinan')
@section('page-active', $item->nama_perizinan ?? nul)
@section('content')
<article class="entry entry-single">

    <h2 class="entry-title">
        <a href="#">{{ $item->nama_perizinan ?? null }}</a>
    </h2>

    <div class="entry-content">
        <p class="font-weight-bold mt-4">Persyaratan</p>
        <p>{!! nl2br(e($item->persyaratan ?? null)) !!}</p>
        <p class="font-weight-bold">Biaya</p>
        <p>{!! nl2br(e($item->biaya ?? null)) !!}</p>
        <p class="font-weight-bold">Cara Penanganan</p>
        <p>{!! nl2br(e($item->cara_penanganan ?? null)) !!}</p>
        <p class="font-weight-bold">Waktu</p>
        <p>{!! nl2br(e($item->waktu ?? 0)) !!} hari kerja</p>
    </div>
    <div class="entry-content">
        <div class="row">
            <div class="col mt-4">
                @if($items)
                <h4 class="mt-4">Perizinan Lainnya</h4>
                <ul>
                    @foreach($items as $item)
                    <li><a href="{{ route('detail-perizinan', $item) }}" class="text-secondary font-weight-bolder">{{ $item->nama_perizinan }}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

    </div>
</article><!-- End blog entry -->
@endsection