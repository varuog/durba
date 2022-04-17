<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Product;
use Http; 
use Auth;
use Traversable;
use Str;

class CategoryService {

    const ROOT_CATEGORY = 'core';
    const BASE_CAT_PRODUCTS = 'core';
    const BASE_CAT_BLOG = 'blogs';
    const BASE_CAT_HEALTH_CONCERNS = 'health concerns';


    public function search(array $filter = [], array $sort=[]) : Traversable {
        //Default sorting
        // if(empty($sort)) {
        //     $sort['created_at'] = 'desc';
        // }

        /**
         * Filter
         */
        $baseCategory = $filter['category_id'] ?? 1; // root id 1 default fallback
        $root = app('rinvex.categories.category')->find($baseCategory);

        if(!empty($filter['is_highlighted'])) {
            $root->where('is_highlighted', $filter['is_highlighted']);
        }
        
        $categories = $root->descendants->toTree($root);

       return $categories;
    }


    public function fetchPopularCategories() {
        $baseCategory= $this->fetchByName('products');
        $filter['category_id'] = $baseCategory->id;
        $filter['is_highlighted'] = true;

        return $this->search($filter, []);
    }


    public function fetchByName($name) {
        $lang = config('app.locale');
        //dd($name, $lang);
        $category = app('rinvex.categories.category')->where("name->{$lang}", $name)
            ->firstOrFail();
        return $category;
    }

    public function fetchById($id) {
        //dd($name, $lang);
        $category = app('rinvex.categories.category')->where("id", $id)
            ->firstOrFail();
        return $category;
    }


    /**
     * Fetch All categoriy ids under a specific category. Also filterable by name
     * @param int $category base category id
     * @param string $name optinal name filter
     * @param bool $wtihParent whether base category should be returned in list
     * @return array of ids
     */
    public function fetchDecendentsId($category, $name=null , bool $wtihParent =true) : Traversable {
        $parentCategory = app('rinvex.categories.category')->find($category);
        $categoryQuery = $parentCategory->descendants();

        if(!empty($name)) {
            $locale = config('app.locale');
            $categoryQuery->where("name->{$locale}", $name);
        }

        $categories = $categoryQuery->pluck('id');
        if($wtihParent) {
            $categories[] = $parentCategory->getKey();
        }

        return $categories;
    }


    public function fetchHighLightedCategories($category, $isHighlighted=null , bool $wtihParent =true) : Traversable {
        //dd($category);
        $parentCategory = app('rinvex.categories.category')->find($category->id);
        //dd($parentCategory);
        $categoryQuery = $parentCategory->descendants;

        if(!is_null($isHighlighted)) {
            $categoryQuery->where("isHighlighted", $isHighlighted);
        }

        $categories = $categoryQuery->pluck('id');
        if($wtihParent) {
            $categories[] = $parentCategory->getKey();
        }

        return $categories;
    }

    public function fetchAllHighlightedCategories() : Traversable {
        return app('rinvex.categories.category')->where('is_highlighted', true)->get();
    }

    public function fetchCategoriesById(Traversable $ids) {
        return app('rinvex.categories.category')->whereIn('id', $ids)->get();
    }

    public function fetchTreeByName($categoryName, $isFlat=false) {

        $baseCategory = $this->fetchByName($categoryName);
        $catQuery =  app('rinvex.categories.category')
            ->descendantsOf($baseCategory->id);
        
        if($isFlat) {
            $categories = $catQuery->toFlatTree();
        } else {
            //dd('ss');
            $categories = $catQuery->toTree($baseCategory->id);
        }

        return $categories;
    }


    public function formatJqTree($categories, $f=true) {
        //dd($categories);

        array_walk( $categories, function(&$category) {
            //dump($category);
            $name = Str::title($category['name']);
            $children = $category['children'] ?? [];
            $catId = $category['id'];
    
            $category=[];
            $category['label'] = $name;

            $category['id'] = $catId;

            //dump($children);
            if(!empty($children)){
                $children = $this->formatJqTree($children, false);
                //dump($children);
            }

            $category['children'] = $children;

        });
       
        //dd($categories);
        return $categories;
    }

    public function formatForBootStrap($categories, $f=true) {
        //dump($f, $categories);

        array_walk( $categories, function(&$category) {
            //dump($category);
            $name = Str::title($category['name']);
            $children = $category['children'] ?? [];
            $catId = $category['id'];
    
            $category=[];
            $category['text'] = $name;

            $category['icon'] = 'glyphicon glyphicon-stop';
            $category['selectedIcon'] = 'glyphicon glyphicon-stop';
            $category['href'] = route('admin.category.index', ['category_id' => $catId] ); //@todo

            //dump($children);
            if(!empty($children)){
                $children = $this->formatForBootStrap($children, false);
                //dump($children);
            }

            $category['nodes'] = $children;

        });
       
        //dd($categories);
        return $categories;
    }

    public function create(array $data) {
        $category = app('rinvex.categories.category')->fill($data);
            $category->save(); // Saved as root
    }

    public function update($category, array $data) {
        $lang = config('app.locale');

        $category->name= [$lang => $data['name']];
        $category->description= [$lang => $data['description']];
        $category->generateSlug();
            $category->save(); // Saved as root
    }
}