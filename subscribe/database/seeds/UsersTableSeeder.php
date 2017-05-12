<?php
use App\User;
use App\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subs_normal = Subscription::where('name', 'normal')->first();
        $subs_standard = Subscription::where('name', 'standard')->first();
        $subs_premium = Subscription::where('name', 'premium')->first();

        $user = new User();
        $user->name = "User";
        $user->email = "user@user.com";
        $user->password = bcrypt('visitor');
        $user->verify_token = Str::random(30);
        $user->verify_status = true;
        $user->save();
        $user->subscriptions()->attach($subs_normal);

        $standard = new User();
        $standard->name = "Standard";
        $standard->email = "standard@standard.com";
        $standard->password = bcrypt('visitor');
        $standard->verify_token = Str::random(30);
        $standard->verify_status = true;
        $standard->save();
        $standard->subscriptions()->attach($subs_standard);

        $premium = new User();
        $premium->name = "premium";
        $premium->email = "premium@premium.com";
        $premium->password = bcrypt('visitor');
        $premium->verify_token = Str::random(30);
        $premium->verify_status = true;
        $premium->save();
        $premium->subscriptions()->attach($subs_premium);
    }
}
