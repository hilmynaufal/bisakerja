<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/css">
        .orgchart {
            background: #fff;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/5.0.0/js/jquery.orgchart.min.js"
        integrity="sha512-IUNqrYw8R7mj0iBzb0FOTGTgEFrxZCHVCHnePUEmcjJ/XQE/0sqRhBmGpp20N2lVzAkIBs0Sz+ibRN8/W9YFnQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/5.0.0/css/jquery.orgchart.css"
        integrity="sha512-5n6uZMAXFfsFB/7EnP7/6HwUOLpWGtSuYZMg9lM7K+RRhDmQoKQOUABjRn+Pl8MdhaXBdwmxB/j0aivqOLryOw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/5.0.0/css/jquery.orgchart.min.css"
        integrity="sha512-9A2BSSUL5eXVMWwrB8aDX8GeOOSMMVCk3fvqOplnswmo4IN4s6DW2ywpb3VCDcGCVwDc3g6S1k9T72NsCkgw5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/5.0.0/js/jquery.orgchart.js"
        integrity="sha512-6TR3veVI1LKFKaoyIiNDU+chMoYN5g2Sw7pqsM3IYJb8Ye0KKpfdPYne2J0SJlzW3C0mbADVqte35rl85rNn/w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/nuysoft/Mock/refactoring/dist/mock-min.js"></script>

    <link rel="icon" href="{{ asset('login_assets/img/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BISA KERJA</title>
    
    <script type="module" crossorigin="" src="index.3e411ead.js.download"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireStyles
    


</head>

<body>
<div 
    x-data="{ loading: false }"
    x-on:show-loading.window="loading = true"
    x-on:hide-loading.window="loading = false">
    <!-- Fullscreen Loading Overlay -->
    <div 
        x-show="loading"
        x-transition
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        style="display: none;">
        <div class="text-white text-xl">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
        </div>
    </div>

    {{ $slot }}
</div>
    
    @livewireScripts
</body>

</html>