<?php

namespace App\Providers;

use App\Models\CaseStudy;
use App\Models\CategorySection;
use App\Models\FaqSection;
use App\Models\FinalCtaSection;
use App\Models\GrowthProofSection;
use App\Models\HomeService;
use App\Models\ProcessSection;
use App\Models\TestimonialSection;
use App\Models\TrustStatistic;
use App\Models\WhyListingGrowthItem;
use App\Models\WhyListingGrowthSection;
use App\Support\MarketingData;
use App\Support\SeoMetadata;
use App\Support\SiteSettings;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SiteSettings::class);
        $this->app->singleton(SeoMetadata::class);
        $this->app->singleton(MarketingData::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ViewFacade::composer('frontend.*', function (View $view): void {
            $view->with('globalSettings', app(SiteSettings::class)->get());
        });

        ViewFacade::composer('frontend.index', function (View $view): void {
            try {
                $trustStatistics = TrustStatistic::query()->active()->ordered()->get();
            } catch (\Throwable) {
                $trustStatistics = collect();
            }

            try {
                $homeServices = HomeService::query()->active()->ordered()->get();
            } catch (\Throwable) {
                $homeServices = collect();
            }

            try {
                $whyListingGrowthSection = WhyListingGrowthSection::query()
                    ->where('singleton_key', 1)
                    ->first();
                $whyListingGrowthItems = WhyListingGrowthItem::query()
                    ->active()
                    ->ordered()
                    ->get();
            } catch (\Throwable) {
                $whyListingGrowthSection = null;
                $whyListingGrowthItems = collect();
            }

            try {
                $growthProofSection = GrowthProofSection::query()
                    ->where('singleton_key', 1)
                    ->first();
                $growthProofItems = $growthProofSection?->items()
                    ->active()
                    ->ordered()
                    ->get() ?? collect();
                $growthProofStatistics = $growthProofSection?->statistics()
                    ->active()
                    ->ordered()
                    ->get() ?? collect();
            } catch (\Throwable) {
                $growthProofSection = null;
                $growthProofItems = collect();
                $growthProofStatistics = collect();
            }

            try {
                $categorySection = CategorySection::query()
                    ->where('singleton_key', 1)
                    ->first();
                $homeCategories = $categorySection?->categories()
                    ->active()
                    ->ordered()
                    ->get() ?? collect();
            } catch (\Throwable) {
                $categorySection = null;
                $homeCategories = collect();
            }

            try {
                $testimonialSection = TestimonialSection::query()
                    ->where('singleton_key', 1)
                    ->first();
                $testimonials = $testimonialSection?->testimonials()
                    ->active()
                    ->ordered()
                    ->get() ?? collect();
            } catch (\Throwable) {
                $testimonialSection = null;
                $testimonials = collect();
            }

            try {
                $caseStudies = CaseStudy::query()->active()->ordered()->get();
            } catch (\Throwable) {
                $caseStudies = collect();
            }

            try {
                $processSection = ProcessSection::query()
                    ->where('singleton_key', 1)
                    ->first();
                $processItems = $processSection?->items()
                    ->active()
                    ->ordered()
                    ->get() ?? collect();
            } catch (\Throwable) {
                $processSection = null;
                $processItems = collect();
            }

            try {
                $faqSection = FaqSection::query()
                    ->where('singleton_key', 1)
                    ->first();
                $faqItems = $faqSection?->items()
                    ->active()
                    ->forHomePage()
                    ->ordered()
                    ->get() ?? collect();
            } catch (\Throwable) {
                $faqSection = null;
                $faqItems = collect();
            }

            try {
                $finalCtaSection = FinalCtaSection::query()
                    ->where('singleton_key', 1)
                    ->first();
            } catch (\Throwable) {
                $finalCtaSection = null;
            }

            $view->with([
                'trustStatistics' => $trustStatistics,
                'homeServices' => $homeServices,
                'whyListingGrowthSection' => $whyListingGrowthSection,
                'whyListingGrowthItems' => $whyListingGrowthItems,
                'growthProofSection' => $growthProofSection,
                'growthProofItems' => $growthProofItems,
                'growthProofStatistics' => $growthProofStatistics,
                'categorySection' => $categorySection,
                'homeCategories' => $homeCategories,
                'testimonialSection' => $testimonialSection,
                'testimonials' => $testimonials,
                'caseStudies' => $caseStudies,
                'processSection' => $processSection,
                'processItems' => $processItems,
                'faqSection' => $faqSection,
                'faqItems' => $faqItems,
                'finalCtaSection' => $finalCtaSection,
            ]);
        });
    }
}
