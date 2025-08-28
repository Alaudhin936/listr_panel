<div class="page-header">
    <div class="header-wrapper">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="nav-left">
            <h1 class="agent-panel-title"> Super Admin Panel</h1>
        </div>
        <div class="nav-right">
            <ul class="nav-menus">
                <li class="username-display">
                    <i class="fas fa-user-circle"></i>
                    Welcome, Super Admin
                </li>
                <li class="profile-nav">
                    <div class="account-user">
                        <i class="fas fa-power-off" style="color:black"></i>
                    </div>
                    <ul class="profile-dropdown">
                        <li>
                            <form method="POST" action="{{route('admin.logout')}}">
                                @csrf
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
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
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
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        padding: 8px 0;
        min-width: 180px;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1000;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .profile-dropdown::before {
        content: '';
        position: absolute;
        top: -6px;
        right: 15px;
        width: 12px;
        height: 12px;
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.05);
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

    /* Responsive design */
    @media (max-width: 768px) {
        .page-header {
            padding: 12px 20px;
        }

        .agent-panel-title {
            font-size: 22px;
        }

        .nav-menus {
            gap: 15px;
        }

        .username-display {
            font-size: 14px;
            padding: 6px 12px;
        }

        .account-user {
            width: 36px;
            height: 36px;
        }

        .profile-dropdown {
            min-width: 160px;
            right: -10px;
        }
    }
</style>