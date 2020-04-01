@extends('layouts.app')

@section('title', $title)

@section('meta_tags')
    @isset($metadata)
        {!! $metadata !!}
    @endisset
@endsection
