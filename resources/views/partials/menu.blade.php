<style>
    .nav-link,
    .nav-icon {
        color: white !important;
    }

    .nav-icon::after,
    .nav-group-toggle::after {
        border-color: white !important;
    }
    .custom-select{
      min-width: 60px;
    }
    </style>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="" style="color: white;">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.home') }}">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> {{ trans('global.dashboard') }}</a></li>

          <li class="nav-group {{ request()->is("admin/members*") ? "c-show" : "" }} {{ request()->is("admin/join-departments*") ? "c-show" : "" }} {{ request()->is("admin/members-affinity-groups*") ? "c-show" : "" }} {{ request()->is("admin/cihmembers*") ? "c-show" : "" }} {{ request()->is("admin/mfs*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-group"></use>
                </svg> {{ trans('cruds.membership.title') }}</a>
            <ul class="nav-group-items">
                @can('dash_board_venue_info')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route('admin.members.index') }}"><span class="nav-icon"></span>
                        Biodata List</a>
                  </li>
                  @endcan

                @can('member_access')
                  <li class="nav-item"><a class="nav-link {{ request()->is("admin/members/create") || request()->is("admin/members/create/*") ? "c-active" : "" }}"
                          href="{{ route('admin.members.create') }}"><span class="nav-icon"></span>
                          Add Biodata</a>
                    </li>
                @endcan

                @can('dash_board_venue_info')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route('admin.qualifications.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.qualification.title') }}</a>
                  </li>
                  @endcan

                @can('qualification_access')
                  <li class="nav-item"><a class="nav-link {{ request()->is("admin/members/create") || request()->is("admin/members/create/*") ? "c-active" : "" }}"
                          href="{{ route('admin.qualifications.create') }}"><span class="nav-icon"></span>
                          Add Qualification</a>
                    </li>
                 @endcan

                 @can('dash_board_venue_info')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route("admin.employment-details.index") }}"><span class="nav-icon"></span>
                        {{ trans('cruds.employmentDetail.title') }}</a>
                  </li>
                  @endcan

                  @can('employment_detail_access')
                  <li class="nav-item"><a class="nav-link {{ request()->is("admin/members/create") || request()->is("admin/members/create/*") ? "c-active" : "" }}"
                          href="{{ route("admin.employment-details.create") }}"><span class="nav-icon"></span>
                          Add Employment Details</a>
                    </li>
                    @endcan

                @can('dash_board_venue_info')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route('admin.spouse-details.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.spouseDetail.title') }}</a>
                  </li>
                  @endcan

                  @can('spouse_detail_access')
                  <li class="nav-item"><a class="nav-link {{ request()->is("admin/members/create") || request()->is("admin/members/create/*") ? "c-active" : "" }}"
                          href="{{ route('admin.spouse-details.create') }}"><span class="nav-icon"></span>
                          Add Spouse Detail</a>
                    </li>
                    @endcan

                @can('child_access')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route('admin.children.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.child.title') }}</a>
                  </li>
                  @endcan

                @can('dash_board_venue_info')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route('admin.interests.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.interest.title') }}</a>
                  </li>
                  @endcan

                  @can('interest_access')
                  <li class="nav-item"><a class="nav-link {{ request()->is("admin/members/create") || request()->is("admin/members/create/*") ? "c-active" : "" }}"
                          href="{{ route('admin.interests.create') }}"><span class="nav-icon"></span>
                         Add Interests</a>
                    </li>
                    @endcan

                @can('dash_board_venue_info')
                <li class="nav-item"><a class="nav-link {{ request()->is("admin/members") || request()->is("admin/members/*") ? "c-active" : "" }}"
                        href="{{ route('admin.mountain-of-influences.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.mountainOfInfluence.title') }}</a>
                  </li>
                  @endcan

                  @can('mountain_of_influence_access')
                  <li class="nav-item"><a class="nav-link {{ request()->is("admin/members/create") || request()->is("admin/members/create/*") ? "c-active" : "" }}"
                          href="{{ route('admin.mountain-of-influences.create') }}"><span class="nav-icon"></span>
                          Add Mountain of Influence</a>
                    </li>
                    @endcan
              </ul>
        </li>

        @can('church_affiliation_access')
        <li class="nav-group {{ request()->is("admin/ats-memberships*") ? "c-show" : "" }} {{ request()->is("admin/join-departments*") ? "c-show" : "" }} {{ request()->is("admin/members-affinity-groups*") ? "c-show" : "" }} {{ request()->is("admin/cihmembers*") ? "c-show" : "" }} {{ request()->is("admin/mfs*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-building"></use>
                </svg> {{ trans('cruds.churchAffiliation.title') }}</a>
            <ul class="nav-group-items">
                @can('ats_membership_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/ats-memberships") || request()->is("admin/ats-memberships/*") ? "c-active" : "" }}"
                        href="{{ route('admin.ats-memberships.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.atsMembership.title') }}</a></li>
                @endcan
                @can('dash_board_recent_member')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/join-departments") || request()->is("admin/join-departments/*") ? "c-active" : "" }}"
                        href="{{ route('admin.join-departments.index') }}"> {{ trans('cruds.joinDepartment.title') }}</a>
                </li>
                @endcan
                @can('join_department_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/join-departments/create") || request()->is("admin/join-departments/create/*") ? "c-active" : "" }}"
                        href="{{ route('admin.join-departments.create') }}"> Join Department</a>
                </li>
                @endcan
                @can('members_affinity_group_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/members-affinity-groups") || request()->is("admin/members-affinity-groups/*") ? "c-active" : "" }}"
                        href="{{ route('admin.members-affinity-groups.index') }}">
                        {{ trans('cruds.membersAffinityGroup.title') }}</a></li>
                @endcan
                @can('cihmember_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/cihmembers") || request()->is("admin/cihmembers/*") ? "c-active" : "" }}"
                        href="{{ route("admin.cihmembers.index") }}"> {{ trans('cruds.cihmember.title') }}</a></li>
                @endcan
                @can('mf_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/mfs") || request()->is("admin/mfs/*") ? "c-active" : "" }}"
                        href="{{ route('admin.mfs.index') }}"><span class="nav-icon"></span>
                        {{ trans('cruds.mf.title') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('appointment_management_access')
        <li
            class="nav-group {{ request()->is("admin/appointment-bookings*") ? "c-show" : "" }} {{ request()->is("admin/type-of-appoinments*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
                </svg> {{ trans('cruds.appointmentManagement.title') }}</a>
            <ul class="nav-group-items">
                @can('appointment_booking_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/appointment-bookings") || request()->is("admin/appointment-bookings/*") ? "c-active" : "" }}"
                        href="{{ route("admin.appointment-bookings.index") }}">
                        {{ trans('cruds.appointmentBooking.title') }}</a></li>
                @endcan
                @can('type_of_appoinment_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/type-of-appoinments") || request()->is("admin/type-of-appoinments/*") ? "c-active" : "" }}"
                        href="{{ route("admin.type-of-appoinments.index") }}">
                        {{ trans('cruds.typeOfAppoinment.title') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('meeting_management_access')
        <li
            class="nav-group {{ request()->is("admin/meetings*") ? "c-show" : "" }} {{ request()->is("admin/attendance-managements*") ? "c-show" : "" }} {{ request()->is("admin/meeting-types*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-group"></use>
                </svg> {{ trans('cruds.meetingManagement.title') }}</a>
            <ul class="nav-group-items">
                @can('meeting_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/meetings") || request()->is("admin/meetings/*") ? "c-active" : "" }}"
                        href="{{ route("admin.meetings.index") }}"> {{ trans('cruds.meeting.title') }}</a></li>
                @endcan
                @can('attendance_management_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/attendance-managements") || request()->is("admin/attendance-managements/*") ? "c-active" : "" }}"
                        href="{{ route("admin.attendance-managements.index") }}">
                        {{ trans('cruds.attendanceManagement.title') }}</a></li>
                @endcan
                @can('meeting_type_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/meeting-types") || request()->is("admin/meeting-types/*") ? "c-active" : "" }}"
                        href="{{ route("admin.meeting-types.index") }}">{{ trans('cruds.meetingType.title') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('venue_management_access')
        <li
            class="nav-group {{ request()->is("admin/bookings*") ? "c-show" : "" }} {{ request()->is("admin/venues*") ? "c-show" : "" }} {{ request()->is("admin/venue-accessories*") ? "c-show" : "" }} {{ request()->is("admin/accessibility-features*") ? "c-show" : "" }} {{ request()->is("admin/locations*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-industry"></use>
                </svg> {{ trans('cruds.venueManagement.title') }}</a>
            <ul class="nav-group-items">
                @can('booking_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/bookings") || request()->is("admin/bookings/*") ? "c-active" : "" }}"
                        href="{{ route("admin.bookings.index") }}"> {{ trans('cruds.booking.title') }}</a></li>
                @endcan
                @can('venue_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/venues") || request()->is("admin/venues/*") ? "c-active" : "" }}"
                        href="{{ route("admin.venues.index") }}"> {{ trans('cruds.venue.title') }}</a></li>
                @endcan
                @can('venue_accessory_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/venue-accessories") || request()->is("admin/venue-accessories/*") ? "c-active" : "" }}"
                        href="{{ route("admin.venue-accessories.index") }}"> {{ trans('cruds.venueAccessory.title') }}</a>
                </li>
                @endcan
                @can('accessibility_feature_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/accessibility-features") || request()->is("admin/accessibility-features/*") ? "c-active" : "" }}"
                        href="{{ route("admin.accessibility-features.index") }}">
                        {{ trans('cruds.accessibilityFeature.title') }}</a></li>
                @endcan
                @can('location_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/locations") || request()->is("admin/locations/*") ? "c-active" : "" }}"
                        href="{{ route("admin.locations.index") }}"> {{ trans('cruds.location.title') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('event_church_program_access')
        <li
            class="nav-group {{ request()->is("admin/events*") ? "c-show" : "" }} {{ request()->is("admin/event-types*") ? "c-show" : "" }} {{ request()->is("admin/attendees*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-globe-alt"></use>
                </svg> {{ trans('cruds.eventChurchProgram.title') }}</a>
            <ul class="nav-group-items">
                @can('event_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "c-active" : "" }}"
                        href="{{ route("admin.events.index") }}"> {{ trans('cruds.event.title') }}</a></li>
                @endcan
                @can('event_type_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/event-types") || request()->is("admin/event-types/*") ? "c-active" : "" }}"
                        href="{{ route("admin.event-types.index") }}"> {{ trans('cruds.eventType.title') }}</a></li>
                @endcan
                @can('attendee_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/attendees") || request()->is("admin/attendees/*") ? "c-active" : "" }}"
                        href="{{ route("admin.attendees.index") }}"> {{ trans('cruds.attendee.title') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('issue_management_access')
        <li class="nav-item"><a
                class="nav-link {{ request()->is("admin/issue-managements") || request()->is("admin/issue-managements/*") ? "c-active" : "" }}"
                href="{{ route("admin.issue-managements.index") }}">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-grid-slash"></use>
                </svg> {{ trans('cruds.issueManagement.title') }}</a>
        </li>
        @endcan
        @can('goal_access')
        <li class="nav-item"><a
                class="nav-link {{ request()->is("admin/goals") || request()->is("admin/goals/*") ? "c-active" : "" }}"
                href="{{ route("admin.goals.index") }}">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-golf"></use>
                </svg> {{ trans('cruds.goal.title') }}</a>
        </li>
        @endcan
        @can('notification_management_access')
        <li
            class="nav-group {{ request()->is("admin/notifications*") ? "c-show" : "" }} {{ request()->is("admin/reminders*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg> {{ trans('cruds.notificationManagement.title') }}</a>
            <ul class="nav-group-items">
                @can('notification_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/notifications") || request()->is("admin/notifications/*") ? "c-active" : "" }}"
                        href="{{ route("admin.notifications.index") }}"> {{ trans('cruds.notification.title') }}</a></li>
                @endcan
                @can('reminder_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/reminders") || request()->is("admin/reminders/*") ? "c-active" : "" }}"
                        href="{{ route("admin.reminders.index") }}"> {{ trans('cruds.reminder.title') }}</a></li>
                @endcan
                <li class="nav-item"><a class="nav-link" href="notifications/modals.html"><span class="nav-icon"></span>
                        Modals</a></li>
                <li class="nav-item"><a class="nav-link" href="notifications/toasts.html"><span class="nav-icon"></span>
                        Toasts</a></li>
            </ul>
        </li>
        @endcan
        @can('outreach_and_mission_access')
        <li
            class="nav-group{{ request()->is("admin/outreaches*") ? "c-show" : "" }} {{ request()->is("admin/outreach-types*") ? "c-show" : "" }} {{ request()->is("admin/e-flyers*") ? "c-show" : "" }} {{ request()->is("admin/outreaches*") ? "c-show" : "" }} {{ request()->is("admin/outreach-types*") ? "c-show" : "" }} {{ request()->is("admin/e-flyers*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-bullhorn"></use>
                </svg> {{ trans('cruds.outreachAndMission.title') }}</a>
            <ul class="nav-group-items">
                @can('outreach_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/outreaches") || request()->is("admin/outreaches/*") ? "c-active" : "" }}"
                        href="{{ route("admin.outreaches.index") }}"> {{ trans('cruds.outreach.title') }}</a></li>
                @endcan
                @can('outreach_type_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/outreach-types") || request()->is("admin/outreach-types/*") ? "c-active" : "" }}"
                        href="{{ route("admin.outreach-types.index") }}"> {{ trans('cruds.outreachType.title') }}</a></li>
                @endcan
                @can('e_flyer_access')
                <li class="nav-item"><a
                        class="nav-link {{ request()->is("admin/e-flyers") || request()->is("admin/e-flyers/*") ? "c-active" : "" }}"
                        href="{{ route("admin.e-flyers.index") }}"> {{ trans('cruds.eFlyer.title') }}</a></li>
                @endcan
            </ul>
        </li>
        @endcan



        @can('ancillary_service_access')
        <li
            class="nav-group {{ request()->is("admin/ancillary-managements*") ? "c-show" : "" }} {{ request()->is("admin/service-types*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-browser"></use>
                </svg> {{ trans('cruds.ancillaryService.title') }}</a>
            <ul class="nav-group-items">
                @can('ancillary_management_access')
                <li class="nav-item"><a href="{{ route("admin.ancillary-managements.index") }}"
                        class="nav-link {{ request()->is("admin/ancillary-managements") || request()->is("admin/ancillary-managements/*") ? "c-active" : "" }}">
                        {{ trans('cruds.ancillaryManagement.title') }}</a>
                </li>
                @endcan
                @can('service_type_access')
                <li class="nav-item"><a href="{{ route("admin.service-types.index") }}"
                        class="nav-link {{ request()->is("admin/service-types") || request()->is("admin/service-types/*") ? "c-active" : "" }}">{{ trans('cruds.serviceType.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('chat_management_access')
        <li class="nav-item">
            <a href="{{ route("admin.chat-managements.index") }}"
                class="nav-link {{ request()->is("admin/chat-managements") || request()->is("admin/chat-managements/*") ? "c-active" : "" }}">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-chat-bubble"></use>
                </svg>
                {{ trans('cruds.chatManagement.title') }}
            </a>
        </li>
        @endcan
        @can('user_management_access')
        <li
            class="nav-group {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-user-plus"></use>
                </svg>
                {{ trans('cruds.userManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('permission_access')
                <li class="nav-item"><a href="{{ route("admin.permissions.index") }}"
                        class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                        {{ trans('cruds.permission.title') }}
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li class="nav-item"><a href="{{ route("admin.roles.index") }}"
                        class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                        {{ trans('cruds.role.title') }}
                    </a>
                </li>
                @endcan
                @can('audit_log_access')
                <li class="nav-item"><a href="{{ route("admin.audit-logs.index") }}"
                        class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                        {{ trans('cruds.auditLog.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('asset_management_access')
        <li
            class="nav-group {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
                </svg> {{ trans('cruds.assetManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('asset_category_access')
                <li class="nav-item"><a href="{{ route("admin.asset-categories.index") }}"
                        class="nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                        <!-- <i class="fa-fw fas fa-tags c-sidebar-nav-icon"></i>  -->
                        {{ trans('cruds.assetCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('asset_location_access')
                <li class="nav-item"><a href="{{ route("admin.asset-locations.index") }}"
                        class="nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                        <!-- <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon"></i>  -->
                        {{ trans('cruds.assetLocation.title') }}
                    </a>
                </li>
                @endcan
                @can('asset_status_access')
                <li class="nav-item"><a href="{{ route("admin.asset-statuses.index") }}"
                        class="nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                        {{ trans('cruds.assetStatus.title') }}
                    </a>
                </li>
                @endcan
                @can('asset_access')
                <li class="nav-item"><a href="{{ route("admin.assets.index") }}"
                        class="nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                        {{ trans('cruds.asset.title') }}
                    </a>
                </li>
                @endcan
                @can('assets_history_access')
                <li class="nav-item"><a href="{{ route("admin.assets-histories.index") }}"
                        class="nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                        {{ trans('cruds.assetsHistory.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('cih_management_access')
        <li
            class="nav-group {{ request()->is("admin/first-timers*") ? "c-show" : "" }} {{ request()->is("admin/dedications*") ? "c-show" : "" }} {{ request()->is("admin/christenings*") ? "c-show" : "" }} {{ request()->is("admin/cih-requests*") ? "c-show" : "" }} {{ request()->is("admin/cihzones*") ? "c-show" : "" }} {{ request()->is("admin/centres*") ? "c-show" : "" }} {{ request()->is("admin/cih-types-of-requests*") ? "c-show" : "" }} {{ request()->is("admin/cih-centers-inspections*") ? "c-show" : "" }} {{ request()->is("admin/inspectorate-groups*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-wrap-text"></use>
                </svg>
                {{ trans('cruds.cihManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('first_timer_access')
                <li class="nav-item"><a href="{{ route("admin.first-timers.index") }}"
                        class="nav-link {{ request()->is("admin/first-timers") || request()->is("admin/first-timers/*") ? "c-active" : "" }}">
                        {{ trans('cruds.firstTimer.title') }}
                    </a>
                </li>
                @endcan
                @can('dedication_access')
                <li class="nav-item"><a href="{{ route("admin.dedications.index") }}"
                        class="nav-link {{ request()->is("admin/dedications") || request()->is("admin/dedications/*") ? "c-active" : "" }}">
                        {{ trans('cruds.dedication.title') }}
                    </a>
                </li>
                @endcan
                @can('christening_access')
                <li class="nav-item"><a href="{{ route("admin.christenings.index") }}"
                        class="nav-link {{ request()->is("admin/christenings") || request()->is("admin/christenings/*") ? "c-active" : "" }}">
                        {{ trans('cruds.christening.title') }}
                    </a>
                </li>
                @endcan
                @can('cih_request_access')
                <li class="nav-item"><a href="{{ route("admin.cih-requests.index") }}"
                        class="nav-link {{ request()->is("admin/cih-requests") || request()->is("admin/cih-requests/*") ? "c-active" : "" }}">
                        {{ trans('cruds.cihRequest.title') }}
                    </a>
                </li>
                @endcan
                @can('cihzone_access')
                <li class="nav-item"><a href="{{ route("admin.cihzones.index") }}"
                        class="nav-link {{ request()->is("admin/cihzones") || request()->is("admin/cihzones/*") ? "c-active" : "" }}">
                        {{ trans('cruds.cihzone.title') }}
                    </a>
                </li>
                @endcan
                @can('centre_access')
                <li class="nav-item"><a href="{{ route("admin.centres.index") }}"
                        class="nav-link {{ request()->is("admin/centres") || request()->is("admin/centres/*") ? "c-active" : "" }}">
                        {{ trans('cruds.centre.title') }}
                    </a>
                </li>
                @endcan
                @can('cih_types_of_request_access')
                <li class="nav-item"><a href="{{ route("admin.cih-types-of-requests.index") }}"
                        class="nav-link {{ request()->is("admin/cih-types-of-requests") || request()->is("admin/cih-types-of-requests/*") ? "c-active" : "" }}">
                        <!-- <i class="fa-fw far fa-envelope c-sidebar-nav-icon"></i> -->
                        {{ trans('cruds.cihTypesOfRequest.title') }}
                    </a>
                </li>
                @endcan
                @can('cih_centers_inspection_access')
                <li class="nav-item"><a href="{{ route("admin.cih-centers-inspections.index") }}"
                        class="nav-link {{ request()->is("admin/cih-centers-inspections") || request()->is("admin/cih-centers-inspections/*") ? "c-active" : "" }}">
                        {{ trans('cruds.cihCentersInspection.title') }}
                    </a>
                </li>
                @endcan
                @can('inspectorate_group_access')
                <li class="nav-item"><a href="{{ route("admin.inspectorate-groups.index") }}"
                        class="nav-link {{ request()->is("admin/inspectorate-groups") || request()->is("admin/inspectorate-groups/*") ? "c-active" : "" }}">
                        {{ trans('cruds.inspectorateGroup.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('join_empowerment_access')
        <li
            class="nav-group {{ request()->is("admin/empowerments*") ? "c-show" : "" }} {{ request()->is("admin/mailings*") ? "c-show" : "" }} {{ request()->is("admin/area-of-specializations*") ? "c-show" : "" }} {{ request()->is("admin/job-levels*") ? "c-show" : "" }} {{ request()->is("admin/empowerment-training-needs*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-weightlifitng"></use>
                </svg>
                {{ trans('cruds.joinEmpowerment.title') }}
            </a>
            <ul class="nav-group-items">
                @can('empowerment_access')
                <li class="nav-item"><a href="{{ route("admin.empowerments.index") }}"
                        class="nav-link {{ request()->is("admin/empowerments") || request()->is("admin/empowerments/*") ? "c-active" : "" }}">
                        {{ trans('cruds.empowerment.title') }}
                    </a>
                </li>
                @endcan
                @can('mailing_access')
                <li class="nav-item"><a href="{{ route("admin.mailings.index") }}"
                        class="nav-link {{ request()->is("admin/mailings") || request()->is("admin/mailings/*") ? "c-active" : "" }}">
                        {{ trans('cruds.mailing.title') }}
                    </a>
                </li>
                @endcan
                @can('area_of_specialization_access')
                <li class="nav-item"><a href="{{ route("admin.area-of-specializations.index") }}"
                        class="nav-link {{ request()->is("admin/area-of-specializations") || request()->is("admin/area-of-specializations/*") ? "c-active" : "" }}">
                        {{ trans('cruds.areaOfSpecialization.title') }}
                    </a>
                </li>
                @endcan
                @can('job_level_access')
                <li class="nav-item"><a href="{{ route("admin.job-levels.index") }}"
                        class="nav-link {{ request()->is("admin/job-levels") || request()->is("admin/job-levels/*") ? "c-active" : "" }}">
                        {{ trans('cruds.jobLevel.title') }}
                    </a>
                </li>
                @endcan
                @can('empowerment_training_need_access')
                <li class="nav-item"><a href="{{ route("admin.empowerment-training-needs.index") }}"
                        class="nav-link {{ request()->is("admin/empowerment-training-needs") || request()->is("admin/empowerment-training-needs/*") ? "c-active" : "" }}">
                        {{ trans('cruds.empowermentTrainingNeed.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('payment_access')
        <li class="nav-item">
            <a href="{{ route("admin.payments.index") }}"
                class="nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "c-active" : "" }}">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-wallet"></use>
                </svg> {{ trans('cruds.payment.title') }}
            </a>
        </li>
        @endcan
        @can('task_management_access')
        <li
            class="nav-group {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-vector"></use>
                </svg>
                {{ trans('cruds.taskManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('task_status_access')
                <li class="nav-item"><a href="{{ route("admin.task-statuses.index") }}"
                        class="nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                        {{ trans('cruds.taskStatus.title') }}
                    </a>
                </li>
                @endcan
                @can('task_tag_access')
                <li class="nav-item"><a href="{{ route("admin.task-tags.index") }}"
                        class="nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                        {{ trans('cruds.taskTag.title') }}
                    </a>
                </li>
                @endcan
                @can('task_access')
                <li class="nav-item"><a href="{{ route("admin.tasks.index") }}"
                        class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                        {{ trans('cruds.task.title') }}
                    </a>
                </li>
                @endcan
                @can('tasks_calendar_access')
                <li class="nav-item"><a href="{{ route("admin.tasks-calendars.index") }}"
                        class="nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                        {{ trans('cruds.tasksCalendar.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('payment_setting_access')
        <li
            class="nav-group {{ request()->is("admin/bank-account-details*") ? "c-show" : "" }} {{ request()->is("admin/bank-account-types*") ? "c-show" : "" }} {{ request()->is("admin/currencies*") ? "c-show" : "" }} {{ request()->is("admin/flutterwave-apikeys*") ? "c-show" : "" }} {{ request()->is("admin/cgcc-payment-forms*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calculator"></use>
                </svg> {{ trans('cruds.paymentSetting.title') }}
            </a>
            <ul class="nav-group-items">
                @can('bank_account_detail_access')
                <li class="nav-item"><a href="{{ route("admin.bank-account-details.index") }}"
                        class="nav-link {{ request()->is("admin/bank-account-details") || request()->is("admin/bank-account-details/*") ? "c-active" : "" }}">
                        {{ trans('cruds.bankAccountDetail.title') }}
                    </a>
                </li>
                @endcan
                @can('bank_account_type_access')
                <li class="nav-item"><a href="{{ route("admin.bank-account-types.index") }}"
                        class="nav-link {{ request()->is("admin/bank-account-types") || request()->is("admin/bank-account-types/*") ? "c-active" : "" }}">
                        {{ trans('cruds.bankAccountType.title') }}
                    </a>
                </li>
                @endcan
                @can('currency_access')
                <li class="nav-item"><a href="{{ route("admin.currencies.index") }}"
                        class="nav-link {{ request()->is("admin/currencies") || request()->is("admin/currencies/*") ? "c-active" : "" }}">
                        {{ trans('cruds.currency.title') }}
                    </a>
                </li>
                @endcan
                @can('flutterwave_apikey_access')
                <li class="nav-item"><a href="{{ route("admin.flutterwave-apikeys.index") }}"
                        class="nav-link {{ request()->is("admin/flutterwave-apikeys") || request()->is("admin/flutterwave-apikeys/*") ? "c-active" : "" }}">
                        {{ trans('cruds.flutterwaveApikey.title') }}
                    </a>
                </li>
                @endcan
                @can('cgcc_payment_form_access')
                <li class="nav-item"><a href="{{ route("admin.cgcc-payment-forms.index") }}"
                        class="nav-link {{ request()->is("admin/cgcc-payment-forms") || request()->is("admin/cgcc-payment-forms/*") ? "c-active" : "" }}">
                        {{ trans('cruds.cgccPaymentForm.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('faq_management_access')
        <li
            class="nav-group {{request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-voice-over-record"></use>
                </svg>
                {{ trans('cruds.faqManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('faq_category_access')
                <li class="nav-item"><a href="{{ route("admin.faq-categories.index") }}"
                        class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                        {{ trans('cruds.faqCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('faq_question_access')
                <li class="nav-item"><a href="{{ route("admin.faq-questions.index") }}"
                        class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                        {{ trans('cruds.faqQuestion.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('administrative_role_access')
        <li
            class="nav-group {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/affinity-groups*") ? "c-show" : "" }} {{ request()->is("admin/ats-membership-records*") ? "c-show" : "" }} {{ request()->is("admin/departments*") ? "c-show" : "" }} {{ request()->is("admin/mountains-of-influences*") ? "c-show" : "" }} {{ request()->is("admin/missionary-forces*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-wc"></use>
                </svg>
                {{ trans('cruds.administrativeRole.title') }}
            </a>
            <ul class="nav-group-items">
                @can('user_access')
                <li class="nav-item"><a href="{{ route("admin.users.index") }}"
                        class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                        {{ trans('cruds.user.title') }}
                    </a>
                </li>
                @endcan
                @can('affinity_group_access')
                <li class="nav-item"><a href="{{ route("admin.affinity-groups.index") }}"
                        class="nav-link {{ request()->is("admin/affinity-groups") || request()->is("admin/affinity-groups/*") ? "c-active" : "" }}">
                        {{ trans('cruds.affinityGroup.title') }}
                    </a>
                </li>
                @endcan
                @can('ats_membership_record_access')
                <li class="nav-item"><a href="{{ route("admin.ats-membership-records.index") }}"
                        class="nav-link {{ request()->is("admin/ats-membership-records") || request()->is("admin/ats-membership-records/*") ? "c-active" : "" }}">
                        {{ trans('cruds.atsMembershipRecord.title') }}
                    </a>
                </li>
                @endcan
                @can('department_access')
                <li class="nav-item"><a href="{{ route("admin.departments.index") }}"
                        class="nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                        {{ trans('cruds.department.title') }}
                    </a>
                </li>
                @endcan
                @can('mountains_of_influence_access')
                <li class="nav-item"><a href="{{ route("admin.mountains-of-influences.index") }}"
                        class="nav-link {{ request()->is("admin/mountains-of-influences") || request()->is("admin/mountains-of-influences/*") ? "c-active" : "" }}">
                        {{ trans('cruds.mountainsOfInfluence.title') }}
                    </a>
                </li>
                @endcan
                @can('missionary_force_access')
                <li class="nav-item"><a href="{{ route("admin.missionary-forces.index") }}"
                        class="nav-link {{ request()->is("admin/missionary-forces") || request()->is("admin/missionary-forces/*") ? "c-active" : "" }}">
                        {{ trans('cruds.missionaryForce.title') }}
                    </a>
                </li>
                @endcan
                @can('user_alert_access')
                <li class="nav-item"><a href="{{ route("admin.user-alerts.index") }}"
                        class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                        {{ trans('cruds.userAlert.title') }}
                    </a>
                </li>
                @endcan
                @can('misc_access')
                <li
                    class="nav-group {{ request()->is("admin/titles*") ? "c-show" : "" }} {{ request()->is("admin/marital-statuses*") ? "c-show" : "" }} {{ request()->is("admin/employment-statuses*") ? "c-show" : "" }} {{ request()->is("admin/qualification-settings*") ? "c-show" : "" }} {{ request()->is("admin/industry-sectors*") ? "c-show" : "" }} {{ request()->is("admin/sub-sectors*") ? "c-show" : "" }} {{ request()->is("admin/organization-types*") ? "c-show" : "" }} {{ request()->is("admin/sports*") ? "c-show" : "" }}">
                    <a class="nav-link nav-group-toggle" href="#">
                        <svg class="nav-icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-view-module"></use>
                        </svg>
                        {{ trans('cruds.misc.title') }}
                    </a>
                    <ul class="nav-group-items">
                        @can('title_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.titles.index") }}"
                                class="nav-link {{ request()->is("admin/titles") || request()->is("admin/titles/*") ? "c-active" : "" }}">
                                {{ trans('cruds.title.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('marital_status_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.marital-statuses.index") }}"
                                class="nav-link {{ request()->is("admin/marital-statuses") || request()->is("admin/marital-statuses/*") ? "c-active" : "" }}">
                                {{ trans('cruds.maritalStatus.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('employment_status_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.employment-statuses.index") }}"
                                class="nav-link {{ request()->is("admin/employment-statuses") || request()->is("admin/employment-statuses/*") ? "c-active" : "" }}">
                                {{ trans('cruds.employmentStatus.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('qualification_setting_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.qualification-settings.index") }}"
                                class="nav-link {{ request()->is("admin/qualification-settings") || request()->is("admin/qualification-settings/*") ? "c-active" : "" }}">
                                {{ trans('cruds.qualificationSetting.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('industry_sector_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.industry-sectors.index") }}"
                                class="nav-link {{ request()->is("admin/industry-sectors") || request()->is("admin/industry-sectors/*") ? "c-active" : "" }}">
                                {{ trans('cruds.industrySector.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('sub_sector_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sub-sectors.index") }}"
                                class="nav-link {{ request()->is("admin/sub-sectors") || request()->is("admin/sub-sectors/*") ? "c-active" : "" }}">
                                {{ trans('cruds.subSector.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('organization_type_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.organization-types.index") }}"
                                class="nav-link {{ request()->is("admin/organization-types") || request()->is("admin/organization-types/*") ? "c-active" : "" }}">
                                {{ trans('cruds.organizationType.title') }}
                            </a>
                        </li>
                        @endcan
                        @can('sport_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sports.index") }}"
                                class="nav-link {{ request()->is("admin/sports") || request()->is("admin/sports/*") ? "c-active" : "" }}">
                                {{ trans('cruds.sport.title') }}
                            </a>
                        </li>
                        @endcan

                        @can('sport_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.mailingSetup.index") }}"
                                class="nav-link {{ request()->is("admin/mailingSetup/create") || request()->is("admin/mailingSetup/*") ? "c-active" : "" }}">
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
        <li
            class="nav-group {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-newspaper"></use>
                </svg>
                {{ trans('cruds.contentManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('content_category_access')
                <li class="nav-item"><a href="{{ route("admin.content-categories.index") }}"
                        class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-folder c-sidebar-nav-icon"></i>
                        {{ trans('cruds.contentCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('content_tag_access')
                <li class="nav-item"><a href="{{ route("admin.content-tags.index") }}"
                        class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                        {{ trans('cruds.contentTag.title') }}
                    </a>
                </li>
                @endcan
                @can('content_page_access')
                <li class="nav-item"><a href="{{ route("admin.content-pages.index") }}"
                        class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                        <i class="fa-fw fas fa-file c-sidebar-nav-icon"></i>{{ trans('cruds.contentPage.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('contact_management_access')
        <li
            class="nav-group {{ request()->is("admin/contact-companies*") ? "c-show" : "" }} {{ request()->is("admin/contact-contacts*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-at"></use>
                </svg>
                {{ trans('cruds.contactManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('contact_company_access')
                <li class="nav-item"><a href="{{ route("admin.contact-companies.index") }}"
                        class="nav-link {{ request()->is("admin/contact-companies") || request()->is("admin/contact-companies/*") ? "c-active" : "" }}">
                        <!-- <i class="fa-fw fas fa-building c-sidebar-nav-icon"> </i> -->
                        {{ trans('cruds.contactCompany.title') }}
                    </a>
                </li>
                @endcan
                @can('contact_contact_access')
                <li class="nav-item"><a href="{{ route("admin.contact-contacts.index") }}"
                        class="nav-link {{ request()->is("admin/contact-contacts") || request()->is("admin/contact-contacts/*") ? "c-active" : "" }}">
                        {{ trans('cruds.contactContact.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('at_access')
        <li
            class="nav-group {{ request()->is("admin/courses*") ? "c-show" : "" }} {{ request()->is("admin/lessons*") ? "c-show" : "" }} {{ request()->is("admin/tests*") ? "c-show" : "" }} {{ request()->is("admin/questions*") ? "c-show" : "" }} {{ request()->is("admin/question-options*") ? "c-show" : "" }} {{ request()->is("admin/test-results*") ? "c-show" : "" }} {{ request()->is("admin/test-answers*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-barcode"></use>
                </svg>
                {{ trans('cruds.at.title') }}
            </a>
            <ul class="nav-group-items">
                @can('course_access')
                <li class="nav-item"><a href="{{ route("admin.courses.index") }}"
                        class="nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "c-active" : "" }}">
                        {{ trans('cruds.course.title') }}
                    </a>
                </li>
                @endcan
                @can('lesson_access')
                <li class="nav-item"><a href="{{ route("admin.lessons.index") }}"
                        class="nav-link {{ request()->is("admin/lessons") || request()->is("admin/lessons/*") ? "c-active" : "" }}">
                        {{ trans('cruds.lesson.title') }}
                    </a>
                </li>
                @endcan
                @can('test_access')
                <li class="nav-item"><a href="{{ route("admin.tests.index") }}"
                        class="nav-link {{ request()->is("admin/tests") || request()->is("admin/tests/*") ? "c-active" : "" }}">
                        {{ trans('cruds.test.title') }}
                    </a>
                </li>
                @endcan
                @can('question_access')
                <li class="nav-item"><a href="{{ route("admin.questions.index") }}"
                        class="nav-link {{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "c-active" : "" }}">
                        {{ trans('cruds.question.title') }}
                    </a>
                </li>
                @endcan
                @can('question_option_access')
                <li class="nav-item"><a href="{{ route("admin.question-options.index") }}"
                        class="nav-link {{ request()->is("admin/question-options") || request()->is("admin/question-options/*") ? "c-active" : "" }}">
                        {{ trans('cruds.questionOption.title') }}
                    </a>
                </li>
                @endcan
                @can('test_result_access')
                <li class="nav-item"><a href="{{ route("admin.test-results.index") }}"
                        class="nav-link {{ request()->is("admin/test-results") || request()->is("admin/test-results/*") ? "c-active" : "" }}">
                        {{ trans('cruds.testResult.title') }}
                    </a>
                </li>
                @endcan
                @can('test_answer_access')
                <li class="nav-item"><a href="{{ route("admin.test-answers.index") }}"
                        class="nav-link {{ request()->is("admin/test-answers") || request()->is("admin/test-answers/*") ? "c-active" : "" }}">
                        {{ trans('cruds.testAnswer.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('product_management_access')
        <li
            class="nav-group {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/product-tags*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }}">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                </svg>
                {{ trans('cruds.productManagement.title') }}
            </a>
            <ul class="nav-group-items">
                @can('product_category_access')
                <li class="nav-item"><a href="{{ route("admin.product-categories.index") }}"
                        class="nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                        {{ trans('cruds.productCategory.title') }}
                    </a>
                </li>
                @endcan
                @can('product_tag_access')
                <li class="nav-item"><a href="{{ route("admin.product-tags.index") }}"
                        class="nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "c-active" : "" }}">
                        {{ trans('cruds.productTag.title') }}
                    </a>
                </li>
                @endcan
                @can('product_access')
                <li class="nav-item"><a href="{{ route("admin.products.index") }}"
                        class="nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                        {{ trans('cruds.product.title') }}
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        <li class="nav-item">
            <a href="{{ route("admin.systemCalendar") }}"
                class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <svg class="nav-icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                </svg>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>

        <div style="display: flex; flex-direction: column; align-items: center;">
            <div style="width: 100%; height: 1px; background-color: white; margin-bottom: 10px;"></div>
            <form action="admin/switch-to-admin" method="POST">
                @csrf
                <button type="submit" class="bg-black text-white btn btn-lg" style="font-size: 20px;">Switch to Admin Dashboard</button>
            </form>
        {{-- @endcan --}}

            <div style="width: 100%; height: 1px; background-color: white; margin-bottom: 10px;"></div>
            <form action="admin/switch-to-hod" method="POST">
                @csrf
                <button type="submit" class="bg-black text-white btn btn-lg" style="font-size: 20px;">Switch to HOD Dashboard</button>
            </form>

            <div style="width: 100%; height: 1px; background-color: white; margin-bottom: 10px;"></div>
            <form action="admin/switch-to-user" method="POST">
                @csrf
                <button type="submit" class="bg-black text-white btn btn-lg" style="font-size: 20px;">Switch to User Dashboard</button>
            </form>
            <div style="width: 100%; height: 1px; background-color: white; margin-bottom: 10px;"></div>
        </div>

    </ul>
