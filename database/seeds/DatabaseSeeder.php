<?php

use App\Restaurant;
use App\RestaurantDetail;
use App\RestaurantGallery;
use App\User;
use App\Category;
use App\Meal;
use App\Option;
use App\Extra;
use App\Menu;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();
        factory(App\Category::class, 1)->create();
        factory(App\Restaurant::class, 5)->create();
        $icecek = new Meal();
        $icecek->category_id = Category::find(1)->id;
        $icecek->name = "Coca Cola";
        $icecek->description = "CocaCola";
        $icecek->save();

        $option = new Option();
        $option->meal_id = $icecek->id;
        $option->option = 'Seçenek 1';
        $option->fee = 2;
        $option->save();

        $option2 = new Option();
        $option2->meal_id = $icecek->id;
        $option2->option = 'Seçenek 2';
        $option2->fee = 2;
        $option2->save();


        $extra = new Extra();
        $extra->meal_id = $icecek->id;
        $extra->extra = 'Extra 1';
        $extra->fee = 5;
        $extra->save();

        $extra2 = new Extra();
        $extra2->meal_id = $icecek->id;
        $extra2->extra = 'Extra 2';
        $extra2->fee = 5;
        $extra2->save();

        $menu = new Menu();
        $menu->restaurant_id = Restaurant::find(1)->id;
        $menu->name = 'Test Menüsü';
        $menu->description = 'Test Menüsü';
        $menu->save();
        $menu->categories()->attach($icecek->category_id);
        $menu->meals()->attach($icecek->id, ['fee' => 10]);

        $user = new User();
        $user->adi = 'mudurumuz';
        $user->email = 'dev3@flyistanbul.com';
        $user->mobile = '05069468693';
        $user->email_verified_at = now();
        $user->password
            = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->remember_token = Str::random(10);
        $user->role = 3;
        $user->save();

        $user2 = new User();
        $user2->adi = 'Müşterimiz';
        $user2->email = 'dev2@flyistanbul.com';
        $user2->mobile = '05069468693';
        $user2->email_verified_at = now();
        $user2->password
            = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user2->remember_token = Str::random(10);
        $user2->role = 2;
        $user2->save();

        $user3 = new User();
        $user3->adi = 'paketcimiz';
        $user3->email = 'bilgitap@flyistanbul.com';
        $user3->mobile = '05069468693';
        $user3->email_verified_at = now();
        $user3->password
            = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user3->remember_token = Str::random(10);
        $user3->role = 4;
        $user3->save();

        $restaurants = Restaurant::all();
        foreach ($restaurants as  $r) {
            $d = new RestaurantDetail();
            $d->restaurant_id = $r->id;
            $d->title = 'Deneme text';
            $d->avatar = asset('frontend/img/thumb_restaurant.jpg');
            $d->description = 'Restaurant Detail description........';
            $d->save();

            for ($i = 0; $i < 5; $i++) {
                $g = new RestaurantGallery();
                $g->restaurant_id = $r->id;
                $g->photo = asset('frontend/img/thumb_restaurant.jpg');
                $g->title = 'Phptp Title';
                $g->save();
            }
        }
    }
}