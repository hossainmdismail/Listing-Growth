<!-- FOOTER -->
<footer>
    <div class="wrap">
        <div class="footer-top">
            <div>
                <a href="{{ route('home') }}" class="logo">{{ $globalSettings?->site_name ?: 'ListingGrowth' }}</a>
                <p class="footer-blurb">
                    {{ $globalSettings?->footer_text ?: $globalSettings?->company_description ?: 'Organic Amazon ranking — no paid ads required — through proven SEO strategy and real shopper feedback.' }}
                </p>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('services') }}">Services</a>
                <a href="{{ route('home') }}#cases">Case Studies</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <a href="{{ route('services') }}">Ranking Optimization</a>
                <a href="{{ route('services') }}">Pre-Launch Lab</a>
                <a href="{{ route('contact') }}">1-on-1 Consultation</a>
            </div>
            <div class="footer-col">
                <h4>Connect</h4>
                @if ($globalSettings?->instagram_url)
                    <a href="{{ $globalSettings->instagram_url }}" target="_blank" rel="noreferrer">Instagram</a>
                @endif
                @if ($globalSettings?->facebook_url)
                    <a href="{{ $globalSettings->facebook_url }}" target="_blank" rel="noreferrer">Facebook</a>
                @endif
                @if ($globalSettings?->linkedin_url)
                    <a href="{{ $globalSettings->linkedin_url }}" target="_blank" rel="noreferrer">LinkedIn</a>
                @endif
            </div>
        </div>
        <div class="footer-bottom">
            <span>{{ $globalSettings?->copyright_text ?: '© '.now()->year.' ListingGrowth. All Rights Reserved.' }}</span>
            <span>Privacy Policy · Terms and Conditions</span>
        </div>
    </div>
</footer>
