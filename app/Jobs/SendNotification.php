<?php

namespace App\Jobs;

use App\Models\Notification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue="notifications";

    protected $notification;


    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

            $this->sendNotification($this->notification);


    }

    private function sendNotification($notification){

        $user = User::query()->find($notification->to);
        if ( $user == null || $user->devices == null )
            return null;

        if ( $user == null && $notification->to == 'admin'){
            $admins = User::query()->whereHas('role', function ($q){
                $q->whereIn('slug',['admin','dev']);
            })->get();
            foreach ($admins as $admin ){
                try{
                    (new FcmMessage)
                        ->topic($notification->type)
                        ->to(array_column($admin->devices , 'device_token'))
                        ->notification([
                            'title' => 'alsaedan',
                            'body' => $notification->message,
                        ])
                        ->data($notification);
                }catch (\Exception $e){

                }

            }
        }else{
            try{
                 (new FcmMessage)
                    ->topic($notification->type)
                    ->to(array_column($user->devices , 'device_token'))
                    ->notification([
                        'title' => 'alsaedan',
                        'body' => $notification->message,
                    ])
                    ->data($notification);
            }catch (\Exception $e){

            }

        }




    }
}
