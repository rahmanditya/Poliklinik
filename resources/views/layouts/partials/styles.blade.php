<style>

    /* Sidebar Animations */
    .sidebar {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar-menu ul li a {
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .sidebar-menu ul li a::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 0;
        background: rgba(255, 255, 255, 0.1);
        transition: width 0.5s ease;
    }

    .sidebar-menu ul li a:hover::before {
        width: 100%;
    }

    .sidebar-menu ul li a.active {
        background: white;
        border-left: 4px solid #fff;
    }

    .sidebar-menu ul li a span:last-child {
        transition: all 0.5s ease;
    }

    .sidebar-menu ul li a:hover span:last-child {
        transform: translateX(5px);
    }

    /* Header Animations */
    header {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.5s ease;
    }

    .search-wrapper {
        transition: all 0.5s ease;
        border: 2px solid transparent;
    }

    .search-wrapper:focus-within {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .search-wrapper input {
        transition: all 0.5s ease;
    }

    .search-wrapper:hover {
        transform: translateY(-1px);
    }

    /* Logout Button Styles */
    .logout-btn {
        position: relative;
        padding: 8px 16px;
        background: linear-gradient(45deg, #ff6b6b, #ff8787);
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.5px;
        overflow: hidden;
        transition: all 0.5s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .logout-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            120deg,
            transparent,
            rgba(255, 255, 255, 0.3),
            transparent
        );
        transition: all 0.5s ease;
    }

    .logout-btn:hover::before {
        left: 100%;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }

    /* Navigation Toggle Animation */
    #nav-toggle:checked + .sidebar {
        animation: slideIn 0.5s ease forwards;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive Design Enhancements */
    @media screen and (max-width: 768px) {
        .sidebar {
            box-shadow: none;
        }
        
        header {
            backdrop-filter: none;
            background: white;
        }
    }
</style>