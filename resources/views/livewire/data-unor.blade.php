<div>
    <form wire:key="{{ $id_jabatan }}" wire:submit.prevent="updateDataUnor">
        <div class="w-full px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
            <div class="flex">
                <h3 class="w-3/4 px-2 pb-3 mb-3 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                    Data Unor</h3>
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
                <div class="flex-initial w-1/3"><label class="block text-sm px-2 mb-3" title="SEKRETARIAT DAERAH"><span
                            class="text-bkn-blue text-base">Nama Unor HR
                            <!----></span><input wire:model="nama_unor_hr" type="text" placeholder="input label"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
                <div class="flex-initial w-1/3"><label class="block text-sm px-2 mb-3" title="SEKRETARIAT DAERAH"><span
                            class="text-bkn-blue text-base">Nama Unor Mapping BKN
                            <!----></span><input wire:model="nama_unor_bkn" type="text" placeholder="input label"
                            autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                    <div class="pl-3 text-xs"> ID: {{ $id_jabatan }}
                    </div>
                </div>
                <div class="flex-initial w-1/3"><label class="block text-sm px-2 mb-3" title="-"
                        data-tooltip-target="tooltip-hover"><span class="text-bkn-blue text-base">Nama Unor Mapping
                            Instansi <!----></span><input wire:model="nama_unor_mapping_instansi" type="text"
                            placeholder="input label" autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                    <div class="pl-3 text-xs"> ID: -</div>
                </div>
            </div>
            <div class="flex">
                <div class="flex-initial w-full"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Nama Pembina
                            <!----></span><input wire:model="nama_pembina" type="text" placeholder="input label"
                            autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
            </div>
            <div class="flex">
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Nama Unor
                            <!----></span><input wire:model="nama_unor" type="text" placeholder="Masukan Nama Unor"
                            autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                </div>
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">Nama Jabatan
                            <!----></span>
                        <input wire:model.live="searchNamaJabatan" type="text" placeholder="Cari Nama Jabatan"
                            autocomplete="on"
                            class=" block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                        @if(!empty($searchNamaJabatan) && count($searchResults) > 0)
                            <ul class="bg-white border mt-1 rounded shadow absolute z-10 w-full max-h-48 overflow-y-auto">
                                @foreach($searchResults as $result)
                                    <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer"
                                        wire:click="selectNamaJabatan('{{ $result->nama_jabatan }}', '{{ $result->kelas_jabatan }}')">
                                        {{ $result->nama_jabatan }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </label>
                </div>
            </div><!---->
            <div class="flex">
                <div class="flex-initial w-1/2">
                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Jenis Unor
                            <!----></span><input wire:model="jenis_unor" type="text" placeholder="Masukan Jenis Unor"
                            autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
                <div class="flex-initial w-1/2">
                    <label class="block text-sm px-2 mb-3"><span class="text-bkn-blue text-base">Jenjang Jabatan
                            <!----></span><input wire:model="jenjang_jabatan" type="text"
                            placeholder="Masukan Jenjang Jabatan" autocomplete="on"
                            class="[object Object] block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                </div>
            </div>
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
                <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                            class="text-bkn-blue text-base">BUP <!----></span><input wire:model="bup" type="text"
                            placeholder="Masukan BUP" autocomplete="on" maxlength="3"
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