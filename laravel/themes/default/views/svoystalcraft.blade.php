<!DOCTYPE html>
<html lang={{ App::getLocale() }}>

<head>
    <meta charset="UTF-8">
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="profile">
    <meta property="og:title" content="{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}"/>
    <meta property="og:description" content="{{ __(config('SETTINGS::SYSTEM:SEO_DESCRIPTION')) }}"/>
    <meta property="og:url" content="https://protesian.host"/>
    <meta property="og:site_name" content="ProtesiaN Host"/>
    <meta property="og:image" content="{{ asset('images/preview.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/styleDmitron.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/main.css') }}?v8">
    <script src="https://kit.fontawesome.com/523a8fe7f9.js" crossorigin="anonymous"></script>
    <title>{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}</title>
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

    <style>
        body {
            background-image: url("{{ asset('images/main-bg.png') }}");
            background-size: cover;
        }

        main {
            height: 90dvh;
            width: 100%;
        }

        li {
            list-style-type: disc;
            list-style-position: inside;
        }

        li::marker {
            content: "->";
            color: #07baca;
        }

        .server-card {
            margin: auto;
            width: 360px;
            backdrop-filter: blur(10px);
            padding: 20px;
            border-color: #1b98a3;
            border-width: 2px;
            border-radius: 15px;
        }

        ul>li>a:hover {
            text-decoration: underline;
            cursor: pointer;
        }
        #ssc-ip {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        #ssc-ip:hover {
            text-decoration: underline;
        }
    </style>
    <div class="p-1 text-white my-cont">
        <header class="sticky z-10 flex items-center justify-between mt-5">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <img src="{{ asset('images/cube.png') }}" alt="" class="w-10 h-10 mr-1">
                <div class="whitespace-nowrap"><span class="text-2xl font-bold">Protes<span class="cyan-dot cyan-dot-small"><i>i</i></span>aN</span></div>
            </a>

            <div class="flex space-x-5">
                <a href="{{ route('welcome') }}" class="hidden text-base font-semibold sm:inline-block button-40">Главная</a>
                <a href="{{ route('home') }}" class="hidden text-base font-semibold sm:inline-block button-40">Панель управления</a>

                <a href="https://discord.gg/ay76Et2dBh" class="mt-auto mb-auto">
                        <svg class="w-10 h-10" viewBox="0 -28.5 256 256" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" fill=""
                        style="--darkreader-inline-fill: #0595a2; --darkreader-inline-stroke: #40eaf9;" stroke="">

                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M216.856339,16.5966031 C200.285002,8.84328665 182.566144,3.2084988 164.041564,0 C161.766523,4.11318106 159.108624,9.64549908 157.276099,14.0464379 C137.583995,11.0849896 118.072967,11.0849896 98.7430163,14.0464379 C96.9108417,9.64549908 94.1925838,4.11318106 91.8971895,0 C73.3526068,3.2084988 55.6133949,8.86399117 39.0420583,16.6376612 C5.61752293,67.146514 -3.4433191,116.400813 1.08711069,164.955721 C23.2560196,181.510915 44.7403634,191.567697 65.8621325,198.148576 C71.0772151,190.971126 75.7283628,183.341335 79.7352139,175.300261 C72.104019,172.400575 64.7949724,168.822202 57.8887866,164.667963 C59.7209612,163.310589 61.5131304,161.891452 63.2445898,160.431257 C105.36741,180.133187 151.134928,180.133187 192.754523,160.431257 C194.506336,161.891452 196.298154,163.310589 198.110326,164.667963 C191.183787,168.842556 183.854737,172.420929 176.223542,175.320965 C180.230393,183.341335 184.861538,190.991831 190.096624,198.16893 C211.238746,191.588051 232.743023,181.531619 254.911949,164.955721 C260.227747,108.668201 245.831087,59.8662432 216.856339,16.5966031 Z M85.4738752,135.09489 C72.8290281,135.09489 62.4592217,123.290155 62.4592217,108.914901 C62.4592217,94.5396472 72.607595,82.7145587 85.4738752,82.7145587 C98.3405064,82.7145587 108.709962,94.5189427 108.488529,108.914901 C108.508531,123.290155 98.3405064,135.09489 85.4738752,135.09489 Z M170.525237,135.09489 C157.88039,135.09489 147.510584,123.290155 147.510584,108.914901 C147.510584,94.5396472 157.658606,82.7145587 170.525237,82.7145587 C183.391518,82.7145587 193.761324,94.5189427 193.539891,108.914901 C193.539891,123.290155 183.391518,135.09489 170.525237,135.09489 Z"
                                    fill="#07baca" fill-rule="nonzero" style="--darkreader-inline-fill: #0595a2;"
                                    data-darkreader-inline-fill=""> </path>
                            </g>
                        </g>
                    </svg></a>
            </div>
        </header>
        <main class="flex items-center justify-center">
            <div class="server-card">
                <h1 class="text-3xl font-bold text-center">Свой Stalcraft</h1>
                <div class="">
                    <h2 class="mt-5 text-xl font-bold">Инструкция по установке:</h2>
                    <ul class="font-semibold">
                        <li>Рекомендуем этот <a target="blank" class="text-purple-500" href="https://llaun.ch/">лаунчер</a></li>
                        <li>Скачать Minecraft 1.16.5</li>
                        <li>Установить Forge не ниже 32.2.34</li>
                        <li>Файлы из скачанного архива переместить в папку mods, в корневой папке Майнкрафта</li>
                        <li>Играть!</li>
                    </ul>
                </div>
                <h2 class="hidden mt-5 mb-5 font-semibold text-center">Статус сервера:<br><span class="text-red-600">оффлайн</span></h2>
                <h2 class="mt-5 mb-5 font-semibold text-center ">Статус сервера:<br><span class="text-green-600">онлайн</span></h2>
                <h2 class="mt-5 mb-5 font-semibold text-center">IP:<br><span id="ssc-ip" class="text-purple-500" onclick="copyIP()" onmouseout="outFunc()">svoystalcraft.protesian.host</span>   <i class="fa-regular fa-clipboard"></i></h2>
                <div class="flex justify-around">
                    <a target="_self" href="{{ route('download', ['filename' => 'mods.zip']) }}" class="text-base font-semibold sm:inline-block button-40">Сборка</a>
                    <a target="blank" href="https://discord.gg/myht7sxQ" class="text-base font-semibold sm:inline-block button-40">Дискорд</a>
                </div>
            </div>
        </main>
    </div>
    <script>
        function copyIP() {
            navigator.clipboard.writeText(document.querySelector("#ssc-ip").innerText)
        }
    </script>
</body>

</html>
