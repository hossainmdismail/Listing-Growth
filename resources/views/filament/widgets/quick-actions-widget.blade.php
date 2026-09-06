<x-filament-widgets::widget>
    <x-filament::section heading="Quick Actions"
        description="Shortcuts to every content-management area available in this project.">
        <div class="dashboard-action-grid">
            @foreach ($actions as $action)
                <article class="dashboard-action-card">
                    <div class="dashboard-action-heading">
                        <span class="dashboard-action-icon">
                            <x-filament::icon :icon="$action['icon']" />
                        </span>
                        <h3>{{ $action['label'] }}</h3>
                    </div>
                    <p>{{ $action['description'] }}</p>
                    <div class="dashboard-action-buttons">
                        <x-filament::button tag="a" :href="$action['manageUrl']" size="sm" color="gray">
                            Manage
                        </x-filament::button>
                        @if ($action['createUrl'])
                            <x-filament::button tag="a" :href="$action['createUrl']" size="sm">
                                Add New
                            </x-filament::button>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

@pushOnce('styles', 'dashboard-action-cards')
    <style>
        .dashboard-action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
            gap: 1rem;
        }

        .dashboard-action-card {
            display: flex;
            min-height: 13rem;
            flex-direction: column;
            padding: 1rem;
            border: 1px solid color-mix(in srgb, currentColor 14%, transparent);
            border-radius: .75rem;
        }

        .dashboard-action-heading {
            display: flex;
            align-items: center;
            gap: .75rem;
        }

        .dashboard-action-heading h3 {
            font-weight: 600;
        }

        .dashboard-action-icon {
            display: grid;
            width: 2.25rem;
            height: 2.25rem;
            flex: 0 0 auto;
            place-items: center;
            border-radius: .625rem;
            color: var(--primary-500);
            background: color-mix(in srgb, var(--primary-500) 12%, transparent);
        }

        .dashboard-action-icon svg {
            width: 1.1rem;
            height: 1.1rem;
        }

        .dashboard-action-card > p {
            margin-top: .875rem;
            font-size: .875rem;
            line-height: 1.5;
            opacity: .65;
        }

        .dashboard-action-buttons {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-top: auto;
            padding-top: 1rem;
        }

        .dashboard-setting-card {
            min-height: 10rem;
        }
    </style>
@endPushOnce
