
@extends('frontend.layout.app')

@section('seo_key', 'home')

@section('content')

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="wrap hero-grid">
            <div data-reveal>
                <span class="eyebrow">Organic Amazon Growth</span>
                <h1>Rank <em>#1</em> on Amazon —<br>without paying for ads</h1>
                <p class="lead">We move Amazon listings from buried to Page 1 using organic ranking strategy, real
                    shopper feedback, and targeted external traffic — visibility that sticks around after the ad budget
                    stops.</p>
                <div class="hero-ctas">
                    <a href="{{ route('contact') }}" class="btn btn-primary">Get My Free Amazon Audit →</a>
                    <a href="#process" class="btn btn-outline">See How It Works</a>
                </div>
                <div class="trust-line"><span class="stars">★★★★★</span> Rated 4.9/5 by Amazon sellers · 500+ brands
                    ranked</div>
                <div class="chip-row">
                    <div class="chip"><span class="up">▲</span> 90% avg. BSR increase</div>
                    <div class="chip"><span class="up">▲</span> $12M+ organic sales</div>
                    <div class="chip"><span class="up">▲</span> 30+ categories</div>
                </div>
            </div>

            <div data-reveal class="rank-card">
                <div class="rank-card-head">
                    <span>Keyword: "pool basketball hoop"</span>
                    <span class="rank-live"><span class="dot"></span> Live tracking</span>
                </div>
                <div class="rank-row">
                    <span class="rank-week">Week 1</span>
                    <div class="rank-bar-wrap">
                        <div class="rank-bar" style="width:18%"></div>
                    </div>
                    <span class="rank-pos">#47</span>
                </div>
                <div class="rank-row">
                    <span class="rank-week">Week 2</span>
                    <div class="rank-bar-wrap">
                        <div class="rank-bar" style="width:42%"></div>
                    </div>
                    <span class="rank-pos">#23</span>
                </div>
                <div class="rank-row">
                    <span class="rank-week">Week 3</span>
                    <div class="rank-bar-wrap">
                        <div class="rank-bar" style="width:78%"></div>
                    </div>
                    <span class="rank-pos">#8</span>
                </div>
                <div class="rank-row">
                    <span class="rank-week">Week 4</span>
                    <div class="rank-bar-wrap">
                        <div class="rank-bar" style="width:100%"></div>
                    </div>
                    <span class="rank-pos top">#1</span>
                </div>
                <div class="rank-footer">
                    <span class="rank-badge">PAGE 1 REACHED</span>
                    <span class="rank-note">28 days to top rank</span>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST STRIP -->
    <div class="trust-strip">
        <div class="wrap">
            <span class="trust-label">Trusted by Amazon sellers across 30+ categories</span>
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

    <!-- SERVICES SECTION -->
    <section id="services">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">Our Services</span>
                <h2>Everything you need to rank higher and sell more</h2>
                <p>A complete organic growth system — from keyword strategy to real customer feedback.</p>
            </div>
            <div class="services-grid">
                @foreach ($homeServices as $homeService)
                    <div class="service-card" data-reveal>
                        <div class="service-icon">
                            <img src="{{ $homeService->icon_url }}" alt="" loading="lazy">
                        </div>
                        <h3>{{ $homeService->title }}</h3>
                        <p>{{ $homeService->short_description }}</p>
                        <a href="{{ $homeService->button_url ?: '#' }}" class="service-link">
                            {{ $homeService->button_label }} →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- METHODOLOGY -->
    @if ($whyListingGrowthSection)
        <section style="background:var(--paper-2);">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $whyListingGrowthSection->section_label }}</span>
                    <h2>{{ $whyListingGrowthSection->title }}</h2>
                    <p>{{ $whyListingGrowthSection->description }}</p>
                </div>
                <div class="pillars">
                    @foreach ($whyListingGrowthItems as $whyListingGrowthItem)
                        <div class="pillar" data-reveal>
                            <span class="pillar-tag">{{ $whyListingGrowthItem->label }}</span>
                            <div>
                                <h3>{{ $whyListingGrowthItem->title }}</h3>
                                <p>{{ $whyListingGrowthItem->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- PROOF SECTION -->
    @if ($growthProofSection)
        <section class="proof">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $growthProofSection->label }}</span>
                    <h2>{{ $growthProofSection->title }}</h2>
                </div>
                <div class="feature-grid" data-reveal>
                    @foreach ($growthProofItems as $growthProofItem)
                        <div class="feature-cell">
                            <div class="num">{{ $growthProofItem->label }}</div>
                            <h3>{{ $growthProofItem->title }}</h3>
                            <p>{{ $growthProofItem->description }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="stat-grid" data-reveal>
                    @foreach ($growthProofStatistics as $growthProofStatistic)
                        <div class="stat-box">
                            <b>{{ $growthProofStatistic->value }}</b>
                            <span>{{ $growthProofStatistic->label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CATEGORIES -->
    @if ($categorySection)
        <section>
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $categorySection->label }}</span>
                    <h2>{{ $categorySection->title }}</h2>
                    <p>{{ $categorySection->description }}</p>
                </div>
                <div class="cat-cloud" data-reveal>
                    @foreach ($homeCategories as $homeCategory)
                        <span class="cat-pill">{{ $homeCategory->name }}</span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- TESTIMONIALS -->
    @if ($testimonialSection)
        <section style="background:var(--paper-2);">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $testimonialSection->label }}</span>
                    <h2>{{ $testimonialSection->title }}</h2>
                    @if ($testimonialSection->description)
                        <p>{{ $testimonialSection->description }}</p>
                    @endif
                </div>
                <div class="testi-grid">
                    @foreach ($testimonials as $testimonial)
                        <div class="testi-card" data-reveal>
                            <div class="testi-mark">"</div>
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

    @if ($caseStudies->isNotEmpty())
        <!-- CASE STUDIES -->
        <section id="cases">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">Case Study</span>
                    <h2>From page 5 to page 1</h2>
                </div>
                <div class="case-grid">
                    @foreach ($caseStudies as $caseStudy)
                        <article class="case-card" data-reveal>
                            <span class="eyebrow" style="color:var(--muted)">{{ $caseStudy->label }}</span>
                            <h3>{{ $caseStudy->subtitle }}</h3>
                            <div class="case-shift">
                                <span class="to">{{ $caseStudy->title }}</span>
                            </div>
                            <p>{{ $caseStudy->short_description }}</p>
                            @if (filled($caseStudy->content))
                                <div class="case-rich-text">{!! str($caseStudy->content)->sanitizeHtml() !!}</div>
                            @endif
                            @if (filled($caseStudy->statistics))
                                <div class="case-meta">
                                    @foreach ($caseStudy->statistics as $statistic)
                                        <div>
                                            <b>{{ $statistic['value'] ?? '' }}</b>
                                            <span>{{ $statistic['label'] ?? '' }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($processSection && $processItems->isNotEmpty())
        <!-- PROCESS -->
        <section id="process" style="background:var(--paper-2);">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $processSection->label }}</span>
                    <h2>{{ $processSection->title }}</h2>
                    <p>{{ $processSection->description }}</p>
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

    @if ($faqSection && $faqItems->isNotEmpty())
        <!-- FAQ -->
        <section id="faq">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">{{ $faqSection->label }}</span>
                    <h2>{{ $faqSection->title }}</h2>
                    @if (filled($faqSection->description))
                        <p>{{ $faqSection->description }}</p>
                    @endif
                </div>
                <div class="faq-list" data-reveal>
                    @foreach ($faqItems as $faqItem)
                        <details class="faq-item" @if ($loop->first) open @endif>
                            <summary>{{ $faqItem->question }}</summary>
                            <p>{{ $faqItem->answer }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($finalCtaSection)
        <!-- FINAL CTA -->
        <section class="final-cta">
            <div class="wrap">
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
