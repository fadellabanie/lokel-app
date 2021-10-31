<div>

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                <!--begin::Image-->
                <div
                    class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                    <img class="mw-50px mw-lg-75px" src="{{$experience->icon}}" alt="image">
                </div>
                <!--end::Image-->
                <!--begin::Wrapper-->
                <div class="flex-grow-1">
                    <!--begin::Head-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::Details-->
                        <div class="d-flex flex-column">
                            <!--begin::Status-->
                            <div class="d-flex align-items-center mb-1">
                                <a href="#"
                                    class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{$experience->title}}</a>
                                <span class="badge badge-light-{{$experience->status == 1 ? " success" : "danger" }}
                                    me-auto">{{status($experience->status)}}</span>
                            </div>
                            <!--end::Status-->
                            <!--begin::Description-->
                            <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">{{$experience->description}}
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Actions-->
                        <div class="d-flex mb-4">
                            <a href="#" class="btn btn-sm btn-primary me-3">Add Target</a>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Head-->
                    <!--begin::Info-->
                    <div class="d-flex flex-wrap justify-content-start">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bolder">{{$experience->created_at->format('F D Y')}}</div>
                                </div>
                                <!--end::Number-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-6 text-gray-400">{{__("Created Data")}}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">

                                    <div class="fs-4 fw-bolder counted" data-kt-countup="true"
                                        data-kt-countup-value="{{$experience->capacity}}">{{$experience->capacity}}
                                    </div>
                                </div>
                                <!--end::Number-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-6 text-gray-400">{{__("Capacity")}}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">

                                    <div class="fs-4 fw-bolder counted" data-kt-countup="true"
                                        data-kt-countup-value="15000" data-kt-countup-prefix="$">
                                        ${{$experience->price}}</div>
                                </div>
                                <!--end::Number-->
                                <!--begin::Label-->
                                <div class="fw-bold fs-6 text-gray-400">{{__("Price")}}</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                        </div>
                        <!--end::Stats-->
                        <!--begin::Users-->
                        <div class="symbol-group symbol-hover mb-3">
                            <!--begin::User-->
                            @foreach ($experience->passengers as $passenger)

                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title=""
                                data-bs-original-title="{{$passenger->full_name}}">
                                <img alt="Pic" src="{{asset($passenger->avatar)}}">
                            </div>
                            @endforeach
                            <!--end::User-->
                            <!--begin::All users-->
                            <a href="#" class="symbol symbol-35px symbol-circle">
                                <span class="symbol-label bg-dark text-inverse-dark fs-8 fw-bolder"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                                    data-bs-original-title="View more users">{{count($experience->passengers)}}</span>
                            </a>
                            <!--end::All users-->
                        </div>
                        <!--end::Users-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Details-->
            <div class="separator"></div>

        </div>
    </div>

    <div class="row g-6 g-xl-9">
        <div class="col-md-6 col-xxl-4">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-65px symbol-circle mb-5">
                        <img src="{{asset($experience->captain->avatar)}}" alt="image">
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <a href="#"
                        class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{$experience->captain->first_name."
                        ".$experience->captain->last_name}}</a>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <div class="fw-bold text-gray-400">{{$experience->captain->email}}</div>
                    <div class="fw-bold text-gray-400 mb-6">{{$experience->captain->mobile}}</div>
                    <!--end::Position-->
                    <!--begin::Info-->
                    <div class="d-flex flex-center flex-wrap">
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fs-6 fw-bolder text-gray-700">{{__("Number Of Trips")}}</div>
                            <div class="fw-bold text-gray-400">{{$experience->captain->number_of_trips}}</div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fw-bold text-gray-400">{{__("Rate")}}</div>
                            <div class="fs-6 fw-bolder text-gray-700">{{$experience->captain->rate}}</div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fw-bold text-gray-400">{{__("Code")}}</div>
                            <div class="fs-6 fw-bolder text-gray-700">{{$experience->captain->code}}</div>
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-8 col-xxl-8">
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{__("Info")}}</h3>
                    </div>
                    <!--end::Card title-->

                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{__("Thumbnail")}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{$experience->thumbnail}}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{__("Included")}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$experience->included}}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{__("Expect")}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$experience->expect}}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{__("Faqs")}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$experience->faqs}}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{__("Meals")}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{$experience->meals}}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>

    <div class="row g-6 g-xl-12 mt-4">
        <div class="col-xl-12">
            <!--begin::Tables Widget 9-->
            <div class="card card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{__("Passengers Statistics")}}</span>
                        <span class="text-muted mt-1 fw-bold fs-7">{{__("Passengers Booking")}}</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th>{{__("#")}}</th>
                                    <th class="min-w-150px">{{__("Name")}}</th>
                                    <th class="min-w-120px">{{__("Info")}}</th>
                                    <th class="min-w-120px">{{__("Booking Data")}}</th>
                                    <th class="min-w-100px text-end">{{__("Actions")}}</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($experience->passengers as $passenger)
                                <tr>
                                    <td>
                                        <span
                                            class="text-muted fw-bold text-muted d-block fs-7">{{$loop->iteration}}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{asset($passenger->avatar)}}" alt="">
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#"
                                                    class="text-dark fw-bolder text-hover-primary fs-6">{{$passenger->full_name}}</a>
                                                <span
                                                    class="text-muted fw-bold text-muted d-block fs-7">{{$passenger->code}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a
                                            class="text-dark fw-bolder text-hover-primary d-block fs-6">{{$passenger->email}}</a>
                                        <span
                                            class="text-muted fw-bold text-muted d-block fs-7">{{$passenger->mobile}}</span>
                                    </td>
                                    <td>
                                        <a
                                            class="text-dark fw-bolder text-hover-primary d-block fs-6">{{$passenger->pivot->created_at}}</a>
                                        <span
                                            class="text-muted fw-bold text-muted d-block fs-7">{{$passenger->pivot->created_at->diffForHumans()}}</span>

                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            <x-show-button href="{{route('admin.passengers.show',$passenger)}}"/>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 9-->
        </div>
    </div>
    <div class="row g-6 g-xl-9">
        <div class="row g-10">
            <!--begin::Col-->

            @forelse ($experience->medias as $media)
            <div class="col-md-4">
                <!--begin::Feature post-->
                <div class="card-xl-stretch me-md-6">
                    <!--begin::Image-->
                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
                        style="background-image:url('{{asset($media->image ?? "")}}')"
                        data-fslightbox="lightbox-video-tutorials">
                        <img src="" class="position-absolute top-50 start-50 translate-middle" alt="">
                    </a>
                    <!--end::Image-->

                </div>
                <!--end::Feature post-->
            </div>
            @empty

            @endforelse
            <!--end::Col-->
        </div>
    </div>
</div>