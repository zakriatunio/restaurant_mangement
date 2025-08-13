# Technology Stack

## Backend Framework
- **Laravel 12.0** - PHP web application framework
- **PHP 8.2+** - Required minimum PHP version
- **MySQL** - Primary database (SQLite for development)

## Frontend Stack
- **Livewire 3.5** - Full-stack framework for Laravel (primary frontend approach)
- **Laravel Jetstream 5.1** - Authentication scaffolding with team management
- **Blade Templates** - Laravel's templating engine
- **Tailwind CSS 3.4** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework (via Livewire)

## Build Tools & Asset Management
- **Vite 5.0** - Frontend build tool and dev server
- **Laravel Vite Plugin** - Laravel integration for Vite
- **PostCSS & Autoprefixer** - CSS processing

## Key Dependencies
- **Spatie Laravel Permission** - Role and permission management
- **Laravel Sanctum** - API authentication
- **Laravel Cashier** - Subscription billing (Stripe integration)
- **Livewire Alert** - Toast notifications
- **Intervention Image** - Image processing
- **DomPDF** - PDF generation
- **QR Code Generator** - QR code creation
- **Maatwebsite Excel** - Excel import/export
- **Pusher** - Real-time notifications

## Payment Gateways
- Stripe, Razorpay, Flutterwave integrations

## Frontend Libraries
- **Flowbite** - Tailwind CSS components
- **Preline UI** - Additional UI components
- **ApexCharts** - Data visualization
- **SweetAlert2** - Modal dialogs
- **FontAwesome** - Icons

## Development Tools
- **Laravel Pint** - Code formatting
- **Laravel Debugbar** - Development debugging
- **PHPUnit** - Testing framework
- **Laravel Sail** - Docker development environment

## Common Commands

### Development
```bash
# Start development server
php artisan serve

# Watch and compile assets
npm run dev

# Build assets for production
npm run build
```

### Database
```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Cache & Optimization
```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimize for production
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Queue Management
```bash
# Process queue jobs
php artisan queue:work

# Restart queue workers
php artisan queue:restart
```

### Code Quality
```bash
# Format code with Pint
./vendor/bin/pint

# Run tests
php artisan test
```