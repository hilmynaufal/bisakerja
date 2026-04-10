<div>
    <form wire:submit.prevent="import">
        <input type="file" wire:model="file" accept=".xlsx,.xls" />

        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2">Import</button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>