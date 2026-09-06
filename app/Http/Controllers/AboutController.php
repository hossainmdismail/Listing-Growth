<?php

namespace App\Http\Controllers;

use App\Models\FinalCtaSection;
use App\Models\TestimonialSection;
use App\Models\TrustStatistic;
use Illuminate\View\View;
use Throwable;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        try {
            $trustStatistics = TrustStatistic::query()->active()->ordered()->get();
        } catch (Throwable) {
            $trustStatistics = collect();
        }

        try {
            $testimonialSection = TestimonialSection::query()
                ->where('singleton_key', 1)
                ->first();
            $testimonials = $testimonialSection?->testimonials()
                ->active()
                ->ordered()
                ->get() ?? collect();
        } catch (Throwable) {
            $testimonialSection = null;
            $testimonials = collect();
        }

        try {
            $finalCtaSection = FinalCtaSection::query()
                ->where('singleton_key', 1)
                ->first();
        } catch (Throwable) {
            $finalCtaSection = null;
        }

        return view('frontend.about', [
            'trustStatistics' => $trustStatistics,
            'testimonialSection' => $testimonialSection,
            'testimonials' => $testimonials,
            'finalCtaSection' => $finalCtaSection,
        ]);
    }
}
