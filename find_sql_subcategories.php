<?php

$sqlProducts = json_decode(file_get_contents(__DIR__ . '/all_sql_products_robust.json'), true);

$counts = [];
foreach ($sqlProducts as $p) {
    $cat = $p['category_id'];
    $sub = $p['subcategory_id'];
    $key = "$cat-$sub";
    if (!isset($counts[$key])) {
        $counts[$key] = [];
    }
    $counts[$key][] = $p['name'];
}

echo "Subcategory distribution of products in raw SQL files:\n\n";
ksort($counts);
foreach ($counts as $key => $names) {
    list($cat, $sub) = explode('-', $key);
    echo "Category $cat, Subcategory $sub: " . count($names) . " products\n";
    foreach ($names as $name) {
        echo "  - $name\n";
    }
    echo "\n";
}
