<div class="w-full bg-white">
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
                                    <div class="inline-block relative">
                                        <input type="text" name="q" wire:model.live="search"
                                            placeholder="Pencarian user..." autocomplete="on"
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
                                                <table class="w-full table-auto">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                No</th>
                                                            <th
                                                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                Nama</th>
                                                            <th
                                                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                Username</th>
                                                            <th
                                                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                Jabatan</th>
                                                            <th
                                                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">
                                                                Jabatan yang dikelola</th>
                                                            <th
                                                                class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 text-sm font-light">
                                                        @forelse ($users as $index => $user)
                                                            <tr
                                                                class="hover:bg-bkn-blue hover:text-white border-b border-gray-200">
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">
                                                                    {{ $index + 1 }}
                                                                </td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">
                                                                    {{ $user->nama ?? '-' }}
                                                                </td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">
                                                                    {{ $user->username ?? '-' }}
                                                                </td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">
                                                                    {{ $user->jabatan ?? '-' }}
                                                                </td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">
                                                                    {{ $user->jabatan_nama ?? '-' }}
                                                                </td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">
                                                                    <button wire:click="editUser({{ $user->id }})" class="text-xs px-2 py-1 bg-yellow-400 text-white rounded mr-1">Edit</button>
                                                                    <button wire:click="deleteUser({{ $user->id }})" class="text-xs px-2 py-1 bg-red-500 text-white rounded" onclick="return confirm('Yakin hapus user ini?')">Hapus</button>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center py-2">Belum ada user.
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                                <div class="flex items-center justify-between mt-4">
                                                    <div>
                                                        <label class="text-xs">Tampilkan
                                                            <select wire:model.live="perPage" class="border rounded px-2 py-1 text-xs">
                                                                <option value="5">5</option>
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                            </select>
                                                            data per halaman
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center space-x-1">
                                                        <button wire:click="goToPage({{ max(1, $page-1) }})" @if($page == 1) disabled @endif class="px-2 py-1 border rounded text-xs bg-gray-100">&lt;</button>
                                                        @for ($i = 1; $i <= $lastPage; $i++)
                                                            <button wire:click="goToPage({{ $i }})" class="px-2 py-1 border rounded text-xs @if($page == $i) bg-bkn-blue text-white @else bg-gray-100 @endif">{{ $i }}</button>
                                                        @endfor
                                                        <button wire:click="goToPage({{ min($lastPage, $page+1) }})" @if($page == $lastPage) disabled @endif class="px-2 py-1 border rounded text-xs bg-gray-100">&gt;</button>
                                                    </div>
                                                    <div class="text-xs">Total: {{ $total }}</div>
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
        </div>
        @if ($editMode)
        <form wire:submit.prevent="updateUser">
            <div class="w-full bg-white dark:bg-gray-800 pt-5 pb-4 sm:py-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">Edit User</h3>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2">
                            <label class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base">Nama</span>
                                <input type="text" wire:model="name" placeholder="Nama" autocomplete="on" class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input" />
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <div class="block text-sm mb-3 mt-2">
                            <label class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base">Username</span>
                                <input type="text" wire:model="username" placeholder="Username" autocomplete="on" class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input" />
                                @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="flex-initial w-full">
                            <div class="block text-sm mb-3 mt-2">
                                <label class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base">Jabatan</span>
                                    <div class="relative">
                                        <input wire:model.live="searchJabatan" type="text" placeholder="Cari Jabatan" autocomplete="off" class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                                        @if(!empty($searchJabatan) && count($searchJabatanResults) > 0)
                                            <ul class="bg-white border mt-1 rounded shadow absolute z-10 w-full max-h-48 overflow-y-auto">
                                                @foreach($searchJabatanResults as $result)
                                                    <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer" wire:click="selectJabatan('{{ $result->id_jabatan }}', '{{ $result->nama_unor }}')">{{ $result->nama_unor }} - id: {{ $result->id_jabatan }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    @error('jabatan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </label>
                            </div>
                            <div class="block text-sm mb-3 mt-2">
                                <label class="block text-sm px-2 mb-3 mt-2"><span class="text-bkn-blue text-base">Password</span>
                                    <input type="text" wire:model="password" placeholder="Password" autocomplete="on" class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input" />
                                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3"></div>
                    <div class="w-1/4">
                        <button type="button" wire:click="cancelEdit" class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-gray-400 border-gray-400 text-white">BATAL</button>
                    </div>
                    <div class="w-1/6">
                        <button type="submit" class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">SIMPAN</button>
                    </div>
                </div>
            </div>
        </form>
        @else
        <form wire:submit.prevent="addUser">
            <div class="w-full bg-white dark:bg-gray-800 pt-5 pb-4 sm:py-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3">Tambah User Baru
                </h3>
                <div class="flex">
                    <div class="flex-initial w-1/2">
                        <div class="block text-sm mb-3 mt-2">
                            <label class="block text-sm px-2 mb-3 mt-2"><span
                                    class="text-bkn-blue text-base">Nama</span>
                                <input type="text" wire:model="name" placeholder="Nama" autocomplete="on"
                                    class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input" />
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <div class="block text-sm mb-3 mt-2">
                            <label class="block text-sm px-2 mb-3 mt-2"><span
                                    class="text-bkn-blue text-base">Username</span>
                                <input type="text" wire:model="username" placeholder="Username" autocomplete="on"
                                    class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input" />
                                @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                    <div class="flex-initial w-1/2">
                        <div class="flex-initial w-full">
                            <div class="block text-sm mb-3 mt-2">
                                <label class="block text-sm px-2 mb-3 mt-2"><span
                                        class="text-bkn-blue text-base">Jabatan</span>
                                    <div class="relative">
                                        <input wire:model.live="searchJabatan" type="text" placeholder="Cari Jabatan"
                                            autocomplete="off"
                                            class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input">
                                        @if(!empty($searchJabatan) && count($searchJabatanResults) > 0)
                                            <ul
                                                class="bg-white border mt-1 rounded shadow absolute z-10 w-full max-h-48 overflow-y-auto">
                                                @foreach($searchJabatanResults as $result)
                                                    <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer"
                                                        wire:click="selectJabatan('{{ $result->id_jabatan }}', '{{ $result->nama_unor }}')">
                                                        {{ $result->nama_unor }} - id: {{ $result->id_jabatan }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    @error('jabatan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </label>
                            </div>
                            <div class="flex-initial w-full">
                                <div class="block text-sm mb-3 mt-2">
                                    <label class="block text-sm px-2 mb-3 mt-2"><span
                                            class="text-bkn-blue text-base">Password</span>
                                        <input type="password" wire:model="password" placeholder="Password"
                                            autocomplete="on"
                                            class="block w-full border mt-1 px-2 rounded focus:border-indigo-800 focus:outline-none focus:shadow-outline-indigo form-input" />
                                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-3/4 text-lg leading-6 font-medium text-gray-900 dark:text-white px-2 mb-3 pb-3"></div>
                    <div class="w-1/4">
                        <button type="button" wire:click="$set('name', ''); $set('email', ''); $set('password', '');"
                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">RESET
                            FORM</button>
                    </div>
                    <div class="w-1/6">
                        <button type="submit"
                            class="items-center float-right px-8 py-1 text-xs font-medium text-white border rounded bg-bkn-blue border-bkn-blue text-bkn-blue">SIMPAN</button>
                    </div>
                </div>
        </form>
        @endif
    </div>
</div>