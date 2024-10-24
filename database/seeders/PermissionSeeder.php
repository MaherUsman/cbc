<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the permissions table
        Permission::truncate();

        // Clear permission cache
        app()['cache']->forget('spatie.permission.cache');

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define all permissions
        $permissions = [
            ['name' => 'view-dashboard', 'display_name' => 'View Dashboard'],
            ['name' => 'create-dashboard', 'display_name' => 'Create Dashboard'],
            ['name' => 'edit-dashboard', 'display_name' => 'Edit Dashboard'],
            ['name' => 'delete-dashboard', 'display_name' => 'Delete Dashboard'],
            ['name' => 'view-event', 'display_name' => 'View Event'],
            ['name' => 'create-event', 'display_name' => 'Create Event'],
            ['name' => 'edit-event', 'display_name' => 'Edit Event'],
            ['name' => 'delete-event', 'display_name' => 'Delete Event'],
            ['name' => 'view-intro', 'display_name' => 'View Introduction'],
            ['name' => 'create-intro', 'display_name' => 'Create Introduction'],
            ['name' => 'edit-intro', 'display_name' => 'Edit Introduction'],
            ['name' => 'delete-intro', 'display_name' => 'Delete Introduction'],
            ['name' => 'view-slider', 'display_name' => 'View Slider'],
            ['name' => 'create-slider', 'display_name' => 'Create Slider'],
            ['name' => 'edit-slider', 'display_name' => 'Edit Slider'],
            ['name' => 'delete-slider', 'display_name' => 'Delete Slider'],
            ['name' => 'view-about-us', 'display_name' => 'View About Us'],
            ['name' => 'create-about-us', 'display_name' => 'Create About Us'],
            ['name' => 'edit-about-us', 'display_name' => 'Edit About Us'],
            ['name' => 'delete-about-us', 'display_name' => 'Delete About Us'],
            ['name' => 'view-about-us-gallery', 'display_name' => 'View About Us Gallery'],
            ['name' => 'create-about-us-gallery', 'display_name' => 'Create About Us Gallery'],
            ['name' => 'edit-about-us-gallery', 'display_name' => 'Edit About Us Gallery'],
            ['name' => 'delete-about-us-gallery', 'display_name' => 'Delete About Us Gallery'],
            ['name' => 'view-animal', 'display_name' => 'View Animal'],
            ['name' => 'create-animal', 'display_name' => 'Create Animal'],
            ['name' => 'edit-animal', 'display_name' => 'Edit Animal'],
            ['name' => 'delete-animal', 'display_name' => 'Delete Animal'],
            ['name' => 'view-animal-category', 'display_name' => 'View Animal Category'],
            ['name' => 'create-animal-category', 'display_name' => 'Create Animal Category'],
            ['name' => 'edit-animal-category', 'display_name' => 'Edit Animal Category'],
            ['name' => 'delete-animal-category', 'display_name' => 'Delete Animal Category'],
            ['name' => 'view-tobas-gallery', 'display_name' => 'View Tobas Gallery'],
            ['name' => 'create-tobas-gallery', 'display_name' => 'Create Tobas Gallery'],
            ['name' => 'edit-tobas-gallery', 'display_name' => 'Edit Tobas Gallery'],
            ['name' => 'delete-tobas-gallery', 'display_name' => 'Delete Tobas Gallery'],
            ['name' => 'view-visitor-gallery', 'display_name' => 'View Visitor Gallery'],
            ['name' => 'create-visitor-gallery', 'display_name' => 'Create Visitor Gallery'],
            ['name' => 'edit-visitor-gallery', 'display_name' => 'Edit Visitor Gallery'],
            ['name' => 'delete-visitor-gallery', 'display_name' => 'Delete Visitor Gallery'],
            ['name' => 'view-activity-gallery', 'display_name' => 'View Activity Gallery'],
            ['name' => 'create-activity-gallery', 'display_name' => 'Create Activity Gallery'],
            ['name' => 'edit-activity-gallery', 'display_name' => 'Edit Activity Gallery'],
            ['name' => 'delete-activity-gallery', 'display_name' => 'Delete Activity Gallery'],
            ['name' => 'view-team', 'display_name' => 'View Team'],
            ['name' => 'create-team', 'display_name' => 'Create Team'],
            ['name' => 'edit-team', 'display_name' => 'Edit Team'],
            ['name' => 'delete-team', 'display_name' => 'Delete Team'],
            ['name' => 'view-setting', 'display_name' => 'View Setting'],
            ['name' => 'create-setting', 'display_name' => 'Create Setting'],
            ['name' => 'edit-setting', 'display_name' => 'Edit Setting'],
            ['name' => 'delete-setting', 'display_name' => 'Delete Setting'],
            ['name' => 'view-job', 'display_name' => 'View Job'],
            ['name' => 'create-job', 'display_name' => 'Create Job'],
            ['name' => 'edit-job', 'display_name' => 'Edit Job'],
            ['name' => 'delete-job', 'display_name' => 'Delete Job'],
            ['name' => 'view-contact-us', 'display_name' => 'View Contact Us'],
            ['name' => 'create-contact-us', 'display_name' => 'Create Contact Us'],
            ['name' => 'edit-contact-us', 'display_name' => 'Edit Contact Us'],
            ['name' => 'delete-contact-us', 'display_name' => 'Delete Contact Us'],
            ['name' => 'view-career', 'display_name' => 'View Career'],
            ['name' => 'create-career', 'display_name' => 'Create Career'],
            ['name' => 'edit-career', 'display_name' => 'Edit Career'],
            ['name' => 'delete-career', 'display_name' => 'Delete Career'],
        ];

        // Insert all permissions at once
        Permission::insert($permissions);
    }
}
