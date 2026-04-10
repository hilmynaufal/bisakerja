<div>
    <form wire:submit.prevent="confirmReplace">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Mode Import:</label>
            <div>
                <label class="block">
                    <input type="radio" wire:model="importMode" value="append" class="mr-2">
                    <span class="text-sm">Append (Tambahkan data baru)</span>
                </label>
                <label class="block">
                    <input type="radio" wire:model="importMode" value="replace" class="mr-2">
                    <span class="text-sm">Replace (Ganti semua data)</span>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">File Excel:</label>
            <input type="file" wire:model="file" accept=".xlsx,.xls" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            @error('file') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <button type="button" wire:click="confirmReplace" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Import Data
        </button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>