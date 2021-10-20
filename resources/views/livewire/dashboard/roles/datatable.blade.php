<div>
    @include('livewire.dashboard.roles.form')
    <div>
        <x-alert id='alert' class="alert-success"></x-alert>
        <div class="card card-flush mt-6 mt-xl-9">

            <div class="card-header mt-5">

                <div class="card-title flex-column">
                    <h3 class="fw-bolder mb-1">{{__("Roles")}}</h3>
                    <div class="fs-6 text-gray-400">{{__("Show All")}}</div>
                </div>

                <div class="card-toolbar">
                    <button type="button" wire:click="resetForm()" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modal">
                        <i class="la la-plus"></i>{{__("New Record")}}

                    </button>
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
                                    <th wire:click="sortBy('name')" data-sort="{{$sortDirection}}" class="min-w-50px">
                                        {{__("Role")}}
                                        <x-sort field="name" sortBy="{{$sortBy}}" sortDirection="{{$sortDirection}}">
                                        </x-sort>
                                    </th>
                                    <th> {{__("Permission")}} </th>

                                    <th class="min-w-50px text-end" style="width: 87.075px;">{{__("Action")}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="fs-6">
                                @forelse($roles as $role)
                                <tr wire:loading.class="opacity-50">
                                    <td>{{$role->name}}</td>
                                    <td> {{Str::ucfirst(implode(',',$role->permissions->pluck('name')->toArray())) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            @can('edit roles')
                                            <x-edit-button data-toggle="modal" data-target="#modal"
                                                wire:click="edit({{ $role->id }})">
                                            </x-edit-button>
                                            @endcan
                                            @can('delete roles')
                                            <x-delete-record-button wire:click="confirm({{ $role->id }})">
                                            </x-delete-record-button>
                                            <x-delete-modal></x-delete-modal>
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
                            {{$roles->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-delete-modal></x-delete-modal>
    </div>

    @section('scripts')


    <script type="text/javascript">
        window.livewire.on('Modal', () => {
            $('#modal').modal('show');
        });  
         window.livewire.on('Modal', () => {
            $('#modal').modal('hide');
        }); 
        window.livewire.on('openDeleteModal', () => {
            $('#deleteModal').modal('show');
        }); 
        window.livewire.on('closeDeleteModal', () => {
            $('#deleteModal').modal('hide');
        });
    </script>

    <script>
        $(document).ready(function() {

    $('#permission_ids').select2({
        placeholder: 'select..',
    }).on('change', function () {
        @this.permission_ids = $(this).val();
    }); 
});

    </script>

    {{-- 
    <script>
        $(document).ready(function () {
            $('#permission_ids').select2();
            $('#permission_ids').on('change', function (e) {
                var data = $('#permission_ids').select2("val");
                @this.set('permission_ids', data);
            });
        });
    
    </script> --}}

    @endsection