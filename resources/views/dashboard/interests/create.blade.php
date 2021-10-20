@extends('layouts.admin')

@section('title',__('Interests'))
@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        @livewire('dashboard.interests.store')
    </div>
</div>

@endsection
