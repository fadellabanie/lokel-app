@props(['field','style','url'])

<div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url('metronic/assets/media/svg/shapes/abstract-{{$style}}.svg')">
  <!--begin::Body-->
  <div class="card-body">
    <p><a href="{{$url}}" class="h3 font-weight-bold text-hover-primary text-dark">{{ $slot }}</a></p>

    <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">{{$field}}</span>
  </div>
  <!--end::Body-->
</div>

