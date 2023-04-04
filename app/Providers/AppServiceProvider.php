<?php

namespace App\Providers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Item;
use App\Models\User;
use App\Observers\AuctionObserver;
use App\Observers\BidObserver;
use App\Observers\ItemObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
        User::observe(UserObserver::class);
        Item::observe(ItemObserver::class);
        Auction::observe(AuctionObserver::class);
        Bid::observe(BidObserver::class);
    }
}
