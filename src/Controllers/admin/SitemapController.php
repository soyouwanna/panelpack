<?php

namespace Decoweb\Panelpack\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Sitemap;
use Decoweb\Panelpack\Models\Product;
use Decoweb\Panelpack\Models\Category;
use Decoweb\Panelpack\Models\Sitemap as Map;
use Illuminate\Support\Facades\Storage;
class SitemapController extends Controller
{
    public function index()
    {
        $last = Map::first();
        //dd($last->updated_at);
        return view('admin.sitemap.index',[
            'last' => $last->updated_at
        ]);
    }

    public function regenerate(Request $request)
    {
        $sitemap = Map::find(1);
        $sitemap->updated_at = Carbon::now();
        $sitemap->save();
        if($request->exists('regenerate')){

            Sitemap::addSitemap(url('/'));
            $products = Product::all();
            foreach ($products as $product) {
                if(null == $product->category_id){
                    $categorie = 'fara-categorie';
                }else{
                    $categorie = str_slug($product->category->name);
                }
                Sitemap::addTag(url('produse/'.$categorie.'/'.$product->id.'/'.str_slug($product->name)), $product->updated_at, 'daily', '0.8');
            }
            $categories = Category::all();
            foreach($categories as $cat){
                Sitemap::addTag(url('categorie/'.$cat->id.'/'.str_slug($cat->name)), $cat->updated_at, 'daily', '0.8');
            }
            Sitemap::addTag(url('/'), Carbon::now(), 'daily', '0.8');
            Sitemap::addTag(url('/servicii'), Carbon::now(), 'daily', '0.8');
            Sitemap::addTag(url('/showroom'), Carbon::now(), 'daily', '0.8');
            Sitemap::addTag(url('/despre-noi'), Carbon::now(), 'daily', '0.8');
            Sitemap::addTag(url('/contact'), Carbon::now(), 'daily', '0.8');
            Storage::disk('www')->put('sitemap.xml', Sitemap::xml() );

        }
        return redirect('admin/sitemap')->with('mesaj','Regenerare reusita!');
    }
}
