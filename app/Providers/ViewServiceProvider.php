<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share menu data dengan view section.menu
        View::composer('section.menu', function ($view) {
            $request = app(Request::class);
            
            $kategori = $request->query('category', 'Drink');
            $page = (int) $request->query('page', 1);
            $perPage = 3;
            $maxItems = 6;

            $menuQuery = Menu::where('kategori', $kategori)
                // ->orderBy('created_at', 'desc')
                ->take($maxItems)
                ->get();

            $menuItems = $menuQuery->slice(($page - 1) * $perPage, $perPage)->values();
            $totalPages = ceil($menuQuery->count() / $perPage);

            $view->with([
                'menuItems' => $menuItems,
                'kategoriAktif' => $kategori,
                'page' => $page,
                'totalPages' => $totalPages
            ]);
        });
    }
}