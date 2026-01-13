<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
            position: relative;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
        }

        .updated {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }

        h2 {
            margin-top: 30px;
            color: #2c3e50;
        }

        p {
            margin: 10px 0;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 8px;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }

        /* ✅ Back Button Style */
        .back-btn {
            display: inline-block;
            padding: 10px 18px;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s ease-in-out;
        }

        .back-btn:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .back-wrapper {
            margin-top: 30px;
            text-align: center;
        }

        /* ✅ Agreement Style */
        .agreement {
            font-size: 14px;
            cursor: pointer;
        }

        /* ✅ Disabled Button Style */
        .back-btn.disabled {
            background: #9ca3af;
            cursor: not-allowed;
            pointer-events: none;
            transform: none;
        }
    </style>
</head>
<body>

@php
    $redirectUrl = Auth::check() && Auth::user()->role === 'admin'
        ? url('admin/dashboard')
        : url('user/dashboard');
@endphp

<div class="container">
    <h1>Privacy Policy</h1>
    <p class="updated">Last updated: January 2026</p>

    <p>
        This Privacy Policy explains how we collect, use, and protect your personal information
        when you use our website and services. By using this platform, you agree to the terms
        described in this policy.
    </p>

    <h2>1. Information We Collect</h2>
    <p>We may collect the following information:</p>
    <ul>
        <li>Personal details such as name, email address, and contact information.</li>
        <li>Account information used for login and authentication.</li>
        <li>Order and transaction details.</li>
        <li>Usage data such as pages visited and actions taken on the site.</li>
    </ul>

    <h2>2. How We Use Your Information</h2>
    <p>Your information is used to:</p>
    <ul>
        <li>Provide and improve our services.</li>
        <li>Process orders and transactions.</li>
        <li>Send important notifications and updates.</li>
        <li>Enhance user experience and security.</li>
    </ul>

    <h2>3. Data Protection</h2>
    <p>
        We implement appropriate security measures to protect your personal data from
        unauthorized access, alteration, disclosure, or destruction.
    </p>

    <h2>4. Sharing of Information</h2>
    <p>
        We do not sell or share your personal information with third parties except when
        required by law or when necessary to provide our services.
    </p>

    <h2>5. Cookies</h2>
    <p>
        Our website may use cookies to improve functionality and user experience.
        You can choose to disable cookies in your browser settings.
    </p>

    <h2>6. Your Rights</h2>
    <p>
        You have the right to access, update, or request deletion of your personal information.
        If you have concerns about your data, you may contact us.
    </p>

    <h2>7. Changes to This Policy</h2>
    <p>
        We may update this Privacy Policy from time to time. Any changes will be posted on this page.
    </p>

    <h2>8. Contact Us</h2>
    <p>
        If you have any questions about this Privacy Policy, you may contact us through our support page.
    </p>

    <!-- ✅ Agreement + Back Button -->
    <div class="back-wrapper">
        <label class="agreement">
            <input type="checkbox" id="agreeCheckbox">
            I have read and agree to the Privacy Policy
        </label>

        <br><br>

        <a 
            href="{{ $redirectUrl }}"
            class="back-btn disabled"
            id="backButton"
        >
            ← Back to Home
        </a>
    </div>

    <footer>
        &copy; 2026 Fast Shipping Store. All rights reserved.
    </footer>
</div>

<!-- ✅ Script -->
<script>
    const checkbox = document.getElementById("agreeCheckbox");
    const backButton = document.getElementById("backButton");

    // disabled by default
    backButton.style.pointerEvents = "none";

    checkbox.addEventListener("change", function () {
        if (this.checked) {
            backButton.classList.remove("disabled");
            backButton.style.pointerEvents = "auto";
        } else {
            backButton.classList.add("disabled");
            backButton.style.pointerEvents = "none";
        }
    });
</script>

</body>
</html>
