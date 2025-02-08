<div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $vehicle->id ? 'Edit Vehicle' : 'Add Vehicle' }}
        </h3>
        <button id="btnClose" type="button"
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
    <form id="formVehicle" action="{{ $vehicle->id ? route('vehicle.update', $vehicle->id) : route('vehicle.store') }}"
        method="POST">
        @csrf
        @if ($vehicle->id)
            @method('PUT')
        @endif
        <div class="grid gap-4 mb-4 {{ $vehicle->id ? 'sm:grid-cols-1' : 'sm:grid-cols-2' }}">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name
                    Vehicle</label>
                <input type="text" name="name" id="name" value="{{ $vehicle->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 capitalize dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Supra MK4">
            </div>
            <div>
                <label for="plate_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Plate
                    Number</label>
                <input type="text" name="plate_number" id="plate_number" value="{{ $vehicle->plate_number }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="N 1234 XYZ" pattern="[A-Z]{1,2}\s[0-9]{1,4}\s[A-Z]{0,3}">
            </div>
            @if ($vehicle->id)
                <div>
                    <label for="status"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option disabled readonly>Pilih Status Kendaraan</option>
                        <option value="tersedia" {{ $vehicle->status == 'tersedia' ? 'selected' : '' }}>Tersedia
                        </option>
                        <option value="sedang digunakan" {{ $vehicle->status == 'sedang digunakan' ? 'selected' : '' }}>
                            Sedang Digunakan</option>
                        <option value="perbaikan" {{ $vehicle->status == 'perbaikan' ? 'selected' : '' }}>Perbaikan
                        </option>
                    </select>
                </div>
            @endif

        </div>
        <button type="submit"
            class="text-white flex items-center ml-auto bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">

            @if ($vehicle->id)
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M17.707 2.293a1 1 0 00-1.414 0L13 5.586 14.414 7 17 4.414a1 1 0 000-1.414zM3 13v4h4l6-6-4-4-6 6H3z"
                        clip-rule="evenodd"></path>
                </svg>
                Edit vehicle
            @else
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
                Add new vehicle
            @endif
        </button>
    </form>
</div>
