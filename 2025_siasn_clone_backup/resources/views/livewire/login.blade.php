<!-- khusus untuk login -->

<div class="login-pf-page">
    <div id="kc-header" class="login-pf-page-header">
    <img src="{{ asset('logo.png') }}" alt="Logo SINJAB" style="max-width: 200px; margin: 20px auto; display: block;">
        <div id="kc-header-wrapper" style="color:#000;" class="w-1/2 mx-auto">SISTEM INFORMASI ANALISIS JABATAN KABUPATEN BANDUNG</div>
    </div>
    <div class="card-pf">
        <header class="login-pf-header">
            <h1 id="kc-page-title" style="font-size:1.2rem"> Login menggunakan akun SSO ASN anda
            </h1>
        </header>
        <div id="kc-content">
            
                @csrf
                <div class="form-group">
                    <label for="username" class="pf-c-form__label pf-c-form__label-text">Username</label>
                    <input tabindex="1" class="pf-c-form-control" wire:model="username" type="text" autofocus=""
                        autocomplete="off" aria-invalid="">
                </div>
                <div class="form-group">
                    <label for="password" class="pf-c-form__label pf-c-form__label-text">Password</label>
                    <input tabindex="2" class="pf-c-form-control" wire:model="password" type="password"
                        autocomplete="off" aria-invalid="">
                </div>
                <button tabindex="4" class="pf-c-button pf-m-primary pf-m-block btn-lg" type="submit" wire:click="login_siasn()">Sign
                    In</button>
            

        </div>
    </div>
</div>