@props(['file'])
<div class="row p-4 mb-2">
    <div class="col-4">
        <a href={{ asset('import-tamplates/'.$file) }} download class="mr-2 btn btn-success btn-xl
"><i class="la la-download"></i> {{ __('Download') }}</a>
    </div>
    <div class="col-8">
        <ul class="list">
            <li class="list-item">{{__("Use this tamplate to import data")}}</li>
            <li class="list-item">{{__("Some files have multiple sheet")}}</li>
        </ul>
    </div>
</div>