@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1>Edit Property</h1>
    @include('realestates._form', [
        'formAction' => route('realestates.update', $estate->id),
        'estate' => $estate
    ])
</div>
@endsection

@section('scripts')

@include('realestates.scripts')

@endsection
