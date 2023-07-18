<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Total Members',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'user',
        ];

        $settings1['total_number'] = 0;
        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => 'Total Male',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Member',
            'group_by_field'        => 'date_of_birth',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'member',
        ];

        $settings2['total_number'] = 0;
        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => 'Total Female',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Member',
            'group_by_field'        => 'date_of_birth',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'member',
        ];

        $settings3['total_number'] = 0;
        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'        => 'Booking by Venue (Weekly)',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Booking',
            'group_by_field'     => 'venue_name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'venue',
            'translation_key'    => 'booking',
        ];

        $chart4 = new LaravelChart($settings4);

        $settings5 = [
            'chart_title'           => 'Recent Members',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Member',
            'group_by_field'        => 'date_of_birth',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'image'      => '',
                'created_at' => '',
            ],
            'translation_key' => 'member',
        ];

        $settings5['data'] = [];
        if (class_exists($settings5['model'])) {
            $settings5['data'] = $settings5['model']::latest()
                ->take($settings5['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings5)) {
            $settings5['fields'] = [];
        }

        $settings6 = [
            'chart_title'           => 'Recent Appointment Bookings',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AppointmentBooking',
            'group_by_field'        => 'appointment_date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'appointment_type' => 'type',
                'assigned_to'      => 'member_name',
            ],
            'translation_key' => 'appointmentBooking',
        ];

        $settings6['data'] = [];
        if (class_exists($settings6['model'])) {
            $settings6['data'] = $settings6['model']::latest()
                ->take($settings6['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings6)) {
            $settings6['fields'] = [];
        }

        $settings7 = [
            'chart_title'           => 'CIH Weekly Request',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\CihRequest',
            'group_by_field'        => 'date_of_request',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'week',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'cihRequest',
        ];

        $settings7['total_number'] = 0;
        if (class_exists($settings7['model'])) {
            $settings7['total_number'] = $settings7['model']::when(isset($settings7['filter_field']), function ($query) use ($settings7) {
                if (isset($settings7['filter_days'])) {
                    return $query->where($settings7['filter_field'], '>=',
                now()->subDays($settings7['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings7['filter_period'])) {
                    switch ($settings7['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings7['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings7['aggregate_function'] ?? 'count'}($settings7['aggregate_field'] ?? '*');
        }

        $settings8 = [
            'chart_title'        => 'Goal Tracker (Monthly)',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\Goal',
            'group_by_field'     => 'goal_name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'month',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'translation_key'    => 'goal',
        ];

        $chart8 = new LaravelChart($settings8);

        $settings9 = [
            'chart_title'        => 'Issues by Department',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\IssueManagement',
            'group_by_field'     => 'department_name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'week',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'relationship_name'  => 'department_concerned',
            'translation_key'    => 'issueManagement',
        ];

        $chart9 = new LaravelChart($settings9);

        $settings10 = [
            'chart_title'        => 'Empowerment by Members',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Empowerment',
            'group_by_field'     => 'ats_membership_records',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_period'      => 'month',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'relationship_name'  => 'ats_membership_no',
            'translation_key'    => 'empowerment',
        ];

        $chart10 = new LaravelChart($settings10);

        $settings11 = [
            'chart_title'           => 'Recent First Timers (Weekly)',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\FirstTimer',
            'group_by_field'        => 'date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
            'fields'                => [
                'surname'      => '',
                'first_name'   => '',
                'phone_number' => '',
                'email'        => '',
                'created_at'   => '',
            ],
            'translation_key' => 'firstTimer',
        ];

        $settings11['data'] = [];
        if (class_exists($settings11['model'])) {
            $settings11['data'] = $settings11['model']::latest()
                ->take($settings11['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings11)) {
            $settings11['fields'] = [];
        }

        $settings12 = [
            'chart_title'           => 'Affinity Group (Member Count)',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AffinityGroup',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'affinityGroup',
        ];

        $settings12['total_number'] = 0;
        if (class_exists($settings12['model'])) {
            $settings12['total_number'] = $settings12['model']::when(isset($settings12['filter_field']), function ($query) use ($settings12) {
                if (isset($settings12['filter_days'])) {
                    return $query->where($settings12['filter_field'], '>=',
                now()->subDays($settings12['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings12['filter_period'])) {
                    switch ($settings12['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings12['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings12['aggregate_function'] ?? 'count'}($settings12['aggregate_field'] ?? '*');
        }

        $settings13 = [
            'chart_title'           => 'Roles',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Role',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'role',
        ];

        $settings13['total_number'] = 0;
        if (class_exists($settings13['model'])) {
            $settings13['total_number'] = $settings13['model']::when(isset($settings13['filter_field']), function ($query) use ($settings13) {
                if (isset($settings13['filter_days'])) {
                    return $query->where($settings13['filter_field'], '>=',
                now()->subDays($settings13['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings13['filter_period'])) {
                    switch ($settings13['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings13['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings13['aggregate_function'] ?? 'count'}($settings13['aggregate_field'] ?? '*');
        }

        $settings14 = [
            'chart_title'           => 'Missionary Force Member',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Mf',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'mf',
        ];

        $settings14['total_number'] = 0;
        if (class_exists($settings14['model'])) {
            $settings14['total_number'] = $settings14['model']::when(isset($settings14['filter_field']), function ($query) use ($settings14) {
                if (isset($settings14['filter_days'])) {
                    return $query->where($settings14['filter_field'], '>=',
                now()->subDays($settings14['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings14['filter_period'])) {
                    switch ($settings14['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings14['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings14['aggregate_function'] ?? 'count'}($settings14['aggregate_field'] ?? '*');
        }

        $settings15 = [
            'chart_title'           => 'Total No. of Spouse(s)',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\SpouseDetail',
            'group_by_field'        => 'wedding_anniv',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'spouseDetail',
        ];

        $settings15['total_number'] = 0;
        if (class_exists($settings15['model'])) {
            $settings15['total_number'] = $settings15['model']::when(isset($settings15['filter_field']), function ($query) use ($settings15) {
                if (isset($settings15['filter_days'])) {
                    return $query->where($settings15['filter_field'], '>=',
                now()->subDays($settings15['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings15['filter_period'])) {
                    switch ($settings15['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings15['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings15['aggregate_function'] ?? 'count'}($settings15['aggregate_field'] ?? '*');
        }

        $settings16 = [
            'chart_title'           => 'Total No. of Children',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Child',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'child',
        ];

        $settings16['total_number'] = 0;
        if (class_exists($settings16['model'])) {
            $settings16['total_number'] = $settings16['model']::when(isset($settings16['filter_field']), function ($query) use ($settings16) {
                if (isset($settings16['filter_days'])) {
                    return $query->where($settings16['filter_field'], '>=',
                now()->subDays($settings16['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings16['filter_period'])) {
                    switch ($settings16['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings16['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings16['aggregate_function'] ?? 'count'}($settings16['aggregate_field'] ?? '*');
        }

        $settings17 = [
            'chart_title'           => 'Departments',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Department',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'department',
        ];

        $settings17['total_number'] = 0;
        if (class_exists($settings17['model'])) {
            $settings17['total_number'] = $settings17['model']::when(isset($settings17['filter_field']), function ($query) use ($settings17) {
                if (isset($settings17['filter_days'])) {
                    return $query->where($settings17['filter_field'], '>=',
                now()->subDays($settings17['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings17['filter_period'])) {
                    switch ($settings17['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings17['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings17['aggregate_function'] ?? 'count'}($settings17['aggregate_field'] ?? '*');
        }

        $settings18 = [
            'chart_title'        => 'Venue Booking by Events',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Booking',
            'group_by_field'     => 'name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'event',
            'translation_key'    => 'booking',
        ];

        $chart18 = new LaravelChart($settings18);

        $settings19 = [
            'chart_title'        => 'Meeting Attendance by Type',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\AttendanceManagement',
            'group_by_field'     => 'types',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
            'relationship_name'  => 'meeting_type',
            'translation_key'    => 'attendanceManagement',
        ];

        $chart19 = new LaravelChart($settings19);

        $settings20 = [
            'chart_title'           => 'Application Users by Roles',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'email_verified_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'name'      => '',
                'email'     => '',
                'roles'     => 'title',
                'firstname' => '',
            ],
            'translation_key' => 'user',
        ];

        $settings20['data'] = [];
        if (class_exists($settings20['model'])) {
            $settings20['data'] = $settings20['model']::latest()
                ->take($settings20['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings20)) {
            $settings20['fields'] = [];
        }

        $settings21 = [
            'chart_title'           => 'Recent Issues Raised',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\IssueManagement',
            'group_by_field'        => 'date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'fields'                => [
                'issue_title'          => '',
                'department_concerned' => 'department_name',
                'issue_location'       => 'name',
            ],
            'translation_key' => 'issueManagement',
        ];

        $settings21['data'] = [];
        if (class_exists($settings21['model'])) {
            $settings21['data'] = $settings21['model']::latest()
                ->take($settings21['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings21)) {
            $settings21['fields'] = [];
        }

        $settings22 = [
            'chart_title'           => 'Goal Rating',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Goal',
            'group_by_field'        => 'achievement_date',
            'group_by_period'       => 'year',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'goal',
        ];

        $chart22 = new LaravelChart($settings22);

        $settings23 = [
            'chart_title'           => 'Recent CIH Members',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Cihmember',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'fields'                => [
                'member_name' => '',
                'gender'      => '',
                'zone'        => 'zone',
            ],
            'translation_key' => 'cihmember',
        ];

        $settings23['data'] = [];
        if (class_exists($settings23['model'])) {
            $settings23['data'] = $settings23['model']::latest()
                ->take($settings23['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings23)) {
            $settings23['fields'] = [];
        }

        $settings24 = [
            'chart_title'        => 'Meeting Participation',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Meeting',
            'group_by_field'     => 'types',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
            'relationship_name'  => 'meeting_type',
            'translation_key'    => 'meeting',
        ];

        $chart24 = new LaravelChart($settings24);

        $settings25 = [
            'chart_title'        => 'Recent CIH Requests',
            'chart_type'         => 'latest_entries',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\CihRequest',
            'group_by_field'     => 'types_of_request',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-12',
            'entries_number'     => '10',
            'fields'             => [
                'date_of_request_event' => '',
                'created_at'            => '',
                'requester_name'        => 'member_name',
                'types_of_request'      => 'types_of_request',
            ],
            'relationship_name' => 'types_of_request',
            'translation_key'   => 'cihRequest',
        ];

        $settings25['data'] = [];
        if (class_exists($settings25['model'])) {
            $settings25['data'] = $settings25['model']::latest()
                ->take($settings25['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings25)) {
            $settings25['fields'] = [];
        }

        $settings26 = [
            'chart_title'        => 'Recent CIH Requests by Type',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\Models\CihTypesOfRequest',
            'group_by_field'     => 'types_of_request',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'translation_key'    => 'cihTypesOfRequest',
        ];

        $chart26 = new LaravelChart($settings26);

        $settings27 = [
            'chart_title'           => 'Birthdays this Month',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Member',
            'group_by_field'        => 'date_of_birth',
            'group_by_period'       => 'month',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'month',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'member',
        ];

        $chart27 = new LaravelChart($settings27);

        $settings28 = [
            'chart_title'        => 'Recent Appointment Booking (By Type)',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\AppointmentBooking',
            'group_by_field'     => 'type',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'relationship_name'  => 'appointment_type',
            'translation_key'    => 'appointmentBooking',
        ];

        $chart28 = new LaravelChart($settings28);

        $settings29 = [
            'chart_title'           => 'Recent Department Pending Request',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\JoinDepartment',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'department' => 'department_name',
                'created_by' => 'member_name',
                'is_pending' => '',
            ],
            'translation_key' => 'joinDepartment',
        ];

        $settings29['data'] = [];
        if (class_exists($settings29['model'])) {
            $settings29['data'] = $settings29['model']::latest()
                ->take($settings29['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings29)) {
            $settings29['fields'] = [];
        }

        $settings30 = [
            'chart_title'           => 'Recent Department Approved',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\JoinDepartment',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'department'  => 'department_name',
                'created_by'  => 'member_name',
                'is_approved' => '',
            ],
            'translation_key' => 'joinDepartment',
        ];

        $settings30['data'] = [];
        if (class_exists($settings30['model'])) {
            $settings30['data'] = $settings30['model']::latest()
                ->take($settings30['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings30)) {
            $settings30['fields'] = [];
        }

        $settings31 = [
            'chart_title'        => 'Department Request (By Department)',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\JoinDepartment',
            'group_by_field'     => 'department_name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'relationship_name'  => 'department',
            'translation_key'    => 'joinDepartment',
        ];

        $chart31 = new LaravelChart($settings31);

        $settings32 = [
            'chart_title'        => 'Recent Meetings (By Type)',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\AttendanceManagement',
            'group_by_field'     => 'types',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'relationship_name'  => 'meeting_type',
            'translation_key'    => 'attendanceManagement',
        ];

        $chart32 = new LaravelChart($settings32);

        $settings33 = [
            'chart_title'        => 'Venue Booking (By Status)',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_relationship',
            'model'              => 'App\Models\Booking',
            'group_by_field'     => 'venue_name',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '7',
            'column_class'       => 'col-md-4',
            'entries_number'     => '5',
            'relationship_name'  => 'venue',
            'translation_key'    => 'booking',
        ];

        $chart33 = new LaravelChart($settings33);

        $settings34 = [
            'chart_title'           => 'Total ATS Member Record',
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\AtsMembershipRecord',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'atsMembershipRecord',
        ];

        $settings34['total_number'] = 0;
        if (class_exists($settings34['model'])) {
            $settings34['total_number'] = $settings34['model']::when(isset($settings34['filter_field']), function ($query) use ($settings34) {
                if (isset($settings34['filter_days'])) {
                    return $query->where($settings34['filter_field'], '>=',
                now()->subDays($settings34['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings34['filter_period'])) {
                    switch ($settings34['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings34['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings34['aggregate_function'] ?? 'count'}($settings34['aggregate_field'] ?? '*');
        }

        return view('home', compact('chart10', 'chart18', 'chart19', 'chart22', 'chart24', 'chart26', 'chart27', 'chart28', 'chart31', 'chart32', 'chart33', 'chart4', 'chart8', 'chart9', 'settings1', 'settings11', 'settings12', 'settings13', 'settings14', 'settings15', 'settings16', 'settings17', 'settings2', 'settings20', 'settings21', 'settings23', 'settings25', 'settings29', 'settings3', 'settings30', 'settings34', 'settings5', 'settings6', 'settings7'));
    }
}
