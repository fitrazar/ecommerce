@section('title', 'Data Kategori')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">

                <a href="{{ route('category.create') }}">
                    <x-button.primary-button>
                        <i class="fa-solid fa-plus"></i>
                        Tambah Data
                    </x-button.primary-button>
                </a>
                <div class="relative overflow-x-auto mt-5">
                    <table id="categoriess" class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Kategori
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </x-card.card-default>
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function() {

                $('#categoriess').DataTable({
                    buttons: [
                        // 'copy', 'excel', 'csv', 'pdf', 'print',
                        'colvis'
                    ],
                    processing: true,
                    search: {
                        return: true
                    },
                    serverSide: true,
                    ajax: '{{ url()->current() }}',
                    columns: [{
                            data: null,
                            name: 'no',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, full, meta) {
                                return data == 1 ? 'Aktif' : 'Tidak Aktif';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                return `
                                <a href="{{ url('/admin/category/${full.slug}/edit') }}">
                                    <x-button.info-button type="button" class="btn-sm text-white"><i class="fa-regular fa-pen-to-square"></i>Edit</x-button.info-button>
                                </a>
                                <x-form action="{{ url('/admin/category/${full.slug}') }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.danger-button type="submit" class="btn-sm text-white delete-button" data-confirm-delete="true"><i class="fa-regular fa-trash-can"></i>Hapus</x-button.danger-button>
                                </x-form>
                            `;
                            }
                        },
                    ]
                });

                $(document).on('click', '.delete-button', function(e) {
                    e.preventDefault();
                    const form = $(this).closest('form');
                    Swal.fire({
                        title: 'Hapus Data!',
                        text: "Apakah anda yakin untuk menghapus data ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });

            });
        </script>
    </x-slot>
</x-app-layout>
