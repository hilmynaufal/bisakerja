<div x-data="{ tambahUnorModal : false, tambahJabatanFungsinal : false, tambahJabatanPelaksana : false}"
    style="margin-left: 15px">
    @if ($isDeleted == true)
        <div></div>
    @else
        <div>
            <ul class="text-sm">
                <li>
                    <div class="relative px-2 py-1 my-1 rounded
                                                                                             @if ($isActive)
                                                                                                 bg-bkn-blue
                                                                                             @else
                                                                                                 bg-gray-200
                                                                                            @endif
                                                                                             ">
                        <div class="flex items-center">
                            <div class="flex items-center w-full mr-auto">
                                <div class="flex w-full">
                                    <div class="flex flex-wrab"><!----><button
                                            wire:click="hideOrShowJabatanChildren('{{$sidebar->id_jabatan}}')"
                                            class="flex items-center 
                                                                                                                    @if ($jabatanChildrens == null && $sidebar->tipe_unor == 0)
                                                                                                                        transform scale-100 -rotate-90
                                                                                                                    @endif  
                                                                                                                    cursor-pointer hover:scale-110 text-white">
                                            @if ($sidebar->tipe_unor == 1)
                                                <svg aria-hidden="true" class="w-4 h-4 my-1" viewBox="-3 -3 30 30"
                                                    fill="currentColor">
                                                    <path
                                                        d="M19.536 0H4.464A4.463 4.463 0 000 4.464v15.073A4.463 4.463 0 004.464 24h15.073A4.463 4.463 0 0024 19.536V4.464A4.463 4.463 0 0019.536 0zm1.193 6.493v3.871l-.922-.005c-.507-.003-.981-.021-1.052-.041-.128-.036-.131-.05-.192-.839-.079-1.013-.143-1.462-.306-2.136-.352-1.457-1.096-2.25-2.309-2.463-.509-.089-2.731-.176-4.558-.177L10.13 4.7v5.82l.662-.033c.757-.038 1.353-.129 1.64-.252.306-.131.629-.462.781-.799.158-.352.262-.815.345-1.542.033-.286.07-.572.083-.636.024-.116.028-.117 1.036-.117h1.012v9.3h-2.062l-.035-.536c-.063-.971-.252-1.891-.479-2.331-.311-.601-.922-.871-2.151-.95a11.422 11.422 0 01-.666-.059l-.172-.027.02 2.926c.021 3.086.03 3.206.265 3.465.241.266.381.284 2.827.368.05.002.065.246.065 1.041v1.039H3.271v-1.039c0-.954.007-1.039.091-1.041.05-.001.543-.023 1.097-.049.891-.042 1.033-.061 1.244-.167a.712.712 0 00.345-.328c.106-.206.107-.254.107-6.78 0-6.133-.006-6.584-.09-6.737a.938.938 0 00-.553-.436c-.104-.032-.65-.07-1.215-.086l-1.026-.027V2.622h17.458v3.871z">
                                                    </path>
                                                </svg>
                                            @elseif ($sidebar->tipe_unor == 2)
                                                <svg aria-hidden="true" class="w-4 h-4 my-1" viewBox="0 0 32 32"
                                                    fill="currentColor">
                                                    <path
                                                        d="M16 3C8.832 3 3 8.832 3 16s5.832 13 13 13 13-5.832 13-13S23.168 3 16 3zm0 2c6.065 0 11 4.935 11 11s-4.935 11-11 11S5 22.065 5 16 9.935 5 16 5zm-3 6v11h2v-4h2.5c1.931 0 3.5-1.569 3.5-3.5S19.431 11 17.5 11H13zm2 2h2.5c.827 0 1.5.673 1.5 1.5s-.673 1.5-1.5 1.5H15v-3z">
                                                    </path>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 my-1" fill="currentColor"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                        d="M19 9l-7 7-7-7">
                                                    </path>
                                                </svg>
                                            @endif
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 my-1" fill="currentColor"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                                d="M19 9l-7 7-7-7">
                                                            </path>
                                                        </svg> -->
                                        </button><!----></div>
                                    <div class="flex w-full"
                                        x-on:click="$wire.setActiveJabatan('{{$sidebar->id_jabatan}}')"><span
                                            class="block w-full px-2 py-1 text-yellow-500 cursor-pointer">
                                            @if ($sidebar->tipe_unor != 0)
                                                {{$sidebar->nama_jabatan}}
                                            @else
                                                {{$sidebar->nama_unor}}
                                            @endif
                                    </div>
                                </div>
                            </div><!----><!---->
                            <div x-data="{open2 : false}">
                                <div class="block">
                                    <button class="flex items-center px-1 py-1 border rounded 
                                                                                                            @if ($isActive)
                                                                                                                border-white
                                                                                                            @else
                                                                                                                border-bkn-blue
                                                                                                            @endif
                                                                                                            "
                                        @click="open2 = !open2">
                                        <div class="block px-1">
                                            <p class="text-xs 
                                                                                                            @if ($isActive)
                                                                                                                text-white    
                                                                                                            @else
                                                                                                                text-bkn-blue
                                                                                                            @endif
                                                                                                            "> Aksi </p>
                                        </div>
                                    </button>
                                    <div class="relative" x-show="open2" @click.away="open2 = false">
                                        <div
                                            class="absolute z-20 w-48 p-2 space-y-1 transform rounded-md shadow-lg bg-gradient-to-br from-white to-gray-50 right-1 ring-1 ring-black ring-opacity-5">
                                            <span @click="() => {tambahUnorModal = true; open2 = false;}"
                                                class="block px-1 py-1 text-xs text-gray-600 capitalize rounded cursor-pointer hover:bg-indigo-900 hover:text-gray-100">
                                                Tambah Unor Struktural </span>
                                            <span @click="() => {tambahJabatanFungsinal = true; open2 = false;}"
                                                class="block px-1 py-1 text-xs text-yellow-400 capitalize rounded cursor-pointer hover:bg-indigo-900 hover:text-gray-100">
                                                Tambah Jabatan Fungsional </span>
                                            <span @click="() => {tambahJabatanPelaksana = true; open2 = false;}"
                                                class="block px-1 py-1 text-xs text-gray-600 capitalize rounded cursor-pointer hover:bg-indigo-900 hover:text-gray-100">
                                                Tambah Jabatan Pelaksana </span>
                                            <span
                                                class="block px-1 py-1 text-xs text-red-600 capitalize rounded cursor-pointer hover:bg-indigo-900 hover:text-gray-100"
                                                x-on:click="$wire.hapusDataUnor('{{$sidebar->id_jabatan}}')">
                                                Hapus Unor </span><!---->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @foreach ($jabatanChildrens as $jabatanChildren)
                    <li>
                        <livewire:sidebar-item :key="'sidebar_item_' . $jabatanChildren->id_jabatan"
                            :sidebar="$jabatanChildren" />
                    </li>
                @endforeach
            </ul>
        </div>
        <div x-show="tambahUnorModal" class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-50"></div>
                </div><span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​ <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form wire:submit.prevent="insertDataUnor(0)">
                        <div class="px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
                            <div class="w-full">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                    <h3 class="px-2 pb-3 text-lg font-medium leading-6 text-gray-900 dark:text-white"
                                        id="modal-headline"> Input Data Unor Struktural Baru </h3>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Id
                                                Jabatan
                                                <!----></span><input wire:model="id_jabatan" type="text"
                                                placeholder="Masukan Jenjang Jabatan" autocomplete="on"
                                                class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <label class="block text-sm px-2 mb-3">
                                        <span class="text-bkn-blue text-base">Nama Unor
                                            <!----></span><input wire:model="nama_unor" type="text"
                                            placeholder="Masukan Nama Unor" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><label
                                        class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Nama Jabatan
                                            <!----></span><input wire:model="nama_jabatan" type="text"
                                            placeholder="Masukan Nama Jabatan" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Jenjang
                                                Jabatan
                                                <!----></span><input wire:model="jenjang_jabatan" type="text"
                                                placeholder="Masukan Jenjang Jabatan" autocomplete="on"
                                                class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Jenis
                                                Unor
                                                <!----></span><input wire:model="jenis_unor" type="text"
                                                placeholder="Masukan Jenis Unor" autocomplete="on"
                                                class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Unor Atasan
                                            Langsung
                                            <!----></span>
                                        <div tabindex="-1"
                                            class="multiselect is-disabled bg-white text-sm text-left block w-full rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo">
                                            <!-- Search --><!--v-if--><!-- Tags (with search) --><!--v-if--><!-- Single label -->
                                            <div class="multiselect-single-label"><span
                                                    class="multiselect-single-label-text">{{ $sidebar->nama_unor }}</span>
                                            </div>
                                            <span class="multiselect-caret"></span><!-- Options -->


                                            <div class="multiselect-spacer"></div>
                                        </div>
                                    </div>
                                    <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Unor Induk
                                        </span>
                                        <div tabindex="-1"
                                            class="multiselect bg-white text-sm text-left block w-full rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo">
                                            <input type="text" class="multiselect-search">
                                            <div class="multiselect-placeholder">Pilih unor induk</div><span
                                                class="multiselect-caret"></span><!-- Options -->
                                            <div class="multiselect-dropdown is-hidden" tabindex="-1">
                                                <ul class="multiselect-options">
                                                    <li class="multiselect-option"><span>Sekretariat DPRD</span></li>
                                                    <li class="multiselect-option"><span>Pemerintah Kab. Bandung</span></li>
                                                </ul>
                                            </div>
                                            <div class="multiselect-spacer"></div>
                                        </div>
                                    </div><label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Kode
                                            Cepat </span><input wire:model="kode_cepat" type="text"
                                            placeholder="Masukan Kode Cepat" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><label
                                        class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">BUP
                                            <!----></span><input wire:model="bup" type="text" placeholder="Masukan BUP"
                                            autocomplete="on" maxlength="3"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    <div class="w-full px-2 mt-2 mb-3 text-sm"><span class="text-base text-bkn-blue">
                                            Jabatan
                                            Prioritas </span>
                                        <div class="flex">
                                            <div class="flex flex-row w-1/2 mt-1"><input type="checkbox"
                                                    class="block w-4 h-4 bg-white border rounded"><label
                                                    class="px-2 text-sm"> J.Prioritas
                                                    Nasional </label></div>
                                            <div class="flex flex-row w-1/2 mt-1"><input type="checkbox"
                                                    class="block w-4 h-4 bg-white border rounded"><label
                                                    class="px-2 text-sm"> J.Prioritas
                                                    Instansi </label></div>
                                        </div>
                                    </div><!----><!---->
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Rumpun
                                                Jabatan
                                                <!----></span><input wire:model="rumpun_jabatan" type="text"
                                                placeholder="Masukan Rumpun Jabatan" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Lokasi
                                                <!----></span><input wire:model="lokasi" type="text"
                                                placeholder="Masukan Lokasi" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Urutan
                                                <!----></span><input wire:model="urutan" type="text"
                                                placeholder="Masukan Urutan" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 mt-2 bg-gray-50 dark:bg-gray-700 sm:px-6 sm:flex sm:flex-row-reverse"><span
                                class="flex w-full rounded shadow-sm sm:ml-3 sm:w-auto"><button type="submit"
                                    @click="tambahUnorModal = false"
                                    class="inline-flex justify-center w-full px-8 py-1 text-xs leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded shadow-sm bg-bkn-blue hover:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo">
                                    SIMPAN </button><!----></span><span
                                class="flex w-full mt-3 rounded shadow-sm sm:mt-0 sm:w-auto"><button type="button"
                                    @click="tambahUnorModal = false"
                                    class="inline-flex justify-center w-full px-6 py-1 text-xs leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue">
                                    BATAL </button></span></div>
                    </form>
                </div>
            </div>
        </div>
        <div x-show="tambahJabatanFungsinal" class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-50"></div>
                </div><span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​ <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form wire:submit.prevent="insertDataUnor(1)">
                        <div class="px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
                            <div class="w-full">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left"><!---->
                                    <h3 class="px-2 pb-3 text-lg font-medium leading-6 text-gray-900 dark:text-white"
                                        id="modal-headline-3"> Input Data Jabatan Fungsional Baru </h3><!----><!---->
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Id
                                                Jabatan
                                                <!----></span><input wire:model="id_jabatan" type="text"
                                                placeholder="Masukan Jenjang Jabatan" autocomplete="on"
                                                class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Nama
                                            Jabatan
                                            <!----></span><input wire:model="nama_jabatan" type="text"
                                            placeholder="Masukan Nama Jabatan" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Nama
                                            Sub Jabatan
                                            <!----></span><input wire:model="nama_sub_jabatan" type="text"
                                            placeholder="Masukan Nama Sub Jabatan" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->

                                    <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Unor Atasan
                                            Langsung
                                            <!----></span>
                                        <div tabindex="-1"
                                            class="multiselect is-disabled bg-white text-sm text-left block w-full rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo">
                                            <!-- Search --><!--v-if--><!-- Tags (with search) --><!--v-if--><!-- Single label -->
                                            <div class="multiselect-single-label"><span
                                                    class="multiselect-single-label-text">{{ $sidebar->nama_unor }}</span>
                                            </div>
                                            <span class="multiselect-caret"></span><!-- Options -->


                                            <div class="multiselect-spacer"></div>
                                        </div>
                                    </div>
                                    <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Unor Induk
                                        </span>
                                        <div tabindex="-1"
                                            class="multiselect bg-white text-sm text-left block w-full rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo">
                                            <input type="text" class="multiselect-search">
                                            <div class="multiselect-placeholder">Pilih unor induk</div><span
                                                class="multiselect-caret"></span><!-- Options -->
                                            <div class="multiselect-dropdown is-hidden" tabindex="-1">
                                                <ul class="multiselect-options">
                                                    <li class="multiselect-option"><span>Sekretariat DPRD</span></li>
                                                    <li class="multiselect-option"><span>Pemerintah Kab. Bandung</span></li>
                                                </ul>
                                            </div>
                                            <div class="multiselect-spacer"></div>
                                        </div>
                                    </div>
                                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Kode
                                            Cepat </span><input wire:model="kode_cepat" type="text"
                                            placeholder="Masukan Kode Cepat" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    <div class="block mt-4 mb-3 text-sm"><label class="block text-sm px-2 mb-3 mt-2"><span
                                                class="font-normal text-base text-bkn-blue dark:text-gray-300">Jenis Jabatan
                                                Fungsional
                                                <!----></span>
                                            <div class="mt-1"><label
                                                    class="flex ml-1 text-gray-600 dark:text-gray-400"><input type="radio"
                                                        id="1" wire:model="jenis_jabatan_fungsional"
                                                        class="text-sm my-1 border border-gray-300 p-2 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray form-radio"
                                                        value="1"><span class="ml-2 my-0.5">Fungsional
                                                        Murni</span></label><label
                                                    class="flex ml-1 text-gray-600 dark:text-gray-400"><input type="radio"
                                                        id="2" wire:model="jenis_jabatan_fungsional"
                                                        class="text-sm my-1 border border-gray-300 p-2 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray form-radio"
                                                        value="2"><span class="ml-2 my-0.5">Koordinator</span></label><label
                                                    class="flex ml-1 text-gray-600 dark:text-gray-400"><input type="radio"
                                                        id="3" wire:model="jenis_jabatan_fungsional"
                                                        class="text-sm my-1 border border-gray-300 p-2 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray form-radio"
                                                        value="3"><span class="ml-2 my-0.5">Sub Koordinator</span></label>
                                            </div>
                                        </label><!----></div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Rumpun
                                                Jabatan
                                                <!----></span><input wire:model="rumpun_jabatan" type="text"
                                                placeholder="Masukan Rumpun Jabatan" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Lokasi
                                                <!----></span><input wire:model="lokasi" type="text"
                                                placeholder="Masukan Lokasi" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Urutan
                                                <!----></span><input wire:model="urutan" type="text"
                                                placeholder="Masukan Urutan" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 mt-2 bg-gray-50 dark:bg-gray-700 sm:px-6 sm:flex sm:flex-row-reverse"><span
                                class="flex w-full rounded shadow-sm sm:ml-3 sm:w-auto"><button type="submit"
                                    @click="tambahJabatanFungsinal = false"
                                    class="inline-flex justify-center w-full px-8 py-1 text-xs leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded shadow-sm bg-bkn-blue hover:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo">
                                    SIMPAN </button><!----></span><span
                                class="flex w-full mt-3 rounded shadow-sm sm:mt-0 sm:w-auto"><button type="button"
                                    @click="tambahJabatanFungsinal = false"
                                    class="inline-flex justify-center w-full px-6 py-1 text-xs leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue">
                                    BATAL </button></span></div>
                    </form>
                </div>
            </div>
        </div>
        <div x-show="tambahJabatanPelaksana" class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-50"></div>
                </div><span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​ <div
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <form wire:submit.prevent="insertDataUnor(2)">
                        <div class="px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
                            <div class="w-full">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left"><!---->
                                    <h3 class="px-2 pb-3 text-lg font-medium leading-6 text-gray-900 dark:text-white"
                                        id="modal-headline-3"> Input Data Jabatan Pelaksana Baru </h3><!----><!---->
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Id
                                                Jabatan
                                                <!----></span><input wire:model="id_jabatan" type="text"
                                                placeholder="Masukan Jenjang Jabatan" autocomplete="on"
                                                class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Nama
                                            Jabatan
                                            <!----></span><input wire:model="nama_jabatan" type="text"
                                            placeholder="Masukan Nama Jabatan" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Detail
                                            Jabatan (Opsional)
                                            <!----></span><input wire:model="nama_sub_jabatan" type="text"
                                            placeholder="Masukan Detail Jabatan" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->

                                    <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Unor Atasan
                                            Langsung
                                            <!----></span>
                                        <div tabindex="-1"
                                            class="multiselect is-disabled bg-white text-sm text-left block w-full rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo">
                                            <!-- Search --><!--v-if--><!-- Tags (with search) --><!--v-if--><!-- Single label -->
                                            <div class="multiselect-single-label"><span
                                                    class="multiselect-single-label-text">{{ $sidebar->nama_unor }}</span>
                                            </div>
                                            <span class="multiselect-caret"></span><!-- Options -->
                                            <div class="multiselect-spacer"></div>
                                        </div>
                                    </div>
                                    <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Unor Induk
                                        </span>
                                        <div tabindex="-1"
                                            class="multiselect bg-white text-sm text-left block w-full rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo">
                                            <input type="text" class="multiselect-search">
                                            <div class="multiselect-placeholder">Pilih unor induk</div><span
                                                class="multiselect-caret"></span><!-- Options -->
                                            <div class="multiselect-dropdown is-hidden" tabindex="-1">
                                                <ul class="multiselect-options">
                                                    <li class="multiselect-option"><span>Sekretariat DPRD</span></li>
                                                    <li class="multiselect-option"><span>Pemerintah Kab. Bandung</span></li>
                                                </ul>
                                            </div>
                                            <div class="multiselect-spacer"></div>
                                        </div>
                                    </div>
                                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Kode
                                            Cepat </span><input wire:model="kode_cepat" type="text"
                                            placeholder="Masukan Kode Cepat" autocomplete="on"
                                            class="bg-white text-sm text-left block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Rumpun
                                                Jabatan
                                                <!----></span><input wire:model="rumpun_jabatan" type="text"
                                                placeholder="Masukan Rumpun Jabatan" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Lokasi
                                                <!----></span><input wire:model="lokasi" type="text"
                                                placeholder="Masukan Lokasi" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                    <div class="flex-initial ">
                                        <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Urutan
                                                <!----></span><input wire:model="urutan" type="text"
                                                placeholder="Masukan Urutan" autocomplete="on"
                                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 mt-2 bg-gray-50 dark:bg-gray-700 sm:px-6 sm:flex sm:flex-row-reverse"><span
                                class="flex w-full rounded shadow-sm sm:ml-3 sm:w-auto"><button type="submit"
                                    @click="tambahJabatanPelaksana = false"
                                    class="inline-flex justify-center w-full px-8 py-1 text-xs leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded shadow-sm bg-bkn-blue hover:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-indigo">
                                    SIMPAN </button><!----></span><span
                                class="flex w-full mt-3 rounded shadow-sm sm:mt-0 sm:w-auto"><button type="button"
                                    @click="tambahJabatanPelaksana = false"
                                    class="inline-flex justify-center w-full px-6 py-1 text-xs leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue">
                                    BATAL </button></span></div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>