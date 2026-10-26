
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CampusConnect | Make Every Hour Count</title>

    <style>
        :root {
            --blue: #1769e0;
            --dark-blue: #104db0;
            --light-blue: #edf5ff;
            --text: #182338;
            --muted: #65738b;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text);
            background: var(--white);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: min(1120px, 90%);
            margin: auto;
        }

        /* Navigation */
        .navbar {
            background: white;
            border-bottom: 1px solid #e9eef6;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-content {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            font-size: 23px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: -0.7px;
        }

        .logo span {
            color: var(--text);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-links a:not(.btn):hover {
            color: var(--blue);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 14px;
            font-weight: 700;
        }

        .login-link {
            color: var(--text);
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 12px 22px;
            border-radius: 9px;
            background: var(--blue);
            color: white;
            font-weight: 700;
            font-size: 14px;
            border: 1px solid var(--blue);
            transition: 0.2s;
        }

        .btn:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
        }

        .btn-outline {
            color: var(--blue);
            background: white;
        }

        .btn-outline:hover {
            color: white;
        }

        /* Hero section */
        .hero {
            background:
                radial-gradient(circle at 85% 20%, #d9eaff 0, transparent 30%),
                linear-gradient(135deg, #f7faff, #edf5ff);
            overflow: hidden;
        }

        .hero-content {
            min-height: 570px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 60px;
            padding-top: 65px;
            padding-bottom: 65px;
        }

        .eyebrow {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 30px;
            background: #dceaff;
            color: var(--dark-blue);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(39px, 5vw, 61px);
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 23px;
        }

        .hero h1 span {
            color: var(--blue);
        }

        .hero-description {
            color: var(--muted);
            font-size: 17px;
            max-width: 510px;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 13px;
            margin-bottom: 30px;
        }

        .hero-note {
            color: var(--muted);
            font-size: 13px;
        }

        /* Hero illustration */
        .hero-visual {
            position: relative;
            min-height: 365px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .visual-circle {
            position: absolute;
            width: 310px;
            height: 310px;
            background: #d5e6ff;
            border-radius: 50%;
        }

        .activity-board {
            position: relative;
            width: 100%;
            max-width: 390px;
            padding: 25px;
            background: white;
            border: 1px solid #e4ebf5;
            border-radius: 22px;
            box-shadow: 0 24px 65px #204d8d1c;
            transform: rotate(-2deg);
        }

        .board-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .board-heading h3 {
            font-size: 17px;
        }

        .live-label {
            color: #14834c;
            background: #e0f8eb;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 13px;
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .icon-study {
            background: #e7efff;
        }

        .icon-art {
            background: #fff0e6;
        }

        .icon-social {
            background: #e5f8ed;
        }

        .activity-info {
            flex: 1;
        }

        .activity-info h4 {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .activity-info p {
            color: var(--muted);
            font-size: 12px;
        }

        .activity-arrow {
            color: var(--blue);
            font-size: 21px;
        }

        .floating-tag {
            position: absolute;
            right: -10px;
            bottom: 30px;
            padding: 13px 17px;
            background: white;
            border: 1px solid #e6edf7;
            border-radius: 13px;
            box-shadow: 0 12px 30px #204d8d14;
            font-size: 13px;
            font-weight: 700;
        }

        /* Categories */
        .categories {
            padding: 85px 0;
        }

        .section-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 42px;
        }

        .section-heading .eyebrow {
            margin-bottom: 13px;
        }

        .section-heading h2 {
            font-size: clamp(28px, 4vw, 39px);
            line-height: 1.2;
            margin-bottom: 14px;
            letter-spacing: -1px;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 15px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .category-card {
            padding: 28px;
            border: 1px solid #e6edf7;
            border-radius: 16px;
            background: white;
            transition: 0.2s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            border-color: #a9caff;
            box-shadow: 0 15px 35px #204d8d0d;
        }

        .category-icon {
            width: 55px;
            height: 55px;
            display: grid;
            place-items: center;
            border-radius: 15px;
            font-size: 27px;
            margin-bottom: 20px;
        }

        .category-card h3 {
            font-size: 18px;
            margin-bottom: 9px;
        }

        .category-card p {
            color: var(--muted);
            font-size: 14px;
        }

        /* Call to action */
        .cta {
            padding: 0 0 85px;
        }

        .cta-content {
            background: linear-gradient(120deg, #1769e0, #104db0);
            border-radius: 22px;
            padding: 50px 30px;
            text-align: center;
            color: white;
        }

        .cta-content h2 {
            font-size: clamp(27px, 4vw, 38px);
            line-height: 1.2;
            margin-bottom: 15px;
        }

        .cta-content p {
            max-width: 570px;
            margin: 0 auto 25px;
            color: #e3edff;
            font-size: 15px;
        }

        .cta-content .btn {
            color: var(--blue);
            background: white;
            border-color: white;
        }

        .cta-content .btn:hover {
            background: #edf5ff;
        }

        /* Footer */
        .footer {
            border-top: 1px solid #e9eef6;
            padding: 27px 0;
        }

        .footer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer p {
            font-size: 13px;
            color: var(--muted);
        }

        /* Mobile responsive */
        @media (max-width: 800px) {
            .nav-content {
                min-height: 70px;
                flex-wrap: wrap;
                padding: 15px 0;
            }

            .nav-links {
                display: none;
            }

            .nav-actions {
                gap: 12px;
            }

            .hero-content {
                grid-template-columns: 1fr;
                gap: 20px;
                padding-top: 60px;
            }

            .hero-visual {
                min-height: 350px;
            }

            .category-grid {
                grid-template-columns: 1fr;
            }

            .categories {
                padding: 65px 0;
            }

            .floating-tag {
                right: 0;
            }
        }

        @media (max-width: 420px) {
            .logo {
                font-size: 20px;
            }

            .nav-actions {
                font-size: 12px;
                gap: 9px;
            }

            .nav-actions .btn {
                padding: 10px 12px;
                font-size: 12px;
            }

            .hero h1 {
                letter-spacing: -1.3px;
            }

            .hero-description {
                font-size: 15px;
            }

            .activity-board {
                padding: 18px;
            }

            .visual-circle {
                width: 260px;
                height: 260px;
            }

            .cta-content {
                padding: 38px 22px;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <header class="navbar">
        <div class="container nav-content">

            <a href="{{ url('/') }}" class="logo">
                Campus<span>Connect.</span>
            </a>

            <nav class="nav-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="#activities">Activities</a>
                <a href="#about">About</a>
            </nav>

            <div class="nav-actions">
                @auth
                    <a class="login-link" href="{{ url('/dashboard') }}">
                        Dashboard
                    </a>
                @else
                    @if (Route::has('login'))
                        <a class="login-link" href="{{ route('login') }}">
                            Log in
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <a class="btn" href="{{ route('register') }}">
                            Get Started
                        </a>
                    @endif
                @endauth
            </div>

        </div>
    </header>

    <!-- Hero -->
    <main>
        <section class="hero">
            <div class="container hero-content">

                <div class="hero-text">
                    <span class="eyebrow">
                        Your campus, your community
                    </span>

                    <h1>
                        Vacant hours?<br>
                        <span>Make them count.</span>
                    </h1>

                    <p class="hero-description">
                        Discover activities, meet people with similar
                        interests, and make the most of your free time
                        on campus with CampusConnect.
                    </p>

                    <div class="hero-buttons">
                        @auth
                            <a class="btn" href="{{ url('/dashboard') }}">
                                Go to Dashboard &rarr;
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a class="btn" href="{{ route('register') }}">
                                    Join CampusConnect &rarr;
                                </a>
                            @endif

                            @if (Route::has('login'))
                                <a class="btn btn-outline"
                                   href="{{ route('login') }}">
                                    Explore with us
                                </a>
                            @endif
                        @endauth
                    </div>

                    <p class="hero-note">
                        Find your people. Discover your next activity.
                    </p>
                </div>

                <div class="hero-visual">
                    <div class="visual-circle"></div>

                    <div class="activity-board">
                        <div class="board-heading">
                            <h3>Campus activities</h3>
                            <span class="live-label">YOUR CAMPUS</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon icon-study">
                                📚
                            </div>
                            <div class="activity-info">
                                <h4>Study Together</h4>
                                <p>Academic review and study sessions</p>
                            </div>
                            <span class="activity-arrow">&rarr;</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon icon-art">
                                🎨
                            </div>
                            <div class="activity-info">
                                <h4>Creative Corner</h4>
                                <p>Art, hobbies, and creative activities</p>
                            </div>
                            <span class="activity-arrow">&rarr;</span>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon icon-social">
                                ☕
                            </div>
                            <div class="activity-info">
                                <h4>Campus Hangout</h4>
                                <p>Meet people and share interests</p>
                            </div>
                            <span class="activity-arrow">&rarr;</span>
                        </div>
                    </div>

                    <div class="floating-tag">
                        ✨ Every hour is an opportunity
                    </div>
                </div>

            </div>
        </section>

        <!-- Activities -->
        <section class="categories" id="activities">
            <div class="container">

                <div class="section-heading">
                    <span class="eyebrow">Find your interest</span>
                    <h2>There's something for everyone.</h2>
                    <p>
                        Turn your vacant hours into opportunities to learn,
                        create, and connect with fellow students.
                    </p>
                </div>

                <div class="category-grid">

                    <article class="category-card">
                        <div class="category-icon icon-study">
                            📖
                        </div>
                        <h3>Study Sessions</h3>
                        <p>
                            Review lessons, prepare for exams, and learn
                            alongside other students.
                        </p>
                    </article>

                    <article class="category-card">
                        <div class="category-icon icon-art">
                            🎨
                        </div>
                        <h3>Arts & Hobbies</h3>
                        <p>
                            Share your creativity and discover people
                            who enjoy the same things you do.
                        </p>
                    </article>

                    <article class="category-card">
                        <div class="category-icon icon-social">
                            🤝
                        </div>
                        <h3>Social Activities</h3>
                        <p>
                            Join casual meetups, recreational activities,
                            and opportunities to make connections.
                        </p>
                    </article>

                </div>
            </div>
        </section>

        <!-- About -->
        <section class="cta" id="about">
            <div class="container">
                <div class="cta-content">
                    <h2>Your free time can mean more.</h2>

                    <p>
                        CampusConnect helps students discover and participate
                        in campus activities, making vacant hours more
                        meaningful and productive.
                    </p>

                    @auth
                        <a class="btn" href="{{ url('/dashboard') }}">
                            Visit Dashboard &rarr;
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a class="btn" href="{{ route('register') }}">
                                Get Started Today &rarr;
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-content">
            <a href="{{ url('/') }}" class="logo">
                Campus<span>Connect.</span>
            </a>

            <p>
                &copy; {{ date('Y') }} CampusConnect.
                Built for a more connected campus.
            </p>
        </div>
    </footer>

</body>
</html>
