<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Src\Role\RoleRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\DB;

class AssignSubscriberForNewUser extends Job implements SelfHandling
{
    public $userId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('user_roles')->insert([
            'user_id' => $this->userId,
            'role_id' => '3'
        ]);
    }
}
