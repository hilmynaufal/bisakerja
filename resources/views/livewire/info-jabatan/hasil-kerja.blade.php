<div class="w-full bg-white"><!----><!---->
  <div>
    <div class="w-full bg-white dark:bg-gray-800">
      <div class="flex w-full">
        <div class="w-full overflow-hidden transition-shadow duration-300 bg-white rounded shadow-sm">
          <div class="flex w-full">
            <div class="w-full mx-auto grid mb-6">
              <div class="flex items-center justify-between my-3">
                <div class="flex items-center">
                  <h2 class="text-xl font-semibold text-gray-700">&nbsp;</h2>
                </div>
                <div class="flex justify-start mt-2">
                  <div class="inline-block relative"><input type="text" name="q" placeholder="Pencarian"
                      autocomplete="on"
                      class="text-sm form-input block leading-snug border rounded-md w-full px-4 pl-8 dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                    <div
                      class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-400">
                      <svg class="ov-icon mr-3" aria-hidden="true" width="19.2" height="19.2" viewBox="0 0 32 32"
                        fill="currentColor" style="font-size: 1.2em;">
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
                                Hasil Kerja </th>
                              <th
                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                Satuan Hasil </th>
                            </tr>
                          </thead>
                          <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($dataHasilKerja as $item)
                              <tr
                                class="hover:bg-bkn-blue hover:text-white hover:bg-bkn-blue hover:text-white border-b border-gray-200">
                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ $loop->iteration }}</td>
                                <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $item->hasil_kerja }}
                                </td>
                                <td class="justify-start text-left cursor-auto py-2 px-2"> {{ $item->satuan_hasil_kerja }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!---->
</div>