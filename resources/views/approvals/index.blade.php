@extends('layouts.app')

@section('title', 'Approvals')

@section('content')

    <div class="px-4 pt-6">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">@yield('title')</h3>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-6 ">
                @if ($approvals->isEmpty())
                    <p class="text-gray-600">No approval requests available.</p>
                @else
                    <table id="approvals-table">
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
                                        Username
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Approval Level
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
                                        Notes
                                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                        </svg>
                                    </span>
                                </th>
                                @if (Auth::user()->hasRole('superadmin'))
                                    <th>
                                        <span class="flex items-center">
                                            Approved At
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th>
                                        <span class="flex items-center">
                                            Approved Role
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th>
                                        <span class="flex items-center">
                                            Created At
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                    <th>
                                        <span class="flex items-center">
                                            Updated At
                                            <svg class="w-4 h-4 ms-1" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                            </svg>
                                        </span>
                                    </th>
                                @endif

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
                            @if (Auth::check() && Auth::user()->hasRole(['superadmin', 'manager', 'supervisor']) && isset($approvals))
                                @php
                                    $roles = Auth::user()->getRoleNames()->all();

                                    $roleApprovalLevels = [];
                                    foreach ($roles as $role) {
                                        $roleApprovalLevels[] = Spatie\Permission\Models\Role::findByName(
                                            $role,
                                        )->approval_level;
                                    }
                                @endphp

                                @foreach ($approvals as $approve)
                                    @if (in_array($approve->approval_level, $roleApprovalLevels))
                                        <tr>
                                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $no++ }}
                                            </td>
                                            <td>{{ $approve->booking->booking_number }}</td>
                                            <td>{{ $approve->user->name }}</td>
                                            <td>{{ $approve->approval_level }}</td>
                                            <td class="p-3">
                                                @if ($approve->status == 'pending')
                                                    <span class="text-yellow-500 dark:text-yellow-400">Pending</span>
                                                @elseif ($approve->status == 'approved')
                                                    <span class="text-green-500">Approved</span>
                                                @elseif ($approve->status == 'rejected')
                                                    <span class="text-red-500">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $approve->notes }}</td>
                                            @if (Auth::user()->hasRole('superadmin'))
                                                <td>{{ $approve->approved_at }}</td>
                                                <td>{{ $approve->approval_role }}</td>
                                                <td>{{ $approve->created_at }}</td>
                                                <td>{{ $approve->updated_at }}</td>
                                            @endif
                                            <td class="flex flex-wrap items-center space-y-2">
                                                <button data-id="{{ $approve->booking_id }}" data-jenis="approved"
                                                    class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-400 action"
                                                    type="button">
                                                    Approved
                                                </button>

                                                <button data-id="{{ $approve->booking_id }}" data-jenis="rejected"
                                                    class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-400 action"
                                                    type="button">
                                                    Rejected
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>


    <!-- Main modal -->
    <div id="modalAction" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full">
        <div id="modalDialog" class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Datatables
        if (document.getElementById("approvals-table") && typeof simpleDatatables.DataTable !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#approvals-table", {
                searchable: true,
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const actionModal = document.getElementById('modalAction');
            const modal = new Modal(actionModal);

            // Rejected Store
            function rejected(id) {
                $('#formApproval').on('submit', function(e) {
                    e.preventDefault();

                    const form = this;
                    const formData = new FormData(form);

                    console.log(id);

                    $.ajax({
                        method: 'POST',
                        url: `/approvals/${id}/reject-action`,
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            modal.hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message,
                                showConfirmButton: false,
                                timer: 1200,
                                didClose: () => {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function(xhr) {
                            if (xhr.status === 422 || xhr.status === 400) {
                                const errors = xhr.responseJSON.errors;
                                Object.values(errors).forEach(err => {
                                    toastr.error(err[0], 'Input Field Error');
                                });
                            } else {
                                toastr.error('Gagal Rejected data. Coba lagi.', 'Error');
                            }
                        }
                    });
                });
            }

            $('#approvals-table').on('click', '.action', function() {

                let data = $(this).data();
                let id = data.id;
                let jenis = data.jenis;

                if (jenis == 'approved') {
                    console.log('testing id');
                    console.log(id);
                    $.ajax({
                        method: 'POST',
                        url: `/approvals/${id}/approve`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message,
                                showConfirmButton: false,
                                timer: 1200,
                                didClose: () => {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function(xhr) {
                            toastr.error('Gagal memperbarui status. Coba lagi.', 'Error');
                        }
                    });

                    return
                }

                $.ajax({
                    method: 'GET',
                    url: `/approvals/${id}/reject-view`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        // console.log('masuk rejected');
                        actionModal.querySelector('#modalDialog').innerHTML = res;

                        const closeBtn = document.getElementById('btnClose');
                        closeBtn.addEventListener('click', function() {
                            modal.hide();
                        })

                        modal.show();
                        rejected(id);
                    },
                    error: function(xhr) {
                        toastr.error('Gagal Rejected data. Coba lagi.', 'Error');
                    }
                })
            })
        })
    </script>
@endpush
