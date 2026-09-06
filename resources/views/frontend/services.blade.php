@extends('frontend.layout.app')

@section('seo_key', 'services')
@section('title', 'Amazon Growth Services | ListingGrowth')
@section('description', 'Explore ListingGrowth services for Amazon ranking, shopper feedback, keyword research, external traffic, and conversion optimization.')

@section('content')
    <section class="page-hero">
        <div class="wrap" data-reveal>
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span>/</span> <span>Services</span></div>
            <span class="eyebrow">Our Services</span>
            <h1>A complete organic growth system for Amazon</h1>
            <p class="lead">From keyword strategy to real shopper feedback, every service works together to help your products rank higher and sell more.</p>
        </div>
    </section>

    @if ($services->isNotEmpty())
        <section>
            <div class="wrap">
                <div class="services-grid">
                    @foreach ($services as $service)
                        <article class="service-card" data-reveal>
                            <div class="service-icon">
                                <img src="{{ $service->icon_url }}" alt="" loading="lazy">
                            </div>
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->short_description }}</p>
                            <a href="{{ \Illuminate\Support\Str::sanitizeUrl($service->button_url) ?? route('contact') }}"
                                class="service-link">
                                {{ $service->button_label ?: 'Explore this service' }} →
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($processSection && $processItems->isNotEmpty())
        <section id="process" style="background:var(--paper-2);">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $processSection->label }}</span>
                    <h2>{{ $processSection->title }}</h2>
                    @if (filled($processSection->description))
                        <p>{{ $processSection->description }}</p>
                    @endif
                </div>
                <div class="process-line" data-reveal>
                    @foreach ($processItems as $processItem)
                        <div class="process-step">
                            <span class="process-num">{{ $processItem->label_number }}</span>
                            <h3>{{ $processItem->title }}</h3>
                            <p>{{ $processItem->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($finalCtaSection)
        <section class="final-cta">
            <div class="wrap" data-reveal>
                <span class="eyebrow" style="color:var(--signal)">{{ $finalCtaSection->label }}</span>
                <h2>{{ $finalCtaSection->title }}</h2>
                <p>{{ $finalCtaSection->description }}</p>
                <div class="hero-ctas">
                    <a href="{{ \Illuminate\Support\Str::sanitizeUrl($finalCtaSection->primary_button_url) ?? '#' }}"
                        class="btn btn-primary">{{ $finalCtaSection->primary_button_text }}</a>
                    <a href="{{ \Illuminate\Support\Str::sanitizeUrl($finalCtaSection->secondary_button_url) ?? '#' }}"
                        class="btn btn-ghost">{{ $finalCtaSection->secondary_button_text }}</a>
                </div>
            </div>
        </section>
    @endif
@endsection
