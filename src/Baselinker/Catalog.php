<?php

namespace Core45\LaravelBaselinker\Baselinker;

class Catalog extends LaravelBaselinker
{
    /**
     * The method allows to create a price group in BaseLinker storage.
     * Providing a price group ID will update the existing price group.
     *
     * @param string $name
     * @param string $description
     * @param string $currency
     * @param int|null $priceGroupId Price group ID for updating existing group
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryPriceGroup
     */
    public function addInventoryPriceGroup(
        string $name,
        string $description,
        string $currency,
        ?int $priceGroupId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'price_group_id' => $priceGroupId,
                'name' => $name,
                'description' => $description,
                'currency' => $currency,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a price group from BaseLinker storage.
     *
     * @param int $priceGroupId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventoryPriceGroup
     */
    public function deleteInventoryPriceGroup(int $priceGroupId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'price_group_id' => $priceGroupId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to get a list of price groups from BaseLinker storage.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryPriceGroups
     */
    public function getInventoryPriceGroups(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add a new warehouse available in BaseLinker catalogues.
     * Adding a warehouse with the same identifier again will cause updates of the previously saved warehouse.
     *
     * @param string $name
     * @param string $description
     * @param bool $stockEdition Is manual editing of stocks permitted
     * @param int|null $warehouseId Warehouse ID for updating existing warehouse
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryWarehouse
     */
    public function addInventoryWarehouse(
        string $name,
        string $description,
        bool $stockEdition = false,
        ?int $warehouseId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'warehouse_id' => $warehouseId,
                'name' => $name,
                'description' => $description,
                'stock_edition' => $stockEdition,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a warehouse from BaseLinker storage.
     *
     * @param int $warehouseId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventoryWarehouse
     */
    public function deleteInventoryWarehouse(int $warehouseId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'warehouse_id' => $warehouseId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to get a list of warehouses from BaseLinker storage.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryWarehouses
     */
    public function getInventoryWarehouses(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add the BaseLinker catalogs.
     * Adding a catalog with the same identifier again will cause updates of the previously saved catalog.
     *
     * @param string $name
     * @param string $description
     * @param array<int, string> $languages
     * @param string $defaultLanguage Default catalogue language
     * @param array<int, int> $priceGroups Array of price group identifiers
     * @param int $defaultPriceGroup ID of the default price group
     * @param array<int, string> $warehouses Array of warehouse identifiers (e.g. "bl_19464")
     * @param string $defaultWarehouse Default warehouse identifier
     * @param bool $reservations Does this catalogue support reservations
     * @param int|null $inventoryId Catalog ID for updating existing catalog
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventory
     */
    public function addInventory(
        string $name,
        string $description,
        array $languages,
        string $defaultLanguage,
        array $priceGroups,
        int $defaultPriceGroup,
        array $warehouses,
        string $defaultWarehouse,
        bool $reservations,
        ?int $inventoryId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'name' => $name,
                'description' => $description,
                'languages' => $languages,
                'default_language' => $defaultLanguage,
                'price_groups' => $priceGroups,
                'default_price_group' => $defaultPriceGroup,
                'warehouses' => $warehouses,
                'default_warehouse' => $defaultWarehouse,
                'reservations' => $reservations,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a catalogue from BaseLinker storage.
     *
     * @param int $inventoryId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventory
     */
    public function deleteInventory(int $inventoryId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to get a list of catalogues from BaseLinker storage.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventories
     */
    public function getInventories(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add a new category in the BaseLinker catalogues.
     * Adding a category with the same identifier again will cause updates of the previously saved category.
     *
     * @param string $name
     * @param int $parentId Parent category ID (0 for root category)
     * @param int|null $inventoryId Catalog ID
     * @param int|null $categoryId Category ID for updating existing category
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryCategory
     */
    public function addInventoryCategory(
        string $name,
        int $parentId = 0,
        ?int $inventoryId = null,
        ?int $categoryId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'category_id' => $categoryId,
                'name' => $name,
                'parent_id' => $parentId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a category from BaseLinker storage.
     *
     * @param int $categoryId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventoryCategory
     */
    public function deleteInventoryCategory(int $categoryId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'category_id' => $categoryId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to get a list of categories from BaseLinker storage.
     *
     * @param int|null $inventoryId Catalog ID (omit to retrieve categories for all catalogs)
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryCategories
     */
    public function getInventoryCategories(?int $inventoryId = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve a list of tags for a BaseLinker catalog.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryTags
     */
    public function getInventoryTags(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add a new manufacturer in the BaseLinker catalogues.
     * Adding a manufacturer with the same identifier again will cause updates of the previously saved manufacturer.
     *
     * @param string $name Manufacturer name
     * @param int|null $manufacturerId Manufacturer ID for updating existing manufacturer
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryManufacturer
     */
    public function addInventoryManufacturer(
        string $name,
        ?int $manufacturerId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'manufacturer_id' => $manufacturerId,
                'name' => $name,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a manufacturer from BaseLinker storage.
     *
     * @param int $manufacturerId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventoryManufacturer
     */
    public function deleteInventoryManufacturer(int $manufacturerId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'manufacturer_id' => $manufacturerId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to get a list of manufacturers from BaseLinker storage.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryManufacturers
     */
    public function getInventoryManufacturers(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve a list of extra fields for a BaseLinker catalog.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryExtraFields
     */
    public function getInventoryExtraFields(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method returns a list of integrations where text values in the catalog can be overwritten.
     *
     * @param int $inventoryId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryIntegrations
     */
    public function getInventoryIntegrations(int $inventoryId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method returns a list of product text fields that can be overwritten for specific integration.
     *
     * @param int $inventoryId Catalog ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryAvailableTextFieldKeys
     */
    public function getInventoryAvailableTextFieldKeys(int $inventoryId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add a new product in the BaseLinker catalogues.
     * Adding a product with the same identifier again will cause updates of the previously saved product.
     *
     * @param string $inventoryId Catalog ID
     * @param array<string, mixed> $textFields Text fields (names, descriptions, etc.)
     * @param string|null $productId Product ID for updating existing product
     * @param string|null $parentId Parent product ID
     * @param bool $isBundle Is the product a bundle
     * @param string|null $ean
     * @param string|null $sku
     * @param float|null $taxRate VAT tax rate (0-100, -1 for exempt, -0.02 for NP, -0.03 for OO)
     * @param float|null $weight
     * @param float|null $height
     * @param float|null $width
     * @param float|null $length
     * @param int $star Product star type (0-5)
     * @param int|null $manufacturerId
     * @param int|null $categoryId
     * @param array<int, float>|null $prices Prices by price group ID
     * @param array<string, int>|null $stock Stock by warehouse ID
     * @param array<string, string>|null $locations Locations by warehouse ID
     * @param array<int, string>|null $images Images (max 16)
     * @param array<string, mixed>|null $links Links to external warehouses
     * @param array<int, int>|null $bundleProducts Bundle product quantities
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryProduct
     */
    public function addInventoryProduct(
        string $inventoryId,
        array $textFields,
        ?string $productId = null,
        ?string $parentId = null,
        bool $isBundle = false,
        ?string $ean = null,
        ?string $sku = null,
        ?float $taxRate = null,
        ?float $weight = null,
        ?float $height = null,
        ?float $width = null,
        ?float $length = null,
        int $star = 0,
        ?int $manufacturerId = null,
        ?int $categoryId = null,
        ?array $prices = null,
        ?array $stock = null,
        ?array $locations = null,
        ?array $images = null,
        ?array $links = null,
        ?array $bundleProducts = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'product_id' => $productId,
                'parent_id' => $parentId,
                'is_bundle' => $isBundle,
                'ean' => $ean,
                'sku' => $sku,
                'tax_rate' => $taxRate,
                'weight' => $weight,
                'height' => $height,
                'width' => $width,
                'length' => $length,
                'star' => $star,
                'manufacturer_id' => $manufacturerId,
                'category_id' => $categoryId,
                'prices' => $prices,
                'stock' => $stock,
                'locations' => $locations,
                'text_fields' => $textFields,
                'images' => $images,
                'links' => $links,
                'bundle_products' => $bundleProducts,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a product from BaseLinker storage.
     *
     * @param int $productId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventoryProduct
     */
    public function deleteInventoryProduct(int $productId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'product_id' => $productId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve detailed data for selected products from the BaseLinker catalogue.
     *
     * @param int $inventoryId
     * @param array<int, int> $products Array of product IDs
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsData
     */
    public function getInventoryProductsData(int $inventoryId, array $products): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'products' => $products,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve a list of products from the BaseLinker catalogue.
     *
     * @param int $inventoryId
     * @param int|null $filterId
     * @param int|null $filterCategoryId
     * @param string|null $filterEan
     * @param string|null $filterSku
     * @param string|null $filterName
     * @param float|null $filterPriceFrom
     * @param float|null $filterPriceTo
     * @param int|null $filterStockFrom
     * @param int|null $filterStockTo
     * @param int|null $page Results paging (1000 products per page)
     * @param string|null $filterSort Sort order
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsList
     */
    public function getInventoryProductsList(
        int $inventoryId,
        ?int $filterId = null,
        ?int $filterCategoryId = null,
        ?string $filterEan = null,
        ?string $filterSku = null,
        ?string $filterName = null,
        ?float $filterPriceFrom = null,
        ?float $filterPriceTo = null,
        ?int $filterStockFrom = null,
        ?int $filterStockTo = null,
        ?int $page = null,
        ?string $filterSort = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'filter_id' => $filterId,
                'filter_category_id' => $filterCategoryId,
                'filter_ean' => $filterEan,
                'filter_sku' => $filterSku,
                'filter_name' => $filterName,
                'filter_price_from' => $filterPriceFrom,
                'filter_price_to' => $filterPriceTo,
                'filter_stock_from' => $filterStockFrom,
                'filter_stock_to' => $filterStockTo,
                'page' => $page,
                'filter_sort' => $filterSort,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve stock levels of products from BaseLinker catalogues.
     *
     * @param int $inventoryId Catalog ID
     * @param int|null $page Results paging (1000 products per page)
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsStock
     */
    public function getInventoryProductsStock(int $inventoryId, ?int $page = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to update stock levels of products in BaseLinker catalogues.
     *
     * @param int $inventoryId Catalog ID
     * @param array<int, array<string, int>> $products Products with stock by warehouse ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=updateInventoryProductsStock
     */
    public function updateInventoryProductsStock(int $inventoryId, array $products): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'products' => $products,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve the gross prices of products from BaseLinker catalogues.
     *
     * @param int $inventoryId Catalog ID
     * @param int|null $page Results paging (1000 products per page)
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsPrices
     */
    public function getInventoryProductsPrices(int $inventoryId, ?int $page = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to update the gross prices of products in BaseLinker catalogues.
     *
     * @param int $inventoryId Catalog ID
     * @param array<int, array<int, float>> $products Products with prices by price group ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=updateInventoryProductsPrices
     */
    public function updateInventoryProductsPrices(int $inventoryId, array $products): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'products' => $products,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve a list of events related to product changes in the BaseLinker catalog.
     *
     * @param int $productId Product identifier (use variant ID for variant logs)
     * @param int|null $dateFrom Unix timestamp
     * @param int|null $dateTo Unix timestamp
     * @param int|null $logType Event type (1=stock, 2=price, 3=create, 4=delete, 5=text, 6=location, 7=links, 8=gallery, 9=variant, 10=bundle)
     * @param string|null $sort "ASC" or "DESC"
     * @param int|null $page Results paging (100 entries per page)
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryProductLogs
     */
    public function getInventoryProductLogs(
        int $productId,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?int $logType = null,
        ?string $sort = null,
        ?int $page = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'product_id' => $productId,
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'log_type' => $logType,
                'sort' => $sort,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to run a personal trigger for products automatic actions.
     *
     * @param int $productId
     * @param int $triggerId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=runProductMacroTrigger
     */
    public function runProductMacroTrigger(int $productId, int $triggerId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'product_id' => $productId,
                'trigger_id' => $triggerId,
            ]),
        ]);

        return $response->json();
    }

    // ==================== INVENTORY DOCUMENTS ====================

    /**
     * The method allows to add an inventory document (e.g., goods receipt, goods issue).
     *
     * @param int $inventoryId Catalog ID
     * @param int $seriesId Document series ID
     * @param string $type Document type (GR=goods receipt, GI=goods issue, II=internal issue, IR=internal receipt, MM=movement)
     * @param string $warehouseId Warehouse ID (e.g., "bl_123")
     * @param string|null $warehouseIdTarget Target warehouse ID (for MM type)
     * @param string|null $description
     * @param array<int, array<string, mixed>>|null $items Document items
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryDocument
     */
    public function addInventoryDocument(
        int $inventoryId,
        int $seriesId,
        string $type,
        string $warehouseId,
        ?string $warehouseIdTarget = null,
        ?string $description = null,
        ?array $items = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'series_id' => $seriesId,
                'type' => $type,
                'warehouse_id' => $warehouseId,
                'warehouse_id_target' => $warehouseIdTarget,
                'description' => $description,
                'items' => $items,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to confirm an inventory document.
     *
     * @param int $documentId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setInventoryDocumentStatusConfirmed
     */
    public function setInventoryDocumentStatusConfirmed(int $documentId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'document_id' => $documentId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve a list of inventory documents.
     *
     * @param int|null $inventoryId Catalog ID
     * @param int|null $documentId Specific document ID
     * @param int|null $dateFrom Unix timestamp
     * @param int|null $dateTo Unix timestamp
     * @param string|null $type Document type filter
     * @param int|null $page Results paging
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryDocuments
     */
    public function getInventoryDocuments(
        ?int $inventoryId = null,
        ?int $documentId = null,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?string $type = null,
        ?int $page = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'document_id' => $documentId,
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'type' => $type,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve items from an inventory document.
     *
     * @param int $documentId
     * @param int|null $page Results paging
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryDocumentItems
     */
    public function getInventoryDocumentItems(int $documentId, ?int $page = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'document_id' => $documentId,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to add items to an inventory document.
     *
     * @param int $documentId
     * @param array<int, array<string, mixed>> $items
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryDocumentItems
     */
    public function addInventoryDocumentItems(int $documentId, array $items): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'document_id' => $documentId,
                'items' => $items,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve document series for inventory documents.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryDocumentSeries
     */
    public function getInventoryDocumentSeries(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    // ==================== SUPPLIERS & PAYERS ====================

    /**
     * The method allows to retrieve a list of suppliers.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventorySuppliers
     */
    public function getInventorySuppliers(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows to add a supplier.
     *
     * @param string $name
     * @param string|null $code
     * @param string|null $address
     * @param string|null $city
     * @param string|null $postcode
     * @param string|null $country
     * @param string|null $taxId
     * @param string|null $email
     * @param string|null $phone
     * @param int|null $supplierId Supplier ID for updating existing supplier
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventorySupplier
     */
    public function addInventorySupplier(
        string $name,
        ?string $code = null,
        ?string $address = null,
        ?string $city = null,
        ?string $postcode = null,
        ?string $country = null,
        ?string $taxId = null,
        ?string $email = null,
        ?string $phone = null,
        ?int $supplierId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'supplier_id' => $supplierId,
                'name' => $name,
                'code' => $code,
                'address' => $address,
                'city' => $city,
                'postcode' => $postcode,
                'country' => $country,
                'tax_id' => $taxId,
                'email' => $email,
                'phone' => $phone,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a supplier.
     *
     * @param int $supplierId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventorySupplier
     */
    public function deleteInventorySupplier(int $supplierId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'supplier_id' => $supplierId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve a list of payers.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryPayers
     */
    public function getInventoryPayers(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows to add a payer.
     *
     * @param string $name
     * @param string|null $code
     * @param string|null $address
     * @param string|null $city
     * @param string|null $postcode
     * @param string|null $country
     * @param string|null $taxId
     * @param string|null $email
     * @param string|null $phone
     * @param int|null $payerId Payer ID for updating existing payer
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryPayer
     */
    public function addInventoryPayer(
        string $name,
        ?string $code = null,
        ?string $address = null,
        ?string $city = null,
        ?string $postcode = null,
        ?string $country = null,
        ?string $taxId = null,
        ?string $email = null,
        ?string $phone = null,
        ?int $payerId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'payer_id' => $payerId,
                'name' => $name,
                'code' => $code,
                'address' => $address,
                'city' => $city,
                'postcode' => $postcode,
                'country' => $country,
                'tax_id' => $taxId,
                'email' => $email,
                'phone' => $phone,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a payer.
     *
     * @param int $payerId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteInventoryPayer
     */
    public function deleteInventoryPayer(int $payerId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'payer_id' => $payerId,
            ]),
        ]);

        return $response->json();
    }

    // ==================== PURCHASE ORDERS ====================

    /**
     * The method allows to retrieve a list of purchase orders.
     *
     * @param int|null $orderId Specific order ID
     * @param int|null $dateFrom Unix timestamp
     * @param int|null $dateTo Unix timestamp
     * @param int|null $idFrom Order ID to start from
     * @param int|null $supplierId Filter by supplier
     * @param string|null $status Filter by status
     * @param int|null $page Results paging
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryPurchaseOrders
     */
    public function getInventoryPurchaseOrders(
        ?int $orderId = null,
        ?int $dateFrom = null,
        ?int $dateTo = null,
        ?int $idFrom = null,
        ?int $supplierId = null,
        ?string $status = null,
        ?int $page = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'id_from' => $idFrom,
                'supplier_id' => $supplierId,
                'status' => $status,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve items from a purchase order.
     *
     * @param int $orderId
     * @param int|null $page Results paging
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryPurchaseOrderItems
     */
    public function getInventoryPurchaseOrderItems(int $orderId, ?int $page = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'page' => $page,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to retrieve purchase order series.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryPurchaseOrderSeries
     */
    public function getInventoryPurchaseOrderSeries(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows to add a purchase order.
     *
     * @param int $inventoryId Catalog ID
     * @param int $seriesId Series ID
     * @param int $supplierId Supplier ID
     * @param string $warehouseId Warehouse ID (e.g., "bl_123")
     * @param string $currency Currency code (e.g., "EUR")
     * @param string|null $description
     * @param int|null $expectedDeliveryDate Unix timestamp
     * @param array<int, array<string, mixed>>|null $items Order items
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryPurchaseOrder
     */
    public function addInventoryPurchaseOrder(
        int $inventoryId,
        int $seriesId,
        int $supplierId,
        string $warehouseId,
        string $currency,
        ?string $description = null,
        ?int $expectedDeliveryDate = null,
        ?array $items = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'series_id' => $seriesId,
                'supplier_id' => $supplierId,
                'warehouse_id' => $warehouseId,
                'currency' => $currency,
                'description' => $description,
                'expected_delivery_date' => $expectedDeliveryDate,
                'items' => $items,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to add items to a purchase order.
     *
     * @param int $orderId
     * @param array<int, array<string, mixed>> $items
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInventoryPurchaseOrderItems
     */
    public function addInventoryPurchaseOrderItems(int $orderId, array $items): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'items' => $items,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to change the status of a purchase order.
     *
     * @param int $orderId
     * @param string $status Status (draft, confirmed, sent, received, cancelled)
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setInventoryPurchaseOrderStatus
     */
    public function setInventoryPurchaseOrderStatus(int $orderId, string $status): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'status' => $status,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve inventory printout templates.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInventoryPrintoutTemplates
     */
    public function getInventoryPrintoutTemplates(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }
}
