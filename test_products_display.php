<?php
/**
 * Script de Test d'Affichage des Produits
 * AnimalerieHMZ - Vérification des images et données
 * 
 * Usage: php test_products_display.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;

echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║     TEST D'AFFICHAGE DES PRODUITS - AnimalerieHMZ             ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

// 1. Statistiques générales
echo "📊 STATISTIQUES GÉNÉRALES\n";
echo str_repeat("─", 70) . "\n";
$totalProducts = Product::count();
$totalCategories = Category::count();
$totalSubCategories = SubCategory::count();
$activeProducts = Product::where('is_active', 1)->count();

echo "✓ Total produits       : {$totalProducts}\n";
echo "✓ Total catégories     : {$totalCategories}\n";
echo "✓ Total sous-catégories: {$totalSubCategories}\n";
echo "✓ Produits actifs      : {$activeProducts}\n";
echo "\n";

// 2. Répartition par catégorie
echo "📦 RÉPARTITION PAR CATÉGORIE\n";
echo str_repeat("─", 70) . "\n";
$categories = Category::withCount('products')->get();
foreach ($categories as $category) {
    $icon = match($category->id) {
        1 => '🐕',
        2 => '🐱',
        3 => '🦜',
        4 => '🐠',
        5 => '🕊️',
        default => '📦'
    };
    printf("%s %-15s : %2d produits\n", $icon, $category->name, $category->products_count);
}
echo "\n";

// 3. Vérification des images
echo "🖼️  VÉRIFICATION DES IMAGES\n";
echo str_repeat("─", 70) . "\n";
$products = Product::all();
$imagesOk = 0;
$imagesMissing = 0;
$missingImages = [];

foreach ($products as $product) {
    $imagePath = public_path($product->image);
    if (file_exists($imagePath)) {
        $imagesOk++;
    } else {
        $imagesMissing++;
        $missingImages[] = [
            'id' => $product->id,
            'name' => $product->name,
            'image' => $product->image
        ];
    }
}

echo "✓ Images trouvées      : {$imagesOk}\n";
echo "✗ Images manquantes    : {$imagesMissing}\n";

if ($imagesMissing > 0) {
    echo "\n⚠️  IMAGES MANQUANTES:\n";
    foreach (array_slice($missingImages, 0, 5) as $missing) {
        echo "   - [{$missing['id']}] {$missing['name']}\n";
        echo "     Chemin: {$missing['image']}\n";
    }
    if (count($missingImages) > 5) {
        echo "   ... et " . (count($missingImages) - 5) . " autres\n";
    }
}
echo "\n";

// 4. Exemples de produits par catégorie
echo "🔍 EXEMPLES DE PRODUITS PAR CATÉGORIE\n";
echo str_repeat("─", 70) . "\n";

foreach ($categories as $category) {
    $icon = match($category->id) {
        1 => '🐕',
        2 => '🐱',
        3 => '🦜',
        4 => '🐠',
        5 => '🕊️',
        default => '📦'
    };
    
    echo "\n{$icon} {$category->name}:\n";
    $categoryProducts = Product::where('category_id', $category->id)
        ->with('subcategory')
        ->limit(3)
        ->get();
    
    foreach ($categoryProducts as $product) {
        $subcatName = $product->subcategory ? $product->subcategory->name : 'N/A';
        $imageExists = file_exists(public_path($product->image)) ? '✓' : '✗';
        
        echo "   {$imageExists} [{$product->id}] {$product->name}\n";
        echo "      Prix: {$product->price} MAD | Stock: {$product->stock} | Sous-cat: {$subcatName}\n";
    }
}
echo "\n";

// 5. Produits spéciaux
echo "⭐ PRODUITS SPÉCIAUX\n";
echo str_repeat("─", 70) . "\n";
$newProducts = Product::where('is_new', 1)->count();
$bestsellers = Product::where('is_bestseller', 1)->count();
$featured = Product::where('is_featured', 1)->count();

echo "🆕 Nouveaux produits   : {$newProducts}\n";
echo "🔥 Bestsellers         : {$bestsellers}\n";
echo "⭐ En vedette          : {$featured}\n";
echo "\n";

// 6. Statistiques de prix
echo "💰 STATISTIQUES DE PRIX\n";
echo str_repeat("─", 70) . "\n";
$avgPrice = Product::avg('price');
$minPrice = Product::min('price');
$maxPrice = Product::max('price');
$productsWithDiscount = Product::whereNotNull('price_old')->count();

printf("Prix moyen             : %.2f MAD\n", $avgPrice);
printf("Prix minimum           : %.2f MAD\n", $minPrice);
printf("Prix maximum           : %.2f MAD\n", $maxPrice);
echo "Produits en promo      : {$productsWithDiscount}\n";
echo "\n";

// 7. Sous-catégories
echo "📂 SOUS-CATÉGORIES PAR CATÉGORIE\n";
echo str_repeat("─", 70) . "\n";
foreach ($categories as $category) {
    $icon = match($category->id) {
        1 => '🐕',
        2 => '🐱',
        3 => '🦜',
        4 => '🐠',
        5 => '🕊️',
        default => '📦'
    };
    
    echo "\n{$icon} {$category->name}:\n";
    $subcategories = SubCategory::where('category_id', $category->id)
        ->withCount('products')
        ->get();
    
    foreach ($subcategories as $subcat) {
        echo "   • {$subcat->name} ({$subcat->products_count} produits)\n";
    }
}
echo "\n";

// 8. Résumé final
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║                        RÉSUMÉ FINAL                            ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";

$status = ($imagesMissing == 0 && $totalProducts == 59) ? '✅ SUCCÈS' : '⚠️  ATTENTION';
echo "\n{$status}\n\n";

if ($totalProducts == 59) {
    echo "✓ Nombre de produits correct (59)\n";
} else {
    echo "✗ Nombre de produits incorrect (attendu: 59, trouvé: {$totalProducts})\n";
}

if ($imagesMissing == 0) {
    echo "✓ Toutes les images sont présentes\n";
} else {
    echo "✗ {$imagesMissing} images manquantes\n";
}

if ($totalSubCategories == 15) {
    echo "✓ Nombre de sous-catégories correct (15)\n";
} else {
    echo "✗ Nombre de sous-catégories incorrect (attendu: 15, trouvé: {$totalSubCategories})\n";
}

echo "\n";
echo "Pour voir les produits sur le site:\n";
echo "→ http://localhost/categories\n";
echo "→ http://localhost/admin/products\n";
echo "\n";
