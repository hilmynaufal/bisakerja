<div class="w-full bg-white"><!---->
    <div><!---->
        <div>
            <div class="w-full bg-white dark:bg-gray-800">
                <div class="flex w-full">
                    <div class="w-full overflow-hidden transition-shadow duration-300 bg-white rounded shadow-sm">
                        <div class="flex w-full">
                            <div class="w-full mx-auto grid mb-6">
                                <div class="flex items-center justify-between my-3">
                                    <div class="flex items-center">
                                        <h2 class="text-xl font-semibold text-gray-700">
                                            &nbsp;</h2>
                                    </div>
                                    <div class="flex justify-start mt-2">
                                        <div class="inline-block relative">
                                            <input type="text" name="q" placeholder="Pencarian" autocomplete="on"
                                                class="text-sm form-input block leading-snug border rounded-md w-full px-4 pl-8 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                            <div
                                                class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-400">
                                                <svg class="ov-icon mr-3" aria-hidden="true" width="19.2" height="19.2"
                                                    viewBox="0 0 32 32" fill="currentColor" style="font-size: 1.2em;">
                                                    <path
                                                        d="M19 3C13.488 3 9 7.488 9 13c0 2.395.84 4.59 2.25 6.313L3.281 27.28 4.72 28.72l7.968-7.969A9.922 9.922 0 0019 23c5.512 0 10-4.488 10-10S24.512 3 19 3zm0 2c4.43 0 8 3.57 8 8s-3.57 8-8 8-8-3.57-8-8 3.57-8 8-8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col bg-white overflow-hidden md:flex-row">
                                    <div class="md:flex md:w-full border-gray-200">
                                        <div class="pb-3 md:pb-0 w-full text-xs">
                                            <div class="w-full">
                                                <div class="w-full overflow-x-scroll overflow-y-scroll">
                                                    <table class="w-full table-auto" id="table_usulan">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    No </th>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Uraian Tugas
                                                                </th>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Hasil Kerja
                                                                </th>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Jumlah Hasil
                                                                </th>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Waktu
                                                                    Penyelesaian
                                                                </th>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Waktu Kerja
                                                                    Efektif
                                                                </th>
                                                                <th
                                                                    class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Kebutuhan
                                                                    Pegawai
                                                                </th><!---->
                                                                <th
                                                                    class="justify-end text-right cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                    Aksi
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-gray-600 text-sm font-light">
                                                            @if ($dataTugasPokok)
                                                                @foreach ($dataTugasPokok as $item)
                                                                    <tr x-data="{open : false}" @click="open = !open"
                                                                        class="hover:bg-bkn-blue hover:text-white hover:bg-bkn-blue hover:text-white border-b border-gray-200">
                                                                        <td
                                                                            class="justify-start text-left cursor-auto py-2 px-2">
                                                                            {{ $loop->iteration }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-left cursor-auto py-2 px-2">
                                                                            {{ $item->uraian_tugas }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-left cursor-auto py-2 px-2">
                                                                            {{ $item->hasil_kerja }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-center cursor-auto py-2 px-2">
                                                                            {{ $item->beban_kerja }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-center cursor-auto py-2 px-2">
                                                                            {{ $item->waktu_penyelesaian }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-center cursor-auto py-2 px-2">
                                                                            {{ $item->waktu_kerja_efektif }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-center cursor-auto py-2 px-2">
                                                                            {{ $item->kebutuhan_pegawai }}
                                                                        </td>
                                                                        <td
                                                                            class="justify-start text-left cursor-auto py-2 px-2">
                                                                            <div class="flex item-right justify-end">
                                                                                <span
                                                                                    wire:click="hapusTugasPokok('{{ $item->id }}')"
                                                                                    class="block px-1 py-1 text-xs text-gray-600 capitalize rounded cursor-pointer hover:bg-indigo-900 hover:text-gray-100">
                                                                                    Hapus </span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr class="font-semibold">
                                                                    <td colspan="4" class="text-right py-2 px-2">JUMLAH</td>
                                                                    <td class="text-center py-2 px-2">{{ $jumlah_waktu_penyelesaian }}</td>
                                                                    <td class="text-center py-2 px-2"></td>
                                                                    <td class="text-center py-2 px-2">{{ $jumlah_kebutuhan_pegawai }}</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr class="font-semibold">
                                                                    <td colspan="6" class="text-right py-2 px-2">JUMLAH PEGAWAI</td>
                                                                    <td class="text-center py-2 px-2">{{ number_format($jumlah_kebutuhan_pegawai, 0) }}</td>
                                                                    <td></td>
                                                                </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!----><!---->
                    </div>
                </div>
            </div><!----><!----><!---->
            <form wire:submit="insertTugasPokok">
                <div class="w-full bg-white dark:bg-gray-800 pt-5 pb-4 sm:py-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">
                        Tugas Pokok </h3>
                    <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                                class="text-bkn-blue text-base">Uraian Tugas
                                <span><span class="text-red-500">*</span></span></span><textarea
                                wire:model="uraian_tugas" placeholder="Ketik Uraian Tugas Disini (maks. 350 Karakter)"
                                autocomplete="on" required="" rows="4"
                                class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-textarea"></textarea></label><!---->
                    </div>
                    <div class="flex">
                        <div class="flex-initial w-1/2">
                            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                        class="text-bkn-blue text-base">Hasil
                                        Kerja <span><span class="text-red-500">*</span></span></span><input
                                        wire:model="hasil_kerja" type="text"
                                        placeholder="Masukan Hasil Kerja (maks. 300 karakter)" autocomplete="on"
                                        required=""
                                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                            </div><!---->
                        </div>
                        <div class="flex-initial w-1/2">
                            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                        class="text-bkn-blue text-base">Satuan
                                        Hasil Kerja <span><span class="text-red-500">*</span></span></span><input
                                        wire:model="satuan_hasil_kerja" type="text"
                                        placeholder="Masukan Satuan Hasil Kerja" autocomplete="on" required=""
                                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                            </div><!---->
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-initial w-1/2">
                            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                        class="text-bkn-blue text-base">Jumlah Hasil <span><span
                                                class="text-red-500">*</span></span></span><input
                                        wire:model="beban_kerja" type="text" placeholder="Masukan Beban Kerja 1 Tahun"
                                        autocomplete="on" required=""
                                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                            </div>
                        </div>
                        <div class="flex-initial w-1/2">
                            <div class="block text-sm mb-3 mt-2"><span class="text-bkn-blue text-base"> Waktu
                                    Kerja Efektif 1 tahun </span><br><input wire:model="waktu_kerja_efektif"
                                    type="radio" id="jam" value="1250"><label class="ml-2 mr-4" for="jam">1250 (dalam
                                    jam)</label><input wire:model="waktu_kerja_efektif" type="radio" id="menit"
                                    value="75000"><label class="ml-2 mr-4" for="menit">75000 (dalam
                                    menit)</label><!----></div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex-initial w-1/2">
                            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                        class="text-bkn-blue text-base">Waktu
                                        Penyelesaian (jam/menit) <span><span
                                                class="text-red-500">*</span></span></span><input
                                        wire:model="waktu_penyelesaian" type="text"
                                        placeholder="Masukan Waktu Penyelesaian" autocomplete="on" required=""
                                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                            </div>
                        </div>
                        <div class="flex-initial w-1/2">
                            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                        class="text-bkn-blue text-base">Kebutuhan
                                        Pegawai <!----></span><input wire:model="kebutuhan_pegawai" type="text"
                                        placeholder="Masukan Kebutuhan Pegawai" autocomplete="on" readonly=""
                                        class="bg-gray-100 block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                            </div>
                        </div>
                    </div>
                    <div class="ml-2"><!----><!----></div>
                </div>
                <div class="flex">
                    <div class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3"></div>
                    <div class="w-1/4"><button type="button"
                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                            RESET FORM</button></div>
                    <div class="w-1/6"><button type="submit"
                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                            SIMPAN </button></div><!---->
                </div>
            </form>
        </div><!---->

    </div>
</div>