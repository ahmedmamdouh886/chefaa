<?php

namespace App\Providers;

use App\Services\Auth\V1\Auth;
use App\Services\Auth\V1\AuthInterface;
use App\Services\Bookings\V1\Booking;
use App\Services\Bookings\V1\BookingInterface;
use App\Services\Bookings\V1\Details\BookingDetails;
use App\Services\Bookings\V1\Details\BookingDetailsInterface;
use App\Services\Trips\V1\Trip;
use App\Services\Trips\V1\TripInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthInterface::class, Auth::class);
        $this->app->singleton(TripInterface::class, Trip::class);
        $this->app->singleton(BookingInterface::class, Booking::class);
        $this->app->singleton(BookingDetailsInterface::class, BookingDetails::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
