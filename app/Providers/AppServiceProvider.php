<?php

namespace App\Providers;


use App\Models\Kot;
use App\Models\Tax;
use App\Models\Area;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use App\Models\Table;
use App\Models\Branch;
use App\Models\Payment;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Expenses;
use App\Models\MenuItem;
use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\FileStorage;
use App\Models\Reservation;
use App\Models\ItemCategory;
use App\Observers\KotObserver;
use App\Observers\TaxObserver;
use App\Models\ExpenseCategory;
use App\Observers\AreaObserver;
use App\Observers\MenuObserver;
use App\Observers\UserObserver;
use App\Models\RestaurantCharge;
use App\Observers\OrderObserver;
use App\Observers\TableObserver;
use App\Models\DeliveryExecutive;
use App\Observers\BranchObserver;
use App\Models\ReservationSetting;
use App\Observers\PaymentObserver;
use App\Http\Middleware\SuperAdmin;
use App\Models\LanguageSetting;
use App\Models\NotificationSetting;
use App\Observers\CurrencyObserver;
use App\Observers\CustomerObserver;
use App\Observers\ExpensesObserver;
use App\Observers\MenuItemObserver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Observers\OrderItemObserver;
use Illuminate\Support\Facades\Gate;
use App\Observers\RestaurantObserver;
use App\Observers\FileStorageObserver;
use App\Observers\ReservationObserver;
use Illuminate\Support\Facades\Schema;
use App\Observers\ItemCategoryObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\PaymentGatewayCredential;
use App\Observers\PaymentGatewayObserver;
use Illuminate\Database\Eloquent\Builder;
use App\Observers\ExpenseCategoryObserver;
use App\Observers\DeliveryExecutiveObserver;
use App\Observers\LanguageSettingObserver;
use App\Observers\RestaurantChargesObserver;
use App\Observers\ReservationSettingObserver;
use Spatie\Translatable\Facades\Translatable;
use App\Observers\NotificationSettingObserver;
use Livewire\Livewire;
use App\Http\Livewire\Table\PanoramaViewer;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (config('app.redirect_https')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.redirect_https')) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
        // Link observers with models
        Area::observe(AreaObserver::class);
        User::observe(UserObserver::class);
        ItemCategory::observe(ItemCategoryObserver::class);
        Kot::observe(KotObserver::class);
        MenuItem::observe(MenuItemObserver::class);
        Menu::observe(MenuObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        Order::observe(OrderObserver::class);
        Payment::observe(PaymentObserver::class);
        ReservationSetting::observe(ReservationSettingObserver::class);
        Reservation::observe(ReservationObserver::class);
        Table::observe(TableObserver::class);
        PaymentGatewayCredential::observe(PaymentGatewayObserver::class);
        Tax::observe(TaxObserver::class);
        Currency::observe(CurrencyObserver::class);
        NotificationSetting::observe(NotificationSettingObserver::class);
        Customer::observe(CustomerObserver::class);
        Restaurant::observe(RestaurantObserver::class);
        Branch::observe(BranchObserver::class);
        FileStorage::observe(FileStorageObserver::class);
        DeliveryExecutive::observe(DeliveryExecutiveObserver::class);
        RestaurantCharge::observe(RestaurantChargesObserver::class);
        Expenses::observe(ExpensesObserver::class);
        ExpenseCategory::observe(ExpenseCategoryObserver::class);
        LanguageSetting::observe(LanguageSettingObserver::class);


        // Implicitly grant "Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin_' . $user->restaurant_id) ? true : null;
        });

        // Search macro for searching in tables.
        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });

        // Fallback to English if the locale is not found
        try {
            Translatable::fallback(global_setting()->locale, 'en');
        } catch (\Exception $e) {
            Log::error('Error in Translatable fallback: ' . $e->getMessage());
        }

        // Model::preventLazyLoading(app()->environment('development'));

        Livewire::component('table.panorama-viewer', PanoramaViewer::class);
    }
}
