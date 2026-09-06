@extends('frontend.layout.app')

@section('seo_key', 'about')
@section('title', 'About Us | ListingGrowth')
@section('description', 'Learn how ListingGrowth helps Amazon sellers build durable organic rankings through search strategy and real shopper feedback.')

@section('content')
    <section class="page-hero">
        <div class="wrap" data-reveal>
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span>/</span> <span>About</span></div>
            <span class="eyebrow">About ListingGrowth</span>
            <h1>Sellers shouldn't have to bleed margin into ads just to be seen.</h1>
            <p class="lead">We started ListingGrowth to prove there's a better way to rank on Amazon — one built on real shopper behavior and search strategy, not an ever-growing ad budget.</p>
        </div>
    </section>

    @if ($trustStatistics->isNotEmpty())
        <div class="trust-strip">
            <div class="wrap">
                <span class="trust-label">A decade of Amazon growth, in numbers</span>
                <div class="trust-stats">
                    @foreach ($trustStatistics as $trustStatistic)
                        <div class="trust-stat">
                            <b>{{ $trustStatistic->field_value }}</b>
                            <span>{{ $trustStatistic->field_name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <section>
        <div class="wrap split">
            <div data-reveal>
                <span class="eyebrow">Our Story</span>
                <h2 class="about-story-title">Built by people who've sat on both sides of the listing</h2>
                <p class="about-story-copy">We've worked inside sourcing, supply chain, and seller operations — and watched the same thing happen over and over: strong products buried on page 5, while ad spend quietly ate the margin that should've gone to the business.</p>
                <p class="about-story-copy">ListingGrowth exists to fix that. We combine real search strategy with real shopper feedback, so ranking is earned — and durable — rather than rented one click at a time.</p>
                <div class="stat-inline-grid">
                    <div class="stat-inline"><b>90%</b><span>Avg. BSR lift</span></div>
                    <div class="stat-inline"><b>28 days</b><span>Avg. time to Page 1</span></div>
                    <div class="stat-inline"><b>4.9/5</b><span>Client rating</span></div>
                </div>
            </div>
            <div class="media-block" data-reveal>
                <div class="rank-card-mini">
                    <div class="about-mission-label">Est. mission</div>
                    <div class="about-mission-copy">Help 5,000 sellers reach Page 1 organically by 2028.</div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-values">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">What We Believe</span>
                <h2>The principles behind every ranking strategy</h2>
            </div>
            <div class="values-grid">
                <div class="value-card" data-reveal>
                    <div class="num">Compliant</div>
                    <h3>Rank the right way</h3>
                    <p>Every tactic we use is fully compliant with Amazon's Terms of Service. No manipulated reviews, no shortcuts that put an account at risk.</p>
                </div>
                <div class="value-card" data-reveal>
                    <div class="num">Evidence-led</div>
                    <h3>Feedback over guesswork</h3>
                    <p>Real shoppers test the listing, the packaging, and the product itself — decisions get made on evidence, not assumptions.</p>
                </div>
                <div class="value-card" data-reveal>
                    <div class="num">Durable</div>
                    <h3>Built to last past launch</h3>
                    <p>We optimize for rank that survives after the campaign ends — not a temporary spike that disappears the moment spend stops.</p>
                </div>
            </div>
        </div>
    </section>

    @if ($testimonialSection && $testimonials->isNotEmpty())
        <section>
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $testimonialSection->label }}</span>
                    <h2>{{ $testimonialSection->title }}</h2>
                    @if (filled($testimonialSection->description))
                        <p>{{ $testimonialSection->description }}</p>
                    @endif
                </div>
                <div class="testi-grid">
                    @foreach ($testimonials as $testimonial)
                        <div class="testi-card" data-reveal>
                            <div class="testi-mark">&quot;</div>
                            <p class="quote">{{ $testimonial->feedback }}</p>
                            <div class="testi-person">
                                @if ($testimonial->profile_url)
                                    <img class="testi-avatar" src="{{ $testimonial->profile_url }}"
                                        alt="{{ $testimonial->name }}" loading="lazy">
                                @else
                                    <div class="testi-avatar">{{ $testimonial->initials }}</div>
                                @endif
                                <div>
                                    <b>{{ $testimonial->name }}</b>
                                    <span>{{ $testimonial->objective }}</span>
                                </div>
                            </div>
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
