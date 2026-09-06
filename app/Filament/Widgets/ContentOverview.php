<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\CategorySectionSettings;
use App\Filament\Pages\FaqSectionSettings;
use App\Filament\Pages\GrowthProofSettings;
use App\Filament\Pages\ProcessSectionSettings;
use App\Filament\Pages\TestimonialSectionSettings;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\HomeServices\HomeServiceResource;
use App\Filament\Resources\SeoPages\SeoPageResource;
use App\Filament\Resources\TrustStatistics\TrustStatisticResource;
use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use App\Models\CaseStudy;
use App\Models\ContactSubmission;
use App\Models\FaqItem;
use App\Models\GrowthProofItem;
use App\Models\GrowthProofStatistic;
use App\Models\HomeCategory;
use App\Models\HomeService;
use App\Models\ProcessItem;
use App\Models\SeoPage;
use App\Models\Testimonial;
use App\Models\TrustStatistic;
use App\Models\WhyListingGrowthItem;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContentOverview extends StatsOverviewWidget
{
    protected static ?int $sort = -2;

    protected static bool $isLazy = false;

    protected ?string $heading = 'Content Overview';

    protected ?string $description = 'A live snapshot of every content area available in this project.';

    /** @return array<string, int> */
    protected function getColumns(): array
    {
        return ['@xl' => 4, '!@lg' => 4];
    }

    /** @return array<Stat> */
    protected function getStats(): array
    {
        $contactSubmissions = $this->countByState(
            ContactSubmission::query(),
            'status',
            ContactSubmission::STATUS_NEW,
        );
        $homeServices = $this->countByState(HomeService::query());
        $trustStatistics = $this->countByState(TrustStatistic::query());
        $whyItems = $this->countByState(WhyListingGrowthItem::query());
        $growthProofItems = $this->countByState(GrowthProofItem::query());
        $growthProofStatistics = $this->countByState(GrowthProofStatistic::query());
        $categories = $this->countByState(HomeCategory::query());
        $testimonials = $this->countByState(Testimonial::query());
        $caseStudies = $this->countByState(CaseStudy::query());
        $processItems = $this->countByState(ProcessItem::query());
        $faqItems = $this->countByState(FaqItem::query());
        $seoPages = $this->countByState(SeoPage::query());

        return [
            Stat::make('Contact Submissions', $contactSubmissions['total'])
                ->description("{$contactSubmissions['matching']} new")
                ->descriptionColor($contactSubmissions['matching'] > 0 ? 'warning' : 'gray')
                ->icon('heroicon-o-envelope')
                ->url(ContactSubmissionResource::getUrl()),
            Stat::make('Home Services', $homeServices['total'])
                ->description("{$homeServices['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-squares-2x2')
                ->url(HomeServiceResource::getUrl()),
            Stat::make('Trust Statistics', $trustStatistics['total'])
                ->description("{$trustStatistics['matching']} active")
                ->descriptionColor('info')
                ->icon('heroicon-o-chart-bar-square')
                ->url(TrustStatisticResource::getUrl()),
            Stat::make('Why Section Items', $whyItems['total'])
                ->description("{$whyItems['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-rectangle-stack')
                ->url(WhyListingGrowthItemResource::getUrl()),
            Stat::make('Growth Proof Items', $growthProofItems['total'])
                ->description("{$growthProofItems['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-presentation-chart-line')
                ->url(GrowthProofSettings::getUrl()),
            Stat::make('Growth Proof Statistics', $growthProofStatistics['total'])
                ->description("{$growthProofStatistics['matching']} active")
                ->descriptionColor('info')
                ->icon('heroicon-o-chart-bar')
                ->url(GrowthProofSettings::getUrl()),
            Stat::make('Categories', $categories['total'])
                ->description("{$categories['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-tag')
                ->url(CategorySectionSettings::getUrl()),
            Stat::make('Testimonials', $testimonials['total'])
                ->description("{$testimonials['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->url(TestimonialSectionSettings::getUrl()),
            Stat::make('Case Studies', $caseStudies['total'])
                ->description("{$caseStudies['matching']} active")
                ->descriptionColor('warning')
                ->icon('heroicon-o-rectangle-stack')
                ->url(CaseStudyResource::getUrl()),
            Stat::make('Process Steps', $processItems['total'])
                ->description("{$processItems['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-list-bullet')
                ->url(ProcessSectionSettings::getUrl()),
            Stat::make('FAQs', $faqItems['total'])
                ->description("{$faqItems['matching']} active")
                ->descriptionColor('info')
                ->icon('heroicon-o-question-mark-circle')
                ->url(FaqSectionSettings::getUrl()),
            Stat::make('SEO Pages', $seoPages['total'])
                ->description("{$seoPages['matching']} active")
                ->descriptionColor('success')
                ->icon('heroicon-o-document-magnifying-glass')
                ->url(SeoPageResource::getUrl()),
        ];
    }

    /**
     * @param  Builder<Model>  $query
     * @return array{total: int, matching: int}
     */
    private function countByState(
        Builder $query,
        string $column = 'is_active',
        bool|string $value = true,
    ): array {
        $counts = $query
            ->toBase()
            ->selectRaw('COUNT(*) AS total')
            ->selectRaw("SUM(CASE WHEN {$column} = ? THEN 1 ELSE 0 END) AS matching", [$value])
            ->first();

        return [
            'total' => (int) ($counts?->total ?? 0),
            'matching' => (int) ($counts?->matching ?? 0),
        ];
    }
}
