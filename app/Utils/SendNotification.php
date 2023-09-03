<?php


namespace App\Utils;

use App\User;
use Illuminate\Support\Facades\Log;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class SendNotification
{
    public static function fire($notification)
    {
        $user = User::query()->find($notification->user_to);
        if ($user == null || $user->devices == null) {
            return null;
        }

        if ($user == null && $notification->user_to == 'admin') {
            $admins = User::query()->whereHas('role', function ($q) {
                $q->whereIn('slug', ['admin','dev']);
            })->get();
            foreach ($admins as $admin) {
                try {
                    self::send(
                        array_column($admin->devices, 'token'),
                        $notification->message,
                        $notification->toArray()
                    );
                } catch (\Exception $e) {
                }
            }
        } else {
            try {
                self::send(
                    array_column($user->devices, 'token'),
                    $notification->message,
                    $notification->toArray()
                );

            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
    }

    private static function send($token, $message, $data_object)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Hala Events');
        $notificationBuilder->setBody($message)
            ->setClickAction("NotificationsActivity")
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data_object);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        $downstreamResponse->tokensToDelete();

        $downstreamResponse->tokensToModify();

        $downstreamResponse->tokensToRetry();
        $downstreamResponse->tokensWithError();
    }
}
