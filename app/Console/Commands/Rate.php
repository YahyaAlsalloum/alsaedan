<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Business;
use App\User;
use App\Utils\SendNotification;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMail;


class Rate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $now = Carbon::now();
        $events = Event::query()
            ->where('date', $now->format('Y-m-d'))
            ->where('end_time','<=',$now->format('H:i'))
            ->whereNull('rate')
            ->get();
            

        foreach ( $events as $event ){
            $user = User::query()->find($event->user_id);

            if ( $user != null){

                $notification = new Notification([
                            'name' => 'Rate',
                            'message' => 'Rate your event ',
                            'user_from' => 'admin',
                            'type' => 'Rate',
                            'user_to' => $user->_id,
                            'data'=>[
                                'action'=>'event-rate',
                                'object_type'=>'Event',
                                'object_id'=>$event->_id,
                            ],
                            'read' => 0,
                        ]);
                $notification->save();
                try {
                    SendNotification::fire($notification);
                } catch (\Exception $e) {
                }
                



            }

            $event->rate = 1;
            $event->save();
        }
        return 0;
    }
}
