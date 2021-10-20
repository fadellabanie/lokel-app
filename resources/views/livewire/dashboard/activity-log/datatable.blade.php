<div>
    <x-alert id='alert' class="alert-success"></x-alert>
    <div class="card card-flush mt-6 mt-xl-9">

        <div class="card-header mt-5">

            <div class="card-title flex-column">
                <h3 class="fw-bolder mb-1">{{__("Orders")}}</h3>
                <div class="fs-6 text-gray-400">{{__("Show All")}}</div>
            </div>

            <div class="card-toolbar my-1">
                <div class="me-6 my-1">
                    <x-status></x-status>
                </div>
                <div class="me-6 my-1">
                    <x-city></x-city>
                </div>
                <div class="me-6 my-1">
                    <x-contract-type></x-contract-type>
                </div>
                <div class="me-6 my-1">
                    <x-realestate-type></x-realestate-type>
                </div>
                <div class="d-flex align-items-center position-relative my-1">
                    <x-search-input></x-search-input>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table
                        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder dataTable no-footer"
                        role="grid">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr role="row">

                            <tr>
                                <th wire:click="sortBy('id')" data-sort="{{$sortDirection}}">{{__("#")}}
                                    <x-sort field="id" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}"></x-sort>
                                </th>
                                <th wire:click="sortBy('subject_type')" data-sort="{{$sortDirection}}">
                                    {{__("Model Name")}}
                                    <x-sort field="subject_type" sortBy="{{$sortBy}}"
                                        sortDirection="{{$sortDirection}}"></x-sort>
                                </th>
                                <th wire:click="sortBy('subject_type')" data-sort="{{$sortDirection}}">{{__("Subject")}}
                                    <x-sort field="subject_type" sortBy="{{$sortBy}}"
                                        sortDirection="{{$sortDirection}}"></x-sort>
                                </th>
                                <th wire:click="sortBy('description')" data-sort="{{$sortDirection}}">{{__("Action")}}
                                    <x-sort field="description" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('causer_type')" data-sort="{{$sortDirection}}">{{__("User")}}
                                    <x-sort field="causer_type" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('created_at')" data-sort="{{$sortDirection}}">{{__("Time")}}
                                    <x-sort field="created_at" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('created_at')" data-sort="{{$sortDirection}}">{{__("Sinc")}}
                                    <x-sort field="created_at" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th>{{ __('Actions') }}</th>
                            </tr>

                        </thead>
                        <tbody class="fs-6">
                            @forelse($activities as $key => $log)
                            <tr wire:loading.class="opacity-50">
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        {{ explode('\\',$log->subject_type)[2] ?? ("Subject") }}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        {{ $log->subject->en_name ?? $log->subject->en_question ?? __("Subject Name not found") }}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        {{ $log->description ?? '' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        <a href="{{route('admin.users.show',$log->causer->id ?? 0)}}"
                                            target="_blank">{{ $log->causer->name ?? __("User") }}</a>
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        {{$log->created_at}}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        {{$log->created_at->diffforhumans()}}
                                    </span>
                                </td>
                                <td>
                                    <span class="d-inline-block" data-toggle="tooltip">
                                        <a class="btn btn-primary font-weight-bolder" data-toggle="modal"
                                            wire:click="getData({{$log->id}})" data-target="#modal">{{__('View Data')}}
                                        </a>
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-danger font-size-lg">
                                    {{ __('No records found') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div
                        class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                    </div>
                    <div
                        class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        {{$activities->links()}}
                    </div>
                </div>
            </div>
            <!--end::Table-->

            <!--end::Table container-->
        </div>
        <!--end::Card body-->
    </div>
</div>