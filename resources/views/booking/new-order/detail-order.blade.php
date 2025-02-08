<div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Details Order
        </h3>
        <button id="btnCloseDetail" type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Modal body -->
    <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
        <div class="text-gray-500 font-medium">Booking Number</div>
        <div class="text-gray-800">: {{ $booking->booking_number }}</div>
        <div class="text-gray-500 font-medium">Booking Name</div>
        <div class="text-gray-800">: {{ $booking->booking_name }}</div>
        <div class="text-gray-500 font-medium">Driver</div>
        <div class="text-gray-800">: {{ $booking->driver->name }}</div>
        <div class="text-gray-500 font-medium">Vehicle</div>
        <div class="text-gray-800">: {{ $booking->vehicle->name }}</div>
        <div class="text-gray-500 font-medium">Plate Number</div>
        <div class="text-gray-800">: {{ $booking->vehicle->plate_number }}</div>
        <div class="text-gray-500 font-medium">Booking Date</div>
        <div class="text-gray-800">: {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}</div>
        <div class="text-gray-500 font-medium">Approval Status</div>
        <div>:
            @if ($booking->approval_status === 'pending')
                <span class="bg-yellow-400 px-2.5 py-1.5 rounded-xl text-white text-xs">Pending</span>
            @elseif ($booking->approval_status === 'in progress')
                <span class="bg-blue-500 px-2.5 py-1.5 rounded-xl text-white text-xs">In
                    Progress</span>
            @elseif ($booking->approval_status === 'approved')
                <span class="bg-green-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Approved</span>
            @else
                <span class="bg-red-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Rejected</span>
            @endif
        </div>
        <div class="text-gray-500 font-medium">Final Approval Status</div>
        <div>:
            @if ($booking->overall_approval_status === 'pending')
                <span class="bg-yellow-400 px-2.5 py-1.5 rounded-xl text-white text-xs">Pending</span>
            @elseif ($booking->overall_approval_status === 'approved')
                <span class="bg-green-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Approved</span>
            @elseif ($booking->overall_approval_status === 'rejected')
                <span class="bg-red-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Rejected</span>
            @else
                <span class="bg-gray-500 px-2.5 py-1.5 rounded-xl text-white text-xs">Unknown</span>
            @endif
        </div>
        <div class="text-gray-500 font-medium">Level</div>
        <div>: <span
                class="bg-blue-500 px-2 py-1 rounded-xl text-white text-xs">{{ $booking->current_approval_level }}</span>
        </div>
        <div class="text-gray-500 font-medium">Requested At</div>
        <div class="text-gray-800">: {{ $booking->requested_at }}</div>
        @if (Auth::user()->hasRole('superadmin'))
            <div class="text-gray-500 font-medium">Created By</div>
            <div class="text-gray-800">: {{ $booking->user->name }}</div>
            <div class="text-gray-500 font-medium">Created At</div>
            <div class="text-gray-800">: {{ $booking->created_at }}</div>
            <div class="text-gray-500 font-medium">Updated At</div>
            <div class="text-gray-800">: {{ $booking->updated_at }}</div>
        @endif
    </div>
</div>
