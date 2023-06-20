<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('membership_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/members*") ? "c-show" : "" }} {{ request()->is("admin/qualifications*") ? "c-show" : "" }} {{ request()->is("admin/employment-details*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }} {{ request()->is("admin/interests*") ? "c-show" : "" }} {{ request()->is("admin/mountain-of-influences*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.membership.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('member_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.members.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.member.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('qualification_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.qualifications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/qualifications") || request()->is("admin/qualifications/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.qualification.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('employment_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.employment-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/employment-details") || request()->is("admin/employment-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.employmentDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('family_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/spouse-details*") ? "c-show" : "" }} {{ request()->is("admin/children*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-people-carry c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.family.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('spouse_detail_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.spouse-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/spouse-details") || request()->is("admin/spouse-details/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-female c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.spouseDetail.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('child_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.children.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/children") || request()->is("admin/children/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-child c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.child.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('interest_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.interests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/interests") || request()->is("admin/interests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-baseball-ball c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.interest.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('mountain_of_influence_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.mountain-of-influences.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mountain-of-influences") || request()->is("admin/mountain-of-influences/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.mountainOfInfluence.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('church_affiliation_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/ats-memberships*") ? "c-show" : "" }} {{ request()->is("admin/join-departments*") ? "c-show" : "" }} {{ request()->is("admin/members-affinity-groups*") ? "c-show" : "" }} {{ request()->is("admin/cihmembers*") ? "c-show" : "" }} {{ request()->is("admin/mfs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-church c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.churchAffiliation.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('ats_membership_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.ats-memberships.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ats-memberships") || request()->is("admin/ats-memberships/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.atsMembership.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('join_department_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.join-departments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/join-departments") || request()->is("admin/join-departments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.joinDepartment.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('members_affinity_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.members-affinity-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/members-affinity-groups") || request()->is("admin/members-affinity-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.membersAffinityGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cihmember_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cihmembers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cihmembers") || request()->is("admin/cihmembers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-church c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cihmember.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('mf_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.mfs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mfs") || request()->is("admin/mfs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.mf.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('appointment_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/appointment-bookings*") ? "c-show" : "" }} {{ request()->is("admin/type-of-appoinments*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-calendar-plus c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.appointmentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('appointment_booking_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.appointment-bookings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/appointment-bookings") || request()->is("admin/appointment-bookings/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.appointmentBooking.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('type_of_appoinment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.type-of-appoinments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/type-of-appoinments") || request()->is("admin/type-of-appoinments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.typeOfAppoinment.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('meeting_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/meetings*") ? "c-show" : "" }} {{ request()->is("admin/attendance-managements*") ? "c-show" : "" }} {{ request()->is("admin/meeting-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.meetingManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('meeting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.meetings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/meetings") || request()->is("admin/meetings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.meeting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('attendance_management_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.attendance-managements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/attendance-managements") || request()->is("admin/attendance-managements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.attendanceManagement.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('meeting_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.meeting-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/meeting-types") || request()->is("admin/meeting-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.meetingType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('venue_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bookings*") ? "c-show" : "" }} {{ request()->is("admin/venues*") ? "c-show" : "" }} {{ request()->is("admin/venue-accessories*") ? "c-show" : "" }} {{ request()->is("admin/accessibility-features*") ? "c-show" : "" }} {{ request()->is("admin/locations*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-archway c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.venueManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('booking_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bookings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bookings") || request()->is("admin/bookings/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.booking.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('venue_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.venues.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/venues") || request()->is("admin/venues/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-pin c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.venue.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('venue_accessory_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.venue-accessories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/venue-accessories") || request()->is("admin/venue-accessories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-toolbox c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.venueAccessory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('accessibility_feature_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.accessibility-features.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/accessibility-features") || request()->is("admin/accessibility-features/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-accessible-icon c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.accessibilityFeature.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/locations") || request()->is("admin/locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-thumbtack c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.location.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('event_church_program_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/events*") ? "c-show" : "" }} {{ request()->is("admin/event-types*") ? "c-show" : "" }} {{ request()->is("admin/attendees*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-calendar-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.eventChurchProgram.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('event_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.events.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.event.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('event_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.event-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/event-types") || request()->is("admin/event-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eventType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('attendee_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.attendees.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/attendees") || request()->is("admin/attendees/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.attendee.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('issue_management_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.issue-managements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/issue-managements") || request()->is("admin/issue-managements/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-toolbox c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.issueManagement.title') }}
                </a>
            </li>
        @endcan
        @can('goal_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.goals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/goals") || request()->is("admin/goals/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-star c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.goal.title') }}
                </a>
            </li>
        @endcan
        @can('notification_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/notifications*") ? "c-show" : "" }} {{ request()->is("admin/reminders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.notificationManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('notification_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.notifications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/notifications") || request()->is("admin/notifications/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-comments c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.notification.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('reminder_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reminders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reminders") || request()->is("admin/reminders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.reminder.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('outreach_and_mission_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/outreaches*") ? "c-show" : "" }} {{ request()->is("admin/outreach-types*") ? "c-show" : "" }} {{ request()->is("admin/e-flyers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-accessible-icon c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.outreachAndMission.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('outreach_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.outreaches.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/outreaches") || request()->is("admin/outreaches/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.outreach.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('outreach_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.outreach-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/outreach-types") || request()->is("admin/outreach-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-donate c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.outreachType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('e_flyer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.e-flyers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/e-flyers") || request()->is("admin/e-flyers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.eFlyer.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('ancillary_service_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/ancillary-managements*") ? "c-show" : "" }} {{ request()->is("admin/service-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.ancillaryService.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('ancillary_management_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.ancillary-managements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ancillary-managements") || request()->is("admin/ancillary-managements/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.ancillaryManagement.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('service_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.service-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/service-types") || request()->is("admin/service-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.serviceType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('chat_management_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.chat-managements.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/chat-managements") || request()->is("admin/chat-managements/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-comments c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.chatManagement.title') }}
                </a>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('asset_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assetManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('asset_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-locations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetLocation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.asset.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('assets_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets-histories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetsHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('cih_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/first-timers*") ? "c-show" : "" }} {{ request()->is("admin/dedications*") ? "c-show" : "" }} {{ request()->is("admin/christenings*") ? "c-show" : "" }} {{ request()->is("admin/cih-requests*") ? "c-show" : "" }} {{ request()->is("admin/cihzones*") ? "c-show" : "" }} {{ request()->is("admin/centres*") ? "c-show" : "" }} {{ request()->is("admin/cih-types-of-requests*") ? "c-show" : "" }} {{ request()->is("admin/cih-centers-inspections*") ? "c-show" : "" }} {{ request()->is("admin/inspectorate-groups*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.cihManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('first_timer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.first-timers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/first-timers") || request()->is("admin/first-timers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.firstTimer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('dedication_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.dedications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/dedications") || request()->is("admin/dedications/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-child c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dedication.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('christening_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.christenings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/christenings") || request()->is("admin/christenings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-child c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.christening.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cih_request_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cih-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cih-requests") || request()->is("admin/cih-requests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-envelope-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cihRequest.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cihzone_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cihzones.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cihzones") || request()->is("admin/cihzones/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-thumbtack c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cihzone.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('centre_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.centres.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/centres") || request()->is("admin/centres/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-houzz c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.centre.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cih_types_of_request_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cih-types-of-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cih-types-of-requests") || request()->is("admin/cih-types-of-requests/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cihTypesOfRequest.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cih_centers_inspection_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cih-centers-inspections.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cih-centers-inspections") || request()->is("admin/cih-centers-inspections/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-teamspeak c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cihCentersInspection.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('inspectorate_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.inspectorate-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/inspectorate-groups") || request()->is("admin/inspectorate-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.inspectorateGroup.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('join_empowerment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/empowerments*") ? "c-show" : "" }} {{ request()->is("admin/mailings*") ? "c-show" : "" }} {{ request()->is("admin/area-of-specializations*") ? "c-show" : "" }} {{ request()->is("admin/job-levels*") ? "c-show" : "" }} {{ request()->is("admin/empowerment-training-needs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.joinEmpowerment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('empowerment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.empowerments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/empowerments") || request()->is("admin/empowerments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.empowerment.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('mailing_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.mailings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mailings") || request()->is("admin/mailings/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.mailing.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('area_of_specialization_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.area-of-specializations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/area-of-specializations") || request()->is("admin/area-of-specializations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.areaOfSpecialization.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('job_level_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.job-levels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/job-levels") || request()->is("admin/job-levels/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.jobLevel.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('empowerment_training_need_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.empowerment-training-needs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/empowerment-training-needs") || request()->is("admin/empowerment-training-needs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-toolbox c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.empowermentTrainingNeed.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('payment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-money-bill-wave c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.payment.title') }}
                </a>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('payment_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/bank-account-details*") ? "c-show" : "" }} {{ request()->is("admin/bank-account-types*") ? "c-show" : "" }} {{ request()->is("admin/currencies*") ? "c-show" : "" }} {{ request()->is("admin/flutterwave-apikeys*") ? "c-show" : "" }} {{ request()->is("admin/cgcc-payment-forms*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-paypal c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.paymentSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('bank_account_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-account-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-account-details") || request()->is("admin/bank-account-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-check-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankAccountDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bank_account_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-account-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-account-types") || request()->is("admin/bank-account-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-university c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankAccountType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('currency_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.currencies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/currencies") || request()->is("admin/currencies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.currency.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('flutterwave_apikey_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.flutterwave-apikeys.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/flutterwave-apikeys") || request()->is("admin/flutterwave-apikeys/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.flutterwaveApikey.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cgcc_payment_form_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cgcc-payment-forms.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cgcc-payment-forms") || request()->is("admin/cgcc-payment-forms/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-credit-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cgccPaymentForm.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('administrative_role_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/affinity-groups*") ? "c-show" : "" }} {{ request()->is("admin/ats-membership-records*") ? "c-show" : "" }} {{ request()->is("admin/departments*") ? "c-show" : "" }} {{ request()->is("admin/mountains-of-influences*") ? "c-show" : "" }} {{ request()->is("admin/missionary-forces*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-toolbox c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.administrativeRole.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('affinity_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.affinity-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/affinity-groups") || request()->is("admin/affinity-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.affinityGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('ats_membership_record_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.ats-membership-records.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ats-membership-records") || request()->is("admin/ats-membership-records/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.atsMembershipRecord.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('department_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.departments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.department.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('mountains_of_influence_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.mountains-of-influences.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mountains-of-influences") || request()->is("admin/mountains-of-influences/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.mountainsOfInfluence.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('missionary_force_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.missionary-forces.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/missionary-forces") || request()->is("admin/missionary-forces/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-handshake c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.missionaryForce.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('misc_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/titles*") ? "c-show" : "" }} {{ request()->is("admin/marital-statuses*") ? "c-show" : "" }} {{ request()->is("admin/employment-statuses*") ? "c-show" : "" }} {{ request()->is("admin/qualification-settings*") ? "c-show" : "" }} {{ request()->is("admin/industry-sectors*") ? "c-show" : "" }} {{ request()->is("admin/sub-sectors*") ? "c-show" : "" }} {{ request()->is("admin/organization-types*") ? "c-show" : "" }} {{ request()->is("admin/sports*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-wrench c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.misc.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('title_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.titles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/titles") || request()->is("admin/titles/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fab fa-black-tie c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.title.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('marital_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.marital-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/marital-statuses") || request()->is("admin/marital-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-life-ring c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.maritalStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('employment_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.employment-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/employment-statuses") || request()->is("admin/employment-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.employmentStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('qualification_setting_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.qualification-settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/qualification-settings") || request()->is("admin/qualification-settings/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.qualificationSetting.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('industry_sector_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.industry-sectors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/industry-sectors") || request()->is("admin/industry-sectors/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-industry c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.industrySector.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('sub_sector_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.sub-sectors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sub-sectors") || request()->is("admin/sub-sectors/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-industry c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.subSector.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('organization_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.organization-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/organization-types") || request()->is("admin/organization-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.organizationType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('sport_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.sports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sports") || request()->is("admin/sports/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-volleyball-ball c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.sport.title') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('sport_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.mailingSetup.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/mailingSetup/create") || request()->is("admin/mailingSetup/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-volleyball-ball c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.mailingSetup.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('contact_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/contact-companies*") ? "c-show" : "" }} {{ request()->is("admin/contact-contacts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-phone-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contactManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('contact_company_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-companies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-companies") || request()->is("admin/contact-companies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactCompany.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_contact_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-contacts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-contacts") || request()->is("admin/contact-contacts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactContact.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('at_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/courses*") ? "c-show" : "" }} {{ request()->is("admin/lessons*") ? "c-show" : "" }} {{ request()->is("admin/tests*") ? "c-show" : "" }} {{ request()->is("admin/questions*") ? "c-show" : "" }} {{ request()->is("admin/question-options*") ? "c-show" : "" }} {{ request()->is("admin/test-results*") ? "c-show" : "" }} {{ request()->is("admin/test-answers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.at.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('course_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.course.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lesson_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.lessons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lesson.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('test_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.test.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.question.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('question_option_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.question-options.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/question-options") || request()->is("admin/question-options/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.questionOption.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('test_result_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.test-results.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/test-results") || request()->is("admin/test-results/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-clipboard-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.testResult.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('test_answer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.test-answers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/test-answers") || request()->is("admin/test-answers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list-ol c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.testAnswer.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/product-tags*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @php($unread = \App\Models\QaTopic::unreadCount())
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="c-sidebar-nav-item">
                <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
    </ul>

</div>
