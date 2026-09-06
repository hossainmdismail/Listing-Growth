@php
    $seo = app(\App\Support\SeoMetadata::class)->resolve(trim($__env->yieldContent('seo_key')), [
        'title' => trim($__env->yieldContent('title', '')),
        'description' => trim($__env->yieldContent('description', '')),
        'og_title' => trim($__env->yieldContent('og_title', '')),
        'og_description' => trim($__env->yieldContent('og_description', '')),
        'og_image' => trim($__env->yieldContent('og_image', '')),
        'twitter_title' => trim($__env->yieldContent('twitter_title', '')),
        'twitter_description' => trim($__env->yieldContent('twitter_description', '')),
        'twitter_image' => trim($__env->yieldContent('twitter_image', '')),
    ]);
    $marketing = app(\App\Support\MarketingData::class)->resolve();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seo['title'] }}</title>
    <meta name="description" content="{{ $seo['description'] }}">
    <meta name="robots" content="{{ $seo['robots'] }}">
    <link rel="canonical" href="{{ $seo['canonical_url'] }}">
    <meta property="og:title" content="{{ $seo['og_title'] }}">
    <meta property="og:description" content="{{ $seo['og_description'] }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $seo['canonical_url'] }}">
    <meta property="og:site_name" content="{{ $seo['site_name'] }}">
    @if ($seo['og_image'])
        <meta property="og:image" content="{{ $seo['og_image'] }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['twitter_title'] }}">
    <meta name="twitter:description" content="{{ $seo['twitter_description'] }}">
    @if ($seo['twitter_image'])
        <meta name="twitter:image" content="{{ $seo['twitter_image'] }}">
    @endif
    @if ($marketing['google_search_console_verification'])
        <meta name="google-site-verification" content="{{ $marketing['google_search_console_verification'] }}">
    @endif
    @if ($marketing['bing_webmaster_verification'])
        <meta name="msvalidate.01" content="{{ $marketing['bing_webmaster_verification'] }}">
    @endif
    @if ($marketing['meta_domain_verification'])
        <meta name="facebook-domain-verification" content="{{ $marketing['meta_domain_verification'] }}">
    @endif
    @if ($seo['favicon_url'])
        <link rel="icon" href="{{ $seo['favicon_url'] }}">
    @endif
    <script type="application/ld+json">{!! json_encode($seo['schema_json'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Centralized CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    @if ($marketing['gtm_enabled'])
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $marketing['gtm_container_id'] }}');
        </script>
    @endif

    @if ($marketing['ga4_enabled'])
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $marketing['ga4_measurement_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $marketing['ga4_measurement_id'] }}');
        </script>
    @endif

    @if ($marketing['meta_pixel_enabled'])
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}
            (window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $marketing['meta_pixel_id'] }}');fbq('track', 'PageView');
        </script>
    @endif

    @if ($marketing['tiktok_pixel_enabled'])
        <script>
            !function (w, d, t) {w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];
            ttq.methods=['page','track','identify','instances','debug','on','off','once','ready','alias','group','enableCookie','disableCookie'];
            ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};
            for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);
            ttq.load=function(e){var n=document.createElement('script');n.type='text/javascript';n.async=!0;
            n.src='https://analytics.tiktok.com/i18n/pixel/events.js?sdkid='+e+'&lib='+t;
            document.getElementsByTagName('script')[0].parentNode.insertBefore(n,document.getElementsByTagName('script')[0]);};
            ttq.load('{{ $marketing['tiktok_pixel_id'] }}');ttq.page();}(window, document, 'ttq');
        </script>
    @endif

    @if ($marketing['custom_head_scripts'])
        {!! $marketing['custom_head_scripts'] !!}
    @endif
</head>

<body>
    @if ($marketing['gtm_enabled'])
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $marketing['gtm_container_id'] }}"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @if ($marketing['custom_body_start_scripts'])
        {!! $marketing['custom_body_start_scripts'] !!}
    @endif

    @include('frontend.layout.header')

    @yield('content')
    <!-- Footer -->
    @include('frontend.layout.footer')

    <!-- Centralized JS -->
    <script src="{{ asset('frontend/js/main.js') }}?v={{ filemtime(public_path('frontend/js/main.js')) }}"></script>

    @if ($marketing['custom_body_end_scripts'])
        {!! $marketing['custom_body_end_scripts'] !!}
    @endif
</body>

</html>
