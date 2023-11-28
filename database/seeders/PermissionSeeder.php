<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premissions = [
            // 'Invoices-list',
            // 'Invoice-detalis-show',
            // 'Invoice-create',
            // 'Invoices-edit',
            // 'Invoices-edit-status',
            // 'Invoices-export-excel',
            // 'Attachment-download',
            // 'Attachment-show',
            // 'Attachment-delete',
            // 'Invoices-delete',
            // 'Invoices-archive',
            // 'Invoices-unarchive',
            // 'Invoices-paid-show',
            // 'Invoices-unpaid-status',
            // 'Invoices-partially-paid-show',
            // 'Invoices-archive-show',
            'Users-reports-show',
            'Invoices-reports-show',
            'User-list',
            'User-create',
            'User-edit',
            'User-delete',
            'Permission-list',
            'Permission-create',
            'Permission-edit',
            'Permission-delete',
            'Products-list',
            'Products-create',
            'Products-edit',
            'Products-delete',
            'Sections-list',
            'Sections-create',
            'Sections-update',
            'Sections-delete',
        ];
        foreach ($premissions as  $premission) {
            Permission::create(['name' => $premission]);
        }
    }
}
