<div x-data="{ showResetModal: false }">
    <!-- khusus untuk login -->

    <section>

        <style>
            @import url("https://fonts.gstatic.com");
            @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css");
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap");
            @import "login_assets/css/style.css";
        </style>
        <form wire:submit.prevent="login_siasn">
            <div class="logo">
                <img src="{{ asset('login_assets/img/logo_ex.png') }}" alt="Logo">
            </div>

            <label for="username">Username</label>
                <input type="text" id="username" placeholder="Username" wire:model="username">

                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" wire:model="password">

            <button>masuk</button>

            <div class="single-icon">
                <a href="#" target="_blank" rel="noopener noreferrer">
                    <img src="{{ asset('login_assets/img/logobawah.png') }}" alt="Login Icon">
                </a>
            </div>

            <style>
                .highlight-bisakerja {
                    font-size: 24px;
                    font-weight: bold;
                }
            </style>

            <div class="footer-text">
                <span class="highlight-bisakerja">BISAKERJA</span><i>versi 1.0</i> <br>
                Basis Informasi Sistem Analisis Jabatan Dan Analisis Beban Kerja<br>
                &copy; Copyright by Bagian Organisasi &
                <a href="https://diskominfo.bandungkab.go.id" target="_blank" rel="noopener noreferrer">
                    Diskominfo Kabupaten Bandung
                </a>
            </div>

        </form>
    </section>

    <div x-show="showResetModal"
        style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;display:flex;align-items:center;justify-content:center;"
        x-transition>
        <div>

            <form wire:submit.prevent="resetPassword" style="display:flex;align-items:center;justify-content:center;">
                <h4>Reset Password</h4>
                <input type="text" wire:model="resetUsername" class="form-control" placeholder="Masukkan Username"
                    required style="margin-bottom:10px;width:100%;">
                <button type="submit" class="btn btn-primary" style="width:100%;margin-bottom:10px;">Reset
                    Password</button>
            </form>
            @if ($resetMessage)
                <div style="margin-top:10px;" class="alert alert-info">{{ $resetMessage }}</div>
            @endif
            <button class="btn btn-secondary" style="width:100%;margin-top:10px;"
                @click="showResetModal = false">Tutup</button>
        </div>
    </div>
</div>