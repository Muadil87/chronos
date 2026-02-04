<div align="center">

<img src="public/logo.png" alt="Chronos Logo" width="200">

# CHRONOS
### The Flow State Operating System

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Flow State](https://img.shields.io/badge/Methodology-Flow_State-777BB4?style=for-the-badge)](https://en.wikipedia.org/wiki/Flow_(psychology))
[![License](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)](LICENSE)

<br />

<!-- 
  IMPORTANT: Ensure your folder is named 'screenshots' (lowercase) 
  and the file is named 'landing-hero.png'.
-->
<img src="screenshots/landing-hero.png" alt="Chronos Landing Page" width="100%" style="border-radius: 10px">

<p align="center">
  <b>Chronos is a minimal operating system designed for deep work.</b><br>
  It replaces standard to-do lists with "Missions" and "Protocols," respecting biological ultradian rhythms to maximize output without burnout.
</p>

</div>
---

## 🧠 The Methodology

Chronos is built on three core pillars: **Structure, Science, and Specificity.**

### 1. How it works
The system forces you to single-task. You define a protocol, set a time limit, and execute.
<img src="screenshots/landing-how.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

### 2. Who is this for?
Designed for engineers, academics, and creators who need to reclaim their attention span.
<img src="screenshots/landing-audience.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

### 3. The Science
We utilize the 90-minute ultradian rhythm to ensure peak cognitive performance.
<img src="screenshots/landing-science.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

---

## 🔐 Access Control

Chronos uses a secure authentication system styled as a "System Initialization."

| **System Initialization (Register)** | **Pilot Authentication (Login)** |
|:---:|:---:|
| <img src="screenshots/auth-register.png" width="100%"> | <img src="screenshots/auth-login.png" width="100%"> |

---

## 🎛️ Command Center (Workflow)

The Command Center is your distraction-free home base.

**1. Main Interface:** View your protocols and initialization status.
<img src="screenshots/dashboard-main.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

**2. Focus Mode Selection:** A streamlined view to jump immediately into action.
<img src="screenshots/dashboard-focus-mode.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

**3. Mission Completion:** Visual feedback when protocols are successfully terminated.
<img src="screenshots/dashboard-completed.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

---

## ⚡ Execution Engine

When you begin a task, you enter the **Mission Briefing** and **Active Flow** stages.

### Mission Briefing
Set your parameters: Name, Duration, and Intelligence Notes.
<img src="screenshots/task-briefing.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

### Active Deep Work
The interface clears. Only the objective and the time remain.
<img src="screenshots/timer-cpp.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">
<img src="screenshots/timer-java.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

---

## 👤 Pilot Profile & Settings

Track your data and manage your credentials.

**1. Analytics:** Visualize your total focus time and completion percentages.
<img src="screenshots/profile-stats.png" width="100%" style="border-radius: 8px; margin-bottom: 20px">

**2. System Menu & Settings:** Update your pilot profile, password, and system preferences.
| **Quick Menu** | **Account Settings** |
|:---:|:---:|
| <img src="screenshots/profile-dropdown.png" width="100%"> | <img src="screenshots/profile-settings.png" width="100%"> |

---

## 🚀 Installation

### Prerequisites
*   PHP 8.1+
*   Composer
*   Node.js & NPM
*   MySQL

### Setup Guide

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/YOUR_USERNAME/chronos.git
    cd chronos
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configure your `.env` with your DB credentials.*

4.  **Database**
    ```bash
    php artisan migrate
    ```

5.  **Launch**
    ```bash
    php artisan serve
    npm run dev
    ```

---

## 👨‍💻 Contributors

**Created & Developed by:** Adil El Bahlouli

---

## 📄 License

This project is open-source and licensed under the [MIT License](LICENSE).
