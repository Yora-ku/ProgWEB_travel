<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel HUB - Booking</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background-size: 400% 400%;
      background-color: #27ae60;
      animation: gradientShift 15s ease infinite;
      min-height: 100vh;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Floating elements */
    .floating-element {
      position: absolute;
      opacity: 0.1;
      animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
      top: 10%;
      left: 5%;
      animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
      top: 20%;
      right: 10%;
      animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
      bottom: 30%;
      left: 15%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    .header {
      text-align: center;
      margin-bottom: 40px;
      position: relative;
      z-index: 10;
    }

    .header h1 {
      color: white;
      font-size: 42px;
      font-weight: 800;
      margin-bottom: 8px;
      text-shadow: 0 4px 20px rgba(0,0,0,0.3);
      animation: slideDown 1s ease-out;
    }

    .header p {
      color: rgba(255, 255, 255, 0.9);
      font-size: 18px;
      font-weight: 300;
      animation: slideUp 1s ease-out 0.3s both;
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .container {
      max-width: 1300px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
      display: flex;
      min-height: 650px;
      position: relative;
      animation: scaleIn 0.8s ease-out 0.5s both;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    @keyframes scaleIn {
      from { opacity: 0; transform: scale(0.9) translateY(20px); }
      to { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* Progress indicator */
    .progress-bar {
      position: absolute;
      top: 0;
      left: 0;
      width: 33%;
      height: 4px;
      background: linear-gradient(90deg, #3498db, #2ecc71);
      border-radius: 0 2px 2px 0;
      animation: progressGlow 2s ease infinite alternate;
    }

    @keyframes progressGlow {
      0% { box-shadow: 0 0 5px rgba(52, 152, 219, 0.5); }
      100% { box-shadow: 0 0 20px rgba(52, 152, 219, 0.8); }
    }

    /* Left Form Section */
    .form-section {
      flex: 1.3;
      padding: 50px;
      background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(240,248,255,0.8));
      position: relative;
    }

    .form-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23f8f9ff' fill-opacity='0.03'%3E%3Cpath d='m0 40l40-40h-40v40z'/%3E%3C/g%3E%3C/svg%3E");
      pointer-events: none;
    }

    .form-section h2 {
      color: #2c3e50;
      font-size: 32px;
      margin-bottom: 12px;
      font-weight: 700;
      position: relative;
      z-index: 2;
    }

    .form-section h2::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, #3498db, #2ecc71);
      border-radius: 2px;
    }

    .form-section .subtitle {
      color: #7f8c8d;
      font-size: 16px;
      margin-bottom: 40px;
      line-height: 1.6;
      position: relative;
      z-index: 2;
    }

    .form-group {
      margin-bottom: 25px;
      position: relative;
      z-index: 2;
    }

    .form-group label {
      display: block;
      color: #2c3e50;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 10px;
      transition: color 0.3s ease;
    }

    .form-group.focused label {
      color: #3498db;
    }

    .input-group {
      position: relative;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .input-group::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, #3498db, #2ecc71);
      border-radius: 16px;
      opacity: 0;
      transition: opacity 0.3s ease;
      z-index: -1;
    }

    .input-group.focused::before {
      opacity: 1;
    }

    .form-group input {
      width: 100%;
      padding: 18px 55px 18px 20px;
      border: 2px solid #e8f0fe;
      border-radius: 15px;
      font-size: 15px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      position: relative;
      z-index: 1;
    }

    .input-group.focused input {
      border: 2px solid transparent;
      background: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(52, 152, 219, 0.15);
    }

    .form-group input:focus {
      outline: none;
    }

    .input-icon {
      position: absolute;
      right: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #7f8c8d;
      width: 22px;
      height: 22px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      z-index: 2;
    }

    .input-group.focused .input-icon {
      color: #3498db;
      transform: translateY(-50%) scale(1.1);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 25px;
    }

    .date-group {
      position: relative;
    }

    .btn-primary {
      width: 100%;
      padding: 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
      color: white;
      border: none;
      border-radius: 16px;
      font-size: 17px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      margin-top: 30px;
      text-transform: uppercase;
      letter-spacing: 1px;
      position: relative;
      overflow: hidden;
      z-index: 2;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s ease;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:active {
      transform: translateY(-1px);
    }

    .terms {
      font-size: 12px;
      color: #95a5a6;
      margin-top: 20px;
      line-height: 1.5;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    .terms a {
      color: #3498db;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .terms a:hover {
      color: #2980b9;
    }

    /* Right Info Section */
    .info-section {
      flex: 1;
      background: linear-gradient(145deg, #667eea, #764ba2);
      padding: 50px;
      display: flex;
      flex-direction: column;
      position: relative;
      overflow: hidden;
    }

    .info-section::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
      background-size: 50px 50px;
      animation: backgroundMove 20s linear infinite;
      opacity: 0.3;
    }

    @keyframes backgroundMove {
      0% { transform: translate(0, 0) rotate(0deg); }
      100% { transform: translate(50px, 50px) rotate(360deg); }
    }

    .hotel-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
      margin-bottom: 30px;
      transition: transform 0.3s ease;
      position: relative;
      z-index: 2;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .hotel-card:hover {
      transform: translateY(-5px);
    }

    .hotel-image {
      width: 100%;
      height: 220px;
      background: linear-gradient(45deg, #667eea, #764ba2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 18px;
      position: relative;
      overflow: hidden;
    }

    .hotel-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
      0% { left: -100%; }
      50% { left: 100%; }
      100% { left: 100%; }
    }

    .hotel-content {
      padding: 25px;
    }

    .hotel-name {
      font-size: 20px;
      font-weight: 700;
      color: #2c3e50;
      margin-bottom: 15px;
      background: linear-gradient(45deg, #2c3e50, #3498db);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hotel-rating {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      animation: pulse 2s ease infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .stars {
      margin-right: 12px;
    }

    .rating-text {
      color: #7f8c8d;
      font-size: 14px;
      font-weight: 500;
    }

    .policy-section {
      margin-bottom: 18px;
      padding: 15px;
      background: rgba(52, 152, 219, 0.05);
      border-radius: 12px;
      border-left: 4px solid #3498db;
      transition: all 0.3s ease;
    }

    .policy-section:hover {
      background: rgba(52, 152, 219, 0.1);
      transform: translateX(5px);
    }

    .policy-title {
      font-size: 14px;
      font-weight: 600;
      color: #2c3e50;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
    }

    .policy-text {
      font-size: 13px;
      color: #7f8c8d;
      line-height: 1.5;
    }

    .price-summary {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      padding: 25px;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      margin-top: auto;
      position: relative;
      z-index: 2;
      border: 1px solid rgba(255, 255, 255, 0.2);
      overflow: hidden;
    }

    .price-summary::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, #3498db, #2ecc71, #f1c40f);
      animation: priceGlow 3s ease infinite;
    }

    @keyframes priceGlow {
      0%, 100% { opacity: 0.5; }
      50% { opacity: 1; }
    }

    .price-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .price-row:hover {
      color: #3498db;
    }

    .price-row.total {
      border-top: 2px solid rgba(52, 152, 219, 0.1);
      padding-top: 18px;
      margin-top: 18px;
      font-weight: 700;
      font-size: 20px;
      background: linear-gradient(45deg, #2c3e50, #e74c3c);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .price {
      color: #e74c3c;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .price.total {
      font-size: 22px;
      animation: bounce 2s ease infinite;
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-2px); }
    }

    /* SVG Icons with enhanced styling */
    .icon-user::before {
      content: '';
      width: 20px;
      height: 20px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f8c8d' stroke-width='2'%3E%3Cpath d='M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2'/%3E%3Ccircle cx='12' cy='7' r='4'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      transition: all 0.3s ease;
    }

    .icon-email::before {
      content: '';
      width: 20px;
      height: 20px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f8c8d' stroke-width='2'%3E%3Cpath d='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'/%3E%3Cpolyline points='22,6 12,13 2,6'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }

    .icon-phone::before {
      content: '';
      width: 20px;
      height: 20px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f8c8d' stroke-width='2'%3E%3Cpath d='M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }

    .icon-calendar::before {
      content: '';
      width: 20px;
      height: 20px;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f8c8d' stroke-width='2'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'/%3E%3Cline x1='16' y1='2' x2='16' y2='6'/%3E%3Cline x1='8' y1='2' x2='8' y2='6'/%3E%3Cline x1='3' y1='10' x2='21' y2='10'/%3E%3C/svg%3E");
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        margin: 10px;
        border-radius: 20px;
      }
      
      .form-section, .info-section {
        padding: 30px 25px;
      }
      
      .form-row {
        grid-template-columns: 1fr;
      }
      
      .header h1 {
        font-size: 32px;
      }

      .floating-element {
        display: none;
      }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(45deg, #3498db, #2ecc71);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(45deg, #2980b9, #27ae60);
    }
  </style>
</head>
<body>

  <!-- Floating decorative elements -->
  <div class="floating-element">
    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1">
      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
      <polyline points="3.29,7 12,12 20.71,7"></polyline>
      <line x1="12" y1="22" x2="12" y2="12"></line>
    </svg>
  </div>
  <div class="floating-element">
    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1">
      <circle cx="12" cy="12" r="10"></circle>
      <polygon points="10,8 16,12 10,16 10,8"></polygon>
    </svg>
  </div>
  <div class="floating-element">
    <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1">
      <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
    </svg>
  </div>

  <div class="header">
    <h1>Travel HUB</h1>
    <p>Your perfect journey starts here</p>
  </div>

  <div class="container">
    <div class="progress-bar"></div>
    
    <!-- Left Form Section -->
    <div class="form-section">
      <h2>Booking Details</h2>
      <p class="subtitle">Please fill in all fields correctly to ensure you receive the booking confirmation and unlock your adventure!</p>

      <div class="form-group">
        <label for="fullname">Full Name</label>
        <div class="input-group">
          <input type="text" id="fullname" placeholder="Enter your full name" required>
          <span class="input-icon icon-user"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <div class="input-group">
          <input type="email" id="email" placeholder="your.email@example.com" required>
          <span class="input-icon icon-email"></span>
        </div>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number</label>
        <div class="input-group">
          <input type="tel" id="phone" placeholder="+62 812 3456 7890" required>
          <span class="input-icon icon-phone"></span>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="checkin">Check-in Date</label>
          <div class="input-group date-group">
            <input type="date" id="checkin" required>
            <span class="input-icon icon-calendar"></span>
          </div>
        </div>
        <div class="form-group">
          <label for="checkout">Check-out Date</label>
          <div class="input-group date-group">
            <input type="date" id="checkout" required>
            <span class="input-icon icon-calendar"></span>
          </div>
        </div>
      </div>

      <button class="btn-primary" onclick="submitBooking()">Continue Your Journey</button>

      <p class="terms">
        By continuing to payment, you agree to <a href="#">Travel HUB's Terms & Conditions</a>, 
        <a href="#">Privacy Policy</a>, and <a href="#">Refund Policy</a>
      </p>
    </div>

    <!-- Right Info Section -->
    <div class="info-section">
      <div class="hotel-card">
        <div class="hotel-image">
          <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5">
            <path d="M3 21h18"></path>
            <path d="M5 21V7l8-4v18"></path>
            <path d="M19 21V11l-6-4"></path>
            <path d="M9 9v.01"></path>
            <path d="M9 12v.01"></path>
            <path d="M9 15v.01"></path>
            <path d="M9 18v.01"></path>
          </svg>
        </div>
        <div class="hotel-content">
          <div class="hotel-name">Royal Savoy Hotel & Spa</div>
          <div class="hotel-rating">
            <div class="stars">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="#f1c40f" stroke="#f1c40f" stroke-width="2">
                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
              </svg>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="#f1c40f" stroke="#f1c40f" stroke-width="2">
                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
              </svg>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="#f1c40f" stroke="#f1c40f" stroke-width="2">
                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
              </svg>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="#f1c40f" stroke="#f1c40f" stroke-width="2">
                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
              </svg>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="#f1c40f" stroke="#f1c40f" stroke-width="2">
                <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
              </svg>
            </div>
            <div class="rating-text">5.0 (128 reviews)</div>
          </div>

          <div class="policy-section">
            <div class="policy-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e74c3c" stroke-width="2" style="display: inline; margin-right: 5px;">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
              </svg>
              Accommodation Policy
            </div>
            <div class="policy-text">Pets are not allowed in this property</div>
          </div>

          <div class="policy-section">
            <div class="policy-title">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f39c12" stroke-width="2" style="display: inline; margin-right: 5px;">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
              </svg>
              Additional Information
            </div>
            <div class="policy-text">We apologize for the inconvenience due to the additional pool that is still under renovation.</div>
          </div>
        </div>
      </div>

      <div class="price-summary">
        <div class="price-row">
          <span>Room Rate (1 night)</span>
          <span class="price">Rp 85.000</span>
        </div>
        <div class="price-row">
          <span>Service Fee</span>
          <span class="price">Rp 10.000</span>
        </div>
        <div class="price-row">
          <span>Tax & Fees</span>
          <span class="price">Rp 5.000</span>
        </div>
        <div class="price-row total">
          <span>Total Price</span>
          <span class="price total">Rp 100.000</span>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
      const inputs = document.querySelectorAll('input');
      const formGroups = document.querySelectorAll('.form-group');
      
      // Add focus effects
      inputs.forEach((input, index) => {
        const inputGroup = input.parentElement;
        const formGroup = input.closest('.form-group');
        
        input.addEventListener('focus', () => {
          inputGroup.classList.add('focused');
          formGroup.classList.add('focused');
        });
        
        input.addEventListener('blur', () => {
          inputGroup.classList.remove('focused');
          formGroup.classList.remove('focused');
        });
        
        // Add typing animation delay for each input
        input.style.animationDelay = `${index * 0.1}s`;
      });

      // Set minimum date to today
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('checkin').setAttribute('min', today);
      document.getElementById('checkout').setAttribute('min', today);

      // Add floating animation to cards
      const hotelCard = document.querySelector('.hotel-card');
      let mouseX = 0, mouseY = 0;
      
      document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX / window.innerWidth;
        mouseY = e.clientY / window.innerHeight;
        
        if (hotelCard) {
          const rotateX = (mouseY - 0.5) * 10;
          const rotateY = (mouseX - 0.5) * -10;
          hotelCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        }
      });

      // Reset card position when mouse leaves
      document.addEventListener('mouseleave', () => {
        if (hotelCard) {
          hotelCard.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        }
      });

      // Add progressive form completion
      const progressBar = document.querySelector('.progress-bar');
      let completedFields = 0;
      const totalFields = 5;

      inputs.forEach(input => {
        input.addEventListener('input', () => {
          completedFields = Array.from(inputs).filter(inp => inp.value.trim() !== '').length;
          const progress = (completedFields / totalFields) * 100;
          progressBar.style.width = `${progress}%`;
          
          if (progress === 100) {
            progressBar.style.background = 'linear-gradient(90deg, #2ecc71, #27ae60)';
            progressBar.style.boxShadow = '0 0 20px rgba(46, 204, 113, 0.8)';
          } else {
            progressBar.style.background = 'linear-gradient(90deg, #3498db, #2ecc71, #f1c40f)';
            progressBar.style.boxShadow = '0 0 20px rgba(52, 152, 219, 0.8)';
          }
        });
      });

      // Add success confetti effect
      window.createConfetti = function() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57'];
        const confettiCount = 50;
        
        for (let i = 0; i < confettiCount; i++) {
          const confetti = document.createElement('div');
          confetti.style.position = 'fixed';
          confetti.style.left = Math.random() * 100 + 'vw';
          confetti.style.top = '-10px';
          confetti.style.width = '10px';
          confetti.style.height = '10px';
          confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
          confetti.style.pointerEvents = 'none';
          confetti.style.borderRadius = '50%';
          confetti.style.zIndex = '10000';
          
          document.body.appendChild(confetti);
          
          const animation = confetti.animate([
            { 
              transform: `translateY(-10px) rotateZ(0deg)`,
              opacity: 1
            },
            { 
              transform: `translateY(100vh) rotateZ(720deg)`,
              opacity: 0
            }
          ], {
            duration: Math.random() * 2000 + 1000,
            easing: 'cubic-bezier(0.5, 0, 0.5, 1)'
          });
          
          animation.onfinish = () => confetti.remove();
        }
      };
    });

    // Update checkout min date when checkin changes
    document.getElementById('checkin').addEventListener('change', function() {
      const checkinDate = this.value;
      const checkoutInput = document.getElementById('checkout');
      const nextDay = new Date(checkinDate);
      nextDay.setDate(nextDay.getDate() + 1);
      checkoutInput.setAttribute('min', nextDay.toISOString().split('T')[0]);
      
      // Add smooth transition effect
      checkoutInput.style.transform = 'scale(1.05)';
      setTimeout(() => {
        checkoutInput.style.transform = 'scale(1)';
      }, 200);
    });

    function submitBooking() {
      const fullname = document.getElementById("fullname").value;
      const email = document.getElementById("email").value;
      const phone = document.getElementById("phone").value;
      const checkin = document.getElementById("checkin").value;
      const checkout = document.getElementById("checkout").value;

      // Enhanced form validation with better UX
      if (!fullname || !email || !phone || !checkin || !checkout) {
        // Highlight empty fields
        const inputs = [
          document.getElementById("fullname"),
          document.getElementById("email"),
          document.getElementById("phone"),
          document.getElementById("checkin"),
          document.getElementById("checkout")
        ];
        
        inputs.forEach(input => {
          if (!input.value) {
            input.style.border = '2px solid #e74c3c';
            input.style.animation = 'shake 0.5s ease-in-out';
            setTimeout(() => {
              input.style.border = '2px solid #e8f0fe';
              input.style.animation = '';
            }, 2000);
          }
        });
        
        alert("🚫 Please fill in all required fields!");
        return;
      }

      // Email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        document.getElementById("email").style.border = '2px solid #e74c3c';
        alert("📧 Please enter a valid email address!");
        return;
      }

      // Date validation
      const checkinDate = new Date(checkin);
      const checkoutDate = new Date(checkout);
      const today = new Date();
      
      if (checkinDate < today) {
        document.getElementById("checkin").style.border = '2px solid #e74c3c';
        alert("📅 Check-in date cannot be in the past!");
        return;
      }
      
      if (checkoutDate <= checkinDate) {
        document.getElementById("checkout").style.border = '2px solid #e74c3c';
        alert("📅 Check-out date must be after check-in date!");
        return;
      }

      // Calculate nights
      const timeDiff = checkoutDate.getTime() - checkinDate.getTime();
      const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));

      // Add loading state to button
      const button = document.querySelector('.btn-primary');
      const originalText = button.textContent;
      button.textContent = 'Processing...';
      button.style.background = 'linear-gradient(135deg, #95a5a6, #7f8c8d)';
      button.disabled = true;

      // Simulate processing time
      setTimeout(() => {
        // Reset button
        button.textContent = originalText;
        button.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%)';
        button.disabled = false;
        
        // Create confetti effect
        createConfetti();
        
        // Success message with enhanced styling
        const checkinFormatted = new Date(checkin).toLocaleDateString('id-ID');
        const checkoutFormatted = new Date(checkout).toLocaleDateString('id-ID');
        
        alert(`🎉 Booking Successful! 
        
✅ Thank you, ${fullname}!
📧 Confirmation email will be sent to ${email}
📱 We'll contact you at ${phone}

🏨 Booking Details:
📅 Check-in: ${checkinFormatted}
📅 Check-out: ${checkoutFormatted}
🌙 ${nights} night(s)
💰 Total: Rp 100.000

🎊 Have a wonderful stay at Royal Savoy Hotel & Spa!`);
        
        console.log("Booking submitted:", {
          fullname, email, phone, checkin, checkout, nights
        });
        
        // Optional: Add success animation to the entire form
        const container = document.querySelector('.container');
        container.style.animation = 'successPulse 1s ease-out';
        
      }, 2000);
    }

    // Add CSS for shake animation and success pulse
    const style = document.createElement('style');
    style.textContent = `
      @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
      }
      
      @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); box-shadow: 0 0 50px rgba(46, 204, 113, 0.5); }
        100% { transform: scale(1); }
      }
    `;
    document.head.appendChild(style);
  </script>

</body>
</html>