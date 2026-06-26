# Guestbook App with CI/CD Pipeline

A modern and responsive Guestbook web application built with Laravel, TailwindCSS, and Tw-Elements. This project implements a fully automated CI/CD pipeline, integrating automated testing, code quality analysis, containerization, and cloud deployment.

![Home Page](public/homepage.jpeg)

## 🚀 Tech Stack

### Frontend

* HTML
* TailwindCSS
* Tw-Elements

### Backend

* Laravel 11
* PHP 8.2

### Database

* Supabase (PostgreSQL)

### Code Quality & Testing

* PHPUnit
* SonarCloud

### Deployment

* Docker
* GitHub Container Registry (GHCR)
* Microsoft Azure App Service

---

## ✨ Features

* **Guest Registration** – Visitors can submit their wishes along with their name, email, and company information.
* **Real-Time Display** – Submitted wishes are instantly displayed on the homepage.
* **Responsive Design** – Optimized for desktop, tablet, and mobile devices.

---

## ⚙️ CI/CD Architecture

This project implements a two-stage CI/CD pipeline using GitHub Actions to ensure code quality and seamless deployment.

```text
Push to master
      │
      ▼
┌─────────────────────────────────┐
│  CI: Testing & Quality          │
│  ├── Setup PHP 8.2 + PCOV       │
│  ├── Install Composer & NPM     │
│  ├── Build Frontend Assets      │
│  ├── Run PHPUnit Tests          │
│  │   └── Generate coverage.xml  │
│  └── SonarCloud Scan            │
└─────────────────┬───────────────┘
                  │ only if CI passed
                  ▼
┌─────────────────────────────────┐
│  CD: Build & Deploy             │
│  ├── Build Docker Image         │
│  ├── Push to GitHub Container   │
│  │   Registry (ghcr.io)         │
│  └── Deploy to Azure App Service│
└─────────────────────────────────┘
```

### Continuous Integration (CI)

The CI workflow automatically runs whenever changes are pushed to the `master` branch. The process includes:

* Setting up PHP 8.2 and PCOV for code coverage.
* Installing Composer and NPM dependencies.
* Building frontend assets.
* Running PHPUnit tests using an in-memory SQLite database.
* Generating code coverage reports.
* Performing static code analysis with SonarCloud.

### Continuous Deployment (CD)

The CD workflow is triggered only when the CI pipeline completes successfully. The process includes:

* Building a Docker image of the application.
* Publishing the image to GitHub Container Registry (GHCR).
* Deploying the updated container image to Microsoft Azure App Service.

---

## 🛠️ Local Installation

### 1. Clone the Repository

```bash
git clone https://github.com/tiaraaulia1008/guestbookpso5.git
```

### 2. Install Dependencies

```bash
cd guestbookpso5

composer install

npm install
npm run build
```

### 3. Configure Environment Variables

```bash
cp .env.example .env
```

Update the `.env` file with your local database configuration or Supabase credentials.

### 4. Generate Application Key and Run Migrations

```bash
php artisan key:generate

php artisan migrate
```

### 5. Start the Development Server

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```
## 👥 Development Team

| No. | Full Name | NRP |
| --- | --------- | --- |
| 1   | Shahnaz Ariqah Simanullang | 5026231087 |
| 2   | Aqilah Ummu Al Nawiswary | 5026231140 |
| 3   | Tiara Aulia Azadirachta Indica | 5026231148 |

