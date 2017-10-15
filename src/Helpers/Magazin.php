<?php
namespace Decoweb\Panelpack\Helpers;

use Decoweb\Panelpack\Helpers\Contracts\MagazinContract;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
class Magazin implements MagazinContract
{
    private $category;
    private $products;

    public function __construct(Model $category, Model $produse)
    {
        $this->category = $category;
        $this->products = $produse;
    }
    /**
     * Returns the parent categories(if any) for the specified category.
     *
     * @param $categorie
     * @param string $parents
     * @return bool|string
     */
    public function  breadcrumbs($categorie, $separator=' &raquo; ',&$parents=''){
        if($categorie === null){
            return '<a href="'.url('/').'" >Acasa</a> '.$separator.' ';
        }
        if($categorie->parent == 0){
            return '<a href="'.url('/').'" >Acasa</a> '.$separator.' '.'<a href="'.url('categorie/'.$categorie->id.'/'.str_slug($categorie->name)).'" >'.$categorie->name.'</a> '.$separator;
        }

        //$parent = $this->category->select('id','name','parent')->where('id',$categorie->parent)->first();
        $parent = $this->category->select('id','name','parent')->find($categorie->parent);
        $slug = str_slug($parent->name,'-');
        $parents = "<a href=\"".url('categorie/'.$parent->id.'/'.$slug)."\">".$parent->name."</a>".$separator.' '.$parents;
        $this-> breadcrumbs($parent,$separator,$parents);

        return '<a href="'.url('/').'" >Acasa</a> '.$separator.' '.$parents.' '.'<a href="'.url('categorie/'.$categorie->id.'/'.str_slug($categorie->name)).'" >'.$categorie->name.'</a> '.$separator;
    }

    /**
     * Returns the price without VAT
     *
     * @param $pret
     * @return bool|string
     */
    public function pretFaraTva($pret){

        if(empty($pret) || !is_numeric($pret)){
            return false;
        }

        $pret = (float)$pret;
        $tva = (int)config('cart.tax');
        $pretFaraTva = $pret / (($tva / 100)+1);

        return number_format($pretFaraTva,2,'.','');
    }

    /**
     * Colecteaza id-urile subcategoriilor, daca exista
     *
     * @param $id
     * @param array $subcat
     * @return array
     */
    public function getSubcategorii($id,&$subcat=[])
    {
        if( ! Schema::hasColumn($this->category->getTable(),'parent') ){
            return $subcat;
        }
        $subcategorii = $this->category->where('parent',$id)->get();
        if($subcategorii->isEmpty() === false){
            foreach($subcategorii as $subcategorie){
                $subcat[] = $subcategorie->id;
                $this->getSubcategorii($subcategorie->id,$subcat);
            }
        }

        return $subcat;
    }

    /**
     * @return Model
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return Model
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param        $idCategorie
     * @param bool   $subcategoryProducts
     * @param string $orderByName
     * @return mixed
     * @throws \Exception
     */
    public function getProduse($idCategorie ,$paginate = null, $subcategoryProducts = true ,$orderByName = 'name'){
        if( ! $this->validCategory($idCategorie) ){
            //throw new \Exception('Id-ul categoriei nu este valid!');
            if($paginate == null){
                $produse = $this->products->orderBy($orderByName)->get();
            }else{
                $produse = $this->products->orderBy($orderByName)->paginate($paginate);
            }
            return $produse;
        }
        $idCategorie = (int)$idCategorie;
        if($subcategoryProducts === true) {
            $subcategorii = $this->getSubcategorii($idCategorie);
        }
        $subcategorii[] = $idCategorie;
        if($paginate == null){
            $produse = $this->products->whereIn('category_id', $subcategorii)->orderBy($orderByName)->get();
        }else{
            $produse = $this->products->whereIn('category_id', $subcategorii)->orderBy($orderByName)->paginate($paginate);
        }
        return $produse;
    }

    public function getRandomProducts($idCategorie ,$limit = null,$skipId = null, $subcategoryProducts = true){
        if( ! $this->validCategory($idCategorie) ){
            //throw new \Exception('Id-ul categoriei nu este valid!');
            if($limit == null){
                $produse = $this->products->where('id','!=',(int)$skipId)->inRandomOrder()->get();
            }else{
                $produse = $this->products->where('id','!=',(int)$skipId)->inRandomOrder()->limit((int)$limit)->get();
            }
            return $produse;
        }
        $idCategorie = (int)$idCategorie;
        if($subcategoryProducts === true) {
            $subcategorii = $this->getSubcategorii($idCategorie);
        }
        $subcategorii[] = $idCategorie;
        if($limit == null){
            $produse = $this->products->whereIn('category_id', $subcategorii)->where('id','!=',(int)$skipId)->inRandomOrder()->get();
        }else{
            $produse = $this->products->whereIn('category_id', $subcategorii)->where('id','!=',(int)$skipId)->inRandomOrder()->limit((int)$limit)->get();
        }
        return $produse;
    }

    private function validCatIds()
    {
        $ids = $this->category->all()->pluck('id')->toArray();
        return $ids;
    }

    public function validCategory($id)
    {
        if( !is_numeric($id) ){
            return false;
        }
        $catIds = $this->validCatIds();
        if( !in_array($id,$catIds) ){
            return false;
        }
        return true;
    }

    public function metode()
    {
        echo '<pre>',print_r(get_class_methods(__CLASS__)),'</pre>';
    }
}