@extends('layouts.app')

@section('title', 'Order')

@section('content')

    <div class="px-4 pt-6">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">@yield('title')</h3>
                </div>
                <div class="items-center sm:flex">
                    <div class="flex items-center">
                        <!-- Modal toggle -->
                        <div class="flex justify-center">
                            <button id="btnAdd"
                                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                type="button">
                                Create New Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-6">
                <table id="orders-table" class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    No
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Booking Number
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Booking Name
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Driver
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Vehicle
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Status
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    Action
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($newOrder as $order)
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $no++ }}
                                </td>
                                <td>{{ $order->booking_number }}</td>
                                <td>{{ $order->booking_name }}</td>
                                <td>{{ $order->driver->name }}</td>
                                <td>{{ $order->vehicle->name }}</td>
                                <td>
                                    @if ($order->approval_status === 'pending')
                                        <span
                                            class="bg-yellow-400 px-2.5 py-1.5 rounded-xl text-white text-xs">Pending</span>
                                    @elseif ($order->approval_status === 'in progress')
                                        <span class="bg-blue-500 px-2.5 py-1.5 rounded-xl text-white text-xs">In
                                            Progress</span>
                                    @elseif ($order->approval_status === 'approved')
                                        <span
                                            class="bg-green-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Approved</span>
                                    @else
                                        <span class="bg-red-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Rejected</span>
                                    @endif
                                </td>
                                <td class="flex items-center space-x-2">
                                    <button data-id="{{ $order->id }}" data-jenis="detail"
                                        class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 action"
                                        type="button">Detail</button>
                                    <button data-id="{{ $order->id }}" data-jenis="edit"
                                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 action"
                                        type="button">Edit</button>
                                    <button data-id="{{ $order->id }}" data-jenis="delete"
                                        class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-400 action"
                                        type="button">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Main modal Add / Edit -->
    <div id="modalAction" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full">
        <div id="modalDialog" class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->

        </div>
    </div>

    <!-- Main modal Detail -->
    <div id="modalActionDetail" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full">
        <div id="modalDialogDetail" class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Datatables
        if (document.getElementById("orders-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#orders-table", {
                searchable: true,
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const addButton = document.getElementById('btnAdd');
            const actionModal = document.getElementById('modalAction');
            const actionModalDetail = document.getElementById('modalActionDetail');
            const modal = new Modal(actionModal);
            const modalDetail = new Modal(actionModalDetail);

            addButton.addEventListener('click', function() {
                $.ajax({
                    method: 'GET',
                    url: `/booking/new-order/create`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        actionModal.querySelector('#modalDialog').innerHTML = res;

                        const closeButton = document.getElementById('btnClose');
                        closeButton.addEventListener('click', function() {
                            modal.hide();
                        });

                        modal.show();
                        store()
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            Object.values(errors).forEach(err => {
                                toastr.error(err[0], 'Input Field Error');
                            });
                        } else {
                            toastr.error('An error occurred while loading the form.', 'Error');
                        }
                    }
                })
            });

            function store() {
                $('#formOrder').on('submit', function(e) {
                    e.preventDefault();

                    const _form = this;
                    const formData = new FormData(_form);

                    $.ajax({
                        method: 'POST',
                        url: `/booking/new-order/`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            modal.hide();
                            toastr.success('Data berhasil ditambahkan!', 'Success', {
                                timeOut: 500,
                                onHidden: function() {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                Object.values(errors).forEach(err => {
                                    toastr.error(err[0], 'Input Field Error');
                                });
                            } else {
                                toastr.error('An error occurred while updating data.', 'Error');
                            }
                        }
                    });
                });
            }

            function update(id) {
                $('#formOrder').on('submit', function(e) {
                    e.preventDefault();

                    const _form = this;
                    const formData = new FormData(_form);

                    $.ajax({
                        method: 'POST',
                        url: `/booking/new-order/${id}`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            modal.hide();
                            toastr.success('Data berhasil diupdate!', 'Success', {
                                timeOut: 500,
                                onHidden: function() {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                Object.values(errors).forEach(err => {
                                    toastr.error(err[0], 'Input Field Error');
                                });
                            } else {
                                toastr.error('An error occurred while updating data.', 'Error');
                            }
                        }
                    });
                });
            }

            $('#orders-table').on('click', '.action', function() {
                let data = $(this).data();
                let id = data.id;
                let jenis = data.jenis;

                if (jenis === 'delete') {
                    // console.log('delete masuk');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#9AA6B2',
                        confirmButtonText: 'Yes, delete it!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                method: 'DELETE',
                                url: `/booking/new-order/${id}`,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(res) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: res.message,
                                        showConfirmButton: false,
                                        timer: 1200,
                                        didClose: () => {
                                            window.location.reload();
                                        }
                                    });
                                },
                                error: function(xhr) {
                                    toastr.error('Gagal menghapus data. Coba lagi.',
                                        'Error');
                                }
                            });
                        }
                    });

                    return;
                }

                // Edit
                if (jenis === 'edit') {
                    $.ajax({
                        method: 'GET',
                        url: `/booking/new-order/${id}/edit`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            actionModal.querySelector('#modalDialog').innerHTML = res;

                            const closeButton = document.getElementById('btnClose');
                            closeButton.addEventListener('click', function() {
                                modal.hide();
                            });

                            modal.show();
                            update(id);
                        }
                    });

                    return
                }

                // Detail
                $.ajax({
                    method: 'GET',
                    url: `/booking/new-order/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        actionModalDetail.querySelector('#modalDialogDetail').innerHTML = res;

                        const closeButtonDetail = document.getElementById('btnCloseDetail');
                        closeButtonDetail.addEventListener('click', function() {
                            modalDetail.hide();
                        });

                        modalDetail.show();
                    }
                });
            });

        });
    </script>
@endpush
