@extends('layouts.admin')

@section('title',__('Cities'))
@section('content')

<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <livewire:dashboard.cities.update :city='$city' />

    </div>
</div>

@endsection
