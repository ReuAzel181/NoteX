<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NoteX - Futuristic Note-Taking Suite</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            :root {
                --primary: #4f8cff;
                --accent: #7c3aed;
                --secondary: #06b6d4;
                --dark: #312e81;
                --light: #e0e7ff;
                --main-gradient: linear-gradient(135deg, #4f8cff, #7c3aed, #06b6d4);
                --main-gradient-hover: linear-gradient(135deg, #7c3aed, #312e81, #4f8cff);
                --bg-main: linear-gradient(135deg, #e0e7ff, #f0f9ff, #f0fdfa);
                --bg-card: rgba(255,255,255,0.95);
                --bg-sidebar: rgba(224,231,255,0.95);
                --bg-hover: rgba(79,140,255,0.08);
                --bg-active: rgba(79,140,255,0.15);
                --text-primary: #1a1a1a;
                --text-secondary: #4a5568;
                --text-active: #4f8cff;
                --border-color: rgba(79,140,255,0.18);
                --shadow-color: rgba(79,140,255,0.12);
                --sidebar-min-width: 280px;
                --sidebar-max-width: 500px;
                --sidebar-collapsed-width: 70px;
                --header-height: 60px;
                --transition-speed: 0.4s;
            }

            /* Dark theme */
            [data-theme="dark"] {
                --bg-main: linear-gradient(135deg, #18192a 0%, #23244a 100%);
                --bg-card: rgba(35,36,74,0.96);
                --bg-sidebar: linear-gradient(180deg, rgba(45,46,90,0.98), rgba(35,36,74,0.98));
                --bg-hover: rgba(79,140,255,0.13);
                --bg-active: rgba(124,58,237,0.18);
                --text-primary: #f3f4fa;
                --text-secondary: #b3b6d4;
                --border-color: rgba(79,140,255,0.25);
                --shadow-color: rgba(124,58,237,0.18);
                --main-gradient: linear-gradient(135deg, #4f8cff 0%, #06b6d4 50%, #7c3aed 100%);
                --main-gradient-hover: linear-gradient(135deg, #7c3aed 0%, #4f8cff 100%);
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                background: var(--bg-main);
                color: var(--text-primary);
                line-height: 1.6;
                overflow-x: hidden;
                position: relative;
            }

            /* Telegram-style linear background pattern */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: 
                    linear-gradient(45deg, transparent 40%, rgba(0, 184, 148, 0.03) 40%, rgba(0, 184, 148, 0.03) 60%, transparent 60%),
                    linear-gradient(-45deg, transparent 40%, rgba(0, 160, 133, 0.02) 40%, rgba(0, 160, 133, 0.02) 60%, transparent 60%),
                    linear-gradient(90deg, transparent 30%, rgba(0, 184, 148, 0.01) 30%, rgba(0, 184, 148, 0.01) 70%, transparent 70%),
                    radial-gradient(circle at 20% 80%, rgba(0, 184, 148, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(0, 160, 133, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(0, 206, 201, 0.05) 0%, transparent 50%);
                background-size: 60px 60px, 80px 80px, 100px 100px, 300px 300px, 250px 250px, 200px 200px;
                pointer-events: none;
                z-index: -1;
                animation: backgroundShift 20s ease-in-out infinite;
            }

            @keyframes backgroundShift {
                0%, 100% { 
                    background-position: 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%; 
                }
                25% { 
                    background-position: 30px 30px, -40px -40px, 50px 0%, 150px 150px, -125px -125px, 100px 100px; 
                }
                50% { 
                    background-position: 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%, 0% 0%; 
                }
                75% { 
                    background-position: -30px -30px, 40px 40px, -50px 0%, -150px -150px, 125px 125px, -100px -100px; 
                }
            }

            /* Floating Particles */
            .floating-particle {
                position: fixed;
                background: var(--primary);
                border-radius: 50%;
                pointer-events: none;
                animation: float 6s ease-in-out infinite;
                z-index: -1;
            }

            .floating-particle:nth-child(1) {
                width: 4px;
                height: 4px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }

            .floating-particle:nth-child(2) {
                width: 6px;
                height: 6px;
                top: 60%;
                right: 15%;
                animation-delay: 2s;
            }

            .floating-particle:nth-child(3) {
                width: 3px;
                height: 3px;
                bottom: 30%;
                left: 20%;
                animation-delay: 4s;
            }

            .floating-particle:nth-child(4) {
                width: 5px;
                height: 5px;
                top: 40%;
                right: 30%;
                animation-delay: 1s;
            }

            @keyframes float {
                0%, 100% { 
                    transform: translateY(0px) rotate(0deg); 
                    opacity: 0.7;
                }
                25% { 
                    transform: translateY(-20px) rotate(5deg); 
                    opacity: 1;
                }
                50% { 
                    transform: translateY(-10px) rotate(-3deg); 
                    opacity: 0.8;
                }
                75% { 
                    transform: translateY(-15px) rotate(2deg); 
                    opacity: 0.9;
                }
            }

            .main-content {
                margin-left: var(--sidebar-min-width);
                margin-top: var(--header-height);
                padding: 2rem;
                min-height: calc(100vh - var(--header-height));
                transition: margin-left var(--transition-speed) ease;
                background: var(--bg-main);
                position: relative;
            }

            .main-content.sidebar-collapsed {
                margin-left: var(--sidebar-collapsed-width);
            }

            .welcome-text {
                font-size: 2.5rem;
                font-weight: 800;
                background: var(--main-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 3rem;
                text-align: center;
                animation: textGlow 3s ease-in-out infinite alternate;
                position: relative;
            }

            .welcome-text::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 100px;
                height: 3px;
                background: var(--main-gradient);
                border-radius: 2px;
                animation: widthPulse 2s ease-in-out infinite;
            }

            @keyframes textGlow {
                0% { filter: drop-shadow(0 0 10px rgba(79,140,255,0.3)); }
                100% { filter: drop-shadow(0 0 20px rgba(79,140,255,0.6)); }
            }

            @keyframes widthPulse {
                0%, 100% { width: 100px; }
                50% { width: 150px; }
            }

            .tools-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }

            .tool-card {
                background: var(--bg-card);
                border-radius: 20px;
                padding: 2rem;
                text-align: center;
                cursor: pointer;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                border: 2px solid transparent;
                position: relative;
                overflow: hidden;
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px rgba(79,140,255,0.1);
                animation: slideInUp 0.6s ease-out forwards;
                opacity: 0;
            }

            .tool-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(79,140,255,0.1), transparent);
                transition: left 0.8s;
            }

            .tool-card:hover::before {
                left: 100%;
            }

            .tool-card:hover {
                transform: translateY(-10px) scale(1.02);
                box-shadow: 0 20px 60px rgba(79,140,255,0.25);
                border-color: var(--primary);
            }

            .tool-icon {
                font-size: 3rem;
                background: var(--main-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 1.5rem;
                transition: all 0.3s ease;
                display: inline-block;
            }

            .tool-card:hover .tool-icon {
                transform: scale(1.2) rotate(5deg);
                filter: drop-shadow(0 0 10px rgba(79,140,255,0.5));
            }

            .tool-title {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 1rem;
                color: var(--text-primary);
                transition: color 0.3s ease;
            }

            .tool-card:hover .tool-title {
                color: var(--primary);
            }

            .tool-description {
                color: var(--text-secondary);
                font-size: 1rem;
                line-height: 1.6;
                transition: color 0.3s ease;
            }

            .tool-card:hover .tool-description {
                color: var(--text-primary);
            }

            .saved-notes {
                background: var(--bg-card);
                border-radius: 20px;
                padding: 2rem;
                border: 2px solid var(--border-color);
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px rgba(79,140,255,0.1);
                position: relative;
                overflow: hidden;
            }

            .saved-notes::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: var(--main-gradient);
            }

            .saved-notes h2 {
                font-size: 1.75rem;
                margin-bottom: 1.5rem;
                color: var(--text-primary);
                font-weight: 700;
                background: var(--main-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .saved-note-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.25rem;
                border-bottom: 1px solid var(--border-color);
                cursor: pointer;
                transition: all 0.3s ease;
                border-radius: 12px;
                margin-bottom: 0.5rem;
            }

            .saved-note-item:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }

            .saved-note-item:hover {
                background: var(--bg-hover);
                transform: translateX(10px);
                box-shadow: 0 4px 20px rgba(79,140,255,0.15);
            }

            .saved-note-title {
                font-weight: 600;
                color: var(--text-primary);
                font-size: 1.1rem;
            }

            .saved-note-date {
                color: var(--text-secondary);
                font-size: 0.9rem;
                background: var(--main-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            @media (max-width: 768px) {
                .main-content {
                    margin-left: 0;
                    padding: 1rem;
                }

                .main-content.sidebar-collapsed {
                    margin-left: 0;
                }

                .tools-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .welcome-text {
                    font-size: 2rem;
                }
            }

            .tool-content {
                display: none;
                background: var(--bg-card);
                border-radius: 20px;
                padding: 2rem;
                margin-top: 1rem;
                border: 2px solid var(--border-color);
                backdrop-filter: blur(10px);
                box-shadow: 0 8px 32px rgba(79,140,255,0.1);
                position: relative;
                overflow: hidden;
            }

            .tool-content::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: var(--main-gradient);
            }

            #section-title {
                font-size: 2rem;
                margin-bottom: 1.5rem;
                color: var(--text-primary);
                font-weight: 700;
                background: var(--main-gradient);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            #exit-button {
                position: fixed;
                top: calc(var(--header-height) + 1rem);
                right: 1rem;
                padding: 0.75rem 1.5rem;
                background: var(--main-gradient);
                border: none;
                border-radius: 25px;
                color: white;
                cursor: pointer;
                display: none;
                align-items: center;
                gap: 0.5rem;
                z-index: 10;
                transition: all 0.3s ease;
                font-weight: 600;
                box-shadow: 0 4px 20px rgba(79,140,255,0.3);
            }

            #exit-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 30px rgba(79,140,255,0.4);
            }

            /* Enhanced animations */
            @keyframes slideInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .tool-card:nth-child(1) { animation-delay: 0.1s; }
            .tool-card:nth-child(2) { animation-delay: 0.2s; }
            .tool-card:nth-child(3) { animation-delay: 0.3s; }
            .tool-card:nth-child(4) { animation-delay: 0.4s; }

            /* Loading animation */
            .loading-dots {
                display: inline-block;
            }

            .loading-dots::after {
                content: '';
                animation: dots 1.5s steps(5, end) infinite;
            }

            @keyframes dots {
                0%, 20% { content: ''; }
                40% { content: '.'; }
                60% { content: '..'; }
                80%, 100% { content: '...'; }
            }

            /* Text gradient animation */
            .text-gradient-animate {
                background: linear-gradient(-45deg, #4f8cff, #7c3aed, #06b6d4, #e0e7ff);
                background-size: 400% 400%;
                animation: gradientShift 3s ease infinite;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            #splash-screen {
                position: fixed;
                z-index: 2000;
                inset: 0;
                width: 100vw;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                background: transparent;
                transition: opacity 0.7s cubic-bezier(.4,0,.2,1);
            }
            #splash-screen.hide {
                opacity: 0;
                pointer-events: none;
            }
            .splash-bg-lively {
                position: absolute;
                inset: 0;
                width: 100vw;
                height: 100vh;
                background: linear-gradient(120deg, #e0e7ff 0%, #4f8cff 40%, #7c3aed 70%, #f472b6 100%);
                background-size: 300% 300%;
                animation: livelyGradientMove 7s ease-in-out infinite alternate;
                z-index: 0;
            }
            @keyframes livelyGradientMove {
                0% { background-position: 0% 50%; }
                100% { background-position: 100% 50%; }
            }
            .splash-lines {
                position: absolute;
                inset: 0;
                width: 100vw;
                height: 100vh;
                z-index: 1;
                pointer-events: none;
                opacity: 0.7;
                animation: linesMove 12s linear infinite alternate;
            }
            @keyframes linesMove {
                0% { transform: translateY(0); }
                100% { transform: translateY(-30px); }
            }
            .splash-stars {
                position: absolute;
                inset: 0;
                width: 100vw;
                height: 100vh;
                z-index: 1;
                pointer-events: none;
            }
            .splash-stars span {
                position: absolute;
                border-radius: 50%;
                background: #fff;
                opacity: 0.7;
                box-shadow: 0 0 8px #4f8cff44, 0 0 16px #7c3aed22;
                animation: splashStarTwinkle 2.5s infinite alternate;
            }
            .splash-stars span:nth-child(1) { width: 4px; height: 4px; left: 12vw; top: 18vh; animation-delay: 0s; }
            .splash-stars span:nth-child(2) { width: 3px; height: 3px; right: 10vw; top: 22vh; animation-delay: 0.5s; }
            .splash-stars span:nth-child(3) { width: 2px; height: 2px; left: 30vw; bottom: 20vh; animation-delay: 1s; }
            .splash-stars span:nth-child(4) { width: 5px; height: 5px; right: 20vw; bottom: 12vh; animation-delay: 1.5s; }
            .splash-stars span:nth-child(5) { width: 3px; height: 3px; left: 60vw; top: 10vh; animation-delay: 0.8s; }
            .splash-stars span:nth-child(6) { width: 2px; height: 2px; right: 40vw; bottom: 30vh; animation-delay: 1.2s; }
            .splash-stars span:nth-child(7) { width: 4px; height: 4px; left: 80vw; top: 40vh; animation-delay: 0.3s; }
            .splash-stars span:nth-child(8) { width: 3px; height: 3px; right: 60vw; bottom: 15vh; animation-delay: 1.7s; }
            @keyframes splashStarTwinkle {
                0%, 100% { opacity: 0.7; }
                50% { opacity: 1; box-shadow: 0 0 16px #4f8cff88, 0 0 32px #7c3aed44; }
            }
            .splash-content {
                position: relative;
                z-index: 2;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .splash-logo {
                margin-bottom: 1.2rem;
                filter: drop-shadow(0 0 32px #fff8) drop-shadow(0 0 16px #4f8cff66);
                animation: splashLogoPulseLight 1.2s infinite alternate;
            }
            @keyframes splashLogoPulseLight {
                0% { filter: drop-shadow(0 0 16px #fff4) drop-shadow(0 0 8px #4f8cff33); }
                100% { filter: drop-shadow(0 0 32px #fff) drop-shadow(0 0 24px #4f8cff99); }
            }
            .splash-title-light {
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                margin-bottom: 0.7rem;
                background: linear-gradient(90deg, #4f8cff, #06b6d4, #7c3aed);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-shadow: 0 2px 24px #fff8;
                animation: splashTitleGlowLight 1.2s infinite alternate;
                text-align: center;
            }
            @keyframes splashTitleGlowLight {
                0% { text-shadow: 0 2px 12px #fff4; }
                100% { text-shadow: 0 2px 32px #4f8cff88; }
            }
            .splash-loading-light {
                display: flex;
                gap: 0.3rem;
                margin-bottom: 0.5rem;
            }
            .splash-loading-light .dot {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: linear-gradient(135deg, #4f8cff, #7c3aed, #fff 80%);
                opacity: 0.8;
                animation: splashDotLight 1.2s infinite;
            }
            .splash-loading-light .dot:nth-child(2) { animation-delay: 0.2s; }
            .splash-loading-light .dot:nth-child(3) { animation-delay: 0.4s; }
            @keyframes splashDotLight {
                0%, 80%, 100% { transform: scale(1); opacity: 0.8; }
                40% { transform: scale(1.4); opacity: 1; }
            }
            .splash-center-card.lively {
                border-radius: 32px;
                border: none;
                box-shadow: 0 8px 48px 0 #7c3aed22, 0 0 0 6px #fff2;
                background: linear-gradient(135deg, rgba(255,255,255,0.85) 60%, rgba(79,140,255,0.08) 100%);
                animation: cardGlow 2.5s ease-in-out infinite alternate;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                z-index: 10;
                padding: 1.7rem 1.5rem 1.2rem 1.5rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-width: 320px;
                max-width: 80vw;
                margin: 0 auto;
                backdrop-filter: blur(8px);
            }
            @keyframes cardGlow {
                0% { box-shadow: 0 8px 48px 0 #7c3aed22, 0 0 0 6px #fff2; }
                100% { box-shadow: 0 8px 64px 0 #4f8cff33, 0 0 0 12px #f472b622; }
            }
            .splash-subtitle {
                color: #5b5b7a;
                font-size: 1.13rem;
                font-weight: 400;
                margin-bottom: 2.3rem;
                text-align: center;
            }
            .splash-features {
                display: flex;
                gap: 1.2rem;
                margin-bottom: 1.5rem;
                padding-top: 0.3rem;
            }
            .splash-feature-card.lively {
                border-radius: 32px;
                border: 1.5px solid rgba(255,255,255,0.35);
                background: rgba(255,255,255,0.18);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                box-shadow: 0 2px 16px 0 #4f8cff11, 0 0 0 3px #fff2;
                animation: featureGlow 2.5s ease-in-out infinite alternate;
                padding: 1.3rem 1.1rem 1rem 1.1rem;
                min-width: 150px;
                max-width: 200px;
                display: flex;
                flex-direction: column;
                align-items: center;
                box-sizing: border-box;
                margin-bottom: 1.2rem;
            }
            .feature-icon {
                font-size: 2.7rem;
                margin-bottom: 1.2rem;
                color: #7c3aed;
                background: linear-gradient(135deg, #4f8cff, #7c3aed);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                font-weight: 700;
            }
            .feature-title {
                font-weight: 700;
                font-size: 1.22rem;
                margin-bottom: 0.5rem;
                color: #23244a;
                text-align: center;
            }
            .feature-desc {
                color: #5b5b7a;
                font-size: 1.01rem;
                font-weight: 400;
                text-align: center;
                line-height: 1.7;
            }
        </style>
    </head>
    <body>
        <!-- Futuristic Splash Screen -->
        <div id="splash-screen" aria-hidden="true">
            <div class="splash-bg-lively"></div>
            <svg class="splash-lines" width="100%" height="100%" viewBox="0 0 1920 1080" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="lineGrad1" x1="0" y1="0" x2="1" y2="1">
                        <stop offset="0%" stop-color="#4f8cff" stop-opacity="0.18"/>
                        <stop offset="100%" stop-color="#e0e7ff" stop-opacity="0.05"/>
                    </linearGradient>
                    <linearGradient id="lineGrad2" x1="1" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#7c3aed" stop-opacity="0.13"/>
                        <stop offset="100%" stop-color="#06b6d4" stop-opacity="0.07"/>
                    </linearGradient>
                </defs>
                <line x1="0" y1="200" x2="1920" y2="400" stroke="url(#lineGrad1)" stroke-width="16"/>
                <line x1="0" y1="600" x2="1920" y2="900" stroke="url(#lineGrad2)" stroke-width="12"/>
                <line x1="0" y1="1000" x2="1920" y2="1080" stroke="url(#lineGrad1)" stroke-width="8"/>
            </svg>
            <div class="splash-stars">
                <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>
            <div class="splash-center-card lively">
                <div class="splash-logo">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                        <defs>
                            <radialGradient id="logo-glow" cx="50%" cy="50%" r="50%" fx="50%" fy="50%">
                                <stop offset="0%" stop-color="#fff" stop-opacity="0.7"/>
                                <stop offset="100%" stop-color="#4f8cff" stop-opacity="0.1"/>
                            </radialGradient>
                            <linearGradient id="logo-gradient-light" x1="0" y1="0" x2="80" y2="80" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#4f8cff"/>
                                <stop offset="0.5" stop-color="#06b6d4"/>
                                <stop offset="1" stop-color="#f472b6"/>
                            </linearGradient>
                        </defs>
                        <circle cx="40" cy="40" r="36" fill="url(#logo-glow)"/>
                        <rect x="12" y="12" width="56" height="56" rx="16" fill="url(#logo-gradient-light)"/>
                        <rect x="26" y="26" width="28" height="28" rx="7" fill="#fff"/>
                        <circle id="orbit-comet" cx="40" cy="12" r="4" fill="#fff"/>
                    </svg>
                </div>
                <div class="splash-title-light">Welcome to NoteX!</div>
                <div class="splash-subtitle">Your futuristic note-taking and productivity suite</div>
                <div class="splash-features">
                    <div class="splash-feature-card lively">
                        <div class="feature-icon"><i class="fas fa-sticky-note"></i></div>
                        <div class="feature-title">Notes</div>
                        <div class="feature-desc">Create and organize your notes with ease</div>
                    </div>
                    <div class="splash-feature-card lively">
                        <div class="feature-icon"><i class="fas fa-paint-brush"></i></div>
                        <div class="feature-title">Digital Canvas</div>
                        <div class="feature-desc">Sketch and visualize your ideas</div>
                    </div>
                    <div class="splash-feature-card lively">
                        <div class="feature-icon"><i class="fas fa-book"></i></div>
                        <div class="feature-title">Dictionary</div>
                        <div class="feature-desc">Look up word definitions instantly</div>
                    </div>
                    <div class="splash-feature-card lively">
                        <div class="feature-icon"><i class="fas fa-calculator"></i></div>
                        <div class="feature-title">Calculator</div>
                        <div class="feature-desc">Perform quick calculations anytime</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Splash Screen -->

        <!-- Floating Particles -->
        <div class="floating-particle"></div>
        <div class="floating-particle"></div>
        <div class="floating-particle"></div>
        <div class="floating-particle"></div>

        <?php echo $__env->make('components.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('components.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="main-content">
            <div id="dashboard-content">
                <h1 class="welcome-text text-gradient-animate">Welcome to NoteX! 🚀</h1>
                
                <div class="tools-grid">
                    <div class="tool-card" onclick="switchContent('notes')">
                        <i class="fas fa-sticky-note tool-icon"></i>
                        <h2 class="tool-title">Smart Notes</h2>
                        <p class="tool-description">AI-powered note-taking with intelligent suggestions</p>
                    </div>
                    
                    <div class="tool-card" onclick="switchContent('draw')">
                        <i class="fas fa-paint-brush tool-icon"></i>
                        <h2 class="tool-title">Digital Canvas</h2>
                        <p class="tool-description">Create stunning digital artwork and diagrams</p>
                    </div>
                    
                    <div class="tool-card" onclick="switchContent('calculator')">
                        <i class="fas fa-calculator tool-icon"></i>
                        <h2 class="tool-title">Scientific Calculator</h2>
                        <p class="tool-description">Advanced mathematical computations</p>
                    </div>
                    
                    <div class="tool-card" onclick="switchContent('dictionary')">
                        <i class="fas fa-book tool-icon"></i>
                        <h2 class="tool-title">Intelligent Dictionary</h2>
                        <p class="tool-description">AI-powered word definitions and examples</p>
                    </div>
                </div>

                <div class="saved-notes">
                    <h2>Your Smart Notes</h2>
                    <div id="savedNotesList"></div>
                </div>
            </div>

            <!-- Include component content directly -->
            <?php echo $__env->make('components.notes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('components.draw', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('components.calculator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('components.dictionary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <button id="exit-button" onclick="showDashboard()">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </button>
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Theme handling
                const themeToggle = document.getElementById('theme-toggle');
                const themeIcon = themeToggle.querySelector('i');
                
                // Load saved theme
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.body.setAttribute('data-theme', savedTheme);
                updateThemeIcon(savedTheme);
                
                themeToggle.addEventListener('click', () => {
                    const currentTheme = document.body.getAttribute('data-theme');
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    
                    document.body.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateThemeIcon(newTheme);
                });
                
                function updateThemeIcon(theme) {
                    themeIcon.className = theme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
                }
                
                // Sidebar resize handling
                const sidebar = document.querySelector('.app-sidebar');
                const resizer = document.querySelector('.sidebar-resizer');
                let isResizing = false;
                
                // Load saved sidebar width
                const savedWidth = localStorage.getItem('sidebarWidth');
                const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
                if (savedWidth && !isSidebarCollapsed) {
                    sidebar.style.width = savedWidth + 'px';
                }
                
                resizer.addEventListener('mousedown', initResize);
                
                function initResize(e) {
                    isResizing = true;
                    resizer.classList.add('dragging');
                    document.addEventListener('mousemove', resize);
                    document.addEventListener('mouseup', stopResize);
                }
                
                function resize(e) {
                    if (!isResizing) return;
                    
                    const minWidth = parseInt(getComputedStyle(document.documentElement)
                        .getPropertyValue('--sidebar-min-width'));
                    const maxWidth = parseInt(getComputedStyle(document.documentElement)
                        .getPropertyValue('--sidebar-max-width'));
                        
                    let newWidth = e.clientX;
                    newWidth = Math.max(minWidth, Math.min(maxWidth, newWidth));
                    
                    sidebar.style.width = newWidth + 'px';
                    localStorage.setItem('sidebarWidth', newWidth);
                }
                
                function stopResize() {
                    isResizing = false;
                    resizer.classList.remove('dragging');
                    document.removeEventListener('mousemove', resize);
                    document.removeEventListener('mouseup', stopResize);
                }
                
                // Mobile menu handling
                const menuToggle = document.querySelector('.menu-toggle');
                
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('show');
                });
                
                // Handle sidebar width changes
                const mainContent = document.querySelector('.main-content');
                const header = document.querySelector('.app-header');
                
                const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                            const sidebarWidth = sidebar.style.width;
                            if (sidebarWidth && !sidebar.classList.contains('collapsed')) {
                                mainContent.style.marginLeft = sidebarWidth;
                                header.style.left = sidebarWidth;
                            }
                        }
                    });
                });
                
                observer.observe(sidebar, { attributes: true });
            });

            function showDashboard() {
                document.querySelectorAll('.tool-content').forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById('dashboard-content').style.display = 'block';
                document.getElementById('section-title').textContent = 'Dashboard';
                document.getElementById('exit-button').style.display = 'none';
                updateSavedNotesList();

                // Update active state in sidebar
                document.querySelectorAll('.nav-section li').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelector('.nav-section li:first-child').classList.add('active');
            }

            function switchContent(contentType) {
                document.querySelectorAll('.tool-content, #dashboard-content').forEach(content => {
                    content.style.display = 'none';
                });

                const contentElement = document.getElementById(`${contentType}-content`);
                if (contentElement) {
                    contentElement.style.display = 'block';
                }

                const titles = {
                    notes: 'Smart Notes',
                    draw: 'Digital Canvas',
                    calculator: 'Scientific Calculator',
                    dictionary: 'Intelligent Dictionary'
                };
                document.getElementById('section-title').textContent = titles[contentType];
                document.getElementById('exit-button').style.display = 'flex';

                // Update active state in sidebar
                document.querySelectorAll('.nav-section li').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelector(`.nav-section a[onclick*="${contentType}"]`).parentElement.classList.add('active');

                // Close mobile menu
                document.querySelector('.app-sidebar').classList.remove('show');

                if (contentType === 'draw') {
                    initializeDrawingCanvas();
                } else if (contentType === 'notes') {
                    loadSavedNotes();
                } else if (contentType === 'dictionary') {
                    document.getElementById('word-search').focus();
                } else if (contentType === 'calculator') {
                    initializeCalculator();
                }
            }

            function updateSavedNotesList() {
                const savedNotes = JSON.parse(localStorage.getItem('notex_notes') || '[]');
                const savedNotesList = document.getElementById('savedNotesList');
                
                if (savedNotesList) {
                    savedNotesList.innerHTML = '';
                    
                    savedNotes.sort((a, b) => new Date(b.updatedAt) - new Date(a.updatedAt))
                        .forEach(note => {
                            const noteElement = document.createElement('div');
                            noteElement.className = 'saved-note-item';
                            noteElement.innerHTML = `
                                <div class="saved-note-title">${note.title || 'Untitled'}</div>
                                <div class="saved-note-date">${new Date(note.updatedAt).toLocaleDateString()}</div>
                            `;
                            
                            noteElement.addEventListener('click', () => {
                                switchContent('notes');
                                setTimeout(() => loadNote(note.id), 100);
                            });
                            
                            savedNotesList.appendChild(noteElement);
                        });

                    if (savedNotes.length === 0) {
                        savedNotesList.innerHTML = '<div class="text-muted text-center p-4">No saved notes yet</div>';
                    }
                }
            }

            // Splash screen logic
            window.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    document.getElementById('splash-screen').classList.add('hide');
                }, 2200);

                // Orbit comet animation
                const comet = document.getElementById('orbit-comet');
                let angle = 0;
                function animateComet() {
                    angle += 2;
                    if (angle > 360) angle = 0;
                    const rad = angle * Math.PI / 180;
                    const r = 28;
                    const cx = 40 + r * Math.sin(rad);
                    const cy = 40 - r * Math.cos(rad);
                    comet.setAttribute('cx', cx);
                    comet.setAttribute('cy', cy);
                    requestAnimationFrame(animateComet);
                }
                animateComet();

                // Allow manual skip
                document.getElementById('splash-cta-btn').onclick = function() {
                    document.getElementById('splash-screen').classList.add('hide');
                };
            });
        </script>
    </body>
</html> <?php /**PATH D:\XAMPP\htdocs\LearnHub\resources\views/welcome.blade.php ENDPATH**/ ?>