@props(['name','count'=> 0])

<a class="d-flex justify-content-between list-group-item list-group-item-action" id="list-{{$name}}-list"
    data-toggle="list" href="#list-{{$name}}" role="tab" aria-controls="{{$name}}">{{$slot}}
    <span class="badge badge-primary badge-pill">{{$count}}</span>
</a>