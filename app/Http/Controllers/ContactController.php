<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Models\ContactSubmission;
use App\Models\FaqSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function create(): View
    {
        try {
            $faqSection = FaqSection::query()
                ->where('singleton_key', 1)
                ->first();
            $faqItems = $faqSection?->items()
                ->active()
                ->forContactPage()
                ->ordered()
                ->get() ?? collect();
        } catch (Throwable) {
            $faqSection = null;
            $faqItems = collect();
        }

        return view('frontend.contact', [
            'faqSection' => $faqSection,
            'faqItems' => $faqItems,
            'categoryOptions' => ContactSubmission::categoryOptions(),
            'serviceOptions' => ContactSubmission::serviceOptions(),
        ]);
    }

    public function store(StoreContactSubmissionRequest $request): RedirectResponse
    {
        ContactSubmission::query()->create($request->validated());

        return redirect()
            ->route('contact')
            ->with('contact_success', 'Thank you! We received your details and will get back to you within one business day.');
    }
}
