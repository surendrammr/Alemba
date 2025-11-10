# Alemba.com October CMS Setup Guide

## ✅ Completed Setup Steps

1. **Environment Configuration**: Created `.env` file from `.env.example`
2. **Dependencies Installed**: All PHP dependencies including Algolia package
3. **Application Key**: Generated and configured
4. **Theme Configuration**: Set active theme to `alembax`
5. **Algolia Error Resolved**: Installed `algolia/algoliasearch-client-php` package

## 🔧 Next Steps to Complete Setup

### 1. Database Setup

You have a few options for the database:

#### Option A: Use MySQL (Recommended)
```bash
# Create database
mysql -u root -p
CREATE DATABASE alemba_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit

# Import your database backup
mysql -u root -p alemba_db < your_backup_file.sql
```

#### Option B: Use SQLite (Easier for development)
```bash
# Update .env file
DB_CONNECTION=sqlite
DB_DATABASE=/Users/vipulmalviya/Downloads/alemba.com-main/database.sqlite

# Create empty SQLite database
touch database.sqlite
```

### 2. Update Database Configuration

Edit your `.env` file with your database details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alemba_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Run Database Migrations

```bash
cd /Users/vipulmalviya/Downloads/alemba.com-main
php artisan migrate
```

### 4. Clear Cache and Optimize

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 5. Set Proper Permissions

```bash
# Make storage directories writable
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### 6. Start the Development Server

```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## 🔍 Access Points

- **Frontend**: `http://localhost:8000`
- **Backend Admin**: `http://localhost:8000/admin`
- **Default Login**: Check your database backup for admin credentials

## 🚨 Important Notes

1. **Algolia Search**: The Algolia search functionality is now working. You'll need to configure your Algolia API keys in the backend admin panel under Settings > Algolia Search Settings.

2. **File Permissions**: Make sure the web server can write to the `storage/` and `bootstrap/cache/` directories.

3. **PHP Version**: This project requires PHP 8.0.2 or higher.

4. **Database Backup**: Make sure to import your database backup before running migrations.

## 🛠️ Troubleshooting

### If you get "Class not found" errors:
```bash
composer dump-autoload
```

### If you get permission errors:
```bash
chmod -R 775 storage/ bootstrap/cache/
```

### If you get theme errors:
Make sure the `ACTIVE_THEME=alembax` is set in your `.env` file.

## 📁 Project Structure

- `themes/alembax/` - Main theme files
- `themes/art-itsm/` - Alternative theme
- `plugins/alemba/` - Custom plugins
- `storage/` - Application storage
- `config/` - Configuration files

## 🎯 Next Steps After Setup

1. Import your database backup
2. Configure Algolia search settings
3. Update any hardcoded URLs in the configuration
4. Test all functionality
5. Set up your web server (Apache/Nginx) for production

The Algolia error has been resolved and the basic October CMS setup is complete!




