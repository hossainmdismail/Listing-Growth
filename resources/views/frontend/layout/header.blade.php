<!-- SITE NAVIGATION -->
<header class="site-nav">
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="logo">
            {{ $globalSettings?->site_name ?: 'ListingGrowth' }}<span class="tag">SEO</span>
        </a>
        <button class="nav-toggle" aria-label="Toggle Menu">
            <span></span><span></span><span></span>
        </button>
        <nav class="nav-links">
            <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
            <a href="{{ route('services') }}" @class(['active' => request()->routeIs('services')])>Services</a>
            <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
            <a href="{{ route('home') }}#cases">Case Studies</a>
            <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
        </nav>
        <div class="nav-cta">
            <a href="{{ route('contact') }}" class="btn btn-outline" style="padding:10px 18px;font-size:13.5px;">Contact</a>
            <a href="{{ route('contact') }}" class="btn btn-primary" style="padding:10px 18px;font-size:13.5px;">Free
                Audit</a>
        </div>
    </div>
</header>
