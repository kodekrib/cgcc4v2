<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController', ['except' => ['destroy']]);

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController', ['except' => ['destroy']]);

    // Title
    Route::apiResource('titles', 'TitleApiController', ['except' => ['destroy']]);

    // Marital Status
    Route::apiResource('marital-statuses', 'MaritalStatusApiController');

    // Employment Status
    Route::apiResource('employment-statuses', 'EmploymentStatusApiController');

    // Member
    Route::post('members/media', 'MemberApiController@storeMedia')->name('members.storeMedia');
    Route::apiResource('members', 'MemberApiController');

    // Qualification Settings
    Route::apiResource('qualification-settings', 'QualificationSettingsApiController');

    // Qualifications
    Route::apiResource('qualifications', 'QualificationsApiController');

    // Spouse Details
    Route::apiResource('spouse-details', 'SpouseDetailsApiController');

    // Children
    Route::apiResource('children', 'ChildrenApiController');

    // Industry Sector
    Route::apiResource('industry-sectors', 'IndustrySectorApiController');

    // Employment Details
    Route::apiResource('employment-details', 'EmploymentDetailsApiController');

    // Cihzones
    Route::apiResource('cihzones', 'CihzonesApiController');

    // Organization Type
    Route::apiResource('organization-types', 'OrganizationTypeApiController');

    // Department
    Route::apiResource('departments', 'DepartmentApiController');

    // Affinity Group
    Route::apiResource('affinity-groups', 'AffinityGroupApiController', ['except' => ['destroy']]);

    // Mountains Of Influence
    Route::apiResource('mountains-of-influences', 'MountainsOfInfluenceApiController');

    // Ats Membership Records
    Route::apiResource('ats-membership-records', 'AtsMembershipRecordsApiController');

    // Members Affinity Group
    Route::apiResource('members-affinity-groups', 'MembersAffinityGroupApiController');

    // Ats Membership
    Route::apiResource('ats-memberships', 'AtsMembershipApiController');

    // Join Department
    Route::apiResource('join-departments', 'JoinDepartmentApiController');

    // Missionary Force
    Route::apiResource('missionary-forces', 'MissionaryForceApiController', ['except' => ['destroy']]);

    // Sports
    Route::apiResource('sports', 'SportsApiController');

    // Interests
    Route::apiResource('interests', 'InterestsApiController');

    // Location
    Route::apiResource('locations', 'LocationApiController');

    // Venue Accessories
    Route::apiResource('venue-accessories', 'VenueAccessoriesApiController');

    // Venue
    Route::apiResource('venues', 'VenueApiController');

    // Meeting
    Route::post('meetings/media', 'MeetingApiController@storeMedia')->name('meetings.storeMedia');
    Route::apiResource('meetings', 'MeetingApiController');

    // Appointment Booking
    Route::post('appointment-bookings/media', 'AppointmentBookingApiController@storeMedia')->name('appointment-bookings.storeMedia');
    Route::apiResource('appointment-bookings', 'AppointmentBookingApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update', 'destroy']]);

    // Accessibility Features
    Route::apiResource('accessibility-features', 'AccessibilityFeaturesApiController');

    // Events
    Route::post('events/media', 'EventsApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventsApiController');

    // Bookings
    Route::apiResource('bookings', 'BookingsApiController');

    // Notification
    Route::post('notifications/media', 'NotificationApiController@storeMedia')->name('notifications.storeMedia');
    Route::apiResource('notifications', 'NotificationApiController');

    // Outreach
    Route::apiResource('outreaches', 'OutreachApiController');

    // Outreach Type
    Route::apiResource('outreach-types', 'OutreachTypeApiController');

    // First Timer
    Route::apiResource('first-timers', 'FirstTimerApiController');

    // Issue Management
    Route::apiResource('issue-managements', 'IssueManagementApiController');

    // Goal
    Route::post('goals/media', 'GoalApiController@storeMedia')->name('goals.storeMedia');
    Route::apiResource('goals', 'GoalApiController');

    // Attendance Management
    Route::post('attendance-managements/media', 'AttendanceManagementApiController@storeMedia')->name('attendance-managements.storeMedia');
    Route::apiResource('attendance-managements', 'AttendanceManagementApiController');

    // Reminders
    Route::post('reminders/media', 'RemindersApiController@storeMedia')->name('reminders.storeMedia');
    Route::apiResource('reminders', 'RemindersApiController');

    // Asset Category
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Location
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Cih Request
    Route::apiResource('cih-requests', 'CihRequestApiController');

    // Cih Centers Inspection
    Route::post('cih-centers-inspections/media', 'CihCentersInspectionApiController@storeMedia')->name('cih-centers-inspections.storeMedia');
    Route::apiResource('cih-centers-inspections', 'CihCentersInspectionApiController');

    // Inspectorate Group
    Route::apiResource('inspectorate-groups', 'InspectorateGroupApiController');

    // Ancillary Management
    Route::post('ancillary-managements/media', 'AncillaryManagementApiController@storeMedia')->name('ancillary-managements.storeMedia');
    Route::apiResource('ancillary-managements', 'AncillaryManagementApiController');

    // Service Type
    Route::apiResource('service-types', 'ServiceTypeApiController');

    // Empowerment
    Route::apiResource('empowerments', 'EmpowermentApiController', ['except' => ['destroy']]);

    // Area Of Specialization
    Route::apiResource('area-of-specializations', 'AreaOfSpecializationApiController');

    // Job Level
    Route::apiResource('job-levels', 'JobLevelApiController');

    // Mailings
    Route::apiResource('mailings', 'MailingsApiController');

    // Flutterwave Apikeys
    Route::apiResource('flutterwave-apikeys', 'FlutterwaveApikeysApiController');

    // Bank Account Details
    Route::apiResource('bank-account-details', 'BankAccountDetailsApiController');

    // Payment
    Route::post('payments/media', 'PaymentApiController@storeMedia')->name('payments.storeMedia');
    Route::apiResource('payments', 'PaymentApiController', ['except' => ['destroy']]);

    // Type Of Appoinment
    Route::apiResource('type-of-appoinments', 'TypeOfAppoinmentApiController');

    // Meeting Types
    Route::apiResource('meeting-types', 'MeetingTypesApiController');

    // Mountain Of Influence
    Route::apiResource('mountain-of-influences', 'MountainOfInfluenceApiController');

    // Empowerment Training Need
    Route::apiResource('empowerment-training-needs', 'EmpowermentTrainingNeedApiController');

    // Mf
    Route::apiResource('mfs', 'MfApiController');

    // Sub Sector
    Route::apiResource('sub-sectors', 'SubSectorApiController');

    // Event Type
    Route::apiResource('event-types', 'EventTypeApiController');

    // Attendees
    Route::apiResource('attendees', 'AttendeesApiController');

    // Bank Account Type
    Route::apiResource('bank-account-types', 'BankAccountTypeApiController');

    // Currency
    Route::apiResource('currencies', 'CurrencyApiController');

    // Cihmember
    Route::apiResource('cihmembers', 'CihmemberApiController');

    // Cih Types Of Request
    Route::apiResource('cih-types-of-requests', 'CihTypesOfRequestApiController');

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tag
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Faq Question
    Route::apiResource('faq-questions', 'FaqQuestionApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Lessons
    Route::post('lessons/media', 'LessonsApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonsApiController');

    // Tests
    Route::apiResource('tests', 'TestsApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Question Options
    Route::apiResource('question-options', 'QuestionOptionsApiController');

    // Test Results
    Route::apiResource('test-results', 'TestResultsApiController');

    // Test Answers
    Route::apiResource('test-answers', 'TestAnswersApiController');

    // Contact Company
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tag
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // E Flyers
    Route::post('e-flyers/media', 'EFlyersApiController@storeMedia')->name('e-flyers.storeMedia');
    Route::apiResource('e-flyers', 'EFlyersApiController');

    // Dedication
    Route::apiResource('dedications', 'DedicationApiController');

    // Christening
    Route::apiResource('christenings', 'ChristeningApiController');

    // Centres
    Route::apiResource('centres', 'CentresApiController');
});
