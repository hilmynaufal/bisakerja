<div class="w-full bg-white">
    <div><!---->
        <form wire:key="{{ $dataDataJabatan->id_jabatan }}" wire:submit.prevent="updateDataJabatan">
            <div class="w-full bg-white dark:bg-gray-800 py-2">
                <div class="flex">
                    <h3 class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">
                        Data Jabatan</h3><!---->
                    
                    <div class="w-1/6"><button type="submit"
                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                            SIMPAN </button></div><!---->
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2">
                            <label class="block text-sm px-2 mb-3">
                                <span class="text-bkn-blue text-base">Nama Jabatan</span>
                                <div class="relative">
                                    <input
                                        wire:model.live="searchNamaJabatan"
                                        type="text"
                                        placeholder="Cari Nama Jabatan"
                                        autocomplete="off"
                                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"
                                    >
                                    @if(!empty($searchNamaJabatan) && count($searchResults) > 0)
                                        <ul class="bg-white border mt-1 rounded shadow absolute z-10 w-full max-h-48 overflow-y-auto">
                                            @foreach($searchResults as $result)
                                                <li
                                                    class="px-4 py-2 hover:bg-gray-200 cursor-pointer"
                                                    wire:click="selectNamaJabatan('{{ $result->nama_jabatan }}', '{{ $result->kelas_jabatan ?? '' }}')"
                                                >
                                                    {{ $result->nama_jabatan }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2">
                            <div class="block text-sm px-2"><span class="text-bkn-blue text-base">Jenis
                                    Jabatan
                                    <!----></span>
                                <input wire:model="jenis_jabatan" type="text" placeholder="Masukan Jenis Jabatan"
                                    autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                            </div><!---->
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2"><label class="block text-sm px-2 mb-3"><span
                                class="text-bkn-blue text-base">Kode Jabatan
                                <!----></span><input wire:model="kode_jabatan" type="text"
                                placeholder="Masukan Kode Jabatan" autocomplete="on"
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                    </div>
                    <div class="flex-initial w-1/2">&nbsp;</div>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pt-3 pb-3">
                    Unit Kerja </h3>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">JPT Madya
                                    <!----></span><input wire:model="jpt_madya" type="text" placeholder="JPT Madya"
                                    autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Administrator
                                    <!----></span><input wire:model="administrator" type="text"
                                    placeholder="Administrator" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">JPT Pratama
                                    <!----></span><input wire:model="jpt_pratama" type="text" placeholder="JPT Pratama"
                                    autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Pengawas
                                    <!----></span>
                                <input wire:model="pengawas" type="text" placeholder="Pengawas" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                        </div>
                    </div>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pt-3 pb-3">
                    Ikhtisar Jabatan </h3>
                <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                            class="text-bkn-blue text-base">Ikhtisar Jabatan
                            <span><span class="text-red-500">*</span></span></span><textarea
                            wire:model="ikhtisar_jabatan" placeholder="Masukan Ikhtisar Jabatan disini"
                            autocomplete="on" required="" rows="4"
                            class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-textarea"></textarea></label><!---->
                </div><!---->
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pt-3 pb-3">
                    Syarat Jabatan </h3>
                <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Pendidikan Formal </span>
                    <input wire:model.live="searchPendidikanMinimum"
                                        type="text"
                                        placeholder="Cari Nama Pendidikan"
                                        autocomplete="off"
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                        @if(!empty($searchPendidikanMinimum) && count($searchPendidikanMinimumResults) > 0)
                                        <ul class="bg-white border mt-1 rounded shadow absolute z-10 w-full max-h-48 overflow-y-auto">
                                            @foreach($searchPendidikanMinimumResults as $result)
                                                <li
                                                    class="px-4 py-2 hover:bg-gray-200 cursor-pointer"
                                                    wire:click="selectPendidikanMin('{{ $result->nama_pendidikan }}')"
                                                >
                                                    {{ $result->nama_pendidikan }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                </div><!---->

                <div class="block text-sm px-2 mb-3 mt-2">
                    <p class="text-bkn-blue text-base"> Pengalaman Kerja (dalam
                        hitungan tahun) </p>
                    <div class="flex flex-row">
                        <div class="flex-initial w-11/12"><input type="text"
                                placeholder="Masukan pengalaman kerja (dalam hitungan tahun)" wire:model="pengalaman"
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                        </div>
                        <div class="flex-initial w-1/12"><!----><!----></div>
                    </div><!---->
                </div>
                <div class="ml-2"><!----><!----></div>
            </div>
        </form>
        <div class="block text-sm px-2 mb-3">
            <div class="block text-sm mb-3">
                <p class="text-bkn-blue text-base"> Pendidikan & Pelatihan <span class="text-red-500"></span></p>
                @foreach ($dataPendidikan as $item)
                    <form wire:submit.prevent="updatePendidikan({{ $item->id }})">
                        <div class="flex flex-row mb-2">
                            <div class="flex-initial w-11/12"><input type="text"
                                    wire:model="input_nama_pendidikan.{{ $item->id }}"
                                    placeholder="Ketik Pendidikan Disini (maks. 500 Karakter)" autocomplete="on"
                                    class="block w-full border text-sm rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"><!---->
                                <div class="text-sm mb-3 flex">
                                    <div class="w-1/6"><button type="submit"
                                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                                            UBAH </button></div>
                                    <button type="button" wire:click="hapusPendidikan('{{ $item->id }}')"
                                        class="inline-flex items-center justify-center h-7 text-xs px-3 py-1 font-medium tracking-wide transition duration-200 rounded shadow transform scale-100 float-right focus:shadow-outline-indigo text-red-500 border border-red-500">
                                        HAPUS </button>
                                </div><!---->

                            </div>
                            <div class="flex">
                            </div>
                        </div>
                    </form>
                @endforeach
                <form wire:submit.prevent="insertPendidikan">
                    <div class="flex flex-row mb-2">
                        <div class="flex-initial w-11/12"><input type="text" wire:model="nama_pendidikan"
                                placeholder="Ketik Pendidikan Disini (maks. 500 Karakter)" autocomplete="on"
                                class="block w-full border text-sm rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"><!---->
                        </div>
                        <div class="flex-initial w-1/12"><!----><!----></div>
                    </div>
                    <div class="block text-sm mb-3"><!----></div><!---->
                    <div class="flex">
                        <div class="w-1/6"><button type="submit"
                                class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                                Tambah </button></div><!---->
                    </div>
                </form>
            </div>
        </div><!---->
    </div>
    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
</div>