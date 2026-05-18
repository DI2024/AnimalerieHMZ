# Testing Inventory Management System

## 🧪 Test Scenarios

### Test 1: Stock Reduction on Order Confirmation

**Steps:**
1. Note the current stock of a product (e.g., Product A has 100 units)
2. Create an order with 5 units of Product A (status: pending)
3. Check Product A stock → Should still be 100 (no change yet)
4. Change order status from "pending" to "confirmed"
5. Check Product A stock → Should now be 95 (reduced by 5)

**Expected Result:** ✅ Stock reduced by order quantity

---

### Test 2: Stock Restoration on Order Cancellation

**Steps:**
1. Start with Product B having 50 units
2. Create an order with 10 units of Product B
3. Confirm the order (status: confirmed)
4. Check Product B stock → Should be 40
5. Cancel the order (status: cancelled)
6. Check Product B stock → Should be 50 again (restored)

**Expected Result:** ✅ Stock restored when order cancelled

---

### Test 3: Stock Re-reduction on Re-confirmation

**Steps:**
1. Start with Product C having 75 units
2. Create and confirm an order with 15 units (stock becomes 60)
3. Cancel the order (stock becomes 75 again)
4. Re-confirm the order (change status back to confirmed)
5. Check Product C stock → Should be 60 again

**Expected Result:** ✅ Stock reduced again when re-confirmed

---

### Test 4: Stock Restoration on Order Deletion

**Steps:**
1. Start with Product D having 30 units
2. Create and confirm an order with 5 units (stock becomes 25)
3. Delete the order from admin panel
4. Check Product D stock → Should be 30 again

**Expected Result:** ✅ Stock restored when confirmed order is deleted

---

### Test 5: No Stock Change for Pending Order Deletion

**Steps:**
1. Start with Product E having 20 units
2. Create an order with 3 units (status: pending, stock still 20)
3. Delete the pending order
4. Check Product E stock → Should still be 20

**Expected Result:** ✅ No stock change for pending order deletion

---

### Test 6: Real-Time Dashboard Updates

**Steps:**
1. Open admin dashboard in browser
2. Note the "Pending Orders" count
3. In another browser tab/window, create a new order as a client
4. Wait 10 seconds (or less)
5. Check the dashboard → Pending orders count should increase
6. A notification should appear
7. The recent orders table should show the new order

**Expected Result:** ✅ Dashboard updates automatically without manual refresh

---

## 🔍 Manual Testing Commands

### Check Product Stock
```sql
SELECT id, name, stock FROM products WHERE id = [PRODUCT_ID];
```

### Check Order Status
```sql
SELECT id, order_number, status FROM orders WHERE id = [ORDER_ID];
```

### Check Order Items
```sql
SELECT oi.*, p.name, p.stock 
FROM order_items oi 
JOIN products p ON oi.product_id = p.id 
WHERE oi.order_id = [ORDER_ID];
```

---

## 🎯 Quick Test Script

You can run this in Laravel Tinker to test the inventory system:

```php
// Start Laravel Tinker
php artisan tinker

// Test Script
$product = \App\Models\Product::first();
echo "Initial Stock: " . $product->stock . "\n";

$order = \App\Models\Order::where('status', 'pending')->first();
echo "Order Status: " . $order->status . "\n";

// Confirm the order
$order->status = 'confirmed';
$order->save();

$product->refresh();
echo "Stock after confirmation: " . $product->stock . "\n";

// Cancel the order
$order->status = 'cancelled';
$order->save();

$product->refresh();
echo "Stock after cancellation: " . $product->stock . "\n";
```

---

## 📊 Expected Behavior Summary

| Action | Old Status | New Status | Stock Change |
|--------|-----------|-----------|--------------|
| Confirm Order | pending | confirmed | -quantity |
| Cancel Order | confirmed | cancelled | +quantity |
| Re-confirm Order | cancelled | confirmed | -quantity |
| Delete Confirmed Order | confirmed | (deleted) | +quantity |
| Delete Pending Order | pending | (deleted) | no change |
| Update to Processing | pending | processing | no change |
| Update to Shipped | confirmed | shipped | no change |
| Update to Delivered | confirmed | delivered | no change |

---

## ⚠️ Important Notes

1. **Only "confirmed" status affects inventory**
   - Other statuses (processing, shipped, delivered) don't change stock
   - Stock is reduced only when order moves TO "confirmed"
   - Stock is restored only when order moves FROM "confirmed" to "cancelled"

2. **Multiple Status Changes**
   - The system tracks the ORIGINAL status vs NEW status
   - It prevents duplicate stock reductions/restorations

3. **Order Items**
   - Each order item's quantity is processed individually
   - If a product is deleted, the system handles it gracefully (checks if product exists)

4. **Real-Time Updates**
   - Dashboard polls every 10 seconds
   - Updates pause when browser tab is hidden
   - Notifications appear for new orders only

---

## 🐛 Common Issues & Solutions

### Issue: Stock not updating
**Solution:** Check if the order has items with valid product IDs

### Issue: Dashboard not refreshing
**Solution:** Check browser console for JavaScript errors, verify route exists

### Issue: Duplicate stock reductions
**Solution:** The system prevents this by checking original vs new status

### Issue: Stock goes negative
**Solution:** Add validation in Product model or order confirmation process

---

**Test Date:** May 18, 2026
**Tested By:** Development Team
**Status:** Ready for Testing
