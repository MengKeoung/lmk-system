<?php

namespace App\Providers;

use App\Models\BusinessSetting;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use App\Models\Category;
use App\Models\BrandCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
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
        // global variable
        view()->composer('*', function ($view) {
            $business_setting = new BusinessSetting;
            $languages = $business_setting->where('type', 'language')->first()->value;

            $langs = array_reduce(json_decode($languages, true), function ($result, $language) {
                if ($language['status'] == 1) {
                    $result[$language['name']] = $language['code'];
                }
                return $result;

            }, []);

            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', $langs);
        });
        // view()->composer('*',function($view) {
        //     $view->with('user', Auth::user());
        //     $view->with('social', Social::all());
        //     // if you need to access in controller and views:
        //     Config::set('something', $something);
        // });
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();





        //  logo

         // Share logo URLs with all views
         View::composer('*', function ($view) {
            $setting = new BusinessSetting();
            $web_header_logo = optional($setting->where('type', 'web_header_logo')->first())->value;
            $web_scroll_logo = optional($setting->where('type', 'web_scroll_logo')->first())->value;
            $phone = optional($setting->where('type', 'phone')->first())->value;
        $email = optional($setting->where('type', 'email')->first())->value;
        $company_name = optional($setting->where('type', 'company_name')->first())->value;

       

       
            $view->with('web_header_logo', $web_header_logo);
            $view->with('web_scroll_logo', $web_scroll_logo);
            $view->with('phone', $phone);
            $view->with('email', $email);
          

            $view->with('company_name', $company_name);
           
  // Fetch product dates from the database


            $socialMediaSetting = BusinessSetting::where('type', 'social_media')->first();
            $socialMedias = $socialMediaSetting ? json_decode($socialMediaSetting->value, true) : [];

            // Ensure all social media links have https://
            foreach ($socialMedias as &$social) {
                if (!str_starts_with($social['link'], 'http')) {
                    $social['link'] = 'https://' . $social['link'];
                }
            }

            // Share the social media links with all views
            // $view->with('social_medias', $socialMedias);
            View::share('social_medias', $socialMedias);
      
            

            // $customer = auth()->guard('customer')->user();
            // if ($customer) {
            //     $carts = Cart::where('customer_id', $customer->id)->get();
            //     $subtotal = $carts->sum('total');
            //     $view->with('carts', $carts)->with('subtotal', $subtotal);
            // }

            $customer = auth()->guard('customer')->user();
    

        });

    //     if (auth()->guard('customer')->check()) {
    //         $carts = Cart::with('product')->where('customer_id', auth()->id())->get();
    //         $subtotal = $carts->sum(function ($cart) {
    //             return $cart->price * $cart->qty;
    //         });
    //         $view->with('carts', $carts)->with('subtotal', $subtotal);
    //     } else {
    //         $view->with('carts', collect())->with('subtotal', 0);
    //     }
    // });
    

    }
}
