@extends('layouts.frontend.app-detail')
@section('page-title', 'Detail Page')
@section('page', 'Page')
@section('page-active', $item->name)
@section('content')
<article class="entry entry-single">
    @if(Storage::disk('public')->exists($item->image ?? null))
    <div class="entry-img">
        <img src="{{ Storage::url($item->image ?? null) }}" alt="" class="img-fluid">
    </div>
    @endif

    <h2 class="entry-title">
        <a href="#">{{ $item->name ?? null }}</a>
    </h2>

    <div class="entry-meta">
        <ul>
            <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="#">{{ $item->author->name ?? null }}</a></li>
            <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="#"><time datetime="2021-03-25">{{ $item->created_at ?? null }}</time></a></li>
        </ul>
    </div>

    <div class="entry-content">
        <p>{!! nl2br(e($item->body ?? null)) !!}</p>
    </div>

    <div class="entry-footer clearfix">
        <div class="float-left">
            @if($item->category)
            <i class="icofont-folder"></i>
            <ul class="cats">
                <li><a href="{{ route('category', $item->category) }}">{{ $item->category->name ?? null }}</a></li>
            </ul>
            @endif
            @if($item->tags)
            <i class="icofont-tags"></i>
            <ul class="tags">
                @foreach($item->tags as $tag)
                <li><a href="{{ route('tag', $tag) }}">{{ $tag->name ?? null }}</a></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</article><!-- End blog entry -->
@endsection