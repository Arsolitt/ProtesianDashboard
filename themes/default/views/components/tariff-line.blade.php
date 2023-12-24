@props(['products', 'multiplier'])


<div class="prices-wrapper swiper-wrapper">
    <div class="price-slide swiper-slide">
        <div class="price-card">
            <span class="card-header card-summ">SOFTWARE 1<br>BUILD</span>
            <div class="card-spec">
                <div class="spec-header">CPU</div>
                <div class="spec-count" style="font-size: 20px">2 vCore</div>
                <div class="spec-header">RAM</div>
                <div class="spec-count" style="font-size: 20px">2 Gb</div>
                <div class="spec-header">SSD</div>
                <div class="spec-count" style="font-size: 20px">20 Gb</div>
            </div>
            <div class="card-summ"><span>{{ 50 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
        </div>
    </div>
    <div class="price-slide swiper-slide">
        <div class="price-card">
            <span class="card-header card-summ">SOFTWARE 2<br>BUILD</span>
            <div class="card-spec">
                <div class="spec-header">CPU</div>
                <div class="spec-count" style="font-size: 20px">4 vCore</div>
                <div class="spec-header">RAM</div>
                <div class="spec-count" style="font-size: 20px">4 Gb</div>
                <div class="spec-header">SSD</div>
                <div class="spec-count" style="font-size: 20px">40 Gb</div>
            </div>
            <div class="card-summ"><span>{{ 100 / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
        </div>
    </div>
    @if($products != null)
    @foreach($products as $product)
    <div class="price-slide swiper-slide">
        <div class="price-card">
            <span class="card-header card-summ">{{ $product["name"] }}<br>BUILD</span>
            <div class="card-spec">
                <div class="spec-header">CPU</div>
                <div class="spec-count" style="font-size: 20px">∞</div>
                <div class="spec-header">RAM</div>
                <div class="spec-count">{{ $product["memory"] / 1024 }} Gb</div>
                <div class="spec-header">SSD</div>
                <div class="spec-count">{{ $product["disk"] / 1024 }} Gb</div>
            </div>
            <div class="card-summ"><span>{{ intval($product["price"]) / $multiplier }}</span> <span class="spec-header">{{ __('EUR') }}</span></div>
        </div>
    </div>
    @endforeach
    @endif
        <div class="price-slide swiper-slide">
            <div class="price-card">
                <span class="card-header card-summ">CUSTOM<br>BUILD</span>
                <div class="card-spec">
                    <div class="spec-header">CPU</div>
                    <div class="spec-count" style="font-size: 20px">∞</div>
                    <div class="spec-header">RAM</div>
                    <div class="spec-count" style="font-size: 20px">∞</div>
                    <div class="spec-header">SSD</div>
                    <div class="spec-count" style="font-size: 20px">∞</div>
                </div>
                <div class="card-summ"><span>???</span> <span class="spec-header">{{ __('EUR') }}</span></div>
            </div>
        </div>
{{--    <div class="price-slide swiper-slide">
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
        </div>--}}
</div>
