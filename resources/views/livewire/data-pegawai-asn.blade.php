<div class="w-full bg-white relative">
    <!-- Loading Overlay -->
    <div wire:loading wire:target="fetchDataFromApi" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center">
            <svg class="animate-spin h-8 w-8 text-bkn-blue mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-600 font-medium">Mengambil data dari API...</p>
            <p class="text-gray-500 text-sm mt-1">Mohon tunggu sebentar</p>
        </div>
    </div>
    <!----><!----><!---->
    <div>
        <div class="w-full dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            
            <!-- Info Kuota Pegawai -->
            <div class="mb-4 px-2">
                <div class="bg-gray-100 border border-gray-300 rounded-lg p-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <svg class="h-5 w-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Informasi Kuota Pegawai</span>
                        </div>
                        <button type="button" wire:click="checkQuota" 
                            class="text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Refresh
                        </button>
                    </div>
                    <div class="mt-2 text-sm text-gray-600">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-blue-600">{{ $kebutuhanPegawai }}</div>
                                <div class="text-xs text-gray-500">Kebutuhan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ $jumlahPegawaiSekarang }}</div>
                                <div class="text-xs text-gray-500">Terisi</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold {{ $sisaKuota > 0 ? 'text-orange-600' : 'text-red-600' }}">{{ $sisaKuota }}</div>
                                <div class="text-xs text-gray-500">Sisa</div>
                            </div>
                        </div>
                        @if($sisaKuota <= 0)
                            <div class="mt-2 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    Kuota Sudah Penuh
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="w-full">
                <div class="w-full">
                    <div class="w-full overflow-x-scroll overflow-y-scroll">
                        <table class="w-full table-auto" id="table_pns">
                            <thead>
                                <tr>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        No </th>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        NIP Baru </th>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        Nama </th>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        Kedudukan Hukum </th>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        Golongan </th>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        Jabatan </th>
                                    <th
                                        class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                        Aksi </th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($dataPegawaiAsn as $pegawai)
                                <tr
                                    class="hover:bg-bkn-blue hover:text-white hover:bg-bkn-blue hover:text-white border-b border-gray-200">
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $loop->iteration }}</td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->nip_baru }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->nama }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->kedudukan_hukum }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->golongan }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->jabatan }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2">
                                        <button 
                                            wire:click="deletePegawaiAsn('{{ $pegawai->nip_baru }}')"
                                            wire:confirm="Apakah Anda yakin ingin menghapus data pegawai {{ $pegawai->nama }} (NIP: {{ $pegawai->nip_baru }})?"
                                            wire:loading.attr="disabled"
                                            class="bg-red-500 hover:bg-red-700 text-white text-xs px-2 py-1 rounded transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                            title="Hapus pegawai">
                                            <span wire:loading.remove wire:target="deletePegawaiAsn('{{ $pegawai->nip_baru }}')">
                                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </span>
                                            <span wire:loading wire:target="deletePegawaiAsn('{{ $pegawai->nip_baru }}')">
                                                <svg class="animate-spin h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                                Menghapus...
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!---->

    <form wire:submit="insertDataPegawaiAsn">
        <div class="w-full bg-white dark:bg-gray-800 pt-5 pb-4 sm:py-6 sm:pb-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">
                Data Pegawai ASN 
            </h3>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4 mx-2">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm text-blue-700">
                            <strong>Petunjuk:</strong> Masukkan NIP Baru, kemudian klik tombol "Ambil Data" atau tekan Enter untuk mengambil data pegawai dari API secara otomatis. Sistem akan memvalidasi duplikasi NIP dan kuota kebutuhan pegawai sebelum menyimpan data.
                        </p>
                        <div class="mt-2 flex gap-2">
                            <button type="button" wire:click="testApiConnection" 
                                class="text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Test Koneksi API
                            </button>
                            <button type="button" wire:click="checkQuota" 
                                class="text-xs bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                Cek Kuota Pegawai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block text-sm mb-3 mt-2">
                <label class="block text-sm px-2 mb-3 mt-2">
                    <span class="text-bkn-blue text-base">NIP Baru
                        <span><span class="text-red-500">*</span></span>
                    </span>
                    <div class="flex gap-2 mt-1">
                        <input wire:model="nip_baru" type="text"
                            placeholder="Masukan NIP Baru" autocomplete="on" required=""
                            wire:keydown.enter="fetchDataFromApi"
                            wire:loading.attr="disabled"
                            class="flex-1 border rounded px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input disabled:opacity-50">
                        <button type="button" wire:click="fetchDataFromApi" 
                            wire:loading.attr="disabled"
                            class="px-4 py-2 text-xs font-medium text-white border rounded bg-green-600 border-green-600 hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="fetchDataFromApi">
                                Ambil Data
                            </span>
                            <span wire:loading wire:target="fetchDataFromApi">
                                <svg class="animate-spin h-4 w-4 text-white inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Loading...
                            </span>
                        </button>
                    </div>
                </label>
            </div>
            <div class="block text-sm mb-3 mt-2">
                <label class="block text-sm px-2 mb-3 mt-2">
                    <span class="text-bkn-blue text-base">Nama
                        <span><span class="text-red-500">*</span></span>
                    </span>
                    <input wire:model="nama" type="text"
                        placeholder="Masukan Nama" autocomplete="on" required=""
                        wire:loading.attr="disabled"
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input disabled:opacity-50">
                </label>
            </div>
            <div class="block text-sm mb-3 mt-2">
                <label class="block text-sm px-2 mb-3 mt-2">
                    <span class="text-bkn-blue text-base">Kedudukan Hukum
                        <span><span class="text-red-500">*</span></span>
                    </span>
                    <input wire:model="kedudukan_hukum"
                        type="text" placeholder="Masukan Kedudukan Hukum" autocomplete="on" required=""
                        wire:loading.attr="disabled"
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input disabled:opacity-50">
                </label>
            </div>
            <div class="flex">
                <div class="flex-initial w-1/2">
                    <div class="block text-sm mb-3 mt-2">
                        <label class="block text-sm px-2 mb-3">
                            <span class="text-bkn-blue text-base">Jabatan
                                <span><span class="text-red-500">*</span></span>
                            </span>
                            <input wire:model="jabatan"
                                type="text" placeholder="Masukan Jabatan" autocomplete="on" required=""
                                wire:loading.attr="disabled"
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input disabled:opacity-50">
                        </label>
                    </div>
                </div>
                <div class="flex-initial w-1/2">
                    <div class="block text-sm mb-3 mt-2">
                        <label class="block text-sm px-2 mb-3">
                            <span class="text-bkn-blue text-base">Golongan
                                <span><span class="text-red-500">*</span></span>
                            </span>
                            <input wire:model="golongan"
                                type="text" placeholder="Masukan Golongan" autocomplete="on" required=""
                                wire:loading.attr="disabled"
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input disabled:opacity-50">
                        </label>
                    </div>
                </div>
            </div>

            <div class="ml-2"><!----><!----></div>
        </div>
        <div class="flex">
            <div class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3"></div>
            <div class="w-1/4">
                <button type="button" wire:click="resetForm"
                    class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-gray-500 border-gray-500 hover:bg-gray-600">
                    RESET FORM
                </button>
            </div>
            <div class="w-1/6">
                @php
                    $kebutuhanPegawai = DB::table('tugas_pokok')->where('id_jabatan', $activeJabatanId)->sum('kebutuhan_pegawai');
                    $jumlahPegawaiSekarang = DB::table('data_pegawai_asn')->where('id_jabatan', $activeJabatanId)->count();
                    $sisaKuota = $kebutuhanPegawai - $jumlahPegawaiSekarang;
                    $isQuotaFull = $sisaKuota <= 0;
                @endphp
                <button type="submit"
                    wire:loading.attr="disabled"
                    @if($isQuotaFull) disabled @endif
                    class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded {{ $isQuotaFull ? 'bg-gray-400 border-gray-400 cursor-not-allowed' : 'bg-bkn-blue border-bkn-blue hover:bg-blue-700' }} disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="insertDataPegawaiAsn">
                        @if($isQuotaFull)
                            KUOTA PENUH
                        @else
                            SIMPAN
                        @endif
                    </span>
                    <span wire:loading wire:target="insertDataPegawaiAsn">
                        <svg class="animate-spin h-4 w-4 text-white inline mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Menyimpan...
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>