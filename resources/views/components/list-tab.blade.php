@props(['name'])

<div class="tab-pane fade" id="list-{{$name}}" role="tabpanel" aria-labelledby="list-{{$name}}-list">
    {{$slot}}
</div>