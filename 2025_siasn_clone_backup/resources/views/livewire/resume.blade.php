<div>
    <style>
        @import url('{{ public_path('index.fbcc6d31.css') }}');
    </style>

    <div class="mb-4">
        <a wire:click="exportPDF" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Export PDF
        </a>
    </div>
    <table class="w-full bg-white text-sm border border-gray-500">
        <tr>
            <td class="bg-gray-50 text-center font-medium py-2">{{ $dataDataJabatan->nama_jabatan }} -
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">I. DATA JABATAN</td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white px-5 py-2">
                <div class="flex">
                    <div class="w-3/12 pl-3">Nama Jabatan</div>
                    <div class="w-9/12">{{ $dataDataJabatan->nama_jabatan }}</div>
                </div>
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white px-5 py-2">
                <div class="flex">
                    <div class="w-3/12 pl-3">Kode Jabatan</div>
                    <div class="w-9/12"></div>
                </div>
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white px-5 py-2">
                <div class="flex">
                    <div class="w-3/12 pl-3">Unit Kerja</div>
                    <div class="w-9/12">&nbsp;</div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">a. JPT Madya</div>
                    <div class="w-9/12"></div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">b. JPT Pratama</div>
                    <div class="w-9/12">{{ $dataDataJabatan->jpt_pratama }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">c. Administrator</div>
                    <div class="w-9/12">{{ $dataDataJabatan->administrator }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">d. Pengawas</div>
                    <div class="w-9/12">{{ $dataDataJabatan->pengawas }}</div>
                </div>
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white px-5 py-2">
                <div class="flex">
                    <div class="w-3/12 pl-3">Ikhtisar Jabatan</div>
                    <div class="w-9/12">{{ $dataDataJabatan->ikhtisar_jabatan }}</div>
                </div>

            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white px-5 py-2">
                <div class="flex">
                    <div class="w-3/12 pl-3">Syarat Jabatan</div>
                    <div class="w-9/12">&nbsp;</div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">a. Tingkat Pendidikan</div>
                    <div class="w-9/12"> {{ $dataDataJabatan->pendidikan }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">b. Pendidikan & Pelatihan</div>
                    <div class="w-9/12">{{ implode(', ', array_column($dataPendidikan, 'nama_item')) }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-3/12 pl-3">c. Pengalaman</div>
                    <div class="w-9/12">{{$dataDataJabatan->pengalaman}}</div>
                </div>
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">II. TUGAS POKOK</td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-3/12">Uraian Tugas</div>
                    <div class="w-2/12">Hasil Kerja</div>
                    <div class="w-1/12">Jumlah Beban Kerja 1 Tahun</div>
                    <div class="w-2/12">Waktu Penyelesaian</div>
                    <div class="w-2/12">Waktu Kerja<br>Efektif<br>1 Tahun</div>
                    <div class="w-1/12">Kebutuhan Pegawai</div>
                </div>
            </td>
        </tr>
        @foreach ($dataTugasPokok as $tugasPokok)
            <tr class="border-t border-gray-500">

                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-3/12">{{ $tugasPokok->uraian_tugas }}</div>
                        <div class="w-2/12 pl-2">{{ $tugasPokok->satuan_hasil_kerja }}</div>
                        <div class="w-1/12 text-center">{{ $tugasPokok->beban_kerja }}</div>
                        <div class="w-2/12 text-center">{{ $tugasPokok->waktu_penyelesaian }}</div>
                        <div class="w-2/12">{{ $tugasPokok->waktu_kerja_efektif }}</div>
                        <div class="w-1/12">{{ $tugasPokok->kebutuhan_pegawai }}</div>
                    </div>
                </td>

            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-white px-5">
                <div class="flex my-2">
                    <div class="w-6/12 text-right font-medium">JUMLAH</div>
                    <div class="w-3/12">&nbsp;</div>
                    <div class="w-2/12"></div>
                    <div class="w-1/12 font-medium">{{ $jumlah_kebutuhan_pegawai }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-6/12 text-right font-medium"> JUMLAH KEBUTUHAN PEGAWAI </div>
                    <div class="w-3/12">&nbsp;</div>
                    <div class="w-2/12">&nbsp;</div>
                    <div class="w-1/12 font-medium"> {{ round($jumlah_kebutuhan_pegawai, 0) }} </div><!---->
                </div>
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">III. HASIL KERJA</td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-8/12">Hasil Kerja</div>
                    <div class="w-3/12">Satuan Hasil Kerja</div>
                </div>
            </td>
        </tr>
        @foreach ($dataTugasPokok as $tugasPokok)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-8/12 pl-2">{{ $tugasPokok->hasil_kerja }}</div>
                        <div class="w-3/12">{{ $tugasPokok->satuan_hasil_kerja }}</div>
                    </div>
                </td>
            </tr>
        @endforeach

        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">IV. BAHAN KERJA</td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-6/12">Bahan Kerja</div>
                    <div class="w-5/12">Penggunaan Dalam Tugas</div>
                </div>
            </td>
        </tr>
        @foreach ($dataBahanKerja as $bahanKerja)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-6/12">{{ $bahanKerja->uraian_bahan_kerja }}</div>
                        <div class="w-5/12">{{ $bahanKerja->penggunaan }}</div>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">V. PERANGKAT KERJA</td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-6/12">Bahan Kerja</div>
                    <div class="w-5/12">Penggunaan Dalam Tugas</div>
                </div>
            </td>
        </tr>
        @foreach ($dataPerangkatKerja as $perangkatKerja)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-6/12">{{ $perangkatKerja->uraian_perangkat_kerja }}</div>
                        <div class="w-5/12">{{ $perangkatKerja->penggunaan }}</div>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">VI. TANGGUNG JAWAB</td>
        </tr>
        @foreach ($dataTanggungJawab as $tanggungJawab)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="my-2 ml-5">{{ $loop->iteration }}. {{ $tanggungJawab->uraian_tanggung_jawab }}</div>
                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">VII. WEWENANG</td>
        </tr>
        @foreach ($dataWewenang as $wewenang)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="my-2 ml-5">{{ $loop->iteration }}. {{ $wewenang->uraian_wewenang }}</div>
                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2"> VIII. KORELASI JABATAN </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-3/12">Unit Kerja / Instansi</div>
                    <div class="w-3/12">Dalam Hal</div>
                </div>
            </td>
        </tr>
        @foreach ($dataKorelasiJabatan as $korelasiJabatan)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-3/12">{{ $korelasiJabatan->unit_kerja }}</div>
                        <div class="w-3/12">{{ $korelasiJabatan->dalam_hal }}</div>
                    </div>

                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2"> IX. RESIKO BAHAYA </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-3/12">Resiko Bahaya</div>
                    <div class="w-3/12">Penyebab</div>
                </div>
            </td>
        </tr>
        @foreach ($dataResikoBahaya as $resikoBahaya)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-3/12">{{ $resikoBahaya->nama_resiko }}</div>
                        <div class="w-3/12">{{ $resikoBahaya->penyebab }}</div>
                    </div>

                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2"> IX. KONDISI LINGKUNGAN KERJA </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">
                <div class="flex">
                    <div class="w-1/12">No</div>
                    <div class="w-5/12">Aspek</div>
                    <div class="w-6/12">Faktor</div>
                </div>
            </td>
        </tr>
        @foreach ($dataKondisiLingkunganKerja as $kondisiLingkunganKerja)
            <tr class="border-t border-gray-500">
                <td class="bg-white px-5 py-2">
                    <div class="flex">
                        <div class="w-1/12">{{ $loop->iteration }}</div>
                        <div class="w-5/12">{{ $kondisiLingkunganKerja->aspek }}</div>
                        <div class="w-6/12">{{ $kondisiLingkunganKerja->faktor }}</div>
                    </div>

                </td>
            </tr>
        @endforeach
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2"> XI. SYARAT JABATAN LAIN </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white">
                <div class="flex my-2">
                    <div class="w-1/12 text-center">a.</div>
                    <div class="w-4/12">Ketrampilan Kerja</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->keterampilan }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-1/12 text-center">b.</div>
                    <div class="w-4/12">Bakat Kerja</div>
                    <div class="w-7/12">{{ implode(', ', array_column($dataBakatKerja, 'nama_item')) }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-1/12 text-center">c.</div>
                    <div class="w-4/12">Tempramen Kerja</div>
                    <div class="w-7/12">{{ implode(', ', array_column($dataTempramenKerja, 'nama_item')) }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-1/12 text-center">d.</div>
                    <div class="w-4/12">Minat Kerja</div>
                    <div class="w-7/12">{{ implode(', ', array_column($dataMinatKerja, 'nama_item')) }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-1/12 text-center">e.</div>
                    <div class="w-4/12">Upaya Fisik</div>
                    <div class="w-7/12">{{ implode(', ', array_column($dataUpayaFisik, 'nama_item')) }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-1/12 text-center">f.</div>
                    <div class="w-4/12">Kondisi Fisik</div>
                    <div class="w-7/12">&nbsp;</div>
                </div>
                <div class="flex my-2">
                    <div class="w-2/12 pr-4 text-right">a.</div>
                    <div class="w-3/12">Jenis Kelamin</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->jenis_kelamin }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-2/12 pr-4 text-right">b.</div>
                    <div class="w-3/12">Umur maksimal</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->umur }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-2/12 pr-4 text-right">c.</div>
                    <div class="w-3/12">Tinggi Badan (cm)</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->tinggi_badan }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-2/12 pr-4 text-right">d.</div>
                    <div class="w-3/12">Berat Badan (Kg)</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->berat_badan }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-2/12 pr-4 text-right">e.</div>
                    <div class="w-3/12">Postur Badan</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->postur_badan }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-2/12 pr-4 text-right">f.</div>
                    <div class="w-3/12">Penampilan</div>
                    <div class="w-7/12">{{ $dataSyaratJabatan->penampilan }}</div>
                </div>
                <div class="flex my-2">
                    <div class="w-1/12 text-center">g.</div>
                    <div class="w-4/12">Fungsi Pekerjaan</div>
                    <div class="w-7/12">&nbsp;</div>
                </div>
                @foreach ($dataFungsiPekerjaan as $fungsiPekerjaan)
                    <div class="flex my-2">
                        <div class="w-2/12 pr-4 text-right">{{ $loop->iteration }}.</div>
                        <div class="w-3/12">{{ $fungsiPekerjaan->nama_item }}</div>
                    </div>
                @endforeach

            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2"> XII. PRESTASI KERJA YANG DIHARAPKAN </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white">
                <div class="flex my-2">
                    <div class="w-1/12 text-center">a.</div>
                    <div class="w-4/12">Nilai Kinerja</div>
                    <div class="w-7/12">Sangat Baik</div>
                </div>
            </td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-gray-50 font-medium px-5 py-2">XIII. KELAS JABATAN</td>
        </tr>
        <tr class="border-t border-gray-500">
            <td class="bg-white px-6 py-2">14</td>
        </tr>
    </table>
</div>