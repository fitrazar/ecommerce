@section('title', 'Data Product')

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.card-default class="static">
                <a href="{{ route('product.create') }}">
                    <x-button.primary-button>
                        <i class="fa-solid fa-plus"></i>
                        Tambah Data
                    </x-button.primary-button>
                </a>
               
                <div class="relative overflow-x-auto mt-5">
                    <table id="products" class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Product</th>
                                <th scope="col" class="px-6 py-3">Brand Product</th>
                                <th scope="col" class="px-6 py-3">Kategori Product</th>
                                <th scope="col" class="px-6 py-3">Stock Product</th>
                                <th scope="col" class="px-6 py-3">Tanggal Dibuat</th>
                                <th scope="col" class="px-6 py-3">Tanggal Diedit</th>
                                <th scope="col" class="px-6 py-3">Action</th>
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
                $('#products').DataTable({
                    buttons: ['colvis'],
                    processing: true,
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
                            name: 'name',
                        },
                        {
                            data: 'brand.name',
                            name: 'brand'
                        },
                        {
                            data: 'category.name',
                            name: 'category'
                        },
                        {
                            data: 'stock',
                            name: 'stock'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                return `
                                 <div class="flex"> 
                                    <a href="{{ url('/admin/product/${full.slug}') }}">
                                        <x-button.warning-button type="button" class="btn-sm text-white mr-1"><i class="fa-regular fa-eye"></i></x-button.info-button>
                                    </a>
                                    <a href="{{ url('/admin/product/${full.slug}/edit') }}">
                                        <x-button.info-button type="button" class="btn-sm text-white"><i class="fa-regular fa-pen-to-square"></i></x-button.info-button>
                                    </a>
                                   <x-form action="{{ url('/admin/product/${full.slug}') }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-button.danger-button type="submit" class="btn-sm text-white delete-button" data-confirm-delete="true"><i class="fa-regular fa-trash-can"></i></x-button.danger-button>
                                    </x-form>
                                </div>
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
