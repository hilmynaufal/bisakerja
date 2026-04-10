<div class="w-full bg-white"><!----><!---->
        <div>
                <div class="w-full bg-white dark:bg-gray-800 px-2 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!---->
                        <ul class="flex flex-wrap mt-3">
                                
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('data-jabatan')"
                                                class="
                                                @if ($activeInfoJabatanPage === 'data-jabatan')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium ">Data
                                                Jabatan</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('tugas-pokok')"
                                                class="@if ($activeInfoJabatanPage === 'tugas-pokok')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Tugas
                                                Pokok</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('hasil-kerja')"
                                                class="@if ($activeInfoJabatanPage === 'hasil-kerja')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Hasil
                                                Kerja</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('bahan-kerja')"
                                                class="@if ($activeInfoJabatanPage === 'bahan-kerja')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Bahan
                                                Kerja</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('perangkat-kerja')"
                                                class="@if ($activeInfoJabatanPage === 'perangkat-kerja')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Perangkat
                                                Kerja</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('tanggung-jawab')"
                                                class="@if ($activeInfoJabatanPage === 'tanggung-jawab')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Tanggung
                                                Jawab</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('wewenang')"
                                                class="@if ($activeInfoJabatanPage === 'wewenang')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Wewenang</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('korelasi-jabatan')"
                                                class="@if ($activeInfoJabatanPage === 'korelasi-jabatan')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Korelasi
                                                Jabatan</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('kondisi-lingkungan-kerja')"
                                                class="@if ($activeInfoJabatanPage === 'kondisi-lingkungan-kerja')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Kondisi
                                                Ling. Kerja</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('resiko-bahaya')"
                                                class="@if ($activeInfoJabatanPage === 'resiko-bahaya')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Resiko
                                                Bahaya</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('syarat-jabatan')"
                                                class="@if ($activeInfoJabatanPage === 'syarat-jabatan')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Syarat
                                                Jabatan Lain</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('prestasi-kerja')"
                                                class="@if ($activeInfoJabatanPage === 'prestasi-kerja')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Prestasi
                                                Kerja Diharapkan</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('kelas-jabatan')"
                                                class="@if ($activeInfoJabatanPage === 'kelas-jabatan')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Kelas
                                                Jabatan</button></li>
                                <li class="mr-2 mb-2"><button wire:click="setActiveInfoJabatanPage('import')"
                                                class="@if ($activeInfoJabatanPage === 'import')
                                                        text-white bg-bkn-blue
                                                @else
                                                        text-bkn-blue bg-white border-bkn-blue 
                                                @endif
                                                items-center w-auto text-xs border rounded py-1 px-1 font-medium">Import</button></li>
                        </ul>
                        
                        @if ($activeInfoJabatanPage === 'data-jabatan')
                                <livewire:data-jabatan :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'tugas-pokok')
                                <livewire:tugas-pokok :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'hasil-kerja')
                                <livewire:hasil-kerja :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'bahan-kerja')
                                <livewire:bahan-kerja :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'perangkat-kerja')
                                <livewire:perangkat-kerja :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'tanggung-jawab')
                                <livewire:tanggung-jawab :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'wewenang')
                                <livewire:wewenang :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'korelasi-jabatan')
                                <livewire:korelasi-jabatan :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'kondisi-lingkungan-kerja')
                                <livewire:kondisi-lingkungan-kerja :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'syarat-jabatan')
                                <livewire:syarat-jabatan :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'resiko-bahaya')
                                <livewire:resiko-bahaya :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'kelas-jabatan')
                                <livewire:kelas-jabatan :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'prestasi-kerja')
                                <livewire:prestasi-kerja :activeJabatanId="$activeJabatanId" />
                        @elseif ($activeInfoJabatanPage === 'import')
                                <livewire:import :activeJabatanId="$activeJabatanId" />
                        @endif
                        
                </div>
        </div><!----><!---->
</div>