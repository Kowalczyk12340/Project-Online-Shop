<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign roles and permissions';

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
        $permissions = config('roles_permissions.permissions');
        foreach($permissions as $permission)
        {
            Permission::findOrCreate($permission);
        }

        $assigns_roles = config('roles_permissions.assigns');
        foreach($assigns_roles as $role => $permission)
        {
            $role = Role::findOrCreate($role);
            $role->syncPermissions([$permissions]);
        }

        $this->info('Creating roles and permissions done successfully');
    }

}
