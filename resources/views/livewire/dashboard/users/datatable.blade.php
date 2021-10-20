<div>
    <x-alert id='alert' class="alert-success"></x-alert>

    <div class="card card-flush mt-6 mt-xl-9">
        <div class="card-header mt-5">
            <div class="card-title flex-column">
                <h3 class="fw-bolder mb-1">{{__("User")}}</h3>
                <div class="fs-6 text-gray-400">{{__("Show All")}}</div>
            </div>
            <div class="card-toolbar my-1">

                <div class="d-flex align-items-center position-relative my-1">
                    <div class="me-6 my-1">
                        <x-city></x-city>
                    </div>
                    <div class="me-6 my-1">
                        <x-user-type></x-user-type>
                    </div>
                    <div class="me-6 my-1">
                        <x-user-status></x-user-status>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <x-search-input></x-search-input>
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        @can('export users')
                        <x-export-button></x-export-button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body pt-0">
            <div id="kt_profile_overview_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table id="kt_profile_overview_table"
                        class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder dataTable no-footer"
                        role="grid">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr role="row">
                                <th wire:click="sortBy('id')" data-sort="{{$sortDirection}}">{{__("#")}}
                                    <x-sort field="id" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}"></x-sort>
                                </th>
                                <th wire:click="sortBy('name')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("User")}}
                                    <x-sort field="name" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('city_id')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                    {{__("City")}}
                                    <x-sort field="city_id" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('mobile')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Mobile")}}
                                    <x-sort field="mobile" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('type')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Type")}}
                                    <x-sort field="type" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('status')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Status")}}
                                    <x-sort field="status" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th wire:click="sortBy('created_at')" data-sort="{{$sortDirection}}" class="min-w-90px">
                                    {{__("Regester")}}
                                    <x-sort field="created_at" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                    </x-sort>
                                </th>
                                <th class="min-w-50px text-end" style="width: 87.075px;">{{__("Action")}}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @forelse($users as $key => $user)
                            <tr wire:loading.class="opacity-50">
                                <td>{{$loop->iteration}}</td>

                                <td class="sorting_1">
                                    <div class="d-flex align-items-center">
                                        <div class="me-5 position-relative">
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="{{asset($user->avatar)}}">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="{{route('admin.users.show',$user)}}"
                                                class="fs-6 text-gray-800 text-hover-primary">{{$user->name}}</a>
                                            <div class="fw-bold text-gray-400">{{$user->email}}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$user->city->en_name ?? ""}}</td>
                                <td>{{$user->mobile}}</td>
                                <td>{!!userType($user->type)!!}</td>
                                <td>{!!userStatus($user->status)!!}</td>
                                <td>{{$user->created_at->format('m-d-Y')}}</td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        @can('edit users')
                                        <x-edit-button href="{{route('admin.users.edit',$user)}}"/>
                                        @endcan
                                        @can('delete users')
                                        <x-delete-record-button wire:click="confirm({{ $user->id }})"/>
                                        @endcan
                                        @can('freeze users')
                                        @if ($user->status == true)
                                        <x-freeze-button wire:click="freeze({{ $user->id }})">
                                        </x-freeze-button>
                                        @else
                                        <x-unfreeze-button wire:click="unFreeze({{ $user->id }})">
                                            </x-freeze-button>
                                        @endif
                                        @endcan

                                    </div>
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
                        {{$users->links()}}
                    </div>
                </div>
            </div>
            <!--end::Table-->

            <!--end::Table container-->
        </div>
        <!--end::Card body-->
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