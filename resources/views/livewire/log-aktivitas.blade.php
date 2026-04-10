<div class="w-full bg-white">
    <div>
        <div class="w-full bg-white dark:bg-gray-800">
            <div class="flex w-full">
                <div class="w-full overflow-hidden transition-shadow duration-300 bg-white rounded shadow-sm">
                    <div class="flex w-full">
                        
                        <div class="w-full mx-auto grid mb-6">
                            <div class="flex items-center justify-between my-3">
                                <div class="flex items-center">
                                    <h2 class="text-xl font-semibold text-gray-700">Log Aktivitas</h2>
                                </div>
                                <div class="flex justify-start mt-2">
                                    <div class="inline-block relative">
                                        <input type="text" name="q" wire:model.live="search"
                                            placeholder="Pencarian username/aktivitas..." autocomplete="on"
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
                                                            <th class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">No</th>
                                                            <th class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">Username</th>
                                                            <th class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">Aktivitas</th>
                                                            <th class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">IP Address</th>
                                                            <th class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">User Agent</th>
                                                            <th class="justify-start text-left cursor-auto px-2 py-4 bg-gray-50 text-gray-500 capitalize">Waktu</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-gray-600 text-sm font-light">
                                                        @forelse ($logs as $index => $log)
                                                            <tr class="hover:bg-bkn-blue hover:text-white border-b border-gray-200">
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ ($page - 1) * $perPage + $index + 1 }}</td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ $log->username ?? '-' }}</td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ $log->activity ?? '-' }}</td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ $log->ip_address ?? '-' }}</td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ $log->user_agent ? Str::limit($log->user_agent, 40) : '-' }}</td>
                                                                <td class="justify-start text-left cursor-auto py-2 px-2">{{ $log->created_at ? \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s') : '-' }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center py-2">Belum ada log aktivitas.</td>
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
    </div>
</div>