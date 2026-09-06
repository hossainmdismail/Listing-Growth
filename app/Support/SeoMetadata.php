<?php

namespace App\Support;

use App\Models\SeoPage;
use Illuminate\Support\Str;
use Throwable;

class SeoMetadata
{
    public function __construct(private readonly SiteSettings $siteSettings) {}

    /**
     * @param  array<string, string|null>  $fallback
     * @return array<string, mixed>
     */
    public function resolve(?string $pageKey, array $fallback = []): array
    {
        $global = $this->siteSettings->get();
        $page = $this->findActivePage($pageKey);

        $title = $page?->meta_title
            ?: ($fallback['title'] ?? null)
            ?: $global?->default_meta_title
            ?: $global?->site_name
            ?: config('app.name', 'ListingGrowth');

        $description = $page?->meta_description
            ?: ($fallback['description'] ?? null)
            ?: $global?->default_meta_description
            ?: $global?->company_description
            ?: '';

        $openGraphTitle = $page?->og_title
            ?: ($fallback['og_title'] ?? null)
            ?: $global?->default_og_title
            ?: $title;

        $openGraphDescription = $page?->og_description
            ?: ($fallback['og_description'] ?? null)
            ?: $global?->default_og_description
            ?: $description;

        $openGraphImage = $this->toAbsoluteUrl(
            $page?->og_image_url
            ?: ($fallback['og_image'] ?? null)
            ?: $global?->default_og_image_url,
        );

        $canonicalUrl = $page?->canonical_url ?: $this->canonicalUrl($global?->canonical_base_url);
        $robots = $page
            ? implode(',', [
                $page->robots_index ? 'index' : 'noindex',
                $page->robots_follow ? 'follow' : 'nofollow',
            ])
            : ($global?->default_robots_meta ?: 'index,follow');

        return [
            'title' => $title,
            'description' => $description,
            'canonical_url' => $canonicalUrl,
            'robots' => $robots,
            'og_title' => $openGraphTitle,
            'og_description' => $openGraphDescription,
            'og_image' => $openGraphImage,
            'twitter_title' => filled($fallback['twitter_title'] ?? null) ? $fallback['twitter_title'] : $openGraphTitle,
            'twitter_description' => filled($fallback['twitter_description'] ?? null) ? $fallback['twitter_description'] : $openGraphDescription,
            'twitter_image' => $this->toAbsoluteUrl(
                filled($fallback['twitter_image'] ?? null) ? $fallback['twitter_image'] : $openGraphImage,
            ),
            'site_name' => $global?->site_name ?: config('app.name', 'ListingGrowth'),
            'favicon_url' => $this->toAbsoluteUrl($global?->favicon_url),
            'schema_json' => $this->schema($page, $canonicalUrl),
        ];
    }

    protected function findActivePage(?string $pageKey): ?SeoPage
    {
        if (blank($pageKey)) {
            return null;
        }

        try {
            return SeoPage::query()
                ->where('page_key', $pageKey)
                ->where('is_active', true)
                ->first();
        } catch (Throwable) {
            return null;
        }
    }

    protected function canonicalUrl(?string $configuredBaseUrl): string
    {
        $baseUrl = rtrim($configuredBaseUrl ?: config('app.url', url('/')), '/');
        $path = request()->path();

        return $path === '/' ? $baseUrl : $baseUrl.'/'.ltrim($path, '/');
    }

    /** @return array<string, mixed> */
    protected function schema(?SeoPage $page, string $canonicalUrl): array
    {
        $global = $this->siteSettings->get();
        $organizationId = rtrim(config('app.url'), '/').'#organization';
        $graph = [
            array_filter([
                '@type' => 'Organization',
                '@id' => $organizationId,
                'name' => $global?->site_name ?: config('app.name'),
                'url' => config('app.url'),
                'logo' => $this->toAbsoluteUrl($global?->logo_url),
                'description' => $global?->company_description,
                'sameAs' => array_values(array_filter([
                    $global?->facebook_url,
                    $global?->instagram_url,
                    $global?->linkedin_url,
                    $global?->twitter_url,
                    $global?->youtube_url,
                ])),
            ], fn (mixed $value): bool => filled($value)),
            [
                '@type' => 'WebSite',
                '@id' => rtrim(config('app.url'), '/').'#website',
                'url' => config('app.url'),
                'name' => $global?->site_name ?: config('app.name'),
                'publisher' => ['@id' => $organizationId],
            ],
        ];

        if (filled($page?->schema_json)) {
            $graph[] = $page->schema_json;
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    protected function toAbsoluteUrl(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//'])) {
            return $value;
        }

        return url($value);
    }
}
