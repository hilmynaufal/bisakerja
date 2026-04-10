<div>
    <form wire:key="{{ $id_jabatan }}" wire:submit.prevent="updateDataUnor">
        <div class="w-full px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
            <div class="flex">
                <h3 class="w-3/4 px-2 pb-3 mb-3 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                    Data Unor </h3>
                <div class="w-1/4"><button type="button"
                        class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                        CETAK DRAFT </button></div>
                <div class="w-1/6"><button type="submit"
                        class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                        SIMPAN </button></div><!---->
            </div>
            <div class="flex"><!----><!---->
                <div><!----></div>
            </div>
            <div class="flex">
                <div class="flex flex-row w-3/4 mt-1"></div>
                <div class="flex flex-row w-1/4 mt-1"><input disabled="" type="checkbox"
                        class="block w-4 h-4 bg-white border rounded"><label class="px-2 text-sm"> Skip Info Jabatan
                    </label></div>
            </div><!---->
            <div class="flex mb-5 ml-3 mr-5"><span>Id Jabatan:
                    {{ $dataUnor->id_jabatan }}</span>
                <hr>
            </div>
            <div class="flex">
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Nama Jabatan
                            <!----></span>
                            <input wire:model.live="searchNamaJabatan" type="text"
                            placeholder="Cari Nama Jabatan" autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                            @if(!empty($searchNamaJabatan) && count($searchResults) > 0)
                            <ul class="bg-white border mt-1 rounded shadow absolute z-10 w-full max-h-48 overflow-y-auto">
                                @foreach($searchResults as $result)
                                <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer" wire:click="selectNamaJabatan('{{ $result->nama_jabatan }}', '{{ $result->kelas_jabatan }}')">
                                    {{ $result->nama_jabatan }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </label>
                </div>
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Nama Sub Jabatan
                            <!----></span><input wire:model="nama_sub_jabatan" type="text"
                            placeholder="Masukan Nama Sub Jabatan" autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                </div>
            </div><!---->
            <div class="flex">
                <div class="flex-initial w-1/2">
                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Unor Atasan Struktural
                            <!----></span><input wire:model="unor_atasan_struktural" type="text"
                            placeholder="Masukan Unor Atasan Struktural" autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
                <div class="flex-initial w-1/2">
                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Unor Induk
                            <!----></span><input wire:model="unor_induk" type="text" placeholder="Unor Induk"
                            autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
            </div>
            <div class="flex">
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Kode Cepat
                            <!----></span><input wire:model="kode_cepat" type="text" placeholder="Masukan Kode Cepat"
                            autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
            </div>
            <div class="block px-2 mt-2 mb-3 text-sm"><span class="text-base text-bkn-blue"> Jabatan Prioritas
                </span>
                <div class="flex">
                    <div class="flex flex-row w-1/4 mt-1"><input disabled="" inputclass="[object Object]"
                            type="checkbox" class="block w-4 h-4 bg-white border rounded"><label class="px-2 text-sm">
                            J.Prioritas Nasional </label></div>
                    <div class="flex flex-row w-1/4 mt-1"><input disabled="" inputclass="[object Object]"
                            type="checkbox" class="block w-4 h-4 bg-white border rounded"><label class="px-2 text-sm">
                            J.Prioritas Instansi </label></div>
                </div>
            </div><!----><!----><!---->
            @if ($dataUnor->tipe_unor === 1)
                <div class="block mt-4 mb-3 text-sm"><label class="block text-sm px-2 mb-3 mt-2"><span
                            class="font-normal text-base text-bkn-blue dark:text-gray-300">Jenis Jabatan
                            Fungsional
                            <!----></span>
                        <div class="mt-1"><label class="flex ml-1 text-gray-600 dark:text-gray-400"><input type="radio"
                                    id="1" wire:model="jenis_jabatan_fungsional"
                                    class="text-sm my-1 border border-gray-300 p-2 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray form-radio"
                                    value="1"><span class="ml-2 my-0.5">Fungsional
                                    Murni</span></label><label class="flex ml-1 text-gray-600 dark:text-gray-400"><input
                                    type="radio" id="2" wire:model="jenis_jabatan_fungsional"
                                    class="text-sm my-1 border border-gray-300 p-2 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray form-radio"
                                    value="2"><span class="ml-2 my-0.5">Koordinator</span></label><label
                                class="flex ml-1 text-gray-600 dark:text-gray-400"><input type="radio" id="3"
                                    wire:model="jenis_jabatan_fungsional"
                                    class="text-sm my-1 border border-gray-300 p-2 focus:border-blue-400 focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-gray form-radio"
                                    value="3"><span class="ml-2 my-0.5">Sub Koordinator</span></label>
                        </div>
                    </label><!----></div>
            @endif
            <div class="flex">
                <div class="flex-initial w-1/2">

                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Level Struktur
                            <!----></span><input wire:model="level_struktur" type="text"
                            placeholder="Masukan Level Struktur" autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
                <div class="flex-initial w-1/2">
                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Lokasi
                            <!----></span><input wire:model="lokasi" type="text" placeholder="Lokasi" autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
            </div>
            <div class="flex">
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Latitude
                            <!----></span><input type="text" placeholder="0" autocomplete="on"
                            class="bg-gray-100 block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Longitude
                            <!----></span><input type="text" placeholder="0" autocomplete="on"
                            class="bg-gray-100 block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
            </div><!----><!---->
            <div class="flex">
                <div class="flex-initial w-1/2"></div>
            </div>
            <div class="flex">
                <div class="flex-initial w-full">
                    <div class="block px-2 mt-2 mb-3 text-sm"><!----><span class="text-base text-bkn-blue"> Rumpun
                            Jabatan <span class="text-red-500">*</span></span>
                        <div>
                            <div class="flex flex-row mb-2">
                                <div class="flex w-full"><!---->
                                    <div class="flex-initial w-full"><input wire:model="rumpun_jabatan" type="text"
                                            class="block w-full px-2 mt-1 text-sm  border rounded focus:outline-none form-input">
                                    </div><!---->
                                </div>
                            </div>
                        </div><!---->
                    </div>
                    @if ($id_jabatan != session("id_jabatan"))
                        <div class="flex">
                            <div class="flex-initial w-full">
                                <div class="block px-2 mt-2 mb-3 text-sm"><!----><span
                                        class="text-base text-bkn-blue">Urutan<span class="text-red-500">*</span></span>
                                    <div>
                                        <div class="flex flex-row mb-2">
                                            <div class="flex w-full"><!---->
                                                <div class="flex-initial w-full"><input wire:model="urutan" type="number"
                                                        class="block w-full px-2 mt-1 text-sm  border rounded focus:outline-none form-input">
                                                </div><!---->
                                            </div>
                                        </div>
                                    </div><!---->
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
          <div class="w-full"><button type="submit"
                        class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                        SIMPAN </button></div><!---->
          <hr class="mt-3 mb-2">
            <div class="ml-2 space-x-2"><!----><!----></div>
        </div>
    </form><!----><!----><!---->
</div><!----><!----><!---->