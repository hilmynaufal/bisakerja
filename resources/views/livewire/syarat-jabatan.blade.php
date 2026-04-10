<div class="w-full bg-white"><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
    <div><!---->

        <form wire:submit.n="saveSyaratJabatan">
            <div class="w-full bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">
                    Syarat Jabatan Lain </h3>
                <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3 mt-2"><span
                            class="text-bkn-blue text-base">Keterampilan Kerja <!----></span><textarea wire:model="keterampilan"
                            placeholder="Ketik Keterampilan Kerja Disini (maks. 255 Karakter)" autocomplete="on"
                            rows="4"
                            class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-textarea"></textarea></label><!---->
                </div><!---->
                <div class="flex">
                    <div class="flex-initial w-1/2" x-data="{ open: false }">
                        <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Bakat
                                Kerja</span>
                            <div tabindex="-1"
                                class="multiselect block w-full bg-white text-sm text-left rounded-md mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                inputclass="" @click="open = !open;">
                                <!-- Search --><!--v-if--><!-- Tags (with search) -->
                                <div class="multiselect-tags">
                                    <!-- Menggunakan data dari controller -->
                                    @foreach($bakatKerja as $bakat)
                                        <span class="multiselect-tag is-disabled">{{ $bakat->kode }} - {{ Str::limit($bakat->nama_item, 25) }}<span class="ml-2"
                                                wire:click="removeBakatKerja('{{ $bakat->kode }}')"><svg
                                                    class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg></span></span>
                                    @endforeach
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
                                        @foreach($bakatKerjaOption as $bakat)
                                            <li class="multiselect-option" wire:click="addBakatKerja('{{ $bakat->kode }}')">
                                                <span>{{ $bakat->kode }} - {{ $bakat->nama_item }}
                                                    ({{ $bakat->deskripsi }})</span>
                                            </li>
                                        @endforeach

                                    </ul><!--v-if--><!--v-if-->
                                </div><!-- Hacky input element to show HTML5 required warning -->
                                <div class="multiselect-spacer"></div>
                            </div><!---->
                        </div>
                    </div>
                    <div class="flex-initial w-1/2" x-data="{ open: false }">
                        <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Minat
                                Kerja </span>
                            <div tabindex="-1"
                                class="multiselect block w-full bg-white text-sm text-left rounded-md mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                inputclass="" @click="open = !open;">
                                <!-- Search --><!--v-if--><!-- Tags (with search) -->
                                <div class="multiselect-tags">
                                    <!-- Menggunakan data dari controller -->
                                    @foreach($minatKerja as $minat)
                                        <span class="multiselect-tag is-disabled">{{ Str::limit($minat->nama_item, 30) }}<span class="ml-2"
                                                wire:click="removeMinatKerja('{{ $minat->id }}')"><svg
                                                    class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg></span></span>
                                    @endforeach
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
                                        @foreach($minatKerjaOption as $minat)
                                            <li class="multiselect-option" wire:click="addMinatKerja('{{ $minat->id }}')">
                                                <span>{{ $minat->nama_item }}
                                                    ({{ $minat->deskripsi }})</span>
                                            </li>
                                        @endforeach

                                    </ul><!--v-if--><!--v-if-->
                                </div>
                                <div class="multiselect-spacer"></div>
                            </div><!---->
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2" x-data="{ open: false }">
                        <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Tempramen
                                Kerja </span>
                            <div tabindex="-1"
                                class="multiselect block w-full bg-white text-sm text-left rounded-md mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                inputclass="" @click="open = !open;">
                                <!-- Search --><!--v-if--><!-- Tags (with search) -->
                                <div class="multiselect-tags">
                                    <!-- Menggunakan data dari controller -->
                                    @foreach($tempramenKerja as $tempramen)
                                        <span class="multiselect-tag is-disabled">{{ $tempramen->kode }} - {{ Str::limit($tempramen->nama_item, 25) }}<span
                                                class="ml-2"
                                                wire:click="removeTempramenKerja('{{ $tempramen->kode }}')"><svg
                                                    class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg></span></span>
                                    @endforeach
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
                                        @foreach($tempramenKerjaOption as $tempramen)
                                            <li class="multiselect-option"
                                                wire:click="addTempramenKerja('{{ $tempramen->kode }}')">
                                                <span>{{ $tempramen->kode }} - {{ $tempramen->nama_item }}
                                                    ({{ $tempramen->deskripsi }})</span>
                                            </li>
                                        @endforeach

                                    </ul><!--v-if--><!--v-if-->
                                </div><!-- Hacky input element to show HTML5 required warning -->
                                <div class="multiselect-spacer"></div>
                            </div><!---->
                        </div>
                    </div>

                    <div class="flex-initial w-1/2">
                        <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Upaya
                                Fisik </span>
                            <div tabindex="-1"
                                class="multiselect block w-full bg-white text-sm text-left rounded-md mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                inputclass="" x-data="{ open: false }" @click="open = !open;">
                                <!-- Search --><!--v-if--><!-- Tags (with search) -->
                                <div class="multiselect-tags">
                                    <!-- Menggunakan data dari controller -->
                                    @foreach($upayaFisik as $upaya)
                                        <span class="multiselect-tag is-disabled">{{ Str::limit($upaya->nama_item, 25) }}<span class="ml-2"
                                                wire:click="removeUpayaFisik('{{ $upaya->kode }}')"><svg
                                                    class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg></span></span>
                                    @endforeach
                                    <div class="multiselect-tags-search-wrapper">
                                        <span class="multiselect-tags-search-copy"></span>
                                    </div>
                                </div>
                                <div class="multiselect-dropdown" x-show="open" @click.away="open = false">
                                    <ul class="multiselect-options">
                                        <!-- Menggunakan data dari controller -->
                                        @foreach($upayaFisikOption as $upaya)
                                            <li class="multiselect-option" wire:click="addUpayaFisik('{{ $upaya->id }}')">
                                                <span>{{ $upaya->nama_item }}
                                                    ({{ $upaya->deskripsi }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="multiselect-spacer"></div>
                            </div><!---->
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <h3 class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pt-3 pb-3">
                        Kondisi Fisik </h3><!---->
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Jenis Kelamin <!----></span><input type="text"
                                    wire:model="jenisKelamin" placeholder="Masukan Jenis Kelamin" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Postur Badan <!----></span><input type="text"
                                    wire:model="posturBadan" placeholder="Masukan Postur Badan" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label>
                        </div>
                    </div>

                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2 px-2"><span class="text-bkn-blue text-base"> Umur
                                Maksimal </span><input type="text" wire:model="umur"
                                class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"
                                inputclass=""><!----></div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Penampilan <!----></span><input type="text"
                                    wire:model="penampilan" placeholder="Masukan Penampilan" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Tinggi Badan (cm) <!----></span><input type="text"
                                    wire:model="tinggiBadan" placeholder="Masukan Tinggi Badan" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        
                    </div>
                </div>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2"><label class="block text-sm px-2 mb-3"><span
                                    class="text-bkn-blue text-base">Berat Badan (Kg) <!----></span><input type="text"
                                    wire:model="beratBadan" placeholder="Masukan Berat Badan" autocomplete="on"
                                    class="block w-full border rounded mt-1 px-2 focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input"></label><!---->
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        
                    </div>
                </div><!---->
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pt-3 pb-3">
                    Fungsi Pekerjaan </h3><!---->
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base"> Fungsi
                                Pekerjaan </span>
                            <div tabindex="-1"
                                class="multiselect block w-full bg-white text-sm text-left rounded-md mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                inputclass="" x-data="{ open: false }" @click="open = !open;">
                                <!-- Search --><!--v-if--><!-- Tags (with search) -->
                                <div class="multiselect-tags">
                                    <!-- Menggunakan data dari controller -->
                                    @foreach($fungsiPekerjaan as $fungsi)
                                        <span class="multiselect-tag is-disabled">{{ $fungsi->kode }} - {{ $fungsi->nama_item }}<span class="ml-2"
                                                wire:click="removeFungsiPekerjaan('{{ $fungsi->kode }}')"><svg
                                                    class="w-4 h-4 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg></span></span>
                                    @endforeach
                                    <div class="multiselect-tags-search-wrapper">
                                        <span class="multiselect-tags-search-copy"></span>
                                    </div>
                                </div>
                                <div class="multiselect-dropdown" x-show="open" @click.away="open = false">
                                    <ul class="multiselect-options">
                                        <!-- Menggunakan data dari controller -->
                                        @foreach($fungsiPekerjaanOption as $fungsi)
                                            <li class="multiselect-option" wire:click="addFungsiPekerjaan('{{ $fungsi->kode }}')">
                                                <span>{{ $fungsi->kode }} - {{ $fungsi->nama_item }}
                                                    ({{ $fungsi->deskripsi }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="multiselect-spacer"></div>
                            </div><!---->
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
            </wire>
    </div><!----><!----><!---->
</div>