<div x-data="{ tambahUnorModal : false, tambahJabatanFungsinal : false }" class="flex w-full mb-3 lg:w-1/3">
    <div class="w-full h-full bg-white">
        <div class="block text-sm px-4 mt-4">
            <div class="relative text-gray-700">
                
                
            </div>
        </div>
        <div class="block text-sm px-2 mb-4 overflow-y-auto h-screen"><!---->
            <ul class="text-sm mt-4">
                <li>
                    <livewire:sidebar-item :key="'sidebar_item_' . $dataSideBar->id_jabatan" :sidebar="$dataSideBar" :activeJabatanId="$id_jabatan"/>
                </li>
            </ul>
        </div>
    </div>

</div>