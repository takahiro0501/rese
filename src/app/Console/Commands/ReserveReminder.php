<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use App\Mail\ShopMail;
use Carbon\Carbon;


class ReserveReminder extends Command
{
    protected $signature = 'reserve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AM8:00にその日予約があるユーザにメールを送信する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->format("Y-m-d");
        $reservasions = Reservation::where('start_at','like', $today.'%' )->get();
        foreach($reservasions as $reservasion){

            $user = User::find($reservasion->user_id);
            $shop = Shop::find($reservasion->shop_id);

            $details = [
                'title' => 'Rese予約通知メール',
                'name' => $user->name,
                'body' => '予約当日となりましたので、ご連絡させて頂きます。',
                'shop_name' => $shop->shop_name,
                'datetime' => $reservasion->start_at,
                'number' => $reservasion->num_of_users
            ];
            Mail::to($user->email)->send(new ShopMail($details));
        }
    }
}
