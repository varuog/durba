<?php

namespace Database\Seeders;

use App\Models\AttributeType;
use App\Models\CategoryAttribute;
use Illuminate\Database\Seeder;
use Arr;
use App\Services\CategoryService;
/**
 * @todo CSV/YAML files should be used to seed the data
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $ayush =  [ 
            'name' => 'ayush',
            'children' => [
                [ 'name' => 'unani'],
                [ 'name' =>  'homeopathy'],
                [ 'name' =>'sidha'],
                [ 'name' =>  'ayurvedh']
            ]
        ];


        $medicine = [
                'name' =>  'medicines',
                'children' => [
                    $ayush
                ],
        ];

        $appliances = [
            'name' =>  'appliances',
            'children' => [
                [ 'name' => 'covid essentials'],
                [ 'name' =>  'diabetic'],
                [ 'name' =>'general health'],
            ],
        ];


        $diagnostic = [
                'name' => 'diagnostics',
                'children' => [
                    [ 
                        'name' => 'diabetic tests'
                    ],
                ],
        ];

        $supplements = [
                'name' =>'supplements',
                'children' => [
                    [ 'name' => 'muscle gainer'],
                    [ 'name' =>  'post workout'],
                ],
        ];

        $healthConcerns = [
            'name' =>'health concerns',
            'children' => [
                [ 'name' => 'liver lare'],
                [ 'name' =>  'diabetic care'],
                [ 'name' =>  'kideny care'],
            ],
        ];

        $blog = [
            'name' =>'blog',
            'children' => [
                [ 'name' => 'health expert'],
                [ 'name' =>  'diet'],
                [ 'name' =>  'diabetic expert'],
            ],
        ];

        $products = [
            'name' =>'products',
            'children' => [$medicine, $supplements, $diagnostic, $appliances]
        ];


        $category = app('rinvex.categories.category')->create([
            'name' => [
                'en' => CategoryService::ROOT_CATEGORY,
            ],
        
            'children' => [$products, $blog, $healthConcerns],
        ]);

        //CategoryAttribute::insert($category);

        /**
         * Map attributes with category
         */
        // $categories = app('rinvex.categories.category')->get();
        // $attribs = AttributeType::get();

        // foreach($categories as $category) {
        //     if(Arr::random([0,1])) {
        //         $category->is_highlighted =1;
        //         $category->save();
        //     }
            
        //     $subsetAttrib = $attribs->random(3);
        //     foreach($subsetAttrib as $attrib) {
        //         $catMapAttr[] = [
        //                 'attribute_type_id' => $attrib->id,
        //                 'category_id' => $category->id,
        //                 'is_filterable' => Arr::random([0,1])
        //         ];
        //     }
        // }

        // CategoryAttribute::insert($catMapAttr);
    }
}
