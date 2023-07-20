<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();
Route::post('/user/login', [LoginController::class, 'sendLoginLink'])->name('userLogin');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
    // Route for switching to admin
    Route::post('switch-to-admin', [RoleController::class, 'switchToAdmin'])->name('switchToAdmin');

    // Route for switching to HOD
    Route::post('switch-to-hod', [RoleController::class, 'switchToHOD'])->name('switchToHOD');

    // Route for switching to User
    Route::post('switch-to-user', [RoleController::class, 'switchToUser'])->name('switchToUser');
    
    // Permissions
    Route::resource('permissions', 'PermissionsController', ['except' => ['destroy']]);

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::get('user/GetUserList', 'UsersController@getUserList');
    Route::resource('users', 'UsersController', ['except' => ['destroy']]);

    // Title
    Route::post('titles/parse-csv-import', 'TitleController@parseCsvImport')->name('titles.parseCsvImport');
    Route::post('titles/process-csv-import', 'TitleController@processCsvImport')->name('titles.processCsvImport');
    Route::resource('titles', 'TitleController', ['except' => ['destroy']]);

    // Marital Status
    Route::delete('marital-statuses/destroy', 'MaritalStatusController@massDestroy')->name('marital-statuses.massDestroy');
    Route::resource('marital-statuses', 'MaritalStatusController');

    // Employment Status
    Route::delete('employment-statuses/destroy', 'EmploymentStatusController@massDestroy')->name('employment-statuses.massDestroy');
    Route::resource('employment-statuses', 'EmploymentStatusController');

    // Member
    Route::delete('members/destroy', 'MemberController@massDestroy')->name('members.massDestroy');
    Route::post('members/media', 'MemberController@storeMedia')->name('members.storeMedia');
    Route::post('members/ckmedia', 'MemberController@storeCKEditorImages')->name('members.storeCKEditorImages');
    Route::post('members/parse-csv-import', 'MemberController@parseCsvImport')->name('members.parseCsvImport');
    Route::post('members/process-csv-import', 'MemberController@processCsvImport')->name('members.processCsvImport');
    Route::get('members/get_member_list', 'MemberController@getMemberlist')->name('member.getMemberlist');
    Route::resource('members', 'MemberController');

    // Qualification Settings
    Route::delete('qualification-settings/destroy', 'QualificationSettingsController@massDestroy')->name('qualification-settings.massDestroy');
    Route::resource('qualification-settings', 'QualificationSettingsController');

    // Qualifications
    Route::delete('qualifications/destroy', 'QualificationsController@massDestroy')->name('qualifications.massDestroy');
    Route::resource('qualifications', 'QualificationsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Spouse Details
    Route::delete('spouse-details/destroy', 'SpouseDetailsController@massDestroy')->name('spouse-details.massDestroy');
    Route::resource('spouse-details', 'SpouseDetailsController');

    // Children
    Route::delete('children/destroy', 'ChildrenController@massDestroy')->name('children.massDestroy');
    Route::post('children/parse-csv-import', 'ChildrenController@parseCsvImport')->name('children.parseCsvImport');
    Route::post('children/process-csv-import', 'ChildrenController@processCsvImport')->name('children.processCsvImport');
    Route::resource('children', 'ChildrenController');

    // Industry Sector
    Route::delete('industry-sectors/destroy', 'IndustrySectorController@massDestroy')->name('industry-sectors.massDestroy');
    Route::resource('industry-sectors', 'IndustrySectorController');

    // Employment Details
    Route::delete('employment-details/destroy', 'EmploymentDetailsController@massDestroy')->name('employment-details.massDestroy');
    Route::resource('employment-details', 'EmploymentDetailsController');

    // Cihzones
    Route::delete('cihzones/destroy', 'CihzonesController@massDestroy')->name('cihzones.massDestroy');
    Route::post('cihzones/parse-csv-import', 'CihzonesController@parseCsvImport')->name('cihzones.parseCsvImport');
    Route::post('cihzones/process-csv-import', 'CihzonesController@processCsvImport')->name('cihzones.processCsvImport');
    Route::resource('cihzones', 'CihzonesController');

    // Organization Type
    Route::delete('organization-types/destroy', 'OrganizationTypeController@massDestroy')->name('organization-types.massDestroy');
    Route::post('organization-types/parse-csv-import', 'OrganizationTypeController@parseCsvImport')->name('organization-types.parseCsvImport');
    Route::post('organization-types/process-csv-import', 'OrganizationTypeController@processCsvImport')->name('organization-types.processCsvImport');
    Route::resource('organization-types', 'OrganizationTypeController');

    // Department
    Route::delete('departments/destroy', 'DepartmentController@massDestroy')->name('departments.massDestroy');
    Route::post('departments/parse-csv-import', 'DepartmentController@parseCsvImport')->name('departments.parseCsvImport');
    Route::post('departments/process-csv-import', 'DepartmentController@processCsvImport')->name('departments.processCsvImport');
    Route::get('departments/getDepartmentList', 'DepartmentController@getDepartmentList');
    Route::resource('departments', 'DepartmentController');

    // Affinity Group
    Route::post('affinity-groups/parse-csv-import', 'AffinityGroupController@parseCsvImport')->name('affinity-groups.parseCsvImport');
    Route::post('affinity-groups/process-csv-import', 'AffinityGroupController@processCsvImport')->name('affinity-groups.processCsvImport');
    Route::resource('affinity-groups', 'AffinityGroupController', ['except' => ['destroy']]);

    // Mountains Of Influence
    Route::delete('mountains-of-influences/destroy', 'MountainsOfInfluenceController@massDestroy')->name('mountains-of-influences.massDestroy');
    Route::post('mountains-of-influences/parse-csv-import', 'MountainsOfInfluenceController@parseCsvImport')->name('mountains-of-influences.parseCsvImport');
    Route::post('mountains-of-influences/process-csv-import', 'MountainsOfInfluenceController@processCsvImport')->name('mountains-of-influences.processCsvImport');
    Route::resource('mountains-of-influences', 'MountainsOfInfluenceController');

    // Ats Membership Records
    Route::delete('ats-membership-records/destroy', 'AtsMembershipRecordsController@massDestroy')->name('ats-membership-records.massDestroy');
    Route::post('ats-membership-records/parse-csv-import', 'AtsMembershipRecordsController@parseCsvImport')->name('ats-membership-records.parseCsvImport');
    Route::post('ats-membership-records/process-csv-import', 'AtsMembershipRecordsController@processCsvImport')->name('ats-membership-records.processCsvImport');
    Route::resource('ats-membership-records', 'AtsMembershipRecordsController');

    // Members Affinity Group
    Route::delete('members-affinity-groups/destroy', 'MembersAffinityGroupController@massDestroy')->name('members-affinity-groups.massDestroy');
    Route::resource('members-affinity-groups', 'MembersAffinityGroupController');

    // Ats Membership
    Route::delete('ats-memberships/destroy', 'AtsMembershipController@massDestroy')->name('ats-memberships.massDestroy');
    Route::resource('ats-memberships', 'AtsMembershipController');

    // Join Department
    Route::delete('join-departments/destroy', 'JoinDepartmentController@massDestroy')->name('join-departments.massDestroy');
    Route::post('join-departments/delist-member', 'JoinDepartmentController@DelistMember')->name('join-departments.delist-member');
    Route::resource('join-departments', 'JoinDepartmentController');

    // Missionary Force
    Route::resource('missionary-forces', 'MissionaryForceController', ['except' => ['destroy']]);

    // Sports
    Route::delete('sports/destroy', 'SportsController@massDestroy')->name('sports.massDestroy');
    Route::resource('sports', 'SportsController');

    // Interests
    Route::delete('interests/destroy', 'InterestsController@massDestroy')->name('interests.massDestroy');
    Route::resource('interests', 'InterestsController');

    // Location
    Route::delete('locations/destroy', 'LocationController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationController');

    // Venue Accessories
    Route::delete('venue-accessories/destroy', 'VenueAccessoriesController@massDestroy')->name('venue-accessories.massDestroy');
    Route::resource('venue-accessories', 'VenueAccessoriesController');

    // Venue
    Route::delete('venues/destroy', 'VenueController@massDestroy')->name('venues.massDestroy');
    Route::resource('venues', 'VenueController');

    // Meeting
    Route::delete('meetings/destroy', 'MeetingController@massDestroy')->name('meetings.massDestroy');
    Route::post('meetings/media', 'MeetingController@storeMedia')->name('meetings.storeMedia');
    Route::post('meetings/ckmedia', 'MeetingController@storeCKEditorImages')->name('meetings.storeCKEditorImages');
    Route::get('meetings/get_Member_list/{member_group}/{member_type}', 'MeetingController@GetMemberList');
    Route::get('meetings/GetMeetingAttendee/{id}', 'MeetingController@GetMeetingAttendee');
    Route::get('meetings/GetMeetingById/{id}', 'MeetingController@GetMeetingById');

    Route::resource('meetings', 'MeetingController');
   // Route::resource('meetings', 'MeetingController');

    // Appointment Booking
    Route::delete('appointment-bookings/destroy', 'AppointmentBookingController@massDestroy')->name('appointment-bookings.massDestroy');
    Route::post('appointment-bookings/media', 'AppointmentBookingController@storeMedia')->name('appointment-bookings.storeMedia');
    Route::post('appointment-bookings/ckmedia', 'AppointmentBookingController@storeCKEditorImages')->name('appointment-bookings.storeCKEditorImages');
    Route::resource('appointment-bookings', 'AppointmentBookingController');

    // User Alerts
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update', 'destroy']]);

    // Accessibility Features
    Route::delete('accessibility-features/destroy', 'AccessibilityFeaturesController@massDestroy')->name('accessibility-features.massDestroy');
    Route::resource('accessibility-features', 'AccessibilityFeaturesController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventsController');

    // Bookings
    Route::delete('bookings/destroy', 'BookingsController@massDestroy')->name('bookings.massDestroy');
    Route::resource('bookings', 'BookingsController');

    // Notification
    Route::delete('notifications/destroy', 'NotificationController@massDestroy')->name('notifications.massDestroy');
    Route::post('notifications/media', 'NotificationController@storeMedia')->name('notifications.storeMedia');
    Route::post('notifications/ckmedia', 'NotificationController@storeCKEditorImages')->name('notifications.storeCKEditorImages');
    Route::resource('notifications', 'NotificationController');

    // Outreach
    Route::delete('outreaches/destroy', 'OutreachController@massDestroy')->name('outreaches.massDestroy');
    Route::resource('outreaches', 'OutreachController');

    // Outreach Type
    Route::delete('outreach-types/destroy', 'OutreachTypeController@massDestroy')->name('outreach-types.massDestroy');
    Route::resource('outreach-types', 'OutreachTypeController');

    // First Timer
    Route::delete('first-timers/destroy', 'FirstTimerController@massDestroy')->name('first-timers.massDestroy');
    Route::resource('first-timers', 'FirstTimerController');

    // Issue Management
    Route::delete('issue-managements/destroy', 'IssueManagementController@massDestroy')->name('issue-managements.massDestroy');
    Route::resource('issue-managements', 'IssueManagementController');

    // Goal
    Route::delete('goals/destroy', 'GoalController@massDestroy')->name('goals.massDestroy');
    Route::post('goals/media', 'GoalController@storeMedia')->name('goals.storeMedia');
    Route::post('goals/ckmedia', 'GoalController@storeCKEditorImages')->name('goals.storeCKEditorImages');
    Route::resource('goals', 'GoalController');

    // Attendance Management
    Route::delete('attendance-managements/destroy', 'AttendanceManagementController@massDestroy')->name('attendance-managements.massDestroy');
    Route::post('attendance-managements/media', 'AttendanceManagementController@storeMedia')->name('attendance-managements.storeMedia');
    Route::post('attendance-managements/ckmedia', 'AttendanceManagementController@storeCKEditorImages')->name('attendance-managements.storeCKEditorImages');
    Route::post('attendance-managements/updateStatus', 'AttendanceManagementController@updateStatus');
    Route::post('attendance-managements/closeStatus', 'AttendanceManagementController@closeStatus');
    Route::post('attendance-managements/cancelStatus', 'AttendanceManagementController@cancelStatus');
    Route::post('attendance-managements/rescheduleStatus', 'AttendanceManagementController@rescheduleStatus');
    Route::get('attendance-managements/GetAttendees/{Id}', 'AttendanceManagementController@GetAttendees');
    Route::get('attendance-managements/GetAttendants/{Id}/{type}', 'AttendanceManagementController@GetAttendants');
    Route::get('attendance-managements/GetMeetingAttendance/{meeting_type_id}/{meeting_title_id}/{date}/{time}', 'AttendanceManagementController@GetMeetingAttendance');
    Route::resource('attendance-managements', 'AttendanceManagementController');

    // Reminders
    Route::delete('reminders/destroy', 'RemindersController@massDestroy')->name('reminders.massDestroy');
    Route::post('reminders/media', 'RemindersController@storeMedia')->name('reminders.storeMedia');
    Route::post('reminders/ckmedia', 'RemindersController@storeCKEditorImages')->name('reminders.storeCKEditorImages');
    Route::resource('reminders', 'RemindersController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Cih Request
    Route::delete('cih-requests/destroy', 'CihRequestController@massDestroy')->name('cih-requests.massDestroy');
    Route::resource('cih-requests', 'CihRequestController');

    // Cih Centers Inspection
    Route::delete('cih-centers-inspections/destroy', 'CihCentersInspectionController@massDestroy')->name('cih-centers-inspections.massDestroy');
    Route::post('cih-centers-inspections/media', 'CihCentersInspectionController@storeMedia')->name('cih-centers-inspections.storeMedia');
    Route::post('cih-centers-inspections/ckmedia', 'CihCentersInspectionController@storeCKEditorImages')->name('cih-centers-inspections.storeCKEditorImages');
    Route::resource('cih-centers-inspections', 'CihCentersInspectionController');

    // Inspectorate Group
    Route::delete('inspectorate-groups/destroy', 'InspectorateGroupController@massDestroy')->name('inspectorate-groups.massDestroy');
    Route::resource('inspectorate-groups', 'InspectorateGroupController');

    // Ancillary Management
    Route::delete('ancillary-managements/destroy', 'AncillaryManagementController@massDestroy')->name('ancillary-managements.massDestroy');
    Route::post('ancillary-managements/media', 'AncillaryManagementController@storeMedia')->name('ancillary-managements.storeMedia');
    Route::post('ancillary-managements/ckmedia', 'AncillaryManagementController@storeCKEditorImages')->name('ancillary-managements.storeCKEditorImages');
    Route::resource('ancillary-managements', 'AncillaryManagementController');

    // Service Type
    Route::delete('service-types/destroy', 'ServiceTypeController@massDestroy')->name('service-types.massDestroy');
    Route::resource('service-types', 'ServiceTypeController');

    // Empowerment
    Route::resource('empowerments', 'EmpowermentController', ['except' => ['destroy']]);

    // Area Of Specialization
    Route::delete('area-of-specializations/destroy', 'AreaOfSpecializationController@massDestroy')->name('area-of-specializations.massDestroy');
    Route::resource('area-of-specializations', 'AreaOfSpecializationController');

    // Job Level
    Route::delete('job-levels/destroy', 'JobLevelController@massDestroy')->name('job-levels.massDestroy');
    Route::resource('job-levels', 'JobLevelController');

    // Mailings
    Route::delete('mailings/destroy', 'MailingsController@massDestroy')->name('mailings.massDestroy');
    Route::resource('mailings', 'MailingsController');

    // Flutterwave Apikeys
    Route::delete('flutterwave-apikeys/destroy', 'FlutterwaveApikeysController@massDestroy')->name('flutterwave-apikeys.massDestroy');
    Route::resource('flutterwave-apikeys', 'FlutterwaveApikeysController');

    // Bank Account Details
    Route::delete('bank-account-details/destroy', 'BankAccountDetailsController@massDestroy')->name('bank-account-details.massDestroy');
    Route::resource('bank-account-details', 'BankAccountDetailsController');

    // Payment
    Route::post('payments/media', 'PaymentController@storeMedia')->name('payments.storeMedia');
    Route::post('payments/ckmedia', 'PaymentController@storeCKEditorImages')->name('payments.storeCKEditorImages');
    Route::resource('payments', 'PaymentController', ['except' => ['destroy']]);

    // Type Of Appoinment
    Route::delete('type-of-appoinments/destroy', 'TypeOfAppoinmentController@massDestroy')->name('type-of-appoinments.massDestroy');
    Route::resource('type-of-appoinments', 'TypeOfAppoinmentController');

    // Meeting Types
    Route::delete('meeting-types/destroy', 'MeetingTypesController@massDestroy')->name('meeting-types.massDestroy');
    Route::resource('meeting-types', 'MeetingTypesController');

    // Mountain Of Influence
    Route::delete('mountain-of-influences/destroy', 'MountainOfInfluenceController@massDestroy')->name('mountain-of-influences.massDestroy');
    Route::resource('mountain-of-influences', 'MountainOfInfluenceController');

    // Empowerment Training Need
    Route::delete('empowerment-training-needs/destroy', 'EmpowermentTrainingNeedController@massDestroy')->name('empowerment-training-needs.massDestroy');
    Route::resource('empowerment-training-needs', 'EmpowermentTrainingNeedController');

    // Mf
    Route::delete('mfs/destroy', 'MfController@massDestroy')->name('mfs.massDestroy');
    Route::resource('mfs', 'MfController');

    // Sub Sector
    Route::delete('sub-sectors/destroy', 'SubSectorController@massDestroy')->name('sub-sectors.massDestroy');
    Route::post('sub-sectors/parse-csv-import', 'SubSectorController@parseCsvImport')->name('sub-sectors.parseCsvImport');
    Route::post('sub-sectors/process-csv-import', 'SubSectorController@processCsvImport')->name('sub-sectors.processCsvImport');
    Route::resource('sub-sectors', 'SubSectorController');

    // Event Type
    Route::delete('event-types/destroy', 'EventTypeController@massDestroy')->name('event-types.massDestroy');
    Route::post('event-types/parse-csv-import', 'EventTypeController@parseCsvImport')->name('event-types.parseCsvImport');
    Route::post('event-types/process-csv-import', 'EventTypeController@processCsvImport')->name('event-types.processCsvImport');
    Route::resource('event-types', 'EventTypeController');

    // Attendees
    Route::delete('attendees/destroy', 'AttendeesController@massDestroy')->name('attendees.massDestroy');
    Route::resource('attendees', 'AttendeesController');

    // Bank Account Type
    Route::delete('bank-account-types/destroy', 'BankAccountTypeController@massDestroy')->name('bank-account-types.massDestroy');
    Route::resource('bank-account-types', 'BankAccountTypeController');

    // Currency
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Cgcc Payment Form
    Route::delete('cgcc-payment-forms/destroy', 'CgccPaymentFormController@massDestroy')->name('cgcc-payment-forms.massDestroy');
    Route::resource('cgcc-payment-forms', 'CgccPaymentFormController');

    // Cihmember
    Route::delete('cihmembers/destroy', 'CihmemberController@massDestroy')->name('cihmembers.massDestroy');
    Route::post('cihmembers/parse-csv-import', 'CihmemberController@parseCsvImport')->name('cihmembers.parseCsvImport');
    Route::post('cihmembers/process-csv-import', 'CihmemberController@processCsvImport')->name('cihmembers.processCsvImport');
    Route::resource('cihmembers', 'CihmemberController');

    // Cih Types Of Request
    Route::delete('cih-types-of-requests/destroy', 'CihTypesOfRequestController@massDestroy')->name('cih-types-of-requests.massDestroy');
    Route::resource('cih-types-of-requests', 'CihTypesOfRequestController');

    // Chat Management
    Route::delete('chat-managements/destroy', 'ChatManagementController@massDestroy')->name('chat-managements.massDestroy');
    Route::resource('chat-managements', 'ChatManagementController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Faq Category
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Question
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::post('courses/parse-csv-import', 'CoursesController@parseCsvImport')->name('courses.parseCsvImport');
    Route::post('courses/process-csv-import', 'CoursesController@processCsvImport')->name('courses.processCsvImport');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::post('lessons/parse-csv-import', 'LessonsController@parseCsvImport')->name('lessons.parseCsvImport');
    Route::post('lessons/process-csv-import', 'LessonsController@processCsvImport')->name('lessons.processCsvImport');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/parse-csv-import', 'ContactContactsController@parseCsvImport')->name('contact-contacts.parseCsvImport');
    Route::post('contact-contacts/process-csv-import', 'ContactContactsController@processCsvImport')->name('contact-contacts.processCsvImport');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // E Flyers
    Route::delete('e-flyers/destroy', 'EFlyersController@massDestroy')->name('e-flyers.massDestroy');
    Route::post('e-flyers/media', 'EFlyersController@storeMedia')->name('e-flyers.storeMedia');
    Route::post('e-flyers/ckmedia', 'EFlyersController@storeCKEditorImages')->name('e-flyers.storeCKEditorImages');
    Route::resource('e-flyers', 'EFlyersController');

    // Dedication
    Route::delete('dedications/destroy', 'DedicationController@massDestroy')->name('dedications.massDestroy');
    Route::resource('dedications', 'DedicationController');

    // Christening
    Route::delete('christenings/destroy', 'ChristeningController@massDestroy')->name('christenings.massDestroy');
    Route::resource('christenings', 'ChristeningController');

    //Mailing Setup
    Route::resource('mailingSetup/create', 'MailingSetupController@create');
    Route::get('mailingSetup/getMailingSetup/{id}', 'MailingSetupController@getMailingSetupbyOperationCode');
    Route::get('mailingSetup/getMailingTemplate/{id}', 'MailingSetupController@getMailingTemplaterationCode');
    Route::get('mailingSetup/GetEmailList/{id}/{userId}/{departmentId}', 'MailingSetupController@GetEmailList');
    Route::get('mailingSetup/BuildEmailTemplate/{operationCode}/{userId}', 'MailingSetupController@BuildEmailTemplate');
    Route::post('mailingSetup/AddMailSetting', 'MailingSetupController@AddMailSetting');
    Route::post('mailingSetup/CreateMailingTemplate', 'MailingSetupController@CreateMailingTemplate');
    Route::resource('mailingSetup', 'MailingSetupController');

    // Image
    Route::post('image-upload', [ImageUploadController::class, 'storeImage'])->name('image.upload');

    // Centres
    Route::delete('centres/destroy', 'CentresController@massDestroy')->name('centres.massDestroy');
    Route::resource('centres', 'CentresController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
