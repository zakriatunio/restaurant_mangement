# Project Structure & Organization

## Application Architecture

This Laravel application follows a **multi-tenant SaaS architecture** with modular organization and Livewire-driven frontend.

## Directory Structure

### Core Application (`app/`)
- **`Actions/`** - Single-purpose action classes (Fortify, Jetstream)
- **`Enums/`** - Type-safe enumerations (OrderStatus, PackageType, etc.)
- **`Events/`** - Domain events (NewOrderCreated, ReservationReceived)
- **`Exports/`** - Excel export classes for reports
- **`Helper/`** - Utility classes and helper functions
- **`Http/Controllers/`** - Traditional controllers (minimal, mostly Livewire)
- **`Http/Middleware/`** - Custom middleware
- **`Imports/`** - Excel import classes
- **`Jobs/`** - Queued background jobs
- **`Listeners/`** - Event listeners
- **`Livewire/`** - **Primary frontend logic** - organized by feature domains
- **`Models/`** - Eloquent models with relationships and business logic
- **`Notifications/`** - Email/push notification classes
- **`Observers/`** - Model observers for lifecycle events
- **`Providers/`** - Service providers for dependency injection
- **`Scopes/`** - Global query scopes (RestaurantScope, BranchScope)
- **`Traits/`** - Reusable model traits (HasRestaurant, HasBranch)

### Frontend Organization (`resources/`)
- **`views/livewire/`** - Livewire component templates (organized by domain)
- **`views/components/`** - Reusable Blade components
- **`views/layouts/`** - Base layouts and shells
- **`views/{domain}/`** - Traditional Blade views organized by feature
- **`css/app.css`** - Main stylesheet (Tailwind CSS)
- **`js/`** - JavaScript modules and utilities

### Configuration (`config/`)
Standard Laravel configuration files with custom additions for:
- Multi-tenant settings
- Payment gateway configurations
- Module system configuration

## Key Architectural Patterns

### Multi-Tenancy
- **Restaurant Scoping**: Most models use `RestaurantScope` and `BranchScope`
- **Tenant Isolation**: Data is isolated per restaurant/branch
- **Shared Database**: Single database with tenant-aware queries

### Livewire-First Frontend
- **Component-Based**: Each feature has dedicated Livewire components
- **Domain Organization**: Components grouped by business domain
- **Minimal JavaScript**: Alpine.js for simple interactions

### Domain-Driven Organization
Livewire components are organized by business domains:
- `Order/` - Order management and POS
- `Menu/` - Menu and item management  
- `Reservations/` - Table booking system
- `Customer/` - Customer management
- `Reports/` - Analytics and reporting
- `Settings/` - Configuration management
- `Shop/` - Customer-facing storefront

### Event-Driven Architecture
- **Domain Events**: Business events trigger side effects
- **Observers**: Model lifecycle management
- **Notifications**: Automated communication

## File Naming Conventions

### Models
- Singular, PascalCase: `Order.php`, `MenuItem.php`
- Relationships follow Laravel conventions

### Livewire Components
- PascalCase classes: `CreateOrder.php`
- Kebab-case views: `create-order.blade.php`
- Organized in domain folders

### Database
- Plural table names: `orders`, `menu_items`
- Snake_case column names
- Foreign keys: `restaurant_id`, `order_id`

### Views
- Kebab-case filenames: `book-a-table.blade.php`
- Domain-organized directories
- Component views in `components/` subdirectory

## Module System
- **Modular Architecture**: Uses `nwidart/laravel-modules`
- **`Modules/`** directory for optional features
- **Livewire Integration**: `mhmiton/laravel-modules-livewire`

## Multi-Language Support
- **Translation Manager**: `barryvdh/laravel-translation-manager`
- **Translatable Models**: `spatie/laravel-translatable`
- **Language files**: `resources/lang/` and `lang/`

## Permission System
- **Spatie Permissions**: Role-based access control
- **Restaurant-scoped**: Permissions isolated per tenant
- **Staff Roles**: Different access levels for restaurant staff