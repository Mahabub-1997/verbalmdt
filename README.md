# ⚡ ElectricianInThisArea: Professional Service Marketplace

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

---

## 💡 Overview
**ElectricianInThisArea** is a robust, **subscription-based Laravel 12 platform** that streamlines hiring for companies seeking skilled tradespeople and professionals. It serves as a **central hub** for talent across key technical roles, while also managing content and a major annual event.

**Supported Professional Categories**
- Electricians  
- Plumbers  
- Roofers  
- Engineers  
- Architects  

---

## ✨ Core Features

###  Professional Service Marketplace
- 🧑‍🔧 Multi-Role Support: Dedicated profiles & search for 5 professional categories.  
- 📍 Area-Wise Search: Find professionals within a specific geographic radius.  

###  Multi-Tiered Subscription Model
| Tier | Access Level | Features |
|------|-------------|---------|
| Free | Limited | Basic listing, restricted profile details, limited visibility |
| Paid (Full Access) | Premium | Full access to job postings, priority search placement, direct contact |
| Back-Link / Partner | Feature-Specific | Strategic partners or SEO contributors, top-tier visibility |

###  🌍 Global Electrician Day Module
- ⏱ Real-time Countdown  
- 📝 Event Registration  
- 💰 Sponsorship Management  
- 🏠 Host Management  

###  📰 Content Management System (CMS)
- CRUD management for pages & sections  
- Contact us page, About page , Global electrician daye image, videos banner and many more.
- Event management & announcements  

---

## 🛠️ Installation & Setup

### Prerequisites
- Laravel 12.x  
- PHP >= 8.2  
- Composer  
- MySQL  


🗂 Project Folder Structure
electricianinthisarea/


├── app/           # Laravel backend

├── bootstrap/

├── config/

├── database/

│   └── seeders/

├── public/        # Public assets

├── resources/
│   └── views/     # Blade templates

├── routes/
│   └── api.php    # API routes

├── storage/

└── frontend/      # frontend code (Next.js)

🤝 Contribution & Support

Contributions welcome! See CONTRIBUTING.md if available.

Report bugs or request features via GitHub Issues.

### Step-by-Step Guide
```bash
# Clone repo
git clone [Your-Repo-URL] electricianinthisarea
cd electricianinthisarea

# Install dependencies
composer install
npm install
npm run dev   # or npm run build for production

# Setup environment
cp .env.example .env
php artisan key:generate
# Edit .env for DB credentials & APP_URL

# Migrate & seed database
php artisan migrate --seed

# Create symbolic storage link
php artisan storage:link

# Run the application
php artisan serve

