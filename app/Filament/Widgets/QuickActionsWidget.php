<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\CategorySectionSettings;
use App\Filament\Pages\FaqSectionSettings;
use App\Filament\Pages\FinalCtaSettings;
use App\Filament\Pages\GrowthProofSettings;
use App\Filament\Pages\ProcessSectionSettings;
use App\Filament\Pages\TestimonialSectionSettings;
use App\Filament\Pages\WhyListingGrowthSettings;
use App\Filament\Resources\CaseStudies\CaseStudyResource;
use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\HomeServices\HomeServiceResource;
use App\Filament\Resources\TrustStatistics\TrustStatisticResource;
use App\Filament\Resources\WhyListingGrowthItems\WhyListingGrowthItemResource;
use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.quick-actions-widget';

    /** @return array<string, array<int, array<string, string|null>>> */
    protected function getViewData(): array
    {
        return [
            'actions' => [
                [
                    'label' => 'Contact Submissions',
                    'description' => 'Review, filter, export, and update incoming contact requests.',
                    'icon' => 'heroicon-o-envelope',
                    'manageUrl' => ContactSubmissionResource::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'Home Services',
                    'description' => 'Manage service cards, SVG icons, ordering, and visibility.',
                    'icon' => 'heroicon-o-squares-2x2',
                    'manageUrl' => HomeServiceResource::getUrl(),
                    'createUrl' => HomeServiceResource::getUrl('create'),
                ],
                [
                    'label' => 'Trust Statistics',
                    'description' => 'Update the trust-strip labels, values, and display order.',
                    'icon' => 'heroicon-o-chart-bar-square',
                    'manageUrl' => TrustStatisticResource::getUrl(),
                    'createUrl' => TrustStatisticResource::getUrl('create'),
                ],
                [
                    'label' => 'Why Section',
                    'description' => 'Edit the singleton section heading and supporting description.',
                    'icon' => 'heroicon-o-document-text',
                    'manageUrl' => WhyListingGrowthSettings::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'Why Section Items',
                    'description' => 'Create and order the reusable reasons shown below the heading.',
                    'icon' => 'heroicon-o-rectangle-stack',
                    'manageUrl' => WhyListingGrowthItemResource::getUrl(),
                    'createUrl' => WhyListingGrowthItemResource::getUrl('create'),
                ],
                [
                    'label' => 'Growth Proof',
                    'description' => 'Manage the section, proof items, and performance statistics.',
                    'icon' => 'heroicon-o-presentation-chart-line',
                    'manageUrl' => GrowthProofSettings::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'Categories',
                    'description' => 'Edit the category section and all ordered category pills.',
                    'icon' => 'heroicon-o-tag',
                    'manageUrl' => CategorySectionSettings::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'Testimonials',
                    'description' => 'Curate section content, client feedback, and optional profiles.',
                    'icon' => 'heroicon-o-chat-bubble-left-right',
                    'manageUrl' => TestimonialSectionSettings::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'Case Studies',
                    'description' => 'Manage case-study content, rich text, statistics, and ordering.',
                    'icon' => 'heroicon-o-rectangle-stack',
                    'manageUrl' => CaseStudyResource::getUrl(),
                    'createUrl' => CaseStudyResource::getUrl('create'),
                ],
                [
                    'label' => 'Process',
                    'description' => 'Update the process heading and its ordered steps.',
                    'icon' => 'heroicon-o-list-bullet',
                    'manageUrl' => ProcessSectionSettings::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'FAQs',
                    'description' => 'Manage questions, answers, ordering, and page visibility.',
                    'icon' => 'heroicon-o-question-mark-circle',
                    'manageUrl' => FaqSectionSettings::getUrl(),
                    'createUrl' => null,
                ],
                [
                    'label' => 'Final CTA',
                    'description' => 'Control the closing call-to-action copy and both buttons.',
                    'icon' => 'heroicon-o-megaphone',
                    'manageUrl' => FinalCtaSettings::getUrl(),
                    'createUrl' => null,
                ],
            ],
        ];
    }
}
