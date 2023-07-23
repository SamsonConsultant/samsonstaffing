<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $menus = [
            ['menu_title' => 'Primary Menu', 'sort_order' => 0, 'slug' => 'primary-menu'],            
            ['menu_title' => 'Footer Menu 1', 'sort_order' => 0, 'slug' => 'footer-menu-1'],            
            ['menu_title' => 'Footer Menu 2', 'sort_order' => 0, 'slug' => 'footer-menu-2'],            
        ];

        foreach ($menus as $menu) {
            \App\Models\Menu::Create($menu);
        }
    }
}
