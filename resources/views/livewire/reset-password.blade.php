<div class="container" style="max-width:400px;margin:40px auto;">
    <h3>Reset Password</h3>
    <form wire:submit.prevent="resetPassword">
        <div style="margin-bottom:10px;">
            <input type="text" wire:model="username" class="form-control" placeholder="Masukkan Username" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
    @if ($successMessage)
        <div style="margin-top:20px;" class="alert alert-info">
            {{ $successMessage }}
        </div>
    @endif
    <div style="margin-top:10px;">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</div>
