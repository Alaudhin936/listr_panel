<div class="page-header">
    <div class="header-wrapper">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>

        </div>
        <div class="nav-left">
            <h1 class="agent-panel-title">Agent Panel</h1>
            <span class="current-page-indicator">
                <?php
                    $routeName = Route::currentRouteName();
                    switch ($routeName) {
                        case 'agent.hotleads.index':
                        case 'agent.hotleads.create':
                        case 'agent.hotleads.show':
                        case 'agent.hotleads.edit':
                            $pageIcon = 'fas fa-fire';
                            $pageTitle = 'Hot Leads';
                            break;
                        case 'agent.booking-appraisals.index':
                        case 'agent.booking-appraisals.create':
                        case 'agent.booking-appraisals.show':
                        case 'agent.booking-appraisals.edit':
                        case 'agent.hotleads.booking-appraisal.create':
                            $pageIcon = 'fas fa-calendar-check';
                            $pageTitle = 'Booking Appraisals';
                            break;
                        case 'agent.appraisals.index':
                        case 'agent.appraisals.create':
                        case 'agent.appraisals.show':
                        case 'agent.appraisals.edit':
                        case 'agent.booking-appraisals.conduct-appraisal.create':
                            $pageIcon = 'fas fa-clipboard-check';
                            $pageTitle = 'Conduct Appraisals';
                            break;
                        case 'agent.just-listed.index':
                        case 'agent.just-listed.create':
                        case 'agent.just-listed.show':
                        case 'agent.just-listed.edit':
                        case 'agent.conduct-appraisals.just-listed.create':

                            $pageIcon = 'fas fa-list';
                            $pageTitle = 'Just Listed';
                            break;
                        case 'agent.templates.index':
                            $pageIcon = 'fas fa-file-text';
                            $pageTitle = 'Templates';
                            break;
                        default:
                            $pageIcon = 'fas fa-tachometer-alt';
                            $pageTitle = 'Dashboard';
                    }
                ?>

                <i class="<?php echo e($pageIcon); ?>"></i>
                <?php echo e($pageTitle); ?>

            </span>
        </div>
        <div class="nav-right">
            <ul class="nav-menus">
                <li class="username-display">
                    <i class="fas fa-user-circle"></i>
                    Welcome, <?php echo e(auth()->guard('agent')->user()->name); ?>

                </li>
                <li class="profile-nav">
                    <div class="account-user">
                        <i class="fas fa-power-off" style="color:black"></i>
                    </div>
                    <ul class="profile-dropdown">
                        <li>
                            <form method="POST" action="<?php echo e(route('agent.logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit">
                                    <i class="fas fa-power-off" style="color:black"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .page-header {
        width: 100%;
        background: #ffffff;
        padding: 15px 30px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 999;
    }

    .header-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .nav-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .agent-panel-title {
        font-size: 26px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .agent-panel-title::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    .current-page-indicator {
        font-size: 16px;
        font-weight: 500;
        color: #495057;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 20px;
        border-left: 3px solid #667eea;
    }

    .current-page-indicator i {
        color: #667eea;
        font-size: 14px;
    }

    .nav-right {
        display: flex;
        align-items: center;
    }

    .nav-menus {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        align-items: center;
        gap: 20px;
    }

    .username-display {
        font-weight: 600;
        color: #495057;
        font-size: 15px;
        padding: 8px 16px;
        background: #f8f9fa;
        border-radius: 25px;
        border: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .username-display i {
        font-size: 14px;
        opacity: 0.8;
    }

    .profile-nav {
        position: relative;
    }

    .account-user {
        cursor: pointer;
        padding: 8px 12px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .account-user i {
        color: #191a1a;
        font-size: 16px;
    }

    .profile-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 10px);
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        padding: 8px 0;
        min-width: 180px;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1000;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .profile-dropdown::before {
        content: '';
        position: absolute;
        top: -6px;
        right: 15px;
        width: 12px;
        height: 12px;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-bottom: none;
        border-right: none;
        transform: rotate(45deg);
    }

    .profile-nav:hover .profile-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .profile-dropdown li {
        padding: 0;
    }

    .profile-dropdown button {
        width: 100%;
        text-align: left;
        padding: 12px 20px;
        color: #495057;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-dropdown button:hover {
        background: #f8f9fa;
        color: #dc3545;
    }

    .profile-dropdown i {
        width: 16px;
        text-align: center;
        font-size: 14px;
    }

    /* Mobile Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 12px 15px;
        }

        .header-wrapper {
            flex-wrap: nowrap;
            gap: 10px;
        }

        .nav-left {
            flex: 1;
            min-width: 0;
            gap: 10px;
        }

        .agent-panel-title {
            font-size: 18px;
            letter-spacing: 0.5px;
        }

        .agent-panel-title::after {
            height: 2px;
        }

        .current-page-indicator {
            font-size: 12px;
            padding: 4px 8px;
            gap: 4px;
            border-radius: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
            border-left-width: 2px;
        }

        .current-page-indicator i {
            font-size: 11px;
        }

        .nav-menus {
            gap: 8px;
        }

        .username-display {
            font-size: 12px;
            padding: 4px 8px;
            display: none;
            /* Hide welcome text on mobile */
        }

        .account-user {
            padding: 6px 8px;
        }

        .profile-dropdown {
            min-width: 160px;
            right: -10px;
        }
    }

    /* For very small screens */
    @media (max-width: 480px) {
        .page-header {
            padding: 10px 12px;
        }

        .nav-left {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .agent-panel-title {
            font-size: 16px;
            letter-spacing: 0.3px;
        }

        .agent-panel-title::after {
            height: 2px;
        }

        .current-page-indicator {
            font-size: 11px;
            padding: 3px 6px;
            max-width: 100px;
            gap: 3px;
        }

        .current-page-indicator i {
            font-size: 10px;
        }

        .nav-menus {
            gap: 5px;
        }

        .account-user {
            padding: 5px 6px;
        }

        .account-user i {
            font-size: 14px;
        }
    }
</style><?php /**PATH C:\Users\ADMIN\Desktop\listr\resources\views/layout/header.blade.php ENDPATH**/ ?>