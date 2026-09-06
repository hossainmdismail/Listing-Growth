<x-filament-widgets::widget>
    <x-filament::section>
        <div class="dashboard-visit-card">
            <div class="dashboard-visit-icon">
                <x-filament::icon icon="heroicon-o-globe-alt" />
            </div>
            <div class="dashboard-visit-copy">
                <h2>Visit Website</h2>
                <p>Open the live public site in a new tab.</p>
            </div>
            <x-filament::button tag="a" :href="$siteUrl" target="_blank" rel="noreferrer"
                icon="heroicon-o-arrow-top-right-on-square">
                Open Website
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

@pushOnce('styles')
    <style>
        .dashboard-visit-card {
            display: flex;
            min-height: 4.5rem;
            align-items: center;
            gap: 1rem;
        }

        .dashboard-visit-icon {
            display: grid;
            width: 3rem;
            height: 3rem;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 9999px;
            color: var(--primary-500);
            background: color-mix(in srgb, var(--primary-500) 12%, transparent);
        }

        .dashboard-visit-icon svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        .dashboard-visit-copy {
            min-width: 0;
            flex: 1;
        }

        .dashboard-visit-copy h2 {
            font-weight: 600;
        }

        .dashboard-visit-copy p {
            margin-top: .125rem;
            font-size: .875rem;
            opacity: .65;
        }

        @media (max-width: 640px) {
            .dashboard-visit-card {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .dashboard-visit-card .fi-btn {
                width: 100%;
            }
        }
    </style>
@endPushOnce
