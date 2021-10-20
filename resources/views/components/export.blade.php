@props(['field','export'])

<!--begin::Dropdown-->
<div class="dropdown dropdown-inline mr-2">
    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="la la-download"></i>{{__("Export")}}</button>
    <!--begin::Dropdown Menu-->
    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        <ul class="nav flex-column nav-hover">
            <li class="nav-header font-weight-bolder text-uppercase text-primary p-4">{{__("Choose an option")}}:
            </li>
          
          
            <li class="nav-item">
                <a class="nav-link">
                    <span class="nav-text">
                        <x-export-button></x-export-button>
                    </span>
                </a>
            </li>
         
          
        </ul>
    </div>
    <!--end::Dropdown Menu-->
</div>
<!--end::Dropdown-->