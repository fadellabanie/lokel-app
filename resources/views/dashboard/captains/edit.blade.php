@extends('layouts.admin')

@section('title',__('Captains'))
@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <livewire:dashboard.captains.update :captain='$captain' />
    </div>
</div>

@endsection