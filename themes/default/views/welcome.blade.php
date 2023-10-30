<!DOCTYPE html>
<html lang={{ App::getLocale() }}>

<head>
    <meta charset="UTF-8">
    <meta property="og:title" content="{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}"/>
    <meta property="og:description" content="{{ __(config('SETTINGS::SYSTEM:SEO_DESCRIPTION')) }}"/>
    <meta property="og:url" content="https://protesian.host"/>
    <meta property="og:site_name" content="ProtesiaN Host"/>
    <meta property="og:image" content="{{ asset('images/preview.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/swiper-bundle.min.css') }}?v6">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/style.css') }}?v6">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/slider.css') }}?v8">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/progressLine.css') }}?v6">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/main.css') }}?v6">
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

<div class="my-cont text-white p-1">
    <header class="flex justify-between items-center sticky z-10 mt-5">
        <a href="{{ route('welcome') }}" class="flex items-center">
            <img src="/images/cube.png" alt="" class="h-10 w-10 mr-1">
            <div class="whitespace-nowrap"><span class="text-2xl font-bold">Protes<span class="cyan-dot cyan-dot-small"><i>i</i></span>aN</span></div>
        </a>

        <div class="flex space-x-5">
            <a href="{{ route('welcome') }}" class="hidden sm:inline-block button-40 linestyle text-base font-semibold">{{ __('Home') }}</a>
            <a href="{{ route('home') }}" class="hidden sm:inline-block button-40 text-base font-semibold">{{ __('Dashboard') }}</a>

            <a href="https://discord.gg/ay76Et2dBh" class="mt-auto mb-auto">
                <svg class="h-10 w-10" viewBox="0 -28.5 256 256" version="1.1" xmlns="http://www.w3.org/2000/svg"
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

    <main class="page-swiper swiper-container">
        <div id="particles-js" class="parallax-bg -z-10 absolute top-0 left-0 bg-cover" data-swiper-parallax=" -20%"></div>
        <div class="page-wrapper w-8/12 ml-auto mr-auto swiper-wrapper">

            <section class="mt-auto mb-auto flex justify-center items-center page-slide swiper-slide">
                <article class="flex flex-col items-center">
                    <h1 class="mb-10 text-5xl lg:text-7xl font-bold whitespace-nowrap" data-swiper-parallax="-300">Protes<span class="cyan-dot cyan-dot-large"><i>i</i></span>aN</h1>
                    <h2 class="text-center text-3xl lg:text-4xl font-semibold mb-10" data-swiper-parallax="-200">
                        {{ __('Game server hosting with') }} <span class="font-bold" style="font-style: italic; color: #07baca; text-transform: uppercase;">{{ __('unlimited') }}</span> {{ __('CPU resources') }}</h2>

                    <a href="{{ route('home') }}" class="sm:hidden button-40 text-base font-semibold">{{ __('Dashboard') }}</a>
                </article>

            </section>

            <section class="lg:hidden flex flex-col justify-center items-center page-slide swiper-slide">
                <article class="node-status text-lg font-semibold w-10/12">
                    <h3 class="text-xl font-bold mb-3">{{ __('Nodes monitoring') }}</h3>
                    <div class="node flex flex-col mb-3 w-full">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 61%"></span>
                        </div>
                        <span class="text-base">FIN-1 i9 9900k</span>
                    </div>
                    <div class="node flex flex-col mb-3 w-full">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 0%"></span>
                        </div>
                        <span class="text-base">FIN-2 R7 5800x</span>
                    </div>
                    <div class="node flex flex-col mb-3 w-full">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 100%"></span>
                        </div>
                        <span class="text-base">SPB-1 i5 12500</span>
                    </div>
                    <div class="node flex flex-col mb-3 w-full">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 100%"></span>
                        </div>
                        <span class="text-base">SPB-2 i5 12500</span>
                    </div>
                </article>
            </section>

            <section class="page-slide swiper-slide flex justify-center items-center">

                <article class="hidden lg:flex lg:flex-col lg:h-full lg:w-6/12 lg:justify-center node-status text-lg font-semibold">
                    <h3 class="font-bold lg:text-3xl mb-3" style="text-transform: uppercase">{{ __('Nodes monitoring') }}</h3>
                    <div class="node flex flex-col mb-3 w-10/12">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 61%"></span>
                        </div>
                        <span class="text-base">FIN-1 i9 9900k</span>
                    </div>
                    <div class="node flex flex-col mb-3 w-10/12">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 0%"></span>
                        </div>
                        <span class="text-base">FIN-2 R7 5800x</span>
                    </div>
                    <div class="node flex flex-col mb-3 w-10/12">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 100%"></span>
                        </div>
                        <span class="text-base">SPB-1 i5 12500</span>
                    </div>
                    <div class="node flex flex-col mb-3 w-10/12">
                        <div class="outer-bar-horizontal w-full">
                            <span class="inner-bar-horizontal" style="width: 100%"></span>
                        </div>
                        <span class="text-base">SPB-2 i5 12500</span>
                    </div>
                </article>

                <article id="tabs" class="flex flex-col lg:h-full lg:w-6/12 items-center h-3/5 justify-center tabs-container">

                    <div class="tab-wrapper">
                        <div id="tabcontent1" data-tab="1" class="tabcontent">
                            <h3 class="text-xl font-bold lg:text-3xl" style="text-transform: uppercase">{{ __('Advantages') }}</h3>
                            <p class="lg:text-2xl">{{ __('One of the key features of ProtesiaN hosting is unlimited CPU. This means that users are not limited in the use of CPU resources and can run and maintain their game servers as efficiently as possible') }}.</p>
                        </div>
                        <div id="tabcontent2" data-tab="2" class="tabcontent">
                            <h3 class="text-xl font-bold lg:text-3xl" style="text-transform: uppercase">{{ __('Support') }}</h3>
                            <p class="lg:text-2xl">{{ __('ProtesiaN technical support team is always ready to help users in case of any problems. Experienced specialists promptly respond to inquiries on any technical problems, as well as provide advice to optimize the servers, which allows users to fully focus on the gameplay process') }}.</p>
                        </div>
                    </div>

                    <div class="tabs flex justify-around mt-3 items-center w-full">
                        <a id="tab1" data-tab="1"
                           class="lg:text-lg cursor-pointer text-gray-700 font-extrabold text-sm tab select-none" style="text-transform: uppercase">{{ __('Advantages') }}</a>
                        <a id="tab2" data-tab="2"
                           class="lg:text-lg cursor-pointer text-gray-700 font-extrabold text-sm tab select-none" style="text-transform: uppercase">{{ __('Support') }}</a>
                    </div>
                </article>

            </section>

            <section class="flex justify-center items-center page-slide swiper-slide">

                @php
                    if (App::isLocale('ru')) {
                        $multiplier = 1;
                    } else {
                        $multiplier = 100;
                    }
                @endphp

                <article class="">
                    <div class="price-content flex flex-col items-center justify-center">
                        <h3 class="text-xl font-bold lg:text-3xl" style="text-transform: uppercase">{{ __('Tariff line') }}</h3>
                        <div class="prices-swiper swiper">
                            <div class="prices-wrapper swiper-wrapper">
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">STARTER<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">1 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">10 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-1</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 75 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">VANILLA<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 30%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">2 Gb</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 15%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 27%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">20 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-2</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 22.5%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 149 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">VANILLA+<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 30%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">4 Gb</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 30%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 27%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">40 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-2</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 22.5%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 299 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">STANDARD<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 45%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">6 Gb</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 45%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 36%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">60 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-2</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 22.5%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 449 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">MEDIUM<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 60%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">8 Gb</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 60%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 45%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">80 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-2</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 22.5%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 599 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">MEDIUM+<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 75%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">10 Gb</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 75%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 54%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">100 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-2</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 45%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 749 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">PREMIUM<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 90%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">∞</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">12 Gb</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 90%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 63%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">120 Gb</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">0-2</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 45%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>{{ 899 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                                <div class="price-slide swiper-slide">
                                    <div class="price-card">
                                        <span class="card-header card-summ">CUSTOM<br>BUILD</span>
                                        <table class="specs-table">
                                            <tr>
                                                <td>
                                                    <div class="spec-cpu spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 100%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">CPU</span>
                                                            <span class="spec-count">UNLIMIT</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-ram spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">RAM</span>
                                                            <span class="spec-count">UNLIMIT</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 100%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="spec-ssd spec-block">
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 100%"></span>
                                                        </div>
                                                        <div class="spec-desc">
                                                            <span class="spec-header">SSD</span>
                                                            <span class="spec-count">UNLIMIT</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="spec-db spec-block">
                                                        <div class="spec-desc">
                                                            <span class="spec-header">BACKUP</span>
                                                            <span class="spec-count">UNLIMIT</span>
                                                        </div>
                                                        <div class="spec-bar outer-bar-vertical">
                                                            <span class="inner-bar-vertical" style="height: 101%"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="card-summ"><span>???</span> <span class="spec-header">{{ __('EUR') }}</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        <div class="mt-10">
                            <a href="{{ route('home') }}" class="button-40 sm:text-2xl mbtn mbtn-cyan font-bold">{{ __('Details') }}</a>
                        </div>
                    </div>
                </article>
            </section>

        </div>
        <div class="flex flex-col items-center w-5 page-pagination swiper-pagination"></div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script src={{ asset('themes/ProtesiaN/particles.js') }}></script>
<script src={{ asset('themes/ProtesiaN/swiper-bundle.min.js') }}></script>
<script src={{ asset('themes/ProtesiaN/main.js') }}></script>
</body>

</html>
