<div class="w-full bg-white">
    <!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
    <div>
        <form novalidate="">
            <div class="w-full bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">
                    Kelas Jabatan </h3>
                <div class="flex">
                    <div class="flex-initial w-1/2" x-data="{ open: false }">
                        <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Kelas
                                Jabatan </span>
                            <div tabindex="-1"
                                class="multiselect block w-full bg-white text-sm text-left rounded-md mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                inputclass="" @click="open = !open;">
                                <!-- Search --><!--v-if--><!-- Tags (with search) -->
                                <div class="multiselect-tags">
                                    <!-- Menggunakan data dari controller -->
                                        <span>{{ $dataKelasJabatan != null ? $dataKelasJabatan : "" }}</span>
                                    <div class="multiselect-tags-search-wrapper">
                                        <!-- Used for measuring search width --><span
                                            class="multiselect-tags-search-copy"></span><!-- Actual search input --><!--v-if-->
                                    </div>
                                </div>
                                <!-- Single label --><!--v-if--><!-- Multiple label --><!--v-if--><!-- Placeholder --><!--v-if--><!-- Spinner --><!--v-if--><!-- Clear --><!--v-if--><!-- Caret --><span
                                    class="multiselect-caret"></span><!-- Options -->
                                <div class="multiselect-dropdown" x-show="open" @click.away="open = false">
                                    <ul class="multiselect-options">
                                        <!-- Menggunakan data dari controller -->
                                        @for($i = 1; $i <= 15; $i++)
                                            <li class="multiselect-option" wire:click="changeKelasJabatan('{{ $i }}')">
                                                <span>{{ $i }}</span>
                                            </li>
                                        @endfor
                                    </ul><!--v-if--><!--v-if-->
                                </div><!-- Hacky input element to show HTML5 required warning -->
                                <div class="multiselect-spacer"></div>
                            </div><!---->
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">&nbsp;</div>
                </div>
                <div class="ml-2"><button type="submit"
                        class="items-center text-xs text-white bg-bkn-blue border rounded px-8 py-1 mt-4 border-bkn-blue font-medium"
                        style="display: none;"> SIMPAN </button><button type="button"
                        class="items-center text-xs text-white bg-gray-500 border rounded px-6 py-1 mt-4 border-gray-500 font-medium"
                        disabled="" style="display: none;"><span class="flex"><span class="mr-2">SIMPAN</span><span
                                class="flex items-center justify-center space-x-1 animate-pulse">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </span></span></button></div>
            </div>
        </form>
    </div><!---->
</div>