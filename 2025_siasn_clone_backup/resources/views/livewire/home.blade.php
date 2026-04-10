<div class="bg-gray-100 overflow-x-hidden">
        <div id="app" data-v-app=""><!---->
                <div class="min-h-screen">
                        <section class="py-5 px-6 bg-white shadow"><!---->
                                <nav class="relative">
                                        <div class="flex items-center">
                                                <div class="flex items-center mr-auto"><button
                                                                class="flex items-center transform scale-100 hover:scale-110"><svg
                                                                        class="block w-10 h-10 p-2 bg-white rounded text-bkn-blue"
                                                                        viewBox="0 0 20 20"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        fill="currentColor">
                                                                        <path
                                                                                d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z">
                                                                        </path>
                                                                </svg></button><a
                                                                href="https://perencanaan-siasn.bkn.go.id/pengelolaan/dashboard"
                                                                class="flex-shrink-0 mx-4 text-2xl font-semibold text-white"><img
                                                                        class="w-auto h-10" src="{{ asset('logo.png') }}"
                                                                        alt=""></a><span
                                                                class="hidden text-2xl font-bold md:block text-bkn-blue">
                                                                SISTEM INFORMASI ANALISIS JABATAN KABUPATEN BANDUNG </span>
                                                </div>
                                                <ul class="items-center hidden mr-6 space-x-6 md:flex">
                                                        <li>&nbsp;</li>
                                                </ul>
                                                <div class="block" x-data="{open : false}" @click="open = !open">
                                                        <button class="flex items-center">
                                                                <div class="relative block w-8 h-8 rounded-lg">
                                                                        <div
                                                                                class="relative flex items-center justify-center w-8 h-8 text-white bg-indigo-800 rounded-lg">
                                                                                -
                                                                        </div>
                                                                </div>
                                                                <div class="hidden mx-2 md:block">
                                                                        <p class="text-sm">{{ $nama }}</p>
                                                                        <p class="text-xs">{{ $jabatan }}</p>
                                                                </div><span><svg class="mx-2 text-gray-400 md:mx-0"
                                                                                width="10" height="6" viewBox="0 0 10 6"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M9.08335 0.666657C8.75002 0.333323 8.25002 0.333323 7.91669 0.666657L5.00002 3.58332L2.08335 0.666657C1.75002 0.333323 1.25002 0.333323 0.916687 0.666657C0.583354 0.99999 0.583354 1.49999 0.916687 1.83332L4.41669 5.33332C4.58335 5.49999 4.75002 5.58332 5.00002 5.58332C5.25002 5.58332 5.41669 5.49999 5.58335 5.33332L9.08335 1.83332C9.41669 1.49999 9.41669 0.99999 9.08335 0.666657Z"
                                                                                        fill="currentColor"></path>
                                                                        </svg></span>
                                                        </button>
                                                        <div class="relative" x-show="open" @click.away="open = false">
                                        <div
                                            class="absolute z-20 w-48 p-2 space-y-1 transform rounded-md shadow-lg bg-gradient-to-br from-white to-gray-50 right-1 ring-1 ring-black ring-opacity-5">
                                            <span wire:click="logout"
                                                class="block px-1 py-1 text-xs text-gray-600 capitalize rounded cursor-pointer hover:bg-indigo-900 hover:text-gray-100">
                                                Logout </span>
                                        </div>
                                    </div>
                                                </div>
                                        </div>
                                        <aside
                                                class="fixed top-0 left-0 z-30 h-full overflow-auto text-xs transition-all duration-300 ease-in-out transform bg-white shadow w-96 -translate-x-full">
                                                <span class="flex items-center w-full p-4"><span
                                                                class="justify-end text-right cursor-pointer text-bkn-blue hover:text-indigo-600"><svg
                                                                        class="w-6 h-6" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg></span></span><span
                                                        class="flex items-center px-4 py-2 bg-gray-300 border-b border-gray-400 cursor-pointer"><span>REFERENSI
                                                                USULAN</span></span>
                                                <div class="items-center block w-full"><a
                                                                href="https://perencanaan-siasn.bkn.go.id/pengelolaan/referensi/peraturan"
                                                                class="flex items-center px-4 py-2 cursor-pointer text-bkn-blue hover:bg-gray-50"><span
                                                                        class="mr-2"></span><span>Referensi
                                                                        Peraturan</span></a></div><span
                                                        class="flex items-center px-4 py-2 bg-gray-300 border-b border-gray-400 cursor-pointer"><span>USULAN
                                                                PETA
                                                                JABATAN</span></span><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
                                        </aside>
                                </nav><!----><!----><!---->
                        </section>
                        <section class="py-4 px-6"><!---->
                                @include('livewire.top-header')
                                <div class="flex flex-col mt-5 mb-20 lg:flex-row lg:space-x-2">
                                        <livewire:sidebar />
                                        <div class="w-full lg:w-2/3">
                                                <div class="w-full h-full">
                                                        <ul class="flex flex-wrap">
                                                                 @if ($activePage === 'peta-jabatan')
                                                                                                                                               <li class="lg:mr-2"><button
                                                                                                                                                                        class="text-blue-500 bg-white inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Peta Jabatan</button></li>
                                                                                                                                @else
                                                                                                                                                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                                                                                                                                                        wire:click="setActivePage('peta-jabatan')"
                                                                                                                                                                                                                                                                                                        class="text-gray-500 bg-gray-200 hover:text-blue-500 hover:bg-gray-50 inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Peta Jabatan</button></li>
                                                                                                                                                                                                                                                                @endif
                                                                @if ($activePage === 'data-unor')
                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                        class="text-blue-500 bg-white inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Data
                                                                                                                                                                        Unor</button></li>
                                                                                                                                @else
                                                                                                                                                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                                                                                                                                                        wire:click="setActivePage('data-unor')"
                                                                                                                                                                                                                                                                                                        class="text-gray-500 bg-gray-200 hover:text-blue-500 hover:bg-gray-50 inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Data
                                                                                                                                                                                                                                                                                                        Unor</button></li>
                                                                                                                                                                                                                                                                @endif
                                                                @if ($activePage === 'info-jabatan')
                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                        class="text-blue-500 bg-white inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Info
                                                                                                                                                                        Jabatan</button></li>
                                                                                                                                @else
                                                                                                                                                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                                                                                                                                                        wire:click="setActivePage('info-jabatan')"
                                                                                                                                                                                                                                                                                                        class="text-gray-500 bg-gray-200 hover:text-blue-500 hover:bg-gray-50 inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Info
                                                                                                                                                                                                                                                                                                        Jabatan</button></li>
                                                                                                                                                                                                                                                                @endif
                                                                @if ($activePage === 'data-pegawai-asn')
                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                        class="text-blue-500 bg-white inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Data
                                                                                                                                                                        Pegawai ASN</button></li>
                                                                                                                                @else
                                                                                                                                                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                                                                                                                                                        wire:click="setActivePage('data-pegawai-asn')"
                                                                                                                                                                                                                                                                                                        class="text-gray-500 bg-gray-200 hover:text-blue-500 hover:bg-gray-50 inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Data
                                                                                                                                                                                                                                                                                                        Pegawai ASN</button></li>
                                                                                                                                                                                                                                                                @endif
                                                                <!-- <li class="lg:mr-2"><button class="text-gray-500 bg-gray-200 hover:text-blue-500 hover:bg-gray-50 inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Data Pegawai ASN</button></li> -->
                                                                @if ($activePage === 'resume')
                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                        class="text-blue-500 bg-white inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Resume</button></li>
                                                                                                                                @else
                                                                                                                                                                                                                                                                        <li class="lg:mr-2"><button
                                                                                                                                                                                                                                                                                                        wire:click="setActivePage('resume')"
                                                                                                                                                                                                                                                                                                        class="text-gray-500 bg-gray-200 hover:text-blue-500 hover:bg-gray-50 inline-block rounded-t-lg py-2 px-4 text-sm font-medium text-center">Resume</button></li>
                                                                                                                                                                                                                                                                @endif
                                                        </ul>
                                                        <div class="w-full bg-white">
                                                                @if ($activePage === 'data-unor')
                                                                                                                                        <livewire:data-unor :id_jabatan="$activeJabatanId" :key="'data-unor'.$activeJabatanId"/>
                                                                                                                                @elseif ($activePage === 'info-jabatan')
                                                                                                                                                                                                                                                                        <livewire:info-jabatan :activeJabatanId="$activeJabatanId" :key="'info-jabatan'.$activeJabatanId"/>
                                                                                                                                                                                                                                                                        @elseif ($activePage === 'data-pegawai-asn')
                                                                                                                                                                                                                                                                        <livewire:data-pegawai-asn :activeJabatanId="$activeJabatanId" :key="'data-pegawai-asn'.$activeJabatanId"/>
                                                                                                                                                                                                                                                                        @elseif ($activePage === 'peta-jabatan')
                                                                                                                                                                                                                                                                        <livewire:peta-jabatan :activeJabatanId="$activeJabatanId" :key="'peta-jabatan'.$activeJabatanId"/>
                                                                                                                                                                                                                                                                @elseif ($activePage === 'resume')
                                                                                                                                                                                                                                                                        <livewire:resume :activeJabatanId="$activeJabatanId" :key="'resume'.$activeJabatanId"/>
                                                                                                                                                                                                                                                                @endif
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                        </section>
                        <div
                                class="fixed w-full bg-bkn-blue px-6 flex flex-col-reverse justify-center bottom-0 py-5 border-t lg:flex-row">
                                <p class="text-sm text-white"> © Copyright 2025 Diskominfo Kabupaten Bandung. All rights
                                        reserved. </p>
                        </div><!---->
                </div>
        </div>
</div>