<div class="w-full bg-white"><!----><!----><!---->
    <div>
        <div class="w-full dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            
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
                                        NIP Lama </th>
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
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @foreach($dataPegawaiAsn as $pegawai)
                                <tr
                                    class="hover:bg-bkn-blue hover:text-white hover:bg-bkn-blue hover:text-white border-b border-gray-200">
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $loop->iteration }}</td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->nip_lama }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->nip_baru }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->nama }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->kedudukan_hukum }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->golongan }} </td>
                                    <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $pegawai->jabatan }} </td>
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
                Data Pegawai ASN </h3>
            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                        class="text-bkn-blue text-base">NIP Lama
                        <span><span class="text-red-500">*</span></span></span><input wire:model="nip_lama" type="text"
                        placeholder="Masukan NIP Lama" autocomplete="on" required=""
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
            </div>
            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                        class="text-bkn-blue text-base">NIP Baru
                        <span><span class="text-red-500">*</span></span></span><input wire:model="nip_baru" type="text"
                        placeholder="Masukan NIP Baru" autocomplete="on" required=""
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
            </div>
            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                        class="text-bkn-blue text-base">Nama
                        <span><span class="text-red-500">*</span></span></span><input wire:model="nama" type="text"
                        placeholder="Masukan Nama" autocomplete="on" required=""
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
            </div>
            <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                        class="text-bkn-blue text-base">Kedudukan Hukum
                        <span><span class="text-red-500">*</span></span></span><input wire:model="kedudukan_hukum"
                        type="text" placeholder="Masukan Kedudukan Hukum" autocomplete="on" required=""
                        class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
            </div>
            <div class="flex">
                <div class="flex-initial w-1/2">
                    <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                class="text-bkn-blue text-base">Jabatan
                                <span><span class="text-red-500">*</span></span></span><input wire:model="jabatan"
                                type="text" placeholder="Masukan Jabatan" autocomplete="on" required=""
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                    </div>
                </div>
                <div class="flex-initial w-1/2">
                    <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                class="text-bkn-blue text-base">Golongan
                                <span><span class="text-red-500">*</span></span></span><input wire:model="golongan"
                                type="text" placeholder="Masukan Golongan" autocomplete="on" required=""
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
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
</div>