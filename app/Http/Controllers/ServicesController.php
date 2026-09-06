<?php

namespace App\Http\Controllers;

use App\Models\FinalCtaSection;
use App\Models\HomeService;
use App\Models\ProcessSection;
use Illuminate\View\View;
use Throwable;

class ServicesController extends Controller
{
    public function __invoke(): View
    {
        try {
            $services = HomeService::query()->active()->ordered()->get();
        } catch (Throwable) {
            $services = collect();
        }

        try {
            $processSection = ProcessSection::query()
                ->where('singleton_key', 1)
                ->first();
            $processItems = $processSection?->items()
                ->active()
                ->ordered()
                ->get() ?? collect();
        } catch (Throwable) {
            $processSection = null;
            $processItems = collect();
        }

        try {
            $finalCtaSection = FinalCtaSection::query()
                ->where('singleton_key', 1)
                ->first();
        } catch (Throwable) {
            $finalCtaSection = null;
        }

        return view('frontend.services', compact(
            'services',
            'processSection',
            'processItems',
            'finalCtaSection',
        ));
    }
}
