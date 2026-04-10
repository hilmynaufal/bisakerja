<div class="w-full bg-white"><!----><!----><!----><!----><!---->
    <div><!---->
        <div class="w-full bg-white dark:bg-gray-800 pt-5 pb-4 sm:py-6 sm:pb-4">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">
                Tanggung Jawab </h3>
            <div class="block text-sm px-2 mb-3 mt-2">
                <p class="text-bkn-blue text-base">Uraian Tanggung Jawab</p>
                @foreach ($dataTanggungJawab as $item)
                    <form wire:submit.prevent="updateTanggungJawab({{ $item->id }})">
                        <div class="flex flex-row mb-2">
                            <div class="flex-initial w-11/12"><input type="text" wire:model="uraianModel.{{ $item->id }}"
                                    placeholder="Ketik Tanggung Jawab Disini (maks. 500 Karakter)" autocomplete="on"
                                    class="block w-full border text-sm rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"><!---->
                                <div class="text-sm mb-3 mt-2 flex">
                                    <div class="w-1/6 mr-2"><button type="submit"
                                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">
                                            UBAH </button></div>
                                    <button type="button" wire:click="hapusTanggungJawab('{{ $item->id }}')"
                                        class="inline-flex items-center justify-center h-7 text-xs px-3 py-1 font-medium tracking-wide transition duration-200 rounded shadow transform scale-100 float-right focus:shadow-outline-indigo text-red-500 border border-red-500">
                                        HAPUS </button>
                                </div><!---->
                            </div>
                            <div class="flex">
                            </div>
                        </div>
                    </form>
                @endforeach
                <form wire:submit.prevent="insertTanggungJawab">
                    <div class="flex flex-row mb-2">
                        <div class="flex-initial w-11/12"><input type="text" wire:model="uraian_tanggung_jawab"
                                placeholder="Ketik Tanggung Jawab Disini (maks. 500 Karakter)" autocomplete="on"
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
        </div>
    </div><!----><!----><!----><!----><!----><!----><!----><!---->
</div>