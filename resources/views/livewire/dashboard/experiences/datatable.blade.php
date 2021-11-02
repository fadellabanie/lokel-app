<div>
    <x-alert id='alert' class="alert-success"></x-alert>

    <form>
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <div class="d-flex align-items-center">
                    <!--begin::Input group-->
                    <div class="position-relative w-md-400px me-md-2">
                        <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                        <span
                            class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path
                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                        fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" class="form-control form-control-solid ps-10" name="search" value=""
                            placeholder="Search" wire:model="search">
                    </div>
                    <!--end::Input group-->
                    <!--begin:Action-->
                    <div class="d-flex align-items-center">
                        <a id="kt_horizontal_search_advanced_link" class="btn btn-link collapsed"
                            data-bs-toggle="collapse" href="#kt_advanced_search_form" aria-expanded="false">Advanced
                            Search</a>
                    </div>
                    <!--end:Action-->
                </div>
                <!--end::Compact form-->
                <!--begin::Advance form-->
                <div class="collapse" id="kt_advanced_search_form" style="">
                    <!--begin::Separator-->
                    <div class="separator separator-dashed mt-9 mb-6"></div>
                    <!--end::Separator-->
                    <!--begin::Row-->
                    <div class="row g-8 mb-8">
                        <!--begin::Col-->
                        <div class="col-xxl-12">
                            <!--begin::Row-->
                            <div class="row g-8">
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <label class="fs-6 form-label fw-bolder text-dark">{{__("Cities")}}</label>
                                    <x-city></x-city>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <label class="fs-6 form-label fw-bolder text-dark">{{__("Countries")}}</label>
                                    <x-countries></x-countries>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-3">
                                    <label class="fs-6 form-label fw-bolder text-dark">{{__("Type")}}</label>
                                    <!--begin::Radio group-->
                                    <div class="nav-group nav-group-fluid">
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" wire:model="status" value="all"
                                                checked="checked">
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">All</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" wire:model="status" value="1">
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">ACCEPT</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" wire:model="status" value="2">
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">REJECT</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label>
                                            <input type="radio" class="btn-check" wire:model="status" value="3">
                                            <span
                                                class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">EXPIRED</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Radio group-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row g-8">
                        <!--begin::Col-->
                        <div class="col-xxl-7">
                            <!--begin::Row-->
                            <div class="row g-8">
                                <!--begin::Col-->
                                <div class="col-lg-4">
                                    <label class="fs-6 form-label fw-bolder text-dark">Min. Price</label>
                                    <!--begin::Dialer-->
                                    <div class="position-relative" data-kt-dialer-prefix="$"
                                        data-kt-dialer-decimals="2">
                                        <!--begin::Decrease control-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                            wire:click="decrease('price_from')">
                                            <!--begin::Svg Icon | path: icons/duotone/Code/Minus.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10">
                                                    </circle>
                                                    <rect fill="#000000" x="6" y="11" width="12" height="2" rx="1">
                                                    </rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--end::Decrease control-->
                                        <!--begin::Input control-->
                                        <input type="text" class="form-control form-control-solid border-0 ps-12"
                                            data-kt-dialer-control="input" placeholder="Amount" name="manageBudget"
                                            readonly="readonly" wire:model="price_from">
                                        <!--end::Input control-->
                                        <!--begin::Increase control-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                            wire:click="increase('price_from')">
                                            <!--begin::Svg Icon | path: icons/duotone/Code/Plus.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10">
                                                    </circle>
                                                    <path
                                                        d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                        fill="#000000"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--end::Increase control-->
                                    </div>
                                    <!--end::Dialer-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-lg-4">
                                    <label class="fs-6 form-label fw-bolder text-dark">Max. Price</label>
                                    <!--begin::Dialer-->
                                    <div class="position-relative" data-kt-dialer-prefix="$"
                                        data-kt-dialer-decimals="2">
                                        <!--begin::Decrease control-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                            wire:click="decrease('price_to')">
                                            <!--begin::Svg Icon | path: icons/duotone/Code/Minus.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10">
                                                    </circle>
                                                    <rect fill="#000000" x="6" y="11" width="12" height="2" rx="1">
                                                    </rect>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--end::Decrease control-->
                                        <!--begin::Input control-->
                                        <input type="text" class="form-control form-control-solid border-0 ps-12"
                                            placeholder="Amount" readonly="readonly" wire:model="price_to">
                                        <!--end::Input control-->
                                        <!--begin::Increase control-->
                                        <button type="button"
                                            class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                            wire:click="increase('price_to')">
                                            <!--begin::Svg Icon | path: icons/duotone/Code/Plus.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10">
                                                    </circle>
                                                    <path
                                                        d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                                        fill="#000000"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--end::Increase control-->
                                    </div>
                                    <!--end::Dialer-->
                                </div>
                                <!--end::Col-->

                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Advance form-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </form>


    <div class="row g-6 g-xl-9">
        <!--begin::Col-->
        @foreach ($experiences as $experience)
        <div class="col-md-6 col-xl-4">
            <!--begin::Card-->
            <a href="{{route('admin.experiences.show',$experience)}}"
                class="card border border-2 border-gray-300 border-hover">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-9">
                    <!--begin::Card Title-->
                    <div class="card-title m-0">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px w-50px bg-light">
                            <img src="{{$experience->icon}}" alt="image" class="p-3">
                        </div>
                        <!--end::Avatar-->
                    </div>
                    <!--end::Car Title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <span
                            class="badge badge-light-primary fw-bolder me-auto px-4 py-3">{{status($experience->status)}}</span>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end:: Card header-->
                <!--begin:: Card body-->
                <div class="card-body p-9">
                    <!--begin::Name-->
                    <div class="fs-3 fw-bolder text-dark">{{$experience->title}}</div>
                    <!--end::Name-->
                    <!--begin::Description-->
                    <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{$experience->description}}</p>
                    <!--end::Description-->
                    <!--begin::Info-->
                    <div class="d-flex flex-wrap mb-5">
                        <!--begin::Due-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                            <div class="fs-6 text-gray-800 fw-bolder">{{$experience->created_at->format('F D Y')}}</div>
                            <div class="fw-bold text-gray-400">{{__("Created At")}}</div>
                        </div>
                        <!--end::Due-->
                        <!--begin::Budget-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                            <div class="fs-6 text-gray-800 fw-bolder">{{$experience->price}}</div>
                            <div class="fw-bold text-gray-400">{{__("Price")}}</div>
                        </div>
                        <!--end::Budget-->
                        <!--begin::Budget-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                            <div class="fs-6 text-gray-800 fw-bolder">{{$experience->capacity}}</div>
                            <div class="fw-bold text-gray-400">{{__("Capacity")}}</div>
                        </div>
                        <!--end::Budget-->
                        <!--begin::Budget-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                            <div class="fs-6 text-gray-800 fw-bolder">{{$experience->code}}</div>
                            <div class="fw-bold text-gray-400">{{__("Code")}}</div>
                        </div>
                        <!--end::Budget-->
                    </div>
                    <div class="separator separator-dashed mb-4"></div>
                    <!--end::Info-->
                    <div class="symbol-group symbol-hover">
                        <!--begin::User-->
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                            data-bs-original-title="{{$experience->captain->first_name}}">
                            <img alt="Pic" src="{{asset($experience->captain->avatar)}}">
                        </div>
                            <!--begin::User-->
                            <div class="fs-3 fw-bolder text-dark">{{$experience->captain->first_name."
                                ".$experience->captain->last_name}}</div>
                    </div>
                </div>
                <!--end:: Card body-->
            </a>
            <!--end::Card-->
        </div>
        @endforeach
        <!--end::Col-->
    </div>

    <div class="d-flex flex-stack flex-wrap pt-10">
        <div class="fs-6 fw-bold text-gray-700">Showing of {{$experiences->total()}}</div>
        {{$experiences->links()}}
    </div>


    <x-delete-modal></x-delete-modal>

</div>

@section('scripts')

<script type="text/javascript">
    window.livewire.on('openDeleteModal', () => {
        $('#deleteModal').modal('show');
    }); 
    window.livewire.on('closeDeleteModal', () => {
        $('#deleteModal').modal('hide');
    }); 
    window.livewire.on('openBlockModal', () => {
        $('#blockModal').modal('show');
    }); 
    window.livewire.on('closeBlockModal', () => {
        $('#blockModal').modal('hide');
    });
</script>
@endsection