@extends('layouts.app')

@section('meta_tags')
    @isset($metadata)
        {!! $metadata !!}
    @endisset
@endsection
