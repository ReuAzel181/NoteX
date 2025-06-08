<aside class="app-sidebar">
    <div class="sidebar-background-shapes"></div>
    
    <div class="sidebar-header">
        <div class="logo">
            <i class="fas fa-atom logo-icon"></i>
            <span class="logo-text nav-text">NoteX</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <h3 class="nav-text">Menu</h3>
            <ul>
                <li class="active">
                    <a href="#" onclick="showDashboard()">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="switchContent('notes')">
                        <i class="fas fa-sticky-note"></i>
                        <span class="nav-text">Smart Notes</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="switchContent('draw')">
                        <i class="fas fa-paint-brush"></i>
                        <span class="nav-text">Digital Canvas</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="switchContent('calculator')">
                        <i class="fas fa-calculator"></i>
                        <span class="nav-text">Calculator</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="switchContent('dictionary')">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">Dictionary</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <h3 class="nav-text">Recent</h3>
            <ul id="recent-items">
                <!-- Recent items will be populated dynamically -->
            </ul>
        </div>

        <div class="nav-section">
            <h3 class="nav-text">Categories</h3>
            <ul id="categoryList">
                <!-- Categories will be populated dynamically -->
            </ul>
            <button class="add-category-btn" onclick="showAddCategoryModal()">
                <i class="fas fa-plus"></i> <span class="nav-text">Add Category</span>
            </button>
        </div>
    </nav>
    
    <div class="sidebar-footer">
        <a href="#" class="user-profile">
            <i class="fas fa-user-circle"></i>
            <span class="nav-text">User Profile</span>
        </a>
    </div>

    <!-- Resizer handles -->
    <div class="sidebar-resizer sidebar-resizer-x" title="Resize Sidebar"></div>
</aside>

<style>
:root {
    --primary: #4f8cff;
    --secondary: #06b6d4;
    --accent: #7c3aed;
    --sidebar-bg: linear-gradient(180deg, rgba(224,231,255,0.95), rgba(240,249,255,0.95));
    --sidebar-border: rgba(79,140,255,0.18);
    --sidebar-text: #312e81;
    --sidebar-text-active: #4f8cff;
    --sidebar-heading: #7c3aed;
    --sidebar-hover-bg: rgba(79,140,255,0.08);
    --sidebar-active-bg: linear-gradient(90deg, rgba(79,140,255,0.15), rgba(124,58,237,0.08));
    --sidebar-shadow: rgba(79,140,255,0.12);
    [data-theme="dark"] {
        --sidebar-bg: linear-gradient(180deg, #2d2e5a 0%, #23244a 100%);
        --sidebar-border: rgba(79,140,255,0.25);
        --sidebar-text: #f3f4fa;
        --sidebar-text-active: #4f8cff;
        --sidebar-heading: #7c3aed;
        --sidebar-hover-bg: rgba(79,140,255,0.13);
        --sidebar-active-bg: linear-gradient(90deg, rgba(124,58,237,0.18), rgba(79,140,255,0.13));
        --sidebar-shadow: rgba(124,58,237,0.18);
    }
    --sidebar-width: 260px;
    --sidebar-min-width: 240px;
    --sidebar-max-width: 500px;
    --sidebar-collapsed-width: 80px;
    --header-height: 60px;
    --transition-speed: 0.4s;
}

.app-sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: var(--sidebar-width);
    height: 100vh;
    background: var(--sidebar-bg);
    border-right: 1px solid var(--sidebar-border);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    z-index: 1000;
    transition: width var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    box-shadow: 4px 0 20px -5px var(--sidebar-shadow);
    overflow: hidden;
}

.sidebar-background-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: -1;
    background: 
        linear-gradient(45deg, transparent 40%, rgba(79,140,255,0.03) 40%, rgba(79,140,255,0.03) 60%, transparent 60%),
        linear-gradient(-45deg, transparent 40%, rgba(124,58,237,0.02) 40%, rgba(124,58,237,0.02) 60%, transparent 60%),
        linear-gradient(90deg, transparent 30%, rgba(6,182,212,0.01) 30%, rgba(6,182,212,0.01) 70%, transparent 70%);
    background-size: 50px 50px, 70px 70px, 90px 90px;
    animation: sidebarBackgroundShift 25s ease-in-out infinite;
}

@keyframes sidebarBackgroundShift {
    0%, 100% { 
        background-position: 0% 0%, 0% 0%, 0% 0%; 
    }
    25% { 
        background-position: 25px 25px, -35px -35px, 45px 0%; 
    }
    50% { 
        background-position: 0% 0%, 0% 0%, 0% 0%; 
    }
    75% { 
        background-position: -25px -25px, 35px 35px, -45px 0%; 
    }
}

.sidebar-background-shapes::before,
.sidebar-background-shapes::after {
    content: '';
    position: absolute;
    background: var(--primary);
    border-radius: 50%;
    opacity: 0.03;
    animation: background-shape-anim 20s infinite linear;
}

.sidebar-background-shapes::before {
    width: 300px;
    height: 300px;
    top: 10%;
    left: -150px;
}

.sidebar-background-shapes::after {
    width: 250px;
    height: 250px;
    bottom: 5%;
    right: -120px;
    animation-delay: -10s;
}

@keyframes background-shape-anim {
    0% { transform: translateY(0) rotate(0deg); }
    100% { transform: translateY(-100px) rotate(360deg); }
}

.app-sidebar.collapsed {
    width: var(--sidebar-collapsed-width);
}

.app-sidebar.collapsed .nav-text,
.app-sidebar.collapsed .sidebar-header .logo-text,
.app-sidebar.collapsed .nav-section h3 {
    opacity: 0;
    visibility: hidden;
    width: 0;
}

.sidebar-header {
    padding: 1.5rem;
    display: flex;
    align-items: center;
    border-bottom: 1px solid var(--sidebar-border);
    flex-shrink: 0;
}

.logo {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    color: var(--text-primary);
}

.logo-icon {
    font-size: 1.8rem;
    background: linear-gradient(135deg, #4f8cff, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: transform 0.4s ease;
}

.logo:hover .logo-icon {
    transform: rotate(360deg);
}

.logo-text {
    font-size: 1.5rem;
    font-weight: 700;
    white-space: nowrap;
}

.sidebar-nav {
    padding: 1.5rem 1rem;
    overflow-y: auto;
    overflow-x: hidden;
    flex-grow: 1;
}

.sidebar-nav::-webkit-scrollbar {
    width: 4px;
}

.sidebar-nav::-webkit-scrollbar-thumb {
    background: var(--secondary);
    border-radius: 2px;
}

.sidebar-resizer-x {
    position: absolute;
    right: 0;
    top: 0;
    width: 6px;
    height: 100%;
    cursor: ew-resize;
    z-index: 1001;
    transition: background-color 0.2s ease;
}

.sidebar-resizer-x:hover,
.sidebar-resizer-x.dragging {
    background: var(--primary);
    opacity: 0.5;
}

.nav-section {
    margin-bottom: 2rem;
}

.nav-section h3 {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--sidebar-heading);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 1rem;
    padding: 0 0.75rem;
    white-space: nowrap;
    transition: opacity 0.3s ease, visibility 0.3s ease, width 0.3s ease;
}

.nav-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-section li {
    margin-bottom: 0.5rem;
}

.nav-section a {
    display: flex;
    align-items: center;
    padding: 0.85rem;
    color: var(--sidebar-text);
    text-decoration: none;
    border-radius: 10px;
    transition: all var(--transition-speed);
    white-space: nowrap;
    position: relative;
    overflow: hidden;
}

.nav-section a::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: var(--primary);
    transform: scaleY(0);
    transition: transform 0.3s ease;
    border-radius: 0 4px 4px 0;
}

.nav-section a:hover {
    background: var(--sidebar-hover-bg);
    color: var(--text-primary);
}

.nav-section li.active a {
    background: var(--sidebar-active-bg);
    color: var(--sidebar-text-active);
    font-weight: 600;
}

.nav-section li.active a::before {
    transform: scaleY(1);
}

.nav-section a i {
    width: 2rem;
    font-size: 1.2rem;
    text-align: center;
    transition: transform 0.3s ease;
}

.nav-section a:hover i {
    transform: scale(1.1);
}

.nav-text {
    opacity: 1;
    visibility: visible;
    transition: opacity 0.3s ease, visibility 0.3s ease, width 0.3s ease;
}

.add-category-btn {
    width: 100%;
    padding: 0.85rem;
    margin-top: 1rem;
    border: 1px dashed var(--sidebar-border);
    border-radius: 10px;
    background: transparent;
    color: var(--sidebar-text);
    cursor: pointer;
    transition: all var(--transition-speed);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    white-space: nowrap;
}

.add-category-btn:hover {
    border-color: var(--primary);
    background: var(--sidebar-hover-bg);
    color: var(--primary);
}

.sidebar-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--sidebar-border);
    flex-shrink: 0;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    color: var(--sidebar-text);
}

@media (max-width: 768px) {
    .app-sidebar {
        transform: translateX(-100%);
        transition: transform var(--transition-speed) ease;
        box-shadow: none;
    }

    .app-sidebar.show {
        transform: translateX(0);
        width: var(--sidebar-min-width) !important;
        box-shadow: 4px 0 20px -5px var(--sidebar-shadow);
    }

    .sidebar-resizer-x {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('.app-sidebar');
    const mainContent = document.querySelector('.main-content');
    
    // Abstracted function to handle layout updates
    function updateLayout(width) {
        document.documentElement.style.setProperty('--sidebar-width', `${width}px`);
        if (mainContent) {
            mainContent.style.marginLeft = `${width}px`;
        }
    }
    
    // Load saved dimensions from localStorage
    let savedWidth = localStorage.getItem('sidebarWidth');
    const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    
    // Initialize sidebar state
    if (isSidebarCollapsed) {
        sidebar.classList.add('collapsed');
        document.body.classList.add('sidebar-collapsed');
        updateLayout(parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-collapsed-width')));
    } else if (savedWidth) {
        const minWidth = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-min-width'));
        const maxWidth = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-max-width'));
        const width = Math.max(minWidth, Math.min(maxWidth, parseInt(savedWidth)));
        updateLayout(width);
        sidebar.style.width = `${width}px`;
    }

    // A single function to toggle the sidebar
    function toggleSidebar() {
        const isCollapsing = !sidebar.classList.contains('collapsed');
        const collapsedWidth = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-collapsed-width'));
        const minWidth = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-min-width'));
        
        if (isCollapsing) {
            savedWidth = parseInt(getComputedStyle(sidebar).width);
            localStorage.setItem('sidebarWidth', savedWidth > minWidth ? savedWidth : minWidth);
            updateLayout(collapsedWidth);
            sidebar.style.width = `${collapsedWidth}px`;
        } else {
            const lastWidth = localStorage.getItem('sidebarWidth') || minWidth;
            const width = Math.max(minWidth, parseInt(lastWidth));
            updateLayout(width);
            sidebar.style.width = `${width}px`;
        }
        
        sidebar.classList.toggle('collapsed');
        document.body.classList.toggle('sidebar-collapsed');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    }

    // Handle clicks on the sidebar header to collapse/expand
    const sidebarHeader = document.querySelector('.sidebar-header');
    if(sidebarHeader) {
        sidebarHeader.addEventListener('click', (e) => {
            // Ensure click is on header but not on resizer or other interactive elements
            if (e.target.closest('.sidebar-header')) {
                toggleSidebar();
            }
        });
    }

    // Resize handling logic
    const resizerX = document.querySelector('.sidebar-resizer-x');
    let isResizing = false;

    function initResize(e) {
        if (sidebar.classList.contains('collapsed')) return;
        
        isResizing = true;
        document.body.style.cursor = 'ew-resize';
        document.body.style.userSelect = 'none';
        
        resizerX.classList.add('dragging');
        document.addEventListener('mousemove', resize);
        document.addEventListener('mouseup', stopResize);
        sidebar.style.transition = 'none';
        if(mainContent) mainContent.style.transition = 'none';
        e.preventDefault();
    }

    function resize(e) {
        if (!isResizing) return;
        
        const minWidth = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-min-width'));
        const maxWidth = parseFloat(getComputedStyle(document.documentElement).getPropertyValue('--sidebar-max-width'));
        const newWidth = Math.max(minWidth, Math.min(maxWidth, e.clientX));
        
        requestAnimationFrame(() => {
            updateLayout(newWidth);
            sidebar.style.width = `${newWidth}px`;
        });
    }

    function stopResize() {
        if (!isResizing) return;
        isResizing = false;
        document.body.style.cursor = 'default';
        document.body.style.userSelect = 'auto';

        localStorage.setItem('sidebarWidth', parseInt(sidebar.style.width));
        resizerX.classList.remove('dragging');
        document.removeEventListener('mousemove', resize);
        document.removeEventListener('mouseup', stopResize);
        sidebar.style.transition = '';
        if(mainContent) mainContent.style.transition = '';
    }

    if(resizerX) {
        resizerX.addEventListener('mousedown', initResize);
    }
});
</script> 