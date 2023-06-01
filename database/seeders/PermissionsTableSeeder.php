<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_access',
            ],
            [
                'id'    => 6,
                'title' => 'role_create',
            ],
            [
                'id'    => 7,
                'title' => 'role_edit',
            ],
            [
                'id'    => 8,
                'title' => 'role_show',
            ],
            [
                'id'    => 9,
                'title' => 'role_delete',
            ],
            [
                'id'    => 10,
                'title' => 'role_access',
            ],
            [
                'id'    => 11,
                'title' => 'user_create',
            ],
            [
                'id'    => 12,
                'title' => 'user_edit',
            ],
            [
                'id'    => 13,
                'title' => 'user_show',
            ],
            [
                'id'    => 14,
                'title' => 'user_access',
            ],
            [
                'id'    => 15,
                'title' => 'title_create',
            ],
            [
                'id'    => 16,
                'title' => 'title_edit',
            ],
            [
                'id'    => 17,
                'title' => 'title_show',
            ],
            [
                'id'    => 18,
                'title' => 'title_access',
            ],
            [
                'id'    => 19,
                'title' => 'administrative_role_access',
            ],
            [
                'id'    => 20,
                'title' => 'marital_status_create',
            ],
            [
                'id'    => 21,
                'title' => 'marital_status_edit',
            ],
            [
                'id'    => 22,
                'title' => 'marital_status_show',
            ],
            [
                'id'    => 23,
                'title' => 'marital_status_delete',
            ],
            [
                'id'    => 24,
                'title' => 'marital_status_access',
            ],
            [
                'id'    => 25,
                'title' => 'misc_access',
            ],
            [
                'id'    => 26,
                'title' => 'employment_status_create',
            ],
            [
                'id'    => 27,
                'title' => 'employment_status_edit',
            ],
            [
                'id'    => 28,
                'title' => 'employment_status_show',
            ],
            [
                'id'    => 29,
                'title' => 'employment_status_delete',
            ],
            [
                'id'    => 30,
                'title' => 'employment_status_access',
            ],
            [
                'id'    => 31,
                'title' => 'member_create',
            ],
            [
                'id'    => 32,
                'title' => 'member_edit',
            ],
            [
                'id'    => 33,
                'title' => 'member_show',
            ],
            [
                'id'    => 34,
                'title' => 'member_delete',
            ],
            [
                'id'    => 35,
                'title' => 'member_access',
            ],
            [
                'id'    => 36,
                'title' => 'qualification_setting_create',
            ],
            [
                'id'    => 37,
                'title' => 'qualification_setting_edit',
            ],
            [
                'id'    => 38,
                'title' => 'qualification_setting_show',
            ],
            [
                'id'    => 39,
                'title' => 'qualification_setting_delete',
            ],
            [
                'id'    => 40,
                'title' => 'qualification_setting_access',
            ],
            [
                'id'    => 41,
                'title' => 'qualification_create',
            ],
            [
                'id'    => 42,
                'title' => 'qualification_edit',
            ],
            [
                'id'    => 43,
                'title' => 'qualification_show',
            ],
            [
                'id'    => 44,
                'title' => 'qualification_delete',
            ],
            [
                'id'    => 45,
                'title' => 'qualification_access',
            ],
            [
                'id'    => 46,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 47,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 48,
                'title' => 'spouse_detail_create',
            ],
            [
                'id'    => 49,
                'title' => 'spouse_detail_edit',
            ],
            [
                'id'    => 50,
                'title' => 'spouse_detail_show',
            ],
            [
                'id'    => 51,
                'title' => 'spouse_detail_delete',
            ],
            [
                'id'    => 52,
                'title' => 'spouse_detail_access',
            ],
            [
                'id'    => 53,
                'title' => 'child_create',
            ],
            [
                'id'    => 54,
                'title' => 'child_edit',
            ],
            [
                'id'    => 55,
                'title' => 'child_show',
            ],
            [
                'id'    => 56,
                'title' => 'child_delete',
            ],
            [
                'id'    => 57,
                'title' => 'child_access',
            ],
            [
                'id'    => 58,
                'title' => 'industry_sector_create',
            ],
            [
                'id'    => 59,
                'title' => 'industry_sector_edit',
            ],
            [
                'id'    => 60,
                'title' => 'industry_sector_show',
            ],
            [
                'id'    => 61,
                'title' => 'industry_sector_delete',
            ],
            [
                'id'    => 62,
                'title' => 'industry_sector_access',
            ],
            [
                'id'    => 63,
                'title' => 'employment_detail_create',
            ],
            [
                'id'    => 64,
                'title' => 'employment_detail_edit',
            ],
            [
                'id'    => 65,
                'title' => 'employment_detail_show',
            ],
            [
                'id'    => 66,
                'title' => 'employment_detail_delete',
            ],
            [
                'id'    => 67,
                'title' => 'employment_detail_access',
            ],
            [
                'id'    => 68,
                'title' => 'church_affiliation_access',
            ],
            [
                'id'    => 69,
                'title' => 'cihzone_create',
            ],
            [
                'id'    => 70,
                'title' => 'cihzone_edit',
            ],
            [
                'id'    => 71,
                'title' => 'cihzone_show',
            ],
            [
                'id'    => 72,
                'title' => 'cihzone_delete',
            ],
            [
                'id'    => 73,
                'title' => 'cihzone_access',
            ],
            [
                'id'    => 74,
                'title' => 'organization_type_create',
            ],
            [
                'id'    => 75,
                'title' => 'organization_type_edit',
            ],
            [
                'id'    => 76,
                'title' => 'organization_type_show',
            ],
            [
                'id'    => 77,
                'title' => 'organization_type_delete',
            ],
            [
                'id'    => 78,
                'title' => 'organization_type_access',
            ],
            [
                'id'    => 79,
                'title' => 'department_create',
            ],
            [
                'id'    => 80,
                'title' => 'department_edit',
            ],
            [
                'id'    => 81,
                'title' => 'department_show',
            ],
            [
                'id'    => 82,
                'title' => 'department_delete',
            ],
            [
                'id'    => 83,
                'title' => 'department_access',
            ],
            [
                'id'    => 84,
                'title' => 'affinity_group_create',
            ],
            [
                'id'    => 85,
                'title' => 'affinity_group_edit',
            ],
            [
                'id'    => 86,
                'title' => 'affinity_group_show',
            ],
            [
                'id'    => 87,
                'title' => 'affinity_group_access',
            ],
            [
                'id'    => 88,
                'title' => 'mountains_of_influence_create',
            ],
            [
                'id'    => 89,
                'title' => 'mountains_of_influence_edit',
            ],
            [
                'id'    => 90,
                'title' => 'mountains_of_influence_show',
            ],
            [
                'id'    => 91,
                'title' => 'mountains_of_influence_delete',
            ],
            [
                'id'    => 92,
                'title' => 'mountains_of_influence_access',
            ],
            [
                'id'    => 93,
                'title' => 'ats_membership_record_create',
            ],
            [
                'id'    => 94,
                'title' => 'ats_membership_record_edit',
            ],
            [
                'id'    => 95,
                'title' => 'ats_membership_record_show',
            ],
            [
                'id'    => 96,
                'title' => 'ats_membership_record_delete',
            ],
            [
                'id'    => 97,
                'title' => 'ats_membership_record_access',
            ],
            [
                'id'    => 98,
                'title' => 'members_affinity_group_create',
            ],
            [
                'id'    => 99,
                'title' => 'members_affinity_group_edit',
            ],
            [
                'id'    => 100,
                'title' => 'members_affinity_group_show',
            ],
            [
                'id'    => 101,
                'title' => 'members_affinity_group_delete',
            ],
            [
                'id'    => 102,
                'title' => 'members_affinity_group_access',
            ],
            [
                'id'    => 103,
                'title' => 'ats_membership_create',
            ],
            [
                'id'    => 104,
                'title' => 'ats_membership_edit',
            ],
            [
                'id'    => 105,
                'title' => 'ats_membership_show',
            ],
            [
                'id'    => 106,
                'title' => 'ats_membership_delete',
            ],
            [
                'id'    => 107,
                'title' => 'ats_membership_access',
            ],
            [
                'id'    => 108,
                'title' => 'join_department_create',
            ],
            [
                'id'    => 109,
                'title' => 'join_department_edit',
            ],
            [
                'id'    => 110,
                'title' => 'join_department_show',
            ],
            [
                'id'    => 111,
                'title' => 'join_department_delete',
            ],
            [
                'id'    => 112,
                'title' => 'join_department_access',
            ],
            [
                'id'    => 113,
                'title' => 'missionary_force_create',
            ],
            [
                'id'    => 114,
                'title' => 'missionary_force_edit',
            ],
            [
                'id'    => 115,
                'title' => 'missionary_force_show',
            ],
            [
                'id'    => 116,
                'title' => 'missionary_force_access',
            ],
            [
                'id'    => 117,
                'title' => 'sport_create',
            ],
            [
                'id'    => 118,
                'title' => 'sport_edit',
            ],
            [
                'id'    => 119,
                'title' => 'sport_show',
            ],
            [
                'id'    => 120,
                'title' => 'sport_delete',
            ],
            [
                'id'    => 121,
                'title' => 'sport_access',
            ],
            [
                'id'    => 122,
                'title' => 'interest_create',
            ],
            [
                'id'    => 123,
                'title' => 'interest_edit',
            ],
            [
                'id'    => 124,
                'title' => 'interest_show',
            ],
            [
                'id'    => 125,
                'title' => 'interest_delete',
            ],
            [
                'id'    => 126,
                'title' => 'interest_access',
            ],
            [
                'id'    => 127,
                'title' => 'venue_management_access',
            ],
            [
                'id'    => 128,
                'title' => 'location_create',
            ],
            [
                'id'    => 129,
                'title' => 'location_edit',
            ],
            [
                'id'    => 130,
                'title' => 'location_show',
            ],
            [
                'id'    => 131,
                'title' => 'location_delete',
            ],
            [
                'id'    => 132,
                'title' => 'location_access',
            ],
            [
                'id'    => 133,
                'title' => 'venue_accessory_create',
            ],
            [
                'id'    => 134,
                'title' => 'venue_accessory_edit',
            ],
            [
                'id'    => 135,
                'title' => 'venue_accessory_show',
            ],
            [
                'id'    => 136,
                'title' => 'venue_accessory_delete',
            ],
            [
                'id'    => 137,
                'title' => 'venue_accessory_access',
            ],
            [
                'id'    => 138,
                'title' => 'venue_create',
            ],
            [
                'id'    => 139,
                'title' => 'venue_edit',
            ],
            [
                'id'    => 140,
                'title' => 'venue_show',
            ],
            [
                'id'    => 141,
                'title' => 'venue_delete',
            ],
            [
                'id'    => 142,
                'title' => 'venue_access',
            ],
            [
                'id'    => 143,
                'title' => 'meeting_management_access',
            ],
            [
                'id'    => 144,
                'title' => 'meeting_create',
            ],
            [
                'id'    => 145,
                'title' => 'meeting_edit',
            ],
            [
                'id'    => 146,
                'title' => 'meeting_show',
            ],
            [
                'id'    => 147,
                'title' => 'meeting_delete',
            ],
            [
                'id'    => 148,
                'title' => 'meeting_access',
            ],
            [
                'id'    => 149,
                'title' => 'notification_management_access',
            ],
            [
                'id'    => 150,
                'title' => 'appointment_management_access',
            ],
            [
                'id'    => 151,
                'title' => 'appointment_booking_create',
            ],
            [
                'id'    => 152,
                'title' => 'appointment_booking_edit',
            ],
            [
                'id'    => 153,
                'title' => 'appointment_booking_show',
            ],
            [
                'id'    => 154,
                'title' => 'appointment_booking_delete',
            ],
            [
                'id'    => 155,
                'title' => 'appointment_booking_access',
            ],
            [
                'id'    => 156,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 157,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 158,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 159,
                'title' => 'membership_access',
            ],
            [
                'id'    => 160,
                'title' => 'accessibility_feature_create',
            ],
            [
                'id'    => 161,
                'title' => 'accessibility_feature_edit',
            ],
            [
                'id'    => 162,
                'title' => 'accessibility_feature_show',
            ],
            [
                'id'    => 163,
                'title' => 'accessibility_feature_delete',
            ],
            [
                'id'    => 164,
                'title' => 'accessibility_feature_access',
            ],
            [
                'id'    => 165,
                'title' => 'event_create',
            ],
            [
                'id'    => 166,
                'title' => 'event_edit',
            ],
            [
                'id'    => 167,
                'title' => 'event_show',
            ],
            [
                'id'    => 168,
                'title' => 'event_delete',
            ],
            [
                'id'    => 169,
                'title' => 'event_access',
            ],
            [
                'id'    => 170,
                'title' => 'booking_create',
            ],
            [
                'id'    => 171,
                'title' => 'booking_edit',
            ],
            [
                'id'    => 172,
                'title' => 'booking_show',
            ],
            [
                'id'    => 173,
                'title' => 'booking_delete',
            ],
            [
                'id'    => 174,
                'title' => 'booking_access',
            ],
            [
                'id'    => 175,
                'title' => 'notification_create',
            ],
            [
                'id'    => 176,
                'title' => 'notification_edit',
            ],
            [
                'id'    => 177,
                'title' => 'notification_show',
            ],
            [
                'id'    => 178,
                'title' => 'notification_delete',
            ],
            [
                'id'    => 179,
                'title' => 'notification_access',
            ],
            [
                'id'    => 180,
                'title' => 'outreach_create',
            ],
            [
                'id'    => 181,
                'title' => 'outreach_edit',
            ],
            [
                'id'    => 182,
                'title' => 'outreach_show',
            ],
            [
                'id'    => 183,
                'title' => 'outreach_delete',
            ],
            [
                'id'    => 184,
                'title' => 'outreach_access',
            ],
            [
                'id'    => 185,
                'title' => 'outreach_type_create',
            ],
            [
                'id'    => 186,
                'title' => 'outreach_type_edit',
            ],
            [
                'id'    => 187,
                'title' => 'outreach_type_show',
            ],
            [
                'id'    => 188,
                'title' => 'outreach_type_delete',
            ],
            [
                'id'    => 189,
                'title' => 'outreach_type_access',
            ],
            [
                'id'    => 190,
                'title' => 'outreach_and_mission_access',
            ],
            [
                'id'    => 191,
                'title' => 'first_timer_create',
            ],
            [
                'id'    => 192,
                'title' => 'first_timer_edit',
            ],
            [
                'id'    => 193,
                'title' => 'first_timer_show',
            ],
            [
                'id'    => 194,
                'title' => 'first_timer_delete',
            ],
            [
                'id'    => 195,
                'title' => 'first_timer_access',
            ],
            [
                'id'    => 196,
                'title' => 'issue_management_create',
            ],
            [
                'id'    => 197,
                'title' => 'issue_management_edit',
            ],
            [
                'id'    => 198,
                'title' => 'issue_management_show',
            ],
            [
                'id'    => 199,
                'title' => 'issue_management_delete',
            ],
            [
                'id'    => 200,
                'title' => 'issue_management_access',
            ],
            [
                'id'    => 201,
                'title' => 'goal_create',
            ],
            [
                'id'    => 202,
                'title' => 'goal_edit',
            ],
            [
                'id'    => 203,
                'title' => 'goal_show',
            ],
            [
                'id'    => 204,
                'title' => 'goal_delete',
            ],
            [
                'id'    => 205,
                'title' => 'goal_access',
            ],
            [
                'id'    => 206,
                'title' => 'attendance_management_create',
            ],
            [
                'id'    => 207,
                'title' => 'attendance_management_edit',
            ],
            [
                'id'    => 208,
                'title' => 'attendance_management_show',
            ],
            [
                'id'    => 209,
                'title' => 'attendance_management_delete',
            ],
            [
                'id'    => 210,
                'title' => 'attendance_management_access',
            ],
            [
                'id'    => 211,
                'title' => 'reminder_create',
            ],
            [
                'id'    => 212,
                'title' => 'reminder_edit',
            ],
            [
                'id'    => 213,
                'title' => 'reminder_show',
            ],
            [
                'id'    => 214,
                'title' => 'reminder_delete',
            ],
            [
                'id'    => 215,
                'title' => 'reminder_access',
            ],
            [
                'id'    => 216,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 217,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 218,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 219,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 220,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 221,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 222,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 223,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 224,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 225,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 226,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 227,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 228,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 229,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 230,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 231,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 232,
                'title' => 'asset_create',
            ],
            [
                'id'    => 233,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 234,
                'title' => 'asset_show',
            ],
            [
                'id'    => 235,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 236,
                'title' => 'asset_access',
            ],
            [
                'id'    => 237,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 238,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 239,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 240,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 241,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 242,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 243,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 244,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 245,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 246,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 247,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 248,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 249,
                'title' => 'task_create',
            ],
            [
                'id'    => 250,
                'title' => 'task_edit',
            ],
            [
                'id'    => 251,
                'title' => 'task_show',
            ],
            [
                'id'    => 252,
                'title' => 'task_delete',
            ],
            [
                'id'    => 253,
                'title' => 'task_access',
            ],
            [
                'id'    => 254,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 255,
                'title' => 'cih_management_access',
            ],
            [
                'id'    => 256,
                'title' => 'cih_request_create',
            ],
            [
                'id'    => 257,
                'title' => 'cih_request_edit',
            ],
            [
                'id'    => 258,
                'title' => 'cih_request_show',
            ],
            [
                'id'    => 259,
                'title' => 'cih_request_delete',
            ],
            [
                'id'    => 260,
                'title' => 'cih_request_access',
            ],
            [
                'id'    => 261,
                'title' => 'cih_centers_inspection_create',
            ],
            [
                'id'    => 262,
                'title' => 'cih_centers_inspection_edit',
            ],
            [
                'id'    => 263,
                'title' => 'cih_centers_inspection_show',
            ],
            [
                'id'    => 264,
                'title' => 'cih_centers_inspection_delete',
            ],
            [
                'id'    => 265,
                'title' => 'cih_centers_inspection_access',
            ],
            [
                'id'    => 266,
                'title' => 'inspectorate_group_create',
            ],
            [
                'id'    => 267,
                'title' => 'inspectorate_group_edit',
            ],
            [
                'id'    => 268,
                'title' => 'inspectorate_group_show',
            ],
            [
                'id'    => 269,
                'title' => 'inspectorate_group_delete',
            ],
            [
                'id'    => 270,
                'title' => 'inspectorate_group_access',
            ],
            [
                'id'    => 271,
                'title' => 'ancillary_service_access',
            ],
            [
                'id'    => 272,
                'title' => 'ancillary_management_create',
            ],
            [
                'id'    => 273,
                'title' => 'ancillary_management_edit',
            ],
            [
                'id'    => 274,
                'title' => 'ancillary_management_show',
            ],
            [
                'id'    => 275,
                'title' => 'ancillary_management_delete',
            ],
            [
                'id'    => 276,
                'title' => 'ancillary_management_access',
            ],
            [
                'id'    => 277,
                'title' => 'service_type_create',
            ],
            [
                'id'    => 278,
                'title' => 'service_type_edit',
            ],
            [
                'id'    => 279,
                'title' => 'service_type_show',
            ],
            [
                'id'    => 280,
                'title' => 'service_type_delete',
            ],
            [
                'id'    => 281,
                'title' => 'service_type_access',
            ],
            [
                'id'    => 282,
                'title' => 'join_empowerment_access',
            ],
            [
                'id'    => 283,
                'title' => 'empowerment_create',
            ],
            [
                'id'    => 284,
                'title' => 'empowerment_edit',
            ],
            [
                'id'    => 285,
                'title' => 'empowerment_show',
            ],
            [
                'id'    => 286,
                'title' => 'empowerment_access',
            ],
            [
                'id'    => 287,
                'title' => 'area_of_specialization_create',
            ],
            [
                'id'    => 288,
                'title' => 'area_of_specialization_edit',
            ],
            [
                'id'    => 289,
                'title' => 'area_of_specialization_show',
            ],
            [
                'id'    => 290,
                'title' => 'area_of_specialization_delete',
            ],
            [
                'id'    => 291,
                'title' => 'area_of_specialization_access',
            ],
            [
                'id'    => 292,
                'title' => 'job_level_create',
            ],
            [
                'id'    => 293,
                'title' => 'job_level_edit',
            ],
            [
                'id'    => 294,
                'title' => 'job_level_show',
            ],
            [
                'id'    => 295,
                'title' => 'job_level_delete',
            ],
            [
                'id'    => 296,
                'title' => 'job_level_access',
            ],
            [
                'id'    => 297,
                'title' => 'mailing_create',
            ],
            [
                'id'    => 298,
                'title' => 'mailing_edit',
            ],
            [
                'id'    => 299,
                'title' => 'mailing_show',
            ],
            [
                'id'    => 300,
                'title' => 'mailing_delete',
            ],
            [
                'id'    => 301,
                'title' => 'mailing_access',
            ],
            [
                'id'    => 302,
                'title' => 'payment_setting_access',
            ],
            [
                'id'    => 303,
                'title' => 'flutterwave_apikey_create',
            ],
            [
                'id'    => 304,
                'title' => 'flutterwave_apikey_edit',
            ],
            [
                'id'    => 305,
                'title' => 'flutterwave_apikey_show',
            ],
            [
                'id'    => 306,
                'title' => 'flutterwave_apikey_delete',
            ],
            [
                'id'    => 307,
                'title' => 'flutterwave_apikey_access',
            ],
            [
                'id'    => 308,
                'title' => 'bank_account_detail_create',
            ],
            [
                'id'    => 309,
                'title' => 'bank_account_detail_edit',
            ],
            [
                'id'    => 310,
                'title' => 'bank_account_detail_show',
            ],
            [
                'id'    => 311,
                'title' => 'bank_account_detail_delete',
            ],
            [
                'id'    => 312,
                'title' => 'bank_account_detail_access',
            ],
            [
                'id'    => 313,
                'title' => 'payment_create',
            ],
            [
                'id'    => 314,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 315,
                'title' => 'payment_show',
            ],
            [
                'id'    => 316,
                'title' => 'payment_access',
            ],
            [
                'id'    => 317,
                'title' => 'type_of_appoinment_create',
            ],
            [
                'id'    => 318,
                'title' => 'type_of_appoinment_edit',
            ],
            [
                'id'    => 319,
                'title' => 'type_of_appoinment_show',
            ],
            [
                'id'    => 320,
                'title' => 'type_of_appoinment_delete',
            ],
            [
                'id'    => 321,
                'title' => 'type_of_appoinment_access',
            ],
            [
                'id'    => 322,
                'title' => 'meeting_type_create',
            ],
            [
                'id'    => 323,
                'title' => 'meeting_type_edit',
            ],
            [
                'id'    => 324,
                'title' => 'meeting_type_show',
            ],
            [
                'id'    => 325,
                'title' => 'meeting_type_delete',
            ],
            [
                'id'    => 326,
                'title' => 'meeting_type_access',
            ],
            [
                'id'    => 327,
                'title' => 'mountain_of_influence_create',
            ],
            [
                'id'    => 328,
                'title' => 'mountain_of_influence_edit',
            ],
            [
                'id'    => 329,
                'title' => 'mountain_of_influence_show',
            ],
            [
                'id'    => 330,
                'title' => 'mountain_of_influence_delete',
            ],
            [
                'id'    => 331,
                'title' => 'mountain_of_influence_access',
            ],
            [
                'id'    => 332,
                'title' => 'empowerment_training_need_create',
            ],
            [
                'id'    => 333,
                'title' => 'empowerment_training_need_edit',
            ],
            [
                'id'    => 334,
                'title' => 'empowerment_training_need_show',
            ],
            [
                'id'    => 335,
                'title' => 'empowerment_training_need_delete',
            ],
            [
                'id'    => 336,
                'title' => 'empowerment_training_need_access',
            ],
            [
                'id'    => 337,
                'title' => 'mf_create',
            ],
            [
                'id'    => 338,
                'title' => 'mf_edit',
            ],
            [
                'id'    => 339,
                'title' => 'mf_show',
            ],
            [
                'id'    => 340,
                'title' => 'mf_delete',
            ],
            [
                'id'    => 341,
                'title' => 'mf_access',
            ],
            [
                'id'    => 342,
                'title' => 'family_access',
            ],
            [
                'id'    => 343,
                'title' => 'sub_sector_create',
            ],
            [
                'id'    => 344,
                'title' => 'sub_sector_edit',
            ],
            [
                'id'    => 345,
                'title' => 'sub_sector_show',
            ],
            [
                'id'    => 346,
                'title' => 'sub_sector_delete',
            ],
            [
                'id'    => 347,
                'title' => 'sub_sector_access',
            ],
            [
                'id'    => 348,
                'title' => 'event_type_create',
            ],
            [
                'id'    => 349,
                'title' => 'event_type_edit',
            ],
            [
                'id'    => 350,
                'title' => 'event_type_show',
            ],
            [
                'id'    => 351,
                'title' => 'event_type_delete',
            ],
            [
                'id'    => 352,
                'title' => 'event_type_access',
            ],
            [
                'id'    => 353,
                'title' => 'event_church_program_access',
            ],
            [
                'id'    => 354,
                'title' => 'attendee_create',
            ],
            [
                'id'    => 355,
                'title' => 'attendee_edit',
            ],
            [
                'id'    => 356,
                'title' => 'attendee_show',
            ],
            [
                'id'    => 357,
                'title' => 'attendee_delete',
            ],
            [
                'id'    => 358,
                'title' => 'attendee_access',
            ],
            [
                'id'    => 359,
                'title' => 'switch_to_member_dashboard_access',
            ],
            [
                'id'    => 360,
                'title' => 'switch_to_admin_dashboard_access',
            ],
            [
                'id'    => 361,
                'title' => 'switch_to_accreditor_dashboard_access',
            ],
            [
                'id'    => 362,
                'title' => 'switch_to_church_programme_access',
            ],
            [
                'id'    => 363,
                'title' => 'bank_account_type_create',
            ],
            [
                'id'    => 364,
                'title' => 'bank_account_type_edit',
            ],
            [
                'id'    => 365,
                'title' => 'bank_account_type_show',
            ],
            [
                'id'    => 366,
                'title' => 'bank_account_type_delete',
            ],
            [
                'id'    => 367,
                'title' => 'bank_account_type_access',
            ],
            [
                'id'    => 368,
                'title' => 'currency_create',
            ],
            [
                'id'    => 369,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 370,
                'title' => 'currency_show',
            ],
            [
                'id'    => 371,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 372,
                'title' => 'currency_access',
            ],
            [
                'id'    => 373,
                'title' => 'cgcc_payment_form_create',
            ],
            [
                'id'    => 374,
                'title' => 'cgcc_payment_form_edit',
            ],
            [
                'id'    => 375,
                'title' => 'cgcc_payment_form_show',
            ],
            [
                'id'    => 376,
                'title' => 'cgcc_payment_form_delete',
            ],
            [
                'id'    => 377,
                'title' => 'cgcc_payment_form_access',
            ],
            [
                'id'    => 378,
                'title' => 'cihmember_create',
            ],
            [
                'id'    => 379,
                'title' => 'cihmember_edit',
            ],
            [
                'id'    => 380,
                'title' => 'cihmember_show',
            ],
            [
                'id'    => 381,
                'title' => 'cihmember_delete',
            ],
            [
                'id'    => 382,
                'title' => 'cihmember_access',
            ],
            [
                'id'    => 383,
                'title' => 'cih_types_of_request_create',
            ],
            [
                'id'    => 384,
                'title' => 'cih_types_of_request_edit',
            ],
            [
                'id'    => 385,
                'title' => 'cih_types_of_request_show',
            ],
            [
                'id'    => 386,
                'title' => 'cih_types_of_request_delete',
            ],
            [
                'id'    => 387,
                'title' => 'cih_types_of_request_access',
            ],
            [
                'id'    => 388,
                'title' => 'chat_management_create',
            ],
            [
                'id'    => 389,
                'title' => 'chat_management_edit',
            ],
            [
                'id'    => 390,
                'title' => 'chat_management_show',
            ],
            [
                'id'    => 391,
                'title' => 'chat_management_delete',
            ],
            [
                'id'    => 392,
                'title' => 'chat_management_access',
            ],
            [
                'id'    => 393,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 394,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 395,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 396,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 397,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 398,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 399,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 400,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 401,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 402,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 403,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 404,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 405,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 406,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 407,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 408,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 409,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 410,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 411,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 412,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 413,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 414,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 415,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 416,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 417,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 418,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 419,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 420,
                'title' => 'course_create',
            ],
            [
                'id'    => 421,
                'title' => 'course_edit',
            ],
            [
                'id'    => 422,
                'title' => 'course_show',
            ],
            [
                'id'    => 423,
                'title' => 'course_delete',
            ],
            [
                'id'    => 424,
                'title' => 'course_access',
            ],
            [
                'id'    => 425,
                'title' => 'lesson_create',
            ],
            [
                'id'    => 426,
                'title' => 'lesson_edit',
            ],
            [
                'id'    => 427,
                'title' => 'lesson_show',
            ],
            [
                'id'    => 428,
                'title' => 'lesson_delete',
            ],
            [
                'id'    => 429,
                'title' => 'lesson_access',
            ],
            [
                'id'    => 430,
                'title' => 'test_create',
            ],
            [
                'id'    => 431,
                'title' => 'test_edit',
            ],
            [
                'id'    => 432,
                'title' => 'test_show',
            ],
            [
                'id'    => 433,
                'title' => 'test_delete',
            ],
            [
                'id'    => 434,
                'title' => 'test_access',
            ],
            [
                'id'    => 435,
                'title' => 'question_create',
            ],
            [
                'id'    => 436,
                'title' => 'question_edit',
            ],
            [
                'id'    => 437,
                'title' => 'question_show',
            ],
            [
                'id'    => 438,
                'title' => 'question_delete',
            ],
            [
                'id'    => 439,
                'title' => 'question_access',
            ],
            [
                'id'    => 440,
                'title' => 'question_option_create',
            ],
            [
                'id'    => 441,
                'title' => 'question_option_edit',
            ],
            [
                'id'    => 442,
                'title' => 'question_option_show',
            ],
            [
                'id'    => 443,
                'title' => 'question_option_delete',
            ],
            [
                'id'    => 444,
                'title' => 'question_option_access',
            ],
            [
                'id'    => 445,
                'title' => 'test_result_create',
            ],
            [
                'id'    => 446,
                'title' => 'test_result_edit',
            ],
            [
                'id'    => 447,
                'title' => 'test_result_show',
            ],
            [
                'id'    => 448,
                'title' => 'test_result_delete',
            ],
            [
                'id'    => 449,
                'title' => 'test_result_access',
            ],
            [
                'id'    => 450,
                'title' => 'test_answer_create',
            ],
            [
                'id'    => 451,
                'title' => 'test_answer_edit',
            ],
            [
                'id'    => 452,
                'title' => 'test_answer_show',
            ],
            [
                'id'    => 453,
                'title' => 'test_answer_delete',
            ],
            [
                'id'    => 454,
                'title' => 'test_answer_access',
            ],
            [
                'id'    => 455,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 456,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 457,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 458,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 459,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 460,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 461,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 462,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 463,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 464,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 465,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 466,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 467,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 468,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 469,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 470,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 471,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 472,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 473,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 474,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 475,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 476,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 477,
                'title' => 'product_create',
            ],
            [
                'id'    => 478,
                'title' => 'product_edit',
            ],
            [
                'id'    => 479,
                'title' => 'product_show',
            ],
            [
                'id'    => 480,
                'title' => 'product_delete',
            ],
            [
                'id'    => 481,
                'title' => 'product_access',
            ],
            [
                'id'    => 482,
                'title' => 'at_access',
            ],
            [
                'id'    => 483,
                'title' => 'e_flyer_create',
            ],
            [
                'id'    => 484,
                'title' => 'e_flyer_edit',
            ],
            [
                'id'    => 485,
                'title' => 'e_flyer_show',
            ],
            [
                'id'    => 486,
                'title' => 'e_flyer_delete',
            ],
            [
                'id'    => 487,
                'title' => 'e_flyer_access',
            ],
            [
                'id'    => 488,
                'title' => 'dedication_create',
            ],
            [
                'id'    => 489,
                'title' => 'dedication_edit',
            ],
            [
                'id'    => 490,
                'title' => 'dedication_show',
            ],
            [
                'id'    => 491,
                'title' => 'dedication_delete',
            ],
            [
                'id'    => 492,
                'title' => 'dedication_access',
            ],
            [
                'id'    => 493,
                'title' => 'christening_create',
            ],
            [
                'id'    => 494,
                'title' => 'christening_edit',
            ],
            [
                'id'    => 495,
                'title' => 'christening_show',
            ],
            [
                'id'    => 496,
                'title' => 'christening_delete',
            ],
            [
                'id'    => 497,
                'title' => 'christening_access',
            ],
            [
                'id'    => 498,
                'title' => 'centre_create',
            ],
            [
                'id'    => 499,
                'title' => 'centre_edit',
            ],
            [
                'id'    => 500,
                'title' => 'centre_show',
            ],
            [
                'id'    => 501,
                'title' => 'centre_delete',
            ],
            [
                'id'    => 502,
                'title' => 'centre_access',
            ],
            [
                'id'    => 503,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 504,
                'title' => 'dash_board_member_info',
            ],
            [
                'id'    => 505,
                'title' => 'dash_board_venue_info',
            ],
            [
                'id'    => 506,
                'title' => 'dash_board_recent_member',
            ],
            [
                'id'    => 507,
                'title' => 'dash_board_recent_appointment_booking',
            ],
            [
                'id'    => 508,
                'title' => 'dash_board_cih_weekly_request',
            ],
            [
                'id'    => 509,
                'title' => 'dash_board_recent_issue_raised',
            ],
        ];

        //Permission::insert($permissions);
        foreach ($permissions as $item) {
            Permission::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
