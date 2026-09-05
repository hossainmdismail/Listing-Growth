
@extends('frontend.layout.app')

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
                    <a href="contact.html" class="btn btn-primary">Get My Free Amazon Audit →</a>
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
                <div class="trust-stat"><b>500+</b><span>Brands scaled</span></div>
                <div class="trust-stat"><b>$12M+</b><span>Organic sales generated</span></div>
                <div class="trust-stat"><b>10+ yrs</b><span>Amazon growth experience</span></div>
                <div class="trust-stat"><b>4.9/5</b><span>Average client rating</span></div>
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

                <div class="service-card" data-reveal>
                    <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 17l6-6 4 4 8-8" />
                            <path d="M21 7v6h-6" />
                        </svg></div>
                    <h3>Ranking Optimization</h3>
                    <p>Full-funnel organic strategy — keyword research, external traffic, and listing improvements built
                        to push you up the results and keep you there.</p>
                    <a href="services.html" class="service-link">Learn more →</a>
                </div>

                <div class="service-card" data-reveal>
                    <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l2.4 6.6L21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4L12 2z" />
                        </svg></div>
                    <h3>Pre-Launch Lab</h3>
                    <p>Test your product with real shoppers before launch. Honest feedback on packaging, pricing, and
                        positioning — before it costs you sales.</p>
                    <a href="services.html" class="service-link">Learn more →</a>
                </div>

                <div class="service-card" data-reveal>
                    <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M21 21l-4.35-4.35" />
                        </svg></div>
                    <h3>Keyword & Competitor Research</h3>
                    <p>High-conversion, low-competition keywords, mapped directly against where your top competitors
                        stand today.</p>
                    <a href="services.html" class="service-link">Learn more →</a>
                </div>

                <div class="service-card" data-reveal>
                    <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19h16" />
                            <path d="M4 15l4-6 4 3 4-8 4 5" />
                        </svg></div>
                    <h3>External Traffic Campaigns</h3>
                    <p>Amazon rewards listings that pull traffic from outside the platform. We send targeted shoppers
                        using the exact keywords you want to own.</p>
                    <a href="services.html" class="service-link">Learn more →</a>
                </div>

                <div class="service-card" data-reveal>
                    <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="14" rx="2" />
                            <path d="M7 9h6M7 13h10" />
                        </svg></div>
                    <h3>Listing & Conversion Optimization</h3>
                    <p>Titles, images, A+ content — refined from real shopper behavior so more clicks turn into sales.
                    </p>
                    <a href="services.html" class="service-link">Learn more →</a>
                </div>

                <div class="service-card" data-reveal>
                    <div class="service-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
                        </svg></div>
                    <h3>1-on-1 Strategy Consultation</h3>
                    <p>Direct access to a growth strategist for a tailored roadmap — launch planning, pricing, or fixing
                        a ranking drop.</p>
                    <a href="contact.html" class="service-link">Book a call →</a>
                </div>

            </div>
        </div>
    </section>

    <!-- METHODOLOGY -->
    <section style="background:var(--paper-2);">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">Why ListingGrowth</span>
                <h2>Months to rank? Not with us.</h2>
                <p>We put your product on Page 1 — and build the system that keeps it there.</p>
            </div>
            <div class="pillars">
                <div class="pillar" data-reveal>
                    <span class="pillar-tag">Rank</span>
                    <div>
                        <h3>Rank #1 for your top keywords</h3>
                        <p>Organic rank builds lasting brand authority — it doesn't switch off the moment your ad budget
                            does.</p>
                    </div>
                </div>
                <div class="pillar" data-reveal>
                    <span class="pillar-tag">Compete</span>
                    <div>
                        <h3>Grow lean, beat bigger rivals</h3>
                        <p>Outrank competitors with deeper ad budgets using a cost-efficient method built on visibility,
                            not spend.</p>
                    </div>
                </div>
                <div class="pillar" data-reveal>
                    <span class="pillar-tag">Build</span>
                    <div>
                        <h3>Build products people actually want</h3>
                        <p>Pre- and post-launch testing gives real customer insight — shape product and listing around
                            what shoppers respond to.</p>
                    </div>
                </div>
                <div class="pillar" data-reveal>
                    <span class="pillar-tag">Price</span>
                    <div>
                        <h3>Nail your pricing strategy</h3>
                        <p>See your product through your customer's eyes and price competitively without leaving money
                            on the table.</p>
                    </div>
                </div>
                <div class="pillar" data-reveal>
                    <span class="pillar-tag">Protect</span>
                    <div>
                        <h3>Start with a strong reputation</h3>
                        <p>Catch issues before they become bad reviews — fewer returns, stronger long-term listing
                            health.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROOF SECTION -->
    <section class="proof">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">The Fastest Way to Grow</span>
                <h2>Built for profitable, lasting Amazon growth</h2>
            </div>
            <div class="feature-grid" data-reveal>
                <div class="feature-cell">
                    <div class="num">01</div>
                    <h3>Page 1 ranking, not page 5</h3>
                    <p>We boost your Best Seller Rank quickly while staying fully compliant with Amazon's Terms of
                        Service.</p>
                </div>
                <div class="feature-cell">
                    <div class="num">02</div>
                    <h3>More eyes, more sales</h3>
                    <p>We make your product genuinely discoverable so shoppers find you before they find your
                        competitors.</p>
                </div>
                <div class="feature-cell">
                    <div class="num">03</div>
                    <h3>A brand people trust</h3>
                    <p>People buy from brands they recognize. We help you build credibility that compounds over time.
                    </p>
                </div>
                <div class="feature-cell">
                    <div class="num">04</div>
                    <h3>Feedback from real shoppers</h3>
                    <p>Your target market audits the entire buying experience, from listing to unboxing.</p>
                </div>
            </div>
            <div class="stat-grid" data-reveal>
                <div class="stat-box"><b>90%</b><span>Avg. BSR improvement</span></div>
                <div class="stat-box"><b>10+</b><span>Years of experience</span></div>
                <div class="stat-box"><b>$1B+</b><span>Revenue for brand partners</span></div>
                <div class="stat-box"><b>30%</b><span>Avg. sales lift in 30 days</span></div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES -->
    <section>
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">Categories</span>
                <h2>Real results across every major category</h2>
                <p>From home goods to electronics, the ranking strategy adapts to your niche.</p>
            </div>
            <div class="cat-cloud" data-reveal>
                <span class="cat-pill">Home & Kitchen</span>
                <span class="cat-pill">Sports & Outdoors</span>
                <span class="cat-pill">Health & Household</span>
                <span class="cat-pill">Beauty & Personal Care</span>
                <span class="cat-pill">Toys & Games</span>
                <span class="cat-pill">Electronics</span>
                <span class="cat-pill">Pet Supplies</span>
                <span class="cat-pill">Baby Products</span>
                <span class="cat-pill">Tools & Home Improvement</span>
                <span class="cat-pill">Grocery & Gourmet</span>
                <span class="cat-pill">Office Products</span>
                <span class="cat-pill">Automotive</span>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section style="background:var(--paper-2);">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">Testimonials</span>
                <h2>Where Amazon success stories are born</h2>
            </div>
            <div class="testi-grid">
                <div class="testi-card" data-reveal>
                    <div class="testi-mark">"</div>
                    <p class="quote">Really thankful for the ListingGrowth team — one of the best organic ranking
                        partners we've worked with.</p>
                    <div class="testi-person">
                        <div class="testi-avatar">KK</div>
                        <div><b>Client Name</b><span>Brand Founder</span></div>
                    </div>
                </div>
                <div class="testi-card" data-reveal>
                    <div class="testi-mark">"</div>
                    <p class="quote">They took our product to Page 1 and kept it there for five straight years. Can't
                        imagine launching without them.</p>
                    <div class="testi-person">
                        <div class="testi-avatar">KU</div>
                        <div><b>Client Name</b><span>E-commerce Director</span></div>
                    </div>
                </div>
                <div class="testi-card" data-reveal>
                    <div class="testi-mark">"</div>
                    <p class="quote">Buyer quality score is noticeably higher compared to every other service we've
                        tried.</p>
                    <div class="testi-person">
                        <div class="testi-avatar">NF</div>
                        <div><b>Client Name</b><span>Amazon Seller</span></div>
                    </div>
                </div>
                <div class="testi-card" data-reveal>
                    <div class="testi-mark">"</div>
                    <p class="quote">I've trusted this team with my business for years — the results speak for
                        themselves.</p>
                    <div class="testi-person">
                        <div class="testi-avatar">DM</div>
                        <div><b>Client Name</b><span>Brand CEO</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CASE STUDIES -->
    <section id="cases">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">Case Study</span>
                <h2>From page 5 to page 1</h2>
            </div>
            <div class="case-grid">
                <div class="case-card" data-reveal>
                    <span class="eyebrow" style="color:var(--muted)">Home & Outdoor</span>
                    <h3>$0 to $178K in 30 days</h3>
                    <div class="case-shift">
                        <span class="from">Page 5</span><span class="arrow">→</span><span class="to">Page 1</span>
                    </div>
                    <p>A 4-step ranking strategy combining keyword-targeted external traffic with real shopper feedback,
                        for the competitive keyword "pool basketball hoop."</p>
                    <div class="case-meta">
                        <div><b>$178K</b><span>Revenue / 30 days</span></div>
                        <div><b>200%</b><span>ROI</span></div>
                        <div><b>10 days</b><span>To Page 1</span></div>
                    </div>
                </div>
                <div class="case-card" data-reveal>
                    <span class="eyebrow" style="color:var(--muted)">Electronics</span>
                    <h3>Ranked & sustained for 18 months</h3>
                    <div class="case-shift">
                        <span class="from">Page 4</span><span class="arrow">→</span><span class="to">#3</span>
                    </div>
                    <p>Ongoing monthly optimization kept this listing inside the top 5 results through two category-wide
                        algorithm shifts.</p>
                    <div class="case-meta">
                        <div><b>$94K</b><span>Revenue / 30 days</span></div>
                        <div><b>3.4x</b><span>Sales growth</span></div>
                        <div><b>18 mo</b><span>Sustained rank</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROCESS -->
    <section id="process" style="background:var(--paper-2);">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">Our Process</span>
                <h2>Test. Rank. Sell. Repeat.</h2>
                <p>A four-step process, in order — each step feeds directly into the next.</p>
            </div>
            <div class="process-line" data-reveal>
                <div class="process-step">
                    <span class="process-num">01</span>
                    <h3>Market & competitor research</h3>
                    <p>We analyze your category, competitors, and target keywords to find where the real opportunity is.
                    </p>
                </div>
                <div class="process-step">
                    <span class="process-num">02</span>
                    <h3>Real shopper feedback</h3>
                    <p>Genuine shoppers test your listing and product, giving honest insight into what's working and
                        what isn't.</p>
                </div>
                <div class="process-step">
                    <span class="process-num">03</span>
                    <h3>Listing & product optimization</h3>
                    <p>We turn feedback into action — sharpened titles, images, and A+ content built to convert.</p>
                </div>
                <div class="process-step">
                    <span class="process-num">04</span>
                    <h3>Rank, sell, repeat</h3>
                    <p>Watch your product climb and sales follow, with monthly reporting to stay sharp as your category
                        shifts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq">
        <div class="wrap">
            <div class="section-head" data-reveal>
                <span class="eyebrow">FAQs</span>
                <h2>All your questions, answered</h2>
            </div>
            <div class="faq-list" data-reveal>
                <details class="faq-item" open>
                    <summary>Is ListingGrowth's approach "white hat"?</summary>
                    <p>Yes. We only use ethical, TOS-compliant methods — genuine shoppers who independently discover,
                        purchase, and evaluate your product. No fake reviews, no shortcuts.</p>
                </details>
                <details class="faq-item">
                    <summary>How do you determine the best keywords for my product?</summary>
                    <p>We combine tools like Helium 10 with manual market research to find high-conversion,
                        low-competition keywords for a balanced traffic and sales approach.</p>
                </details>
                <details class="faq-item">
                    <summary>How does external traffic improve my Amazon ranking?</summary>
                    <p>Amazon rewards listings that pull in diverse traffic from outside the platform. Targeted external
                        shoppers signal demand and strengthen your organic position.</p>
                </details>
                <details class="faq-item">
                    <summary>How long until I see results?</summary>
                    <p>Most clients see measurable ranking and traffic improvement within 2–6 weeks, with ongoing
                        optimization to sustain it long-term.</p>
                </details>
                <details class="faq-item">
                    <summary>Do I still need PPC if I work with you?</summary>
                    <p>No — but you can absolutely pair both. Many clients combine organic ranking with a lean PPC
                        strategy for maximum reach.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="final-cta">
        <div class="wrap">
            <span class="eyebrow" style="color:var(--signal)">Ready When You Are</span>
            <h2>Scaling on Amazon shouldn't be hard.<br>Let's simplify it.</h2>
            <p>Get a free Amazon SEO audit and a tailored growth plan — no cost, no obligation.</p>
            <div class="hero-ctas">
                <a href="contact.html" class="btn btn-primary">Get My Free Amazon SEO Audit →</a>
                <a href="contact.html" class="btn btn-ghost">Book a Consultation</a>
            </div>
        </div>
    </section>

@endsection
