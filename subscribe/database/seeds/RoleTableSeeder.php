<?php
use App\Subscription;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current = Carbon::now();

        $subscription_normal = new Subscription();
        $subscription_normal->name = 'normal';
        $subscription_normal->details = 'No Subscription';
        $subscription_normal->save();

        $subscription_standard = new Subscription();
        $subscription_standard->name = 'standard';
        $subscription_standard->details = 'Normal Subscription';
        $subscription_standard->ends_at = $current->addDays(365);
        $subscription_standard->save();

        $subscription_premium = new Subscription();
        $subscription_premium->name = 'premium';
        $subscription_premium->details = 'Premium Subscription';
        $subscription_premium->ends_at = $current->addDays(365);
        $subscription_premium->save();
    }
}
