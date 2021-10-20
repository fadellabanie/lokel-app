@props(['errors'])

@if ($errors->any())
    <div class="alert alert-danger mb-5 p-5" role="alert">
        <h4 class="alert-heading">{{ __('Whoops! Something went wrong.') }}</h4>
        <div class="border-bottom border-white opacity-20 mb-5"></div>
        <ul class="">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
