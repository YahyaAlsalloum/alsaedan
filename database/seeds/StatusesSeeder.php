<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::query()->truncate();

        $status = new Status();
        $status->name = 'Active';
        $status->slug = 'active';
        $status->color = '#8bc34a';
        $status->save();

        $status = new Status();
        $status->name = 'InActive';
        $status->slug = 'in-active';
        $status->color = '#f44336';
        $status->save();

        $status = new Status();
        $status->name = 'Pending';
        $status->slug = 'pending';
        $status->color = '#ffc107';
        $status->save();

        $status = new Status();
        $status->name = 'Requested';
        $status->slug = 'requested';
        $status->color = '#FF9800';
        $status->save();

        $status = new Status();
        $status->name = 'Accepted';
        $status->slug = 'accepted';
        $status->color = '#2196F3';
        $status->save();

        $status = new Status();
        $status->name = 'Declined';
        $status->slug = 'declined';
        $status->color = '#795548';
        $status->save();


        $status = new Status();
        $status->name = 'Rejected';
        $status->slug = 'rejected';
        $status->color = '#795548';
        $status->save();

        $status = new Status();
        $status->name = 'Canceled';
        $status->slug = 'canceled';
        $status->color = '#795548';
        $status->save();

        $status = new Status();
        $status->name = 'Banned';
        $status->slug = 'banned';
        $status->color = '#795548';
        $status->save();


        $status = new Status();
        $status->name = 'Hold';
        $status->slug = 'hold';
        $status->color = '#795548';
        $status->save();


        $status = new Status();
        $status->name = 'In Review';
        $status->slug = 'in-review';
        $status->color = '#795548';
        $status->save();
    }
}
