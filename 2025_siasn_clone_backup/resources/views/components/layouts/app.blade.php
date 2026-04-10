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

    <title>{{ $title ?? 'Page Title' }}</title>
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

    <link rel="icon" href="https://perencanaan-siasn.bkn.go.id/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BKN - LAYANAN PERENCANAAN</title>
    
    <script type="module" crossorigin="" src="index.3e411ead.js.download"></script>
    <link rel="modulepreload" href="https://perencanaan-siasn.bkn.go.id/assets/vendor.2fb5a69e.js">
    <link href="css2" rel="stylesheet">
    <link rel="stylesheet" href="index.fbcc6d31.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @livewireStyles
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    <link rel="icon" href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/login/keycloak/img/favicon.ico" />
<link
    href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/common/keycloak/web_modules/@fortawesome/fontawesome-free/css/icons/all.css"
    rel="stylesheet" />
<link
    href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/common/keycloak/web_modules/@patternfly/react-core/dist/styles/base.css"
    rel="stylesheet" />
<link
    href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/common/keycloak/web_modules/@patternfly/react-core/dist/styles/app.css"
    rel="stylesheet" />
<!-- <link
    href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/common/keycloak/node_modules/patternfly/dist/css/patternfly.min.css"
    rel="stylesheet" /> -->
<link
    href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/common/keycloak/node_modules/patternfly/dist/css/patternfly-additions.min.css"
    rel="stylesheet" />
<link href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/common/keycloak/lib/pficon/pficon.css" rel="stylesheet" />
<link href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/login/keycloak/css/login.css" rel="stylesheet" />
<link href="https://sso-siasn.bkn.go.id/auth/resources/rprbj/login/keycloak/css/tile.css" rel="stylesheet" />


</head>

<body>
    
    {{ $slot }}
    @livewireScripts
</body>

</html>