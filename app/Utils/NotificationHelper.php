<?php


namespace App\Utils;


use App\Events\NotificationEvent;

trait NotificationHelper
{
    public function sendNotification($to, $from, $message, $title, $type, $object)
    {
        /**
         * Sample of sending notification
         * $notification = array();
         * Auth::user()->id for current id , or u can use any other user id
         * PS the object will be saved as json encode
         * comment, new request , updated status
         */

        $notification['to'] = array_values(array_unique($to->toArray())); // [] for all  users ,[1,2,3] for specific ids , 1 for one user
        $notification['from'] = $from;
        $notification['message'] = $message; // required
        $notification['title'] = $title; // optional
        $notification['type'] = $type;
        $notification['object'] = $object; //set the whole object in the notification record in case u need it to use the id or name of this object

        event(new NotificationEvent($notification));
    }
}
