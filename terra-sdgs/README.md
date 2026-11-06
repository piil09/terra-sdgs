# Terra SDGs

A Laravel-based platform for Sustainable Development Goals (SDGs) with event registration, donation campaigns, and educational articles.

## Overview

Terra SDGs is a web application designed to promote and support Sustainable Development Goals through:
- **Event Management**: Host and register for SDG-related events
- **Donation System**: Collect donations for SDG initiatives
- **Educational Content**: Articles and resources about sustainability
- **Community Building**: Connect volunteers and organizations

## Features

### Core Functionality

- 🎯 **Event Registration System**
  - Browse upcoming events
  - Register for events with comprehensive form
  - Track volunteer registrations

- 💰 **Donation Management**
  - Multiple donation campaigns
  - Secure donation processing
  - Campaign progress tracking

- 📚 **Educational Articles**
  - Categorized articles on SDG topics
  - Article detail pages
  - Related content recommendations

- 👥 **User Management**
  - Authentication system
  - Role-based access control
  - User profiles

### Database Schema

The application uses a well-designed database schema with the following tables:

| Table | Description |
|-------|-------------|
| `users` | Application users with authentication |
| `events` | SDG-related events |
| `event_registrations` | Volunteer registrations for events |
| `donation_campaigns` | Fundraising campaigns |
| `donations` | Individual donations to campaigns |
| `article_categories` | Categories for educational content |
| `articles` | Educational articles about SDGs |

## ERD Diagram

The complete Entity Relationship Diagram is available in:
- **Draw.io Format**: `ERD_Terra_SDGs.drawio` (editable in diagrams.net)
- **PNG Format**: `ERD_Terra_SDGs.png` and `ERD_Terra_SDGs_CrowsFoot.png`

The ERD shows all database relationships using Crow's Foot notation for the physical model and Chen notation for the conceptual model.

## Getting Started

### Prerequisites

- PHP 8.0+
- Composer
- Node.js 16+
- MySQL or SQLite

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/muhgavril/terra-sdgs.git
   cd terra-sdgs
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Set up environment**
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

5. **Configure database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build frontend assets**
   ```bash
   npm run dev
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

8. **Visit the application**
   ```
   http://localhost:8000
   ```

## Project Structure

```
terra-sdgs/
├── app/
│   ├── Http/Controllers/     # SiteController, GreetController
│   ├── Models/              # User, Donation, EventRegistration
│   └── Services/            # SiteDataService
├── database/
│   ├── migrations/         # All SQL migrations
│   └── seeders/           # Database seeds
├── resources/views/         # Blade templates
├── routes/                 # Route definitions
├── ERD_Terra_SDGs.drawio    # Entity Relationship Diagram
├── PRD_Terra_SDGs.docx     # Product Requirement Document
└── README.md               # Project documentation
```

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Home page |
| GET | `/about` | About page |
| GET | `/events` | Events listing |
| GET | `/events/register` | Event registration form |
| POST | `/events/register` | Submit event registration |
| GET | `/articles` | Articles listing |
| GET | `/articles/{slug}` | Article detail page |
| GET | `/donate` | Donation page |
| POST | `/donate` | Submit donation |
| GET | `/login` | Login page |

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Contact

**Gavril Muhammad Ghazanfar**
- Email: muhgavril@gmail.com
- GitHub: @muhgavril

## Acknowledgments

- Laravel framework
- SDG framework by United Nations
