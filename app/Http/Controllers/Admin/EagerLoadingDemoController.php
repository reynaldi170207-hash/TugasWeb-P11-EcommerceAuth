<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EagerLoadingDemoController extends Controller
{
    public function __invoke()
    {
        Model::preventLazyLoading(false);

        DB::flushQueryLog();
        DB::enableQueryLog();

        $lazy = Product::orderBy('id')->take(20)->get();
        foreach ($lazy as $product) {
            $product->category->name;
            $product->user->name;
            $product->tags->count();
        }
        $lazyQueries = DB::getQueryLog();

        DB::flushQueryLog();

        $eager = Product::with(['category', 'user', 'tags'])->orderBy('id')->take(20)->get();
        foreach ($eager as $product) {
            $product->category->name;
            $product->user->name;
            $product->tags->count();
        }
        $eagerQueries = DB::getQueryLog();

        DB::disableQueryLog();

        return view('demo.eager', [
            'lazyCount' => count($lazyQueries),
            'eagerCount' => count($eagerQueries),
            'eagerSql' => array_column($eagerQueries, 'query'),
            'rows' => $eager->count(),
        ]);
    }
}
