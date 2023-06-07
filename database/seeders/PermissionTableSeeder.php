<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'paid-bills',
            'unpaid-bills',
            'partialypaid-bills',
            'bills-archive',

            'add-bills',
            'bill-details',
            'bill-edit',
            'bill-delete',
            'bill-payment',
            'bill-print',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'all-member',
            'add-member',
            'edit-member',
            'show-member',
            'delete-member',


           'all-products',
           'add-products',
           'edit-products',
           'delete-products',


           'all-category',
           'add-category',
           'edit-category',
           'delete-category',
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}