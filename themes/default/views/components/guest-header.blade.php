@props(['active' => ''])

<header class="flex justify-between items-center sticky z-10 mt-5" style="padding-left: 1.25rem; padding-right: 1.25rem">
    <a href="{{ route('welcome') }}" class="flex items-center">
        <img src="/images/cube.png" alt="" class="h-10 w-10 mr-1">
        <div class="whitespace-nowrap"><span class="text-2xl font-bold">Protes<span class="cyan-dot cyan-dot-small"><i>i</i></span>aN</span></div>
    </a>

    <div class="flex space-x-5">
        <div class="mt-auto mb-auto">
            <button class="mt-2" onclick="toggleDropdown()">
                <svg class="w-7 h-7" fill="#00abbf" viewBox="0 0 48 48">
                    <path d="M0 0h48v48h-48z" fill="none" />
                    <path
                        d="M23.99 4c-11.05 0-19.99 8.95-19.99 20s8.94 20 19.99 20c11.05 0 20.01-8.95 20.01-20s-8.96-20-20.01-20zm13.85 12h-5.9c-.65-2.5-1.56-4.9-2.76-7.12 3.68 1.26 6.74 3.81 8.66 7.12zm-13.84-7.93c1.67 2.4 2.97 5.07 3.82 7.93h-7.64c.85-2.86 2.15-5.53 3.82-7.93zm-15.48 19.93c-.33-1.28-.52-2.62-.52-4s.19-2.72.52-4h6.75c-.16 1.31-.27 2.64-.27 4 0 1.36.11 2.69.28 4h-6.76zm1.63 4h5.9c.65 2.5 1.56 4.9 2.76 7.13-3.68-1.26-6.74-3.82-8.66-7.13zm5.9-16h-5.9c1.92-3.31 4.98-5.87 8.66-7.13-1.2 2.23-2.11 4.63-2.76 7.13zm7.95 23.93c-1.66-2.4-2.96-5.07-3.82-7.93h7.64c-.86 2.86-2.16 5.53-3.82 7.93zm4.68-11.93h-9.36c-.19-1.31-.32-2.64-.32-4 0-1.36.13-2.69.32-4h9.36c.19 1.31.32 2.64.32 4 0 1.36-.13 2.69-.32 4zm.51 11.12c1.2-2.23 2.11-4.62 2.76-7.12h5.9c-1.93 3.31-4.99 5.86-8.66 7.12zm3.53-11.12c.16-1.31.28-2.64.28-4 0-1.36-.11-2.69-.28-4h6.75c.33 1.28.53 2.62.53 4s-.19 2.72-.53 4h-6.75z" />
                </svg>
            </button>
            <ul class="absolute w-80 max-h-96 overflow-y-auto p-2 mt-2 space-y-2 hidden" id="dropdown">
                <form method="post" action="{{ route('changeLocale') }}" class="nav-item text-center">
                    @csrf
                    @foreach (explode(',', config('SETTINGS::LOCALE:AVAILABLE')) as $key)
                        <li class="flex">
                            <button
                                class="dark:hover:bg-gray-800 dark:hover:text-gray-200 duration-150 font-semibold hover:bg-gray-100 hover:text-gray-800 inline-flex justify-between px-2 py-1 rounded-md text-sm transition-colors w-full"
                                name="inputLocale" value="{{ $key }}">
                                {{ __($key) }}
                            </button>
                        </li>
                    @endforeach
                </form>
            </ul>
        </div>
        @if($active == "home")
            <a href="{{ route('welcome') }}" class="hidden sm:inline-block button-40 linestyle text-base font-semibold">{{ __('Home') }}</a>
            <a href="{{ route('home') }}" class="hidden sm:inline-block button-40 text-base font-semibold">{{ __('Dashboard') }}</a>
        @elseif($active == "dashboard")
            <a href="{{ route('welcome') }}" class="hidden sm:inline-block button-40 text-base font-semibold">{{ __('Home') }}</a>
            <a href="{{ route('home') }}" class="hidden sm:inline-block button-40 linestyle text-base font-semibold">{{ __('Dashboard') }}</a>
        @else
            <a href="{{ route('welcome') }}" class="hidden sm:inline-block button-40 text-base font-semibold">{{ __('Home') }}</a>
            <a href="{{ route('home') }}" class="hidden sm:inline-block button-40 text-base font-semibold">{{ __('Dashboard') }}</a>
        @endif

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
