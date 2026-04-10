<div class="w-full bg-white px-2 pt-5 pb-4 sm:p-6 sm:pb-4">
    <div>
        <div class="w-full bg-white dark:bg-gray-800">
            <div class="flex w-full">
                <div class="w-full overflow-hidden transition-shadow duration-300 bg-white rounded shadow-sm">
                    <div class="flex w-full">
                        <ul class="flex flex-wrap mt-3">
                            <li class="mr-2 mb-2"><button wire:click="setActiveDashboardAdminPage('statistik')"
                                    class="
                                                @if ($activeDashboardAdminPage === 'statistik')
                                                    text-white bg-bkn-blue
                                                @else
                                                    text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium ">Statistik</button></li>
                            <li class="mr-2 mb-2"><button wire:click="setActiveDashboardAdminPage('kelola-user')"
                                    class="
                                                @if ($activeDashboardAdminPage === 'kelola-user')
                                                    text-white bg-bkn-blue
                                                @else
                                                    text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium ">Kelola User</button></li>
                            <li class="mr-2 mb-2"><button wire:click="setActiveDashboardAdminPage('log-aktivitas')"
                                    class="
                                                @if ($activeDashboardAdminPage === 'log-aktivitas')
                                                    text-white bg-bkn-blue
                                                @else
                                                    text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium ">Log Aktivitas</button></li>
                        </ul>



                    </div>
                    @if ($activeDashboardAdminPage === 'kelola-user')
                        <livewire:kelola-user />
                    @elseif ($activeDashboardAdminPage === 'log-aktivitas')
                        <livewire:log-aktivitas />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>