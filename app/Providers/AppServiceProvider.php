<?php

namespace App\Providers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function($expression) {
            return "Rp. <?php echo number_format($expression, 0, ', ', '.'); ?>";
        });

        view()->composer('*', function ($view)
        {
            $role = Session::get('role');
            $id = Session::get('id');
            $konsumen_id = Auth::guard($role)->user()->$id;

            $keranjang = Keranjang::with(['produk', 'pembeli'])
                ->where('pembeli_id', $konsumen_id)
                ->where('pembeli_type', $role == 'konsumen' ? 'App\Models\Konsumen' : 'App\Models\Pelapak')
                ->where('status', 'N')
                ->limit(1)
                ->first();

            //...with this variable
            $view->with('cart', $keranjang );
        });
    }
}
