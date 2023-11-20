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
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/swiper-bundle.min.css') }}?v7">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/style.css') }}?v7">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/slider.css') }}?v7">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/progressLine.css') }}?v7">
    <link rel="stylesheet" href="{{ asset('themes/ProtesiaN/main.css') }}?v7">
    <title>{{ __(config('SETTINGS::SYSTEM:SEO_TITLE')) }}</title>
</head>

<body style="overflow: hidden">

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
    <x-guest-header active="home"></x-guest-header>
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
                    <x-nodes-monitoring width="w-full" :nodes=$nodes></x-nodes-monitoring>
                </article>
            </section>

            <section class="page-slide swiper-slide flex justify-center items-center">

                <article class="hidden lg:flex lg:flex-col lg:h-full lg:w-6/12 lg:justify-center node-status text-lg font-semibold">
                    <x-nodes-monitoring width="w-10/12" :nodes=$nodes></x-nodes-monitoring>
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

                <article class="">
                    <div class="price-content flex flex-col items-center justify-center">
                        <h3 class="text-xl font-bold lg:text-3xl" style="text-transform: uppercase">{{ __('Tariff line') }}</h3>
                        <div class="prices-swiper swiper">

                            <x-tariff-line multiplier="{{ $multiplier }}" :products=$products></x-tariff-line>

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
