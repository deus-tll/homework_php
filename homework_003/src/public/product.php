<?php

use App\Collections\CategoryCollection;
use App\Collections\ProductCollection;
use App\Forms\CategoryForm;
use App\Forms\ProductForm;
use App\Forms\ProductSearchForm;
use App\Requests\CategoryCreateRequest;
use App\Requests\ProductCreateRequest;
use App\Requests\SelectedCategoryRequest;
use App\Views\CategoryView;
use App\Views\ProductsByCategoryView;
use App\Views\ProductSearchView;
use App\Views\ProductView;

require_once '../vendor/autoload.php';


$productCollection = new ProductCollection();
$categoryCollection = new CategoryCollection();


$newProduct = ProductCreateRequest::getProduct();
if ($newProduct) {
    $productCollection->addProduct($newProduct);
}

$newCategory = CategoryCreateRequest::getCategory($productCollection->getAll());
if ($newCategory) {
    $categoryCollection->addCategory($newCategory);
    $productCollection->clearAll();
}


$productForm = new ProductForm();
$productForm->echoForm();

$productView = new ProductView();
echo $productView->getAllHtml($productCollection->getAll());


echo "<hr/>";


$searchForm = new ProductSearchForm();
$searchForm->echoForm();

$searchView = new ProductSearchView();
$searchView->showResult($productCollection);


echo "<hr/>";


$categoryForm = new CategoryForm();
$categoryForm->echoForm();


$categoryView = new CategoryView();
echo $categoryView->getAllHtml($categoryCollection->getAll());

$selectedCategory = SelectedCategoryRequest::getSelectedCategory($categoryCollection);
if ($selectedCategory) {
    $categoryProducts = $selectedCategory->getCategoryProducts();
    $productsByCategoryView = new ProductsByCategoryView();

    echo "<h2>Products in Category: {$selectedCategory->getName()}</h2>";
    echo $productsByCategoryView->getAllHtml($categoryProducts);
}
else {
    echo "Category not found!";
}