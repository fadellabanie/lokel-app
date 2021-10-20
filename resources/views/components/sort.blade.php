@props(['field','sortBy','sortDirection'])

@if ($sortBy !== $field)
<i  class=" text-muted fas fa-sort"></i>
@elseif ($sortDirection == 'asc')
<i style="color:rgba(38, 38, 236, 0.774)" class="fas fa-sort-up"></i>
{{-- <i class="flaticon2-arrow-up"></i> --}}
@else
<i style="color:rgba(38, 38, 236, 0.774)" class="fas fa-sort-down"></i>
{{-- <i class="flaticon2-arrow-down"></i> --}}

@endif