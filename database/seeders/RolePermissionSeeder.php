<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            'dashboard.view',

            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Roles
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Permissions
            'permissions.view',
            'permissions.create',
            'permissions.edit',
            'permissions.delete',

            // Properties
            'properties.view',
            'properties.create',
            'properties.edit',
            'properties.delete',

            // Property Types
            'property-types.view',
            'property-types.create',
            'property-types.edit',
            'property-types.delete',

            // Configurations
            'configurations.view',
            'configurations.edit',

            // Owners
            'owners.view',
            'owners.create',
            'owners.edit',
            'owners.delete',

            // Agents
            'agents.view',
            'agents.create',
            'agents.edit',
            'agents.delete',

            // Leads
            'leads.view',
            'leads.create',
            'leads.edit',
            'leads.delete',

            // Property Visits
            'property-visits.view',
            'property-visits.create',
            'property-visits.edit',
            'property-visits.delete',

            // Bookings
            'bookings.view',
            'bookings.create',
            'bookings.edit',
            'bookings.delete',

            // Tenants
            'tenants.view',
            'tenants.create',
            'tenants.edit',
            'tenants.delete',

            // Rental Agreements
            'rental-agreements.view',
            'rental-agreements.create',
            'rental-agreements.edit',
            'rental-agreements.delete',

            // Rent Payments
            'rent-payments.view',
            'rent-payments.create',
            'rent-payments.edit',
            'rent-payments.delete',

            // Maintenance
            'maintenance.view',
            'maintenance.create',
            'maintenance.edit',
            'maintenance.delete',

            // Vendors
            'vendors.view',
            'vendors.create',
            'vendors.edit',
            'vendors.delete',

            // Expenses
            'expenses.view',
            'expenses.create',
            'expenses.edit',
            'expenses.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission,
                    'guard_name' => 'web',
                ]
            );
        }

        // Admin Role
        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        // Admin gets every permission
        $admin->syncPermissions(
            Permission::where('guard_name', 'web')->get()
        );
    }
}