<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto scrollbar">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    {{-- Menu Dashboard --}}
                    <li>
                        <a href="{{ route('dashboard.index') }}"
                            class="flex items-center p-2 text-base rounded-lg group {{ request()->segment(1) == 'dashboard' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                            <svg class="w-6 h-6 transition duration-75 {{ request()->segment(1) == 'dashboard' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                            </svg>
                            <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                        </a>
                    </li>
                    {{-- End Menu Dashboard --}}

                    {{-- Menu Master Data --}}
                    @if (Auth::user()->hasRole('superadmin'))
                        @can('read')
                            <li>
                                <button type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group {{ request()->segment(1) == 'masterdata' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }} "
                                    aria-controls="dropdown-masterdata" data-collapse-toggle="dropdown-masterdata">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 {{ request()->segment(1) == 'masterdata' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }} "
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z">
                                        </path>
                                    </svg>
                                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Master
                                        Data</span>
                                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul id="dropdown-masterdata"
                                    class="space-y-2 py-2 {{ request()->segment(1) == 'masterdata' ? '' : 'hidden' }}">
                                    <li>
                                        <a href="{{ route('role.index') }}"
                                            class="text-base rounded-lg flex items-center p-2 group {{ request()->segment(2) == 'role' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-gray-300' }} hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white transition duration-75 pl-11">
                                            Roles
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('permission.index') }}"
                                            class="text-base rounded-lg flex items-center p-2 group {{ request()->segment(2) == 'permission' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-gray-300' }} hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white transition duration-75 pl-11">
                                            Permissions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('role-access.index') }}"
                                            class="text-base rounded-lg flex items-center p-2 group {{ request()->segment(2) == 'role-access' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-gray-300' }} hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white transition duration-75 pl-11">
                                            Roles Access
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user-management.index') }}"
                                            class="text-base rounded-lg flex items-center p-2 group {{ request()->segment(2) == 'user-management' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-gray-300' }} hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white transition duration-75 pl-11">
                                            Users Management
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            {{-- End Menu Master Data --}}

                            {{-- Menu User --}}
                            <li>
                                <a href="{{ route('user.index') }}"
                                    class="flex items-center p-2 text-base rounded-lg group {{ request()->segment(1) == 'user' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                                    <svg class="w-6 h-6 transition duration-75 {{ request()->segment(1) == 'user' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                        fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4"></circle>
                                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6H4z"></path>
                                    </svg>


                                    <span class="ml-3" sidebar-toggle-item>User</span>
                                </a>
                            </li>
                        @endcan
                    @endif
                    {{-- End Menu User --}}

                    @if (Auth::user()->hasRole(['superadmin', 'admin']))
                        {{-- Menu Vehicle --}}
                        <li>
                            <a href="{{ route('vehicle.index') }}"
                                class="flex items-center p-2 text-base rounded-lg group {{ request()->segment(1) == 'vehicle' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                                <svg class="w-6 h-6 transition duration-75 {{ request()->segment(1) == 'vehicle' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                    fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17 11V7H7v4H2v6h1l1 4h14l1-4h1v-6h-5zm-5-2V9h-4v2h4zm4 0h-2v2h2v-2zM7 9h2v2H7zm9.03 6l-.71 3H7.68l-.71-3H16.03z" />
                                </svg>
                                <span class="ml-3" sidebar-toggle-item>Vehicle</span>
                            </a>
                        </li>
                        {{-- End Menu Vehicle --}}

                        {{-- Menu Driver --}}
                        <li>
                            <a href="{{ route('driver.index') }}"
                                class="flex items-center p-2 text-base rounded-lg group {{ request()->segment(1) == 'driver' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                                <svg class="w-6 h-6 transition duration-75 {{ request()->segment(1) == 'driver' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 2a5 5 0 015 5v2h3a1 1 0 011 1v6a1 1 0 01-1 1h-2l-1 4h-8l-1-4H2a1 1 0 01-1-1V10a1 1 0 011-1h3V7a5 5 0 015-5zm1 6H9v2h2V8zm4 4h-2v2h2v-2zM7 8h2v2H7z"
                                        clip-rule="evenodd" />
                                </svg>


                                <span class="ml-3" sidebar-toggle-item>Driver</span>
                            </a>
                        </li>
                        {{-- End Menu Driver --}}

                        {{-- Menu Booking --}}
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group {{ request()->segment(1) == 'booking' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}"
                                aria-controls="booking" data-collapse-toggle="booking">
                                <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 {{ request()->segment(1) == 'booking' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 011-1h6a1 1 0 011 1v1h2a2 2 0 012 2v11a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h2V2zm1 1v1h6V3H7zM4 7h12v9H4V7z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Booking</span>
                                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="booking"
                                class="py-2 space-y-2 {{ request()->segment(1) == 'booking' ? '' : 'hidden' }}">
                                <li>
                                    <a href="{{ route('new-order.index') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group {{ request()->segment(2) == 'new-order' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-gray-300' }} hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">New
                                        Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('histories.index') }}"
                                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group {{ request()->segment(2) == 'histories' ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-gray-300' }} hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Riwayat
                                        Pemesanan</a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Menu Booking --}}
                    @endif

                    {{-- Menu Approvals --}}
                    @if (Auth::user()->hasRole(['superadmin', 'manager', 'supervisor']))
                        <li>
                            <a href="{{ route('approvals.index') }}"
                                class="flex items-center p-2 text-base rounded-lg group {{ request()->segment(1) == 'approvals' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                                <svg class="w-6 h-6 transition duration-75 {{ request()->segment(1) == 'approvals' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                    fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17 11V7H7v4H2v6h1l1 4h14l1-4h1v-6h-5zm-5-2V9h-4v2h4zm4 0h-2v2h2v-2zM7 9h2v2H7zm9.03 6l-.71 3H7.68l-.71-3H16.03z" />
                                </svg>
                                <span class="ml-3" sidebar-toggle-item>Approvals</span>
                            </a>
                        </li>
                    @endif
                    {{-- End Menu Approvals --}}

                    {{-- Menu Report --}}
                    @can('view reports')
                        <li>
                            <a href="{{ route('reports.index') }}"
                                class="flex items-center p-2 text-base rounded-lg group {{ request()->segment(1) == 'reports' ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700' }}">
                                <svg class="w-6 h-6 transition duration-75 {{ request()->segment(1) == 'reports' ? 'text-gray-900 dark:text-white' : 'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' }}"
                                    fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17 2H7C5.89 2 5 2.89 5 4v16c0 1.11.89 2 2 2h12c1.11 0 2-.89 2-2V6l-6-4zm0 18H7V4h6v5h5v11z" />
                                </svg>

                                <span class="ml-3" sidebar-toggle-item>Reports</span>
                            </a>
                        </li>
                    @endcan
                    {{-- End Menu Report --}}
                </ul>
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
