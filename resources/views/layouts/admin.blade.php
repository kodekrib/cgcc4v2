<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="My Citadel Global Member Database">
    <meta name="author" content="TG Department Of Citadel Global Community Church">
    <meta name="keyword" content="Citadel Global Community Church">
    <title>{{ trans('panel.site_title') }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="coreui/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="coreui/assets/favicon/android-icon-192x192.png">
    <link rel="manifest" href="coreui/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="coreui/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <!-- <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" /> -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/segment7" type="text/css" />
    <!-- Vendors styles-->
    <link rel="stylesheet" href="coreui/vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="coreui/css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="coreui/css/style.css" rel="stylesheet">
<<<<<<< HEAD
    <link href="{{ asset('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">

=======
>>>>>>> 2e212d7621958a3609c223bf230ff43c4465e2c7
    @yield('styles')
</head>

<body>
    <div class="sidebar sidebar-light sidebar-fixed" id="sidebar" style="background-color: #DDA72A;">
        <div class="sidebar-brand d-none d-md-flex" style="background-color: #DDA72A;">
            <svg class="sidebar-brand-full" width="180" height="40" alt="Citadel Global Community Church"
                viewBox="0 0 143 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_812_35464)">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M31.9869 19.1949L23.9902 13.9883V31.986H31.9869V19.1949Z" fill="white" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.9937 20.7914L22.391 18.0273V31.9868H15.9937V20.7914Z" fill="white" />
                    <path
                        d="M12.795 7.9975H9.7203L8.79668 4.79883L7.87347 7.9975H4.79834L7.34489 9.59684L6.20496 12.7955L8.79668 10.8447L11.39 12.7955L10.2485 9.59684L12.795 7.9975Z"
                        fill="white" />
                    <path
                        d="M31.9868 3.24506V0H28.7417H3.24506H0V3.24506V28.7417V31.9868H3.24506H14.394V28.7881H3.19868V3.19868H28.7457L28.7609 15.1937L31.9868 17.2884V3.24506Z"
                        fill="white" />
                </g>
                <path
                    d="M40.1116 1.73981V3.32316H42.0116V8.45703H43.7868V3.32316H45.6773V1.73981H40.1116ZM50.7099 1.73981V4.31155H48.2149V1.73981H46.4396V8.45703H48.2149V5.89489H50.7099V8.45703H52.4851V1.73981H50.7099ZM53.7491 1.73981V8.45703H58.6431V6.92167H55.5244V5.82772H58.2976V4.30195H55.5244V3.27518H58.5855V1.73981H53.7491ZM61.3414 5.19438C61.3414 7.59339 63.1743 8.60097 65.0167 8.60097C65.7268 8.60097 66.3889 8.45703 66.9743 8.17875V6.45146C66.5905 6.82571 65.9571 7.03682 65.2662 7.03682C64.2202 7.03682 63.1647 6.49944 63.1647 5.19438C63.1647 3.73579 64.2202 3.15043 65.2854 3.15043C65.8995 3.15043 66.5137 3.35194 66.9263 3.6974V2.0181C66.341 1.73981 65.6596 1.59587 64.9783 1.59587C63.1647 1.59587 61.3414 2.66103 61.3414 5.19438ZM67.9557 1.73981V8.45703H69.731V1.73981H67.9557ZM70.4927 1.73981V3.32316H72.3928V8.45703H74.168V3.32316H76.0584V1.73981H70.4927ZM77.2238 8.45703L77.6076 7.40147H80.3904L80.7743 8.45703H82.5975L79.9586 1.73981H78.0394L75.4005 8.45703H77.2238ZM78.8263 4.02367C78.8839 3.86053 78.9414 3.6974 78.999 3.34235C79.0566 3.6974 79.1142 3.86053 79.1717 4.02367L79.8627 5.96206H78.1354L78.8263 4.02367ZM83.24 1.73981V8.45703H85.9173C88.3163 8.45703 89.4294 7.05601 89.4294 5.09842C89.4294 3.14083 88.3163 1.73981 85.9173 1.73981H83.24ZM87.6062 5.09842C87.6062 6.3555 86.9825 6.92167 85.9173 6.92167H85.0153V3.27518H85.9173C86.9825 3.27518 87.6062 3.84134 87.6062 5.09842ZM90.3808 1.73981V8.45703H95.2748V6.92167H92.1561V5.82772H94.9293V4.30195H92.1561V3.27518H95.2172V1.73981H90.3808ZM96.3034 1.73981V8.45703H101.149V6.87369H98.0786V1.73981H96.3034ZM40.2939 16.0984C40.2939 18.5358 42.1075 19.601 44.0171 19.601C44.7752 19.601 45.5525 19.4378 46.2434 19.15V15.7626H44.5641V18.0272C44.449 18.056 44.2954 18.0752 44.1035 18.0752C43.3358 18.0752 42.1171 17.7585 42.1171 16.0984C42.1171 14.7166 43.1439 14.16 44.2283 14.16C44.9 14.16 45.5813 14.3519 46.0803 14.6974V13.0181C45.447 12.7494 44.7177 12.5959 43.998 12.5959C42.1267 12.5959 40.2939 13.5939 40.2939 16.0984ZM47.3299 12.7398V19.457H52.1759V17.8737H49.1051V12.7398H47.3299ZM52.3918 16.0984C52.3918 17.9696 53.5913 19.601 55.9903 19.601C58.3893 19.601 59.5888 17.9696 59.5888 16.0984C59.5888 14.2272 58.3893 12.5959 55.9903 12.5959C53.5913 12.5959 52.3918 14.2272 52.3918 16.0984ZM57.7656 16.0984C57.7656 17.1732 57.1514 17.9696 55.9903 17.9696C54.8292 17.9696 54.215 17.1732 54.215 16.0984C54.215 15.0237 54.8292 14.2272 55.9903 14.2272C57.1514 14.2272 57.7656 15.0237 57.7656 16.0984ZM60.515 12.7398V19.457H63.4322C64.7085 19.457 66.1671 19.0828 66.1671 17.557C66.1671 16.6262 65.6201 16.108 64.9004 15.8969C65.5434 15.6666 65.8984 15.1772 65.8984 14.4383C65.8984 13.2772 65.0156 12.7398 63.5474 12.7398H60.515ZM64.3822 17.3651C64.3822 17.8929 64.0272 18.0656 63.4898 18.0656H62.2807V16.6646H63.4898C64.0272 16.6646 64.3822 16.8373 64.3822 17.3651ZM64.1231 14.755C64.1231 15.1388 63.8545 15.3787 63.3843 15.3787L62.2903 15.3691V14.1312H63.3843C63.8545 14.1312 64.1231 14.3711 64.1231 14.755ZM68.0401 19.457L68.4239 18.4015H71.2067L71.5906 19.457H73.4138L70.7749 12.7398H68.8557L66.2168 19.457H68.0401ZM69.6426 15.0237C69.7002 14.8605 69.7577 14.6974 69.8153 14.3423C69.8729 14.6974 69.9305 14.8605 69.988 15.0237L70.679 16.9621H68.9517L69.6426 15.0237ZM74.0563 12.7398V19.457H78.9023V17.8737H75.8316V12.7398H74.0563ZM81.077 16.1944C81.077 18.5934 82.9098 19.601 84.7523 19.601C85.4624 19.601 86.1245 19.457 86.7099 19.1787V17.4515C86.326 17.8257 85.6927 18.0368 85.0018 18.0368C83.9558 18.0368 82.9003 17.4994 82.9003 16.1944C82.9003 14.7358 83.9558 14.1504 85.021 14.1504C85.6351 14.1504 86.2493 14.3519 86.6619 14.6974V13.0181C86.0765 12.7398 85.3952 12.5959 84.7139 12.5959C82.9003 12.5959 81.077 13.661 81.077 16.1944ZM87.3086 16.0984C87.3086 17.9696 88.5081 19.601 90.9071 19.601C93.3061 19.601 94.5056 17.9696 94.5056 16.0984C94.5056 14.2272 93.3061 12.5959 90.9071 12.5959C88.5081 12.5959 87.3086 14.2272 87.3086 16.0984ZM92.6823 16.0984C92.6823 17.1732 92.0682 17.9696 90.9071 17.9696C89.746 17.9696 89.1318 17.1732 89.1318 16.0984C89.1318 15.0237 89.746 14.2272 90.9071 14.2272C92.0682 14.2272 92.6823 15.0237 92.6823 16.0984ZM101.199 12.7398L99.1551 15.8873L97.1111 12.7398H95.4318V19.457H97.2071V15.8777L98.6465 18.0944H99.6637L101.103 15.8873V19.457H102.878V12.7398H101.199ZM109.914 12.7398L107.87 15.8873L105.826 12.7398H104.147V19.457H105.922V15.8777L107.362 18.0944H108.379L109.818 15.8873V19.457H111.593V12.7398H109.914ZM117.065 12.7398V16.7989C117.065 17.701 116.576 18.0176 115.818 18.0176C115.06 18.0176 114.57 17.701 114.57 16.7989V12.7398H112.795V16.8949C112.795 18.9197 114.33 19.601 115.818 19.601C117.305 19.601 118.84 18.9197 118.84 16.8949V12.7398H117.065ZM121.816 19.457V16.7126C121.816 16.3479 121.806 15.9257 121.777 15.609L124.407 19.457H126.086V12.7398H124.311V15.4843C124.311 15.8585 124.32 16.2807 124.349 16.5974L121.72 12.7398H120.04V19.457H121.816ZM127.35 12.7398V19.457H129.125V12.7398H127.35ZM129.887 12.7398V14.3232H131.787V19.457H133.562V14.3232H135.453V12.7398H129.887ZM139.957 19.457V17.1636L142.577 12.7398H140.562L139.075 15.5131L137.587 12.7398H135.572L138.192 17.1636V19.457H139.957ZM40.2939 27.1944C40.2939 29.5934 42.1267 30.601 43.9692 30.601C44.6793 30.601 45.3414 30.457 45.9268 30.1787V28.4515C45.5429 28.8257 44.9096 29.0368 44.2187 29.0368C43.1727 29.0368 42.1171 28.4994 42.1171 27.1944C42.1171 25.7358 43.1727 25.1504 44.2379 25.1504C44.852 25.1504 45.4661 25.3519 45.8788 25.6974V24.0181C45.2934 23.7398 44.6121 23.5959 43.9308 23.5959C42.1171 23.5959 40.2939 24.661 40.2939 27.1944ZM51.1784 23.7398V26.3115H48.6834V23.7398H46.9082V30.457H48.6834V27.8949H51.1784V30.457H52.9537V23.7398H51.1784ZM58.4207 23.7398V27.7989C58.4207 28.701 57.9313 29.0176 57.1732 29.0176C56.4151 29.0176 55.9257 28.701 55.9257 27.7989V23.7398H54.1505V27.8949C54.1505 29.9197 55.6858 30.601 57.1732 30.601C58.6606 30.601 60.196 29.9197 60.196 27.8949V23.7398H58.4207ZM63.1712 30.457V28.2691H63.9389L65.5414 30.457H67.547L65.6949 28.0196C66.4338 27.7222 66.9808 27.1176 66.9808 26.0045C66.9808 24.2292 65.5894 23.7398 64.2268 23.7398H61.3959V30.457H63.1712ZM63.1712 25.2752H64.3035C64.8121 25.2752 65.1576 25.5343 65.1576 26.0525C65.1576 26.5706 64.8121 26.8297 64.3035 26.8297H63.1712V25.2752ZM67.7794 27.1944C67.7794 29.5934 69.6122 30.601 71.4547 30.601C72.1648 30.601 72.8269 30.457 73.4123 30.1787V28.4515C73.0284 28.8257 72.3951 29.0368 71.7042 29.0368C70.6582 29.0368 69.6026 28.4994 69.6026 27.1944C69.6026 25.7358 70.6582 25.1504 71.7234 25.1504C72.3375 25.1504 72.9516 25.3519 73.3643 25.6974V24.0181C72.7789 23.7398 72.0976 23.5959 71.4163 23.5959C69.6026 23.5959 67.7794 24.661 67.7794 27.1944ZM78.6639 23.7398V26.3115H76.1689V23.7398H74.3937V30.457H76.1689V27.8949H78.6639V30.457H80.4392V23.7398H78.6639Z"
                    fill="white" />
                <defs>
                    <clipPath id="clip0_812_35464">
                        <rect width="31.9868" height="31.9868" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <svg class="sidebar-brand-narrow" width="40" height="40" alt="Citadel Global Community Church"
                viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_812_35465)">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M31.9869 19.1949L23.9902 13.9883V31.986H31.9869V19.1949Z" fill="#ffffff" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.9937 20.7914L22.391 18.0273V31.9868H15.9937V20.7914Z" fill="#ffffff" />
                    <path
                        d="M12.795 7.9975H9.7203L8.79668 4.79883L7.87347 7.9975H4.79834L7.34489 9.59684L6.20496 12.7955L8.79668 10.8447L11.39 12.7955L10.2485 9.59684L12.795 7.9975Z"
                        fill="#ffffff" />
                    <path
                        d="M31.9868 3.24506V0H28.7417H3.24506H0V3.24506V28.7417V31.9868H3.24506H14.394V28.7881H3.19868V3.19868H28.7457L28.7609 15.1937L31.9868 17.2884V3.24506Z"
                        fill="#fffff" />
                </g>
                <defs>
                    <clipPath id="clip0_812_35465">
                        <rect width="31.9868" height="31.9868" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
        </div>
        @include('partials.menu')
    </div>
    <div class="sidebar sidebar-light sidebar-lg sidebar-end sidebar-overlaid hide" id="aside">
        <div class="sidebar-header bg-transparent p-0">
            <ul class="nav nav-underline nav-underline-primary" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#timeline" role="tab">
                        <svg class="icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-list"></use>
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" data-coreui-toggle="tab" href="#messages" role="tab">
                        <svg class="icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-speech"></use>
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" data-coreui-toggle="tab" href="#settings" role="tab">
                        <svg class="icon">
                            <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                        </svg></a></li>
            </ul>
            <button class="sidebar-close" type="button" data-coreui-close="sidebar">
                <svg class="icon">
                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-x"></use>
                </svg>
            </button>
        </div>
        <!-- Tab panes-->
        <div class="tab-content">
            <div class="tab-pane active" id="timeline" role="tabpanel">
                <div class="list-group list-group-flush">
                    <div
                        class="list-group-item border-start-4 border-start-secondary bg-light text-center fw-bold text-medium-emphasis text-uppercase small dark:bg-white dark:bg-opacity-10 dark:text-medium-emphasis">
                        Today</div>
                    <div class="list-group-item border-start-4 border-start-warning list-group-item-divider">
                        <div class="avatar avatar-lg float-end"><img class="avatar-img"
                                src="coreui/assets/img/avatars/7.jpg" alt="user@email.com"></div>
                        <div>Meeting with <strong>Lucas</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 1 - 3pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
                            </svg> Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item border-start-4 border-start-info">
                        <div class="avatar avatar-lg float-end"><img class="avatar-img"
                                src="coreui/assets/img/avatars/4.jpg" alt="user@email.com"></div>
                        <div>Skype with <strong>Megan</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 4 - 5pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/brand.svg#cib-skype"></use>
                            </svg> On-line</small>
                    </div>
                    <div
                        class="list-group-item border-start-4 border-start-secondary bg-light text-center fw-bold text-medium-emphasis text-uppercase small dark:bg-white dark:bg-opacity-10 dark:text-medium-emphasis">
                        Tomorrow</div>
                    <div class="list-group-item border-start-4 border-start-danger list-group-item-divider">
                        <div>New UI Project - <strong>deadline</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 10 - 11pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                            </svg> creativeLabs HQ</small>
                        <div class="avatars-stack mt-2">
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/2.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/3.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/4.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/5.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/6.jpg"
                                    alt="user@email.com"></div>
                        </div>
                    </div>
                    <div class="list-group-item border-start-4 border-start-success list-group-item-divider">
                        <div><strong>#10 Startups.Garden</strong> Meetup</div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 1 - 3pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-location-pin"></use>
                            </svg> Palo Alto, CA</small>
                    </div>
                    <div class="list-group-item border-start-4 border-start-primary list-group-item-divider">
                        <div><strong>Team meeting</strong></div><small class="text-medium-emphasis me-3">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-calendar"></use>
                            </svg> 4 - 6pm</small><small class="text-medium-emphasis">
                            <svg class="icon">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-home"></use>
                            </svg> creativeLabs HQ</small>
                        <div class="avatars-stack mt-2">
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/2.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/3.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/4.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/5.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/6.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/7.jpg"
                                    alt="user@email.com"></div>
                            <div class="avatar avatar-xs"><img class="avatar-img" src="coreui/assets/img/avatars/8.jpg"
                                    alt="user@email.com"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-3" id="messages" role="tabpanel">
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="coreui/assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="coreui/assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="coreui/assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
                <hr>
                <div class="message">
                    <div class="py-3 pb-5 me-3 float-start">
                        <div class="avatar"><img class="avatar-img" src="assets/img/avatars/7.jpg"
                                alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </div>
                    <div><small class="text-medium-emphasis">Lukasz Holeczek</small><small
                            class="text-medium-emphasis float-end mt-1">1:52 PM</small></div>
                    <div class="text-truncate fw-bold">Lorem ipsum dolor sit amet</div><small
                        class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="tab-pane p-3" id="settings" role="tabpanel">
                <h6>Settings</h6>
                <div class="aside-options">
                    <div class="clearfix mt-4">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox"
                                checked="">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                1</label>
                        </div>
                    </div>
                    <div><small class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                2</label>
                        </div>
                    </div>
                    <div><small class="text-medium-emphasis">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</small></div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                3</label>
                        </div>
                    </div>
                </div>
                <div class="aside-options">
                    <div class="clearfix mt-3">
                        <div class="form-check form-switch form-switch-lg">
                            <input class="form-check-input me-0" id="flexSwitchCheckDefaultLg" type="checkbox"
                                checked="">
                            <label class="form-check-label fw-semibold small" for="flexSwitchCheckDefaultLg">Option
                                4</label>
                        </div>
                    </div>
                </div>
                <hr>
                <h6>System Utilization</h6>
                <div class="text-uppercase mb-1 mt-4"><small><b>CPU Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">348 Processes. 1/4 Cores.</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>Memory Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">11444GB/16384MB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 1 Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">243GB/256GB</small>
                <div class="text-uppercase mb-1 mt-2"><small><b>SSD 2 Usage</b></small></div>
                <div class="progress progress-thin">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div><small class="text-medium-emphasis">25GB/256GB</small>
            </div>
        </div>
    </div>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light bg-opacity-50 dark:bg-transparent">
        <header class="header header-light bg-primary header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    <svg class="icon icon-lg">
                        <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                    </svg>
                </button><a class="header-brand d-md-none" href="#">
                    <svg width="118" height="46" alt="CoreUI Logo">
                        <use xlink:href="coreui/assets/brand/coreui.svg#full"></use>
                    </svg></a>

                <ul class="header-nav ms-auto me-3">
                    <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown"
                            href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon icon-lg my-1 mx-2">
                                <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                            </svg><span
                                class="position-absolute top-0 start-50 translate-middle p-1 ms-2 mt-2 bg-danger rounded-circle"><span
                                    class="visually-hidden">New alerts</span></span></a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
                            @php($unread = \App\Models\QaTopic::unreadCount())
                            <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10">
                                <strong>You have {{ $unread }} {{ trans('global.messages') }}</strong>
                            </div>
                            <a class="dropdown-item" href="#">
                                <div class="message">
                                    <div class="py-3 me-3 float-start">
                                        <div class="avatar"><img class="avatar-img"
                                                src="coreui/assets/img/avatars/7.jpg" alt="user@email.com"><span
                                                class="avatar-status bg-success"></span></div>
                                    </div>
                                    <div><small class="text-medium-emphasis">John Doe</small><small
                                            class="text-medium-emphasis float-end mt-1">Just now</small></div>
                                    <div class="text-truncate font-weight-bold"><span class="text-danger">!</span>
                                        Important message</div>
                                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="message">
                                    <div class="py-3 me-3 float-start">
                                        <div class="avatar"><img class="avatar-img"
                                                src="coreui/assets/img/avatars/6.jpg" alt="user@email.com"><span
                                                class="avatar-status bg-warning"></span></div>
                                    </div>
                                    <div><small class="text-medium-emphasis">John Doe</small><small
                                            class="text-medium-emphasis float-end mt-1">5 minutes ago</small></div>
                                    <div class="text-truncate font-weight-bold">Lorem ipsum dolor sit amet</div>
                                    <div class="small text-medium-emphasis text-truncate">Lorem ipsum dolor sit amet,
                                        consectetur adipisicing elit, sed do eiusmod tempor incididunt...</div>
                                </div>
                            </a>

                            <a class="dropdown-item text-center border-top"
                                href="{{ route("admin.messenger.index") }}"><strong>View all messages</strong></a>
                        </div>
                    </li>
                </ul>

                <ul class="header-nav me-4">
                    <li class="nav-item dropdown d-flex align-items-center"><a class="nav-link py-0"
                            data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img" src="coreui/assets/img/avatars/8.jpg"
                                    alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                                <div class="fw-semibold">{{ trans('cruds.membership.title') }}</div>
                            </div>
                            @can('member_access')
                            <a class="dropdown-item" href="{{ route('admin.members.index') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                                </svg> {{ trans('cruds.member.title') }}</a>
                            @endcan
                            @can('qualification_access')
                            <a class="dropdown-item" href="{{ route('admin.qualifications.index') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                                </svg> {{ trans('cruds.qualification.title') }}</a>
                            @endcan
                            @can('employment_detail_access')
                            <a class="dropdown-item" href="{{ route("admin.employment-details.index") }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                                </svg> {{ trans('cruds.employmentDetail.title') }}</a>
                            @endcan
                            @can('spouse_detail_access')
                            <a class="dropdown-item" href="{{ route('admin.spouse-details.index') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-square">
                                    </use>
                                </svg> {{ trans('cruds.spouseDetail.title') }}</a>
                            @endcan
                            @can('child_access')
                            <a class="dropdown-item" href="{{ route('admin.children.index') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-square">
                                    </use>
                                </svg> {{ trans('cruds.child.title') }}</a>
                            @endcan
                            @can('interest_access')
                            <a class="dropdown-item" href="{{ route('admin.interests.index') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-square">
                                    </use>
                                </svg> {{ trans('cruds.interest.title') }}</a>
                            @endcan
                            @can('mountain_of_influence_access')
                            <a class="dropdown-item" href="{{ route('admin.mountain-of-influences.index') }}">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-comment-square">
                                    </use>
                                </svg> {{ trans('cruds.mountainOfInfluence.title') }}</a>
                            @endcan
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <svg class="icon me-2">
                                    <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                                    </use>
                                </svg> {{ trans('global.logout') }}</a>
                        </div>
                    </li>
                </ul>
                <button class="header-toggler px-md-0 me-md-3" type="button"
                    onclick="coreui.Sidebar.getInstance(document.querySelector('#aside')).show()">
                    <svg class="icon icon-lg">
                        <use xlink:href="coreui/vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
                    </svg>
                </button>
            </div>
        </header>

        <div style="height: fit-content; text-align: left; padding: 20px;">
            @yield('content')
        </div>


        <footer class="footer" style="margin: 20px;">
            <div><a href="https://thecitadelglobal.org" target="_blank">The Citadel Community Global Church </a></div>
            <div class="ms-auto">Powered by&nbsp;Technecal Group Of CCGC © 2023.</div>
        </footer>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script>
    var token = "{{ csrf_token() }}";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js">
    </script>
    <script src="coreui/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js"></script>
    <script src="coreui/vendors/simplebar/js/simplebar.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('js/api.call.js') }}"></script>
    <script>
    if (document.body.classList.contains('dark-theme')) {
        var element = document.getElementById('btn-dark-theme');
        if (typeof(element) != 'undefined' && element != null) {
            document.getElementById('btn-dark-theme').checked = true;
        }
    } else {
        var element = document.getElementById('btn-light-theme');
        if (typeof(element) != 'undefined' && element != null) {
            document.getElementById('btn-light-theme').checked = true;
        }
    }

    function handleThemeChange(src) {
        var event = document.createEvent('Event');
        event.initEvent('themeChange', true, true);

        if (src.value === 'light') {
            document.body.classList.remove('dark-theme');
        }
        if (src.value === 'dark') {
            document.body.classList.add('dark-theme');
        }
        document.body.dispatchEvent(event);
    }
    </script>
    @yield('scripts')
    <!-- Plugins and scripts required by this view-->
    <script src="coreui/vendors/chart.js/js/chart.min.js"></script>
    <script src="coreui/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="coreui/vendors/@coreui/utils/js/coreui-utils.js"></script>
    <script src="coreui/js/main.js"></script>
    <script>
    </script>
</body>

</html>
