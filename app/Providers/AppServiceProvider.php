<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Component::macro('notify', function ($title, $text, $icon = 'success') {
            $this->dispatch('notify', title: $title, text: $text, icon: $icon);
        });

        Component::macro('closeModal', function ($modal) {
            $this->dispatch('closeModal', modal: $modal);
        });

        Component::macro('openModal', function ($modal) {
            $this->dispatch('openModal', modal: $modal);
        });

        Blade::directive('amount', fn(string|int|float $value) => "<?php echo number_format(floatval($value), 2); ?>");

        Blade::directive('money', fn(string|int|float $value) => "<?php echo '$' . number_format(floatval($value), 2); ?>");

        Blade::directive('weight', fn(string|int|float $value) => "<?php echo number_format(floatval($value), 2) . ' kg.'; ?>");
    }
}
