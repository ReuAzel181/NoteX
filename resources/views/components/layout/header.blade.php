<header class="app-header">
    <div class="header-left">
        <button class="menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo">NoteX</div>
    </div>
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search anything... notes, tools, ideas...">
    </div>
    <div class="header-right">
        <button class="theme-toggle" id="theme-toggle" title="Toggle dark mode">
            <i class="fas fa-moon"></i>
        </button>
        <button class="notification-btn" title="Notifications">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">2</span>
        </button>
        <button class="settings-btn" title="Settings">
            <i class="fas fa-cog"></i>
        </button>
        <button class="profile-btn" title="Profile">
            <i class="fas fa-user-circle"></i>
        </button>
    </div>
</header>

<style>
:root {
    --primary: #4f8cff;
    --header-bg: rgba(224,231,255,0.92);
    --header-border: rgba(79,140,255,0.18);
    --header-shadow: rgba(79,140,255,0.10);
    --header-text: #312e81;
    --header-icon-hover: #7c3aed;
    --search-bg: #fff;
    --search-focus-border: #4f8cff;
    [data-theme="dark"] {
        --header-bg: linear-gradient(90deg, #23244a 0%, #2d2e5a 100%);
        --header-border: rgba(79,140,255,0.25);
        --header-shadow: rgba(124,58,237,0.10);
        --header-text: #f3f4fa;
        --header-icon-hover: #06b6d4;
        --search-bg: #23244a;
    }
    --transition-speed: 0.4s;
}

.app-header {
    position: fixed;
    top: 0;
    left: var(--sidebar-width, 260px); /* Default value */
    right: 0;
    height: var(--header-height);
    background: var(--header-bg);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    border-bottom: 1px solid var(--header-border);
    z-index: 999;
    transition: left var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 24px 0 rgba(79,140,255,0.10);
    overflow: hidden;
}

.app-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 100%;
    background: 
        linear-gradient(45deg, transparent 40%, rgba(79,140,255,0.04) 40%, rgba(79,140,255,0.04) 60%, transparent 60%),
        linear-gradient(-45deg, transparent 40%, rgba(124,58,237,0.03) 40%, rgba(124,58,237,0.03) 60%, transparent 60%),
        linear-gradient(90deg, transparent 30%, rgba(6,182,212,0.02) 30%, rgba(6,182,212,0.02) 70%, transparent 70%);
    background-size: 40px 40px, 60px 60px, 80px 80px;
    pointer-events: none;
    z-index: -1;
    animation: headerBackgroundShift 15s ease-in-out infinite;
}

@keyframes headerBackgroundShift {
    0%, 100% { 
        background-position: 0% 0%, 0% 0%, 0% 0%; 
    }
    25% { 
        background-position: 20px 20px, -30px -30px, 40px 0%; 
    }
    50% { 
        background-position: 0% 0%, 0% 0%, 0% 0%; 
    }
    75% { 
        background-position: -20px -20px, 30px 30px, -40px 0%; 
    }
}

.header-left {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.menu-toggle {
    display: none;
    background: none;
    border: none;
    color: var(--header-text);
    cursor: pointer;
    padding: 0.5rem;
    font-size: 1.2rem;
}

.logo {
    font-size: 1.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #00b894, #00a085);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    display: none; /* Hidden on desktop, shown on mobile */
}

.search-bar {
    flex: 1;
    max-width: 700px;
    position: relative;
    margin: 0 2rem;
}

.search-bar input {
    width: 100%;
    padding: 0.75rem 1.5rem 0.75rem 3rem;
    border: 2px solid var(--header-border);
    border-radius: 25px;
    font-size: 1rem;
    background: var(--search-bg);
    color: var(--header-text);
    transition: all 0.3s ease;
    box-shadow: 0 2px 12px 0 rgba(79,140,255,0.10);
    font-weight: 600;
}

.search-bar input:focus {
    outline: none;
    border-color: var(--search-focus-border);
    background: var(--header-bg);
    box-shadow: 0 0 0 3px rgba(79,140,255,0.18);
}

.search-bar i {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--header-icon-hover);
    font-size: 1.2rem;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.header-right button {
    background: none;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    color: var(--header-text);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-right button:hover {
    background: var(--sidebar-hover-bg);
    color: var(--header-icon-hover);
    transform: scale(1.1);
}

.header-right button i {
    font-size: 1.3rem;
    transition: transform 0.3s ease;
}

.header-right button:hover i {
    transform: rotate(15deg);
}

.notification-badge {
    position: absolute;
    top: 6px;
    right: 6px;
    background: #e74c3c;
    color: white;
    font-family: -apple-system, sans-serif;
    font-weight: 600;
    font-size: 0.7rem;
    line-height: 1;
    padding: 3px 6px;
    border-radius: 10px;
    border: 2px solid var(--header-bg);
}

@media (max-width: 992px) {
    .search-bar {
        max-width: 400px;
    }
}

@media (max-width: 768px) {
    .app-header {
        left: 0;
        padding: 0 1rem;
    }

    .menu-toggle {
        display: block;
    }

    .logo {
        display: block;
    }

    .search-bar {
        margin: 0 1rem;
        flex: 1;
    }

    .header-right button:not(.theme-toggle) {
        display: none;
    }
}
</style> 