<!-- Header Component -->
<header class="header">
    <div class="header-left">
        <button class="menu-toggle" aria-label="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo">NoteX</div>
    </div>
    
    <div class="search-container">
        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" class="search-input" placeholder="Search for anything..." aria-label="Search">
        </div>
    </div>

    <div class="header-right">
        <div class="notification-wrapper">
            <button class="header-icon" aria-label="Notifications" id="notificationBtn">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">2</span>
            </button>
            <div class="notification-dropdown dropdown-base">
                <div class="dropdown-header">
                    <h3>Notifications</h3>
                    <button class="mark-all-read">Mark all as read</button>
                </div>
                <div class="notification-list">
                    <!-- Notifications will be loaded here via JavaScript -->
                    <div class="loading-indicator">Loading notifications...</div>
                </div>
            </div>
        </div>
        
        <div class="settings-wrapper">
            <button class="header-icon" aria-label="Settings" id="settingsBtn">
                <i class="fas fa-cog"></i>
            </button>
            <div class="settings-dropdown dropdown-base">
                <div class="dropdown-header">
                    <h3>Settings</h3>
                </div>
                <div class="settings-list">
                    <a href="/profile" class="settings-item">
                        <i class="fas fa-user"></i>
                        <span>Profile Settings</span>
                    </a>
                    <a href="/preferences" class="settings-item">
                        <i class="fas fa-cog"></i>
                        <span>Preferences</span>
                    </a>
                    <a href="/appearance" class="settings-item">
                        <i class="fas fa-paint-brush"></i>
                        <span>Appearance</span>
                    </a>
                    <div class="settings-divider"></div>
                    <a href="/help" class="settings-item">
                        <i class="fas fa-question-circle"></i>
                        <span>Help & Support</span>
                    </a>
                    <form action="/logout" method="POST" class="settings-item logout">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="user-profile">
            <div class="user-avatar" 
                 role="button" 
                 aria-label="User Menu"
                 id="userProfileBtn"
                 data-username="{{ Auth::user()->name ?? 'Guest' }}"
                 data-email="{{ Auth::user()->email ?? 'guest@example.com' }}">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-dropdown dropdown-base">
                <div class="user-info">
                    <div class="user-avatar-large">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <h4>{{ Auth::user()->name ?? 'Guest' }}</h4>
                        <p>{{ Auth::user()->email ?? 'guest@example.com' }}</p>
                    </div>
                </div>
                <div class="user-actions">
                    <a href="/profile" class="user-action-item">
                        <i class="fas fa-user-circle"></i>
                        <span>View Profile</span>
                    </a>
                    <a href="/dashboard" class="user-action-item">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <form action="/logout" method="POST" class="user-action-item logout">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.header {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 1000;
    height: 64px;
    transition: all 0.3s ease;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.menu-toggle {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: transparent;
    border-radius: 12px;
    cursor: pointer;
    color: #2c3e50;
    transition: all 0.2s ease;
}

.menu-toggle:hover {
    background: rgba(0, 0, 0, 0.04);
    transform: scale(1.05);
}

.logo {
    font-size: 1.35rem;
    font-weight: 700;
    background: linear-gradient(45deg, #3498db, #2ecc71);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: -0.5px;
}

.search-container {
    flex: 1;
    max-width: 600px;
    margin: 0 2rem;
}

.search-wrapper {
    position: relative;
    width: 100%;
}

.search-wrapper i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 0.9rem;
    pointer-events: none;
}

.search-input {
    width: 100%;
    height: 44px;
    padding: 0 1rem 0 2.75rem;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.9);
    color: #1e293b;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
    background: white;
}

.search-input::placeholder {
    color: #94a3b8;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-left: auto;
}

.header-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: transparent;
    border-radius: 12px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
}

.header-icon:hover {
    background: rgba(0, 0, 0, 0.04);
    color: #1e293b;
    transform: translateY(-1px);
}

.notification-badge {
    position: absolute;
    top: 6px;
    right: 6px;
    background: #ef4444;
    color: white;
    font-size: 0.7rem;
    font-weight: 600;
    width: 18px;
    height: 18px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
}

.user-profile {
    margin-left: 0.5rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: linear-gradient(45deg, #3498db, #2ecc71);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.user-avatar:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .search-container {
        display: none;
    }
    
    .header {
        padding: 0.75rem 1rem;
    }
    
    .logo {
        font-size: 1.25rem;
    }

    .dropdown-base {
        position: fixed;
        top: 64px;
        left: 0;
        right: 0;
        border-radius: 0;
        max-height: calc(100vh - 64px);
        overflow-y: auto;
    }
}

@media (max-width: 480px) {
    .search-container {
        display: none;
    }
}

/* Dropdown Base Styles */
.dropdown-base {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.08);
    min-width: 280px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.2s ease;
    z-index: 1010;
}

.dropdown-base.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Position wrappers */
.notification-wrapper, .settings-wrapper, .user-profile {
    position: relative;
}

.dropdown-header {
    padding: 1rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.dropdown-header h3 {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1e293b;
}

/* Search Results Styles */
.search-results {
    @extend .dropdown-base;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: white;
    max-height: 400px;
    overflow-y: auto;
}

.search-result-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    gap: 1rem;
    transition: all 0.2s ease;
    cursor: pointer;
    color: inherit;
    text-decoration: none;
}

.search-result-item:hover {
    background: rgba(0, 0, 0, 0.02);
}

.search-result-content {
    flex: 1;
}

.search-result-title {
    font-weight: 500;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.search-result-description {
    font-size: 0.85rem;
    color: #64748b;
}

.search-no-results {
    padding: 1rem;
    text-align: center;
    color: #64748b;
}

/* Notification Dropdown */
.notification-dropdown {
    @extend .dropdown-base;
    margin-top: 0.5rem;
}

.notification-list {
    max-height: 360px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem;
    gap: 1rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.04);
    transition: all 0.2s ease;
    cursor: pointer;
}

.notification-item:hover {
    background: rgba(0, 0, 0, 0.02);
}

.notification-item.read {
    opacity: 0.7;
}

.notification-icon {
    width: 36px;
    height: 36px;
    border-radius: 18px;
    background: rgba(52, 152, 219, 0.1);
    color: #3498db;
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification-content {
    flex: 1;
}

.notification-text {
    font-size: 0.9rem;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.notification-time {
    font-size: 0.8rem;
    color: #64748b;
}

.notification-dot {
    width: 8px;
    height: 8px;
    border-radius: 4px;
    background: #3498db;
    margin-top: 0.25rem;
}

.mark-all-read {
    font-size: 0.8rem;
    color: #3498db;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.mark-all-read:hover {
    background: rgba(52, 152, 219, 0.1);
}

/* Settings Dropdown */
.settings-dropdown {
    @extend .dropdown-base;
    margin-top: 0.5rem;
}

.settings-list {
    padding: 0.5rem 0;
}

.settings-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    gap: 1rem;
    color: #1e293b;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
}

.settings-item:hover {
    background: rgba(0, 0, 0, 0.02);
}

.settings-item i {
    width: 20px;
    color: #64748b;
}

.settings-divider {
    height: 1px;
    background: rgba(0, 0, 0, 0.06);
    margin: 0.5rem 0;
}

.settings-item.logout {
    color: #ef4444;
}

.settings-item.logout button {
    display: flex;
    align-items: center;
    gap: 1rem;
    width: 100%;
    background: none;
    border: none;
    color: inherit;
    font: inherit;
    cursor: pointer;
    padding: 0;
}

/* User Dropdown */
.user-dropdown {
    @extend .dropdown-base;
    margin-top: 0.5rem;
}

.user-info {
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}

.user-avatar-large {
    width: 48px;
    height: 48px;
    border-radius: 24px;
    background: linear-gradient(45deg, #3498db, #2ecc71);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-details h4 {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.25rem;
}

.user-details p {
    font-size: 0.85rem;
    color: #64748b;
}

.user-actions {
    padding: 0.5rem 0;
}

.user-action-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    gap: 1rem;
    color: #1e293b;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
}

.user-action-item:hover {
    background: rgba(0, 0, 0, 0.02);
}

.user-action-item i {
    width: 20px;
    color: #64748b;
}

.user-action-item.logout {
    color: #ef4444;
}

.user-action-item.logout button {
    display: flex;
    align-items: center;
    gap: 1rem;
    width: 100%;
    background: none;
    border: none;
    color: inherit;
    font: inherit;
    cursor: pointer;
    padding: 0;
}

/* Sidebar Collapse Animation */
aside {
    transition: all 0.3s ease;
}

aside.collapsed {
    transform: translateX(-100%);
}

main {
    transition: all 0.3s ease;
}

main.expanded {
    margin-left: 0;
}

/* Loading indicator */
.loading-indicator {
    padding: 1rem;
    text-align: center;
    color: #64748b;
    font-size: 0.9rem;
}
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Header component initialized');
        
        // The functionality for notifications, settings, and profile dropdown
        // is implemented in the external header.js file.
        // This ensures we don't have duplicate implementations.
    });
</script>
<!-- Include header.js using Vite -->
@vite('resources/js/header.js')
@endpush 