<?php
$themeClass = 'dark';
if (!empty($_COOKIE['theme'])) {
    $themeClass = $_COOKIE['theme'];
}
?>

<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data" lang="en" id="html" class="<?php echo $themeClass; ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}" property="og:title">
    <meta content="{{ __(config('SETTINGS::SYSTEM:SEO_DESCRIPTION')) }}" property="og:description">
    <meta property="og:url" content="https://protesian.host"/>
    <meta property="og:site_name" content="ProtesiaN Host"/>
    <meta property="og:image" content="{{ asset('images/preview.png') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
        if (prefersDarkScheme.matches && !window.localStorage.getItem('dark') && "<?php echo $themeClass; ?>" == "") {
            document.querySelector("html").classList.add("dark");
        }
    </script>

    <script defer src="{{ asset('js/app.js') }}" defer></script>

    @if (config('SETTINGS::RECAPTCHA:ENABLED') == 'true')
        {!! htmlScriptTagJsApi() !!}
    @endif
</head>

<body>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();
    for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
    k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(95399310, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/95399310" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900 dark:text-gray-300 text-gray-700">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.1/dist/sweetalert2.all.min.js"></script>
    <script>
        @if (Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: "{{ Session::get('error') }}",
            })
        @endif

        @if (Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: "{{ Session::get('success') }}",
                position: 'top-end',
                showConfirmButton: false,
                background: '#343a40',
                toast: true,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        @endif
    </script>

</body>

</html>
