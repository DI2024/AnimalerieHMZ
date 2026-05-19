# Total Sales Column Fix

## Problem
The welcome page was throwing an error:
```
SQLSTATE[42S22]: Column not found: 1054 Unknown column 'total_sales' in 'order clause'
```

This occurred because the `HomeController` was trying to order products by `total_sales` column, but the migration to add this column hadn't been run yet.

## Solution Applied

### 1. Ran Migration
```bash
php artisan migrate
```
This executed the migration `2026_05_18_173356_add_total_sales_to_products_table.php` which added the `total_sales` column to the products table with a default value of 0.

### 2. Calculated Initial Sales Data
```bash
php artisan products:calculate-sales
```
This command calculated the total sales for all products based on existing order items and populated the `total_sales` column with accurate data.

Result: ✓ Sales calculated for 11 products

### 3. Cleared All Caches
```bash
php artisan optimize:clear
```
Cleared config, cache, compiled files, events, routes, and views to ensure all changes take effect.

## How It Works

### Automatic Updates
The `total_sales` column is automatically updated by the `Order` model using Laravel Model Events:

- **When order is confirmed**: Stock decreases, `total_sales` increases
- **When confirmed order is cancelled**: Stock increases, `total_sales` decreases
- **When confirmed order is deleted**: Stock increases, `total_sales` decreases

### Manual Recalculation
If you need to recalculate sales from scratch (e.g., after data import or correction):
```bash
php artisan products:calculate-sales
```

## Files Involved

- **Migration**: `database/migrations/2026_05_18_173356_add_total_sales_to_products_table.php`
- **Command**: `app/Console/Commands/CalculateProductSales.php`
- **Model Logic**: `app/Models/Order.php` (boot method with model events)
- **Controller**: `app/Http/Controllers/HomeController.php` (uses total_sales for sorting bestsellers)

## Status
✅ **FIXED** - Welcome page now loads correctly with products sorted by total sales and rating.
