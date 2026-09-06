@extends('frontend.layout.app')

@section('seo_key', 'contact')
@section('title', 'Contact Us | ListingGrowth')
@section('description', 'Tell us about your Amazon product and receive a free audit with a tailored growth plan.')

@section('content')
    <section class="page-hero">
        <div class="wrap" data-reveal>
            <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <span>/</span> <span>Contact</span></div>
            <span class="eyebrow">Get In Touch</span>
            <h1>Let's get your listing to Page 1</h1>
            <p class="lead">Tell us about your product and we'll come back with a free audit and a tailored growth plan — no cost, no obligation.</p>
        </div>
    </section>

    <section>
        <div class="wrap contact-layout">
            <div data-reveal>
                @if (session('contact_success'))
                    <div class="form-success" role="status">{{ session('contact_success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="form-errors" role="alert">
                        <strong>Please check the highlighted fields.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="contact-form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="name">Full name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                placeholder="Jane Cooper" maxlength="150" autocomplete="name" required
                                @class(['field-invalid' => $errors->has('name')])>
                            @error('name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="jane@brand.com" maxlength="254" autocomplete="email" required
                                @class(['field-invalid' => $errors->has('email')])>
                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="listing_url">Amazon listing URL</label>
                            <input type="text" id="listing_url" name="listing_url" value="{{ old('listing_url') }}"
                                placeholder="amazon.com/dp/..." maxlength="2048" inputmode="url"
                                @class(['field-invalid' => $errors->has('listing_url')])>
                            @error('listing_url')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Product category</label>
                            <select id="category" name="category" @class(['field-invalid' => $errors->has('category')])>
                                <option value="">Select a category</option>
                                @foreach ($categoryOptions as $value => $label)
                                    <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="service">What are you interested in?</label>
                        <select id="service" name="service" @class(['field-invalid' => $errors->has('service')])>
                            <option value="">Select a service</option>
                            @foreach ($serviceOptions as $value => $label)
                                <option value="{{ $value }}" @selected(old('service') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('service')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Tell us about your goal</label>
                        <textarea id="message" name="message" rows="5" maxlength="5000"
                            placeholder="What are you trying to achieve — a launch, a ranking drop, scaling an existing listing?"
                            @class(['field-invalid' => $errors->has('message')])>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary contact-submit">Send & Get My Free Audit →</button>
                </form>
            </div>

            <div data-reveal>
                <div class="contact-info-card">
                    <h3>Talk to a strategist</h3>
                    <p>Prefer to skip the form? Reach out directly and we'll get back to you within one business day.</p>

                    @if (filled($globalSettings?->contact_email))
                        <div class="contact-row">
                            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16v16H4z"/><path d="M4 4l8 8 8-8"/></svg></div>
                            <div><b>{{ $globalSettings->contact_email }}</b><span>Email us anytime</span></div>
                        </div>
                    @endif
                    @if (filled($globalSettings?->contact_phone))
                        <div class="contact-row">
                            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .3 2 .6 3a2 2 0 0 1-.5 2L8 10a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2-.5c1 .3 2 .5 3 .6a2 2 0 0 1 1.7 2z"/></svg></div>
                            <div><b>{{ $globalSettings->contact_phone }}</b><span>Mon–Fri, 9am–6pm ET</span></div>
                        </div>
                    @endif
                    @if (filled($globalSettings?->address))
                        <div class="contact-row">
                            <div class="ico"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                            <div><b>{{ $globalSettings->address }}</b><span>Serving clients globally</span></div>
                        </div>
                    @endif

                    <div class="response-time">
                        <div class="response-time-label">RESPONSE TIME</div>
                        <div class="response-time-status"><span></span>Usually within 1 business day</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($faqItems->isNotEmpty())
        <section class="contact-faq">
            <div class="wrap">
                <div class="section-head" data-reveal>
                    <span class="eyebrow">Before You Reach Out</span>
                    <h2>Quick answers</h2>
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
@endsection
