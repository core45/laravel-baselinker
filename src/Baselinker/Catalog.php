<?php

namespace Core45\LaravelBaselinker\Baselinker;

class Catalog extends LaravelBaselinker
{
    /**
     * The method allows to create a price group in BaseLinker storage. Providing a price group ID will update the existing price group. Such price groups may be later assigned in addInventory method.
     *
     * @param string $name
     * @param string $description
     * @param string $currency
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=addInventoryPriceGroup
     */
    public function addInventoryPriceGroup(
        string $name,
        string $description,
        string $currency
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'name' => $name,
                'description' => $description,
                'currency' => $currency
            ]),
        ]);
    }

    /**
     * The method allows to delete a price group from BaseLinker storage.
     *
     * @param int $priceGroupId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=deleteInventoryPriceGroup
     */
    public function deleteInventoryPriceGroup(int $priceGroupId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'price_group_id' => $priceGroupId
            ]),
        ]);
    }

    /**
     * The method allows to get a list of price groups from BaseLinker storage.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=getInventoryPriceGroups
     */
    public function getInventoryPriceGroups()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
        ]);
    }

    /**
     * The method allows you to add a new warehouse available in BaseLinker catalogues.
     * Adding a warehouse with the same identifier again will cause updates of the previously saved warehouse.
     * The method does not allow editing warehouses created automatically for the purpose of keeping external stocks of shops, wholesalers etc.
     * Such warehouse may be later used in addInventory method.
     *
     * @param string $name
     * @param string $description
     * @param bool $stockEdition Is manual editing of stocks permitted. A false value means that you can only edit your stock through the API.
     * @param int|null $warehouseId Warehouse ID. The list of identifiers can be retrieved using the method getInventoryWarehouses. Optional.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=addInventoryWarehouse
     */
    public function addInventoryWarehouse(
        string $name,
        string $description,
        bool $stockEdition = false,
        ?int $warehouseId = null
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'warehouse_id' => $warehouseId,
                'name' => $name,
                'description' => $description,
                'stock_edition' => $stockEdition
            ]),
        ]);
    }

    /**
     * The method allows to delete a warehouse from BaseLinker storage.
     * The method does not allow deleting warehouses created automatically for the purpose of keeping external stocks of shops, wholesalers etc.
     *
     * @param int $warehouseId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=deleteInventoryWarehouse
     */
    public function deleteInventoryWarehouse(int $warehouseId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'warehouse_id' => $warehouseId
            ]),
        ]);
    }

    /**
     * The method allows to get a list of warehouses from BaseLinker storage.
     * The method does not return warehouses created automatically for the purpose of keeping external stocks of shops, wholesalers etc.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=getInventoryWarehouses
     */
    public function getInventoryWarehouses()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
        ]);
    }

    /**
     * The method allows you to add the BaseLinker catalogs.
     * Adding a catalog with the same identifier again will cause updates of the previously saved catalog.
     *
     * @param int $inventoryId Catalog ID. The list of identifiers can be retrieved using the method getInventories. Optional.
     * @param string $name
     * @param string $description
     * @param array $languages
     * @param string $defaultLanguage Default catalogue language. Must be included in the "languages" parameter.
     * @param array $priceGroups An array of price group identifiers available in the catalogue. The list of price group identifiers can be downloaded using the getInventoryPriceGroups method
     * @param int $defaultPriceGroup ID of the price group default for the catalogue. The identifier must be included in the "price_groups" parameter.
     * @param array $warehouses An array of warehouse identifiers available in the catalogue. The list of warehouse identifiers can be retrieved using the getInventoryWarehouses API method. The format of the identifier should be as follows: "[type:bl|shop|warehouse]_[id:int]". (e.g. "shop_2445")
     * @param string $defaultWarehouse Identifier of the warehouse default for the catalogue. The identifier must be included in the "warehouses" parameter.
     * @param bool $reservations Does this catalogue support reservations
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->addInventory('Inventory 2', 'Cool inventory no. 2', ['en', 'pl'], 'en', [18704, 18705], 18705, ['bl_19464', 'bl_19580'], 'bl_19464', true);
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
    )
    {
        return $this->makeRequest([
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
    }

    /**
     * The method allows to delete a catalogue from BaseLinker storage.
     *
     * @param int $inventoryId Catalog ID. The list of identifiers can be retrieved using the method getInventories. Optional.
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->deleteInventory(18705);
     *
     * @see https://api.baselinker.com/?method=deleteInventory
     */
    public function deleteInventory(int $inventoryId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);
    }

    /**
     * The method allows to get a list of catalogues from BaseLinker storage.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventories();
     *
     * @see https://api.baselinker.com/?method=getInventories
     */
    public function getInventories()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
        ]);
    }

    /**
     * The method allows you to add a new category in the BaseLinker catalogues.
     * Adding a category with the same identifier again will cause updates of the previously saved category.
     *
     * @param string $name
     * @param int|null $parentId
     * @param int|null $inventoryId
     * @param int|null $categoryId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->addInventoryCategory('Category 1', null, 18705, 18705);
     * ->addInventoryCategory('Category 2', 0); // 0 - root category
     *
     * @see https://api.baselinker.com/?method=addInventoryCategory
     */
    public function addInventoryCategory(
        string $name,
        int $parentId = 0,
        ?int $inventoryId = null,
        ?int $categoryId = null
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'category_id' => $categoryId,
                'name' => $name,
                'parent_id' => $parentId,
            ]),
        ]);
    }

    /**
     * The method allows to delete a category from BaseLinker storage.
     *
     * @param int $categoryId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->deleteInventoryCategory(18705);
     *
     * @see https://api.baselinker.com/?method=deleteInventoryCategory
     */
    public function deleteInventoryCategory(int $categoryId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'category_id' => $categoryId,
            ]),
        ]);
    }

    /**
     * The method allows to get a list of categories from BaseLinker storage.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryCategories();
     *
     * @see https://api.baselinker.com/?method=getInventoryCategories
     */
    public function getInventoryCategories()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__
        ]);
    }

    /**
     * The method allows you to add a new manufacturer in the BaseLinker catalogues.
     * Adding a manufacturer with the same identifier again will cause updates of the previously saved manufacturer.
     *
     * @param int|null $manufacturerId
     * @param string $name
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->addInventoryManufacturer(null, 'Manufacturer 1');
     *
     * @see https://api.baselinker.com/?method=addInventoryManufacturer
     */
    public function addInventoryManufacturer(
        ?int $manufacturerId = null,
        string $name
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'manufacturer_id' => $manufacturerId,
                'name' => $name,
            ]),
        ]);
    }

    /**
     * The method allows to delete a manufacturer from BaseLinker storage.
     *
     * @param int $manufacturerId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->deleteInventoryManufacturer(18705);
     *
     * @see https://api.baselinker.com/?method=deleteInventoryManufacturer
     */
    public function deleteInventoryManufacturer(int $manufacturerId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'manufacturer_id' => $manufacturerId,
            ]),
        ]);
    }

    /**
     * The method allows to get a list of manufacturers from BaseLinker storage.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryManufacturers();
     *
     * @see https://api.baselinker.com/?method=getInventoryManufacturers
     */
    public function getInventoryManufacturers()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__
        ]);
    }

    /**
     * The method allows you to retrieve a list of extra fields for a BaseLinker catalog.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryExtraFields();
     *
     * @see https://api.baselinker.com/?method=getInventoryExtraFields
     */
    public function getInventoryExtraFields()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__
        ]);
    }

    /**
     *The method returns a list of integrations where text values in the catalog can be overwritten.
     * The returned data contains a list of accounts for each integration and a list of languages supported by the integration
     *
     * @param int $inventoryId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryExtraFields(123);
     *
     * @see https://api.baselinker.com/?method=getInventoryIntegrations
     */
    public function getInventoryIntegrations(int $inventoryId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);
    }

    /**
     * The method returns a list of product text fields that can be overwritten for specific integration.
     *
     * @param int $inventoryId Catalog ID. The list of identifiers can be retrieved by the getInventories method (inventory_id field).
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryIntegrations(123);
     *
     * @see https://api.baselinker.com/?method=getInventoryAvailableTextFieldKeys
     */
    public function getInventoryAvailableTextFieldKeys(int $inventoryId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
            ]),
        ]);
    }

    /**
     * The method allows you to add a new product in the BaseLinker catalogues.
     * Adding a product with the same identifier again will cause updates of the previously saved product.
     *
     * @param string $inventoryId Catalog ID. The list of identifiers can be retrieved by the getInventories method (inventory_id field).
     * @param string $productId Product ID. The list of identifiers can be retrieved by the getProductsList method (product_id field).
     * @param string $parentId Parent product ID. The list of identifiers can be retrieved by the getProductsList method (product_id field).
     * @param bool $isBundle Is the product a bundle
     * @param string $ean
     * @param string $sku
     * @param float $taxRate VAT tax rate e.g. "23", (value from range 0-100, EXCEPTION values: "-1" for "EXPT"/"ZW" exempt from VAT, "-0.02" for "NP" annotation, "-0.03" for "OO" VAT reverse charge)
     * @param float $weight
     * @param float $height
     * @param float $width
     * @param float $length
     * @param int $star Product star type. It takes from 0 to 5 values. 0 means no starring.
     * @param int $manufacturerId Product manufacturer ID. IDs can be retrieved with getInventoryManufacturers method.
     * @param int $categoryId Product category ID (category must be previously created with addInventoryCategories) method.
     * @param array $prices A list containing product prices, where the key is the price group ID and value is a product gross price for a given price group. The list of price groups can be retrieved with getInventoryPriceGroups method.
     * @param array $stock A list containing product prices, where the key is the price group ID and value is a product gross price for a given price group. The list of price groups can be retrieved with getInventoryPriceGroups method.
     * @param array $locations A list containing product locations where the key is the warehouse ID and value is a product location for a given warehouse, eg. "A-5-2". Warehouse ID should have this format: "[type:bl|shop|warehouse]_[id:int]" (eg. "bl_123"). The list of warehouse IDs can be retrieved with getInventoryWarehouses method.
     *
     * @param array $textFields A list containing field text values (names, descriptions, etc.) of a product, where the key is the field text ID and value is the field value. The field text ID consists of the following components separated with the "|" character:
     *
     * [field] - Field name. Accepted field names: "name", "description", "features", "description_extra1", "description_extra2", "description_extra3", "description_extra4", "extra_field_[extra-field-ID]" e.g. "extra_field_75". The list of extra fields IDs can be retrieved with getInventoryExtraFields method.
     * [lang] - A two-letter code of language, which gets assigned given value e.g. "en". If this value is not specified, the default catalog language is assigned. The list of languages available for each integration can be retrieved with getInventoryIntegrations method.
     * [source_id] - Integration ID provided when the given text field value is to be overwritten only for a specific integration. ID should have a following format: "[type:varchar]_[id:int]", where the type means a kind of integration (e.g. "ebay", "amazon", "google"), and ID is an account identifier for given integration (eg. "ebay_2445").
     * If a value is to be overwritten throughout the integration (e.g. for all Amazon accounts), the value "0" should be used as the identifier. (e.g. "amazon_0").
     *
     * Examples of text field identifiers:
     *
     * "name" - Default name assigned to the default language.
     * "name|de" - Name assigned to a particular language.
     * "name|de|amazon_0" - Name assigned to a specific language for all Amazon accounts.
     * "name|de|amazon_123" - Name assigned to a specific language for an Amazon account with ID 123.
     *
     * The list of all text field identifiers can be retrieved with the getInventoryAvailableTextFieldKeys method.
     *
     * In the case of the name and short additional fields, the character limit for the field value is 200. When specifying the value of a product feature (field "features"), provide a list where the key is the name of the parameter (e.g. "Colour") and the value is the value of that parameter (e.g. "White").
     *
     * In case of file the following format is expected:
     * {
     * "title": "file.pdf" (varchar(40) - the file name)
     * "file": "data:4AAQSkZJRgABA[...]" (binary - the file body limited to 2MB)
     * }
     *
     * @param array $images A list of product images (maximum 16). Each element of the list is a separate photo where the key is the photo position in the gallery (numbering from 0 to 15). You can delete a photo by sending "" at the selected position. You can submit a photo in binary format, or a link to the photo. In case of binary format, the photo should be coded in base64 and at the very beginning of the photo string the prefix "data:" should be provided. In case of link to the photo, the prefix "url:" must be given before the link. Example:
     * {
     * "0": "url:http://adres.pl/zdjecie.jpg", (url - the photo url limited to 1000 characters length)
     * "3": "data:4AAQSkZJRgABA[...]", (binary - the photo content limited to 2MB)
     * "5": "", (empty - to delete the photo)
     * ...
     * }
     *
     * @param array $links An array containing product links to external warehouses (e.g. shops, wholesalers). Each element of the array is a list in which the key is the identifier of the external warehouse in the format "[type:shop|warehouse]_[id:int]". (e.g. "shop_2445"). The warehouse identifiers can be retrieved with the getStoragesList method. The value is an array containing the fields listed below.
     * @param array $bundleProducts A list containing information about the products included in the bundle, where the key is the identifier of the product included in the bundle, and the value is the number of pieces of this product in the bundle. Subproducts can only be defined if the added/edited product is a bundle (is_bundle = true).
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
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
        ?int $star = 0,
        ?int $manufacturerId = null,
        ?int $categoryId = null,
        ?array $prices = null,
        ?array $stock = null,
        ?array $locations = null,
        ?array $images = null,
        ?array $links = null,
        ?array $bundleProducts = null,
    )
    {
        return $this->makeRequest([
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
    }

    /**
     * The method allows to delete a product from BaseLinker storage.
     *
     * @param int $productId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->deleteInventoryProduct(18705);
     *
     * @see https://api.baselinker.com/?method=deleteInventoryProduct
     */
    public function deleteInventoryProduct(int $productId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'product_id' => $productId,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve detailed data for selected products from the BaseLinker catalogue.
     *
     * @param int $inventoryId
     * @param array $products
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryProductsData(18705, [18705, 18706]);
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsData
     */
    public function getInventoryProductsData(
        int $inventoryId,
        array $products
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'products' => $products,
            ]),
        ]);
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
     * @param int|null $page
     * @param string|null $filterSort
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryProductsList(18705, null, null, null, null, null, null, null, null, null, null, null);
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
    )
    {
        return $this->makeRequest([
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
    }

    /**
     * The method allows you to retrieve a list of products from the BaseLinker catalogue.
     *
     * @param int $inventoryId
     * @param int|null $page
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryProductsListTranslated(18705);
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsListTranslated
     */
    public function getInventoryProductsStock(
        int $inventoryId,
        ?int $page
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'page' => $page,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve a list of products from the BaseLinker catalogue.
     *
     * @param int $inventoryId Catalog ID. The list of identifiers can be retrieved using the method getInventories.
     * @param array $products An array of products, where the key is a product ID and the value is a list of stocks. When determining the variant stock, provide variant ID as a product ID.
     * In the stocks array the key should be the warehouse ID and the value - stock for that warehouse. The format of the warehouse identifier should be as follows: "[type:bl|shop|warehouse]_[id:int]". (e.g. "bl_123"). The list of warehouse identifiers can be retrieved using the getInventoryWarehousesmethod.
     *
     * Stocks cannot be assigned to the warehouses created automatically for purposes of keeping external stocks (shops, wholesalers, etc.).
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryProductsListTranslated(18705, [18705, 18706]);
     *
     * @see https://api.baselinker.com/?method=getInventoryProductsListTranslated
     */
    public function updateInventoryProductsStock(
        int $inventoryId,
        array $products
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'products' => $products,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve the gross prices of products from BaseLinker catalogues.
     *
     * @param int $inventoryId Catalog ID. The list of identifiers can be retrieved using the method getInventories.
     * @param int $page (optional) Results paging (1000 products per page for BaseLinker warehouse)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getInventoryProductsPrices(18705);
     *
     * @see https://api.baselinker.com/index.php?method=getInventoryProductsPrices
     */
    public function getInventoryProductsPrices(
        int $inventoryId,
        ?int $page
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'page' => $page,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve the gross prices of products from BaseLinker catalogues.
     *
     * @param int $inventoryId Catalog ID. The list of identifiers can be retrieved using the method getInventories.
     * @param array $products An array of products, where the key is a product ID and the value is a list of prices. When determining the variant price, provide variant ID as a product ID.
     * In the prices array the key should be the price group ID and the value - gross price for that price group. The list of price group identifiers can be retrieved using the getInventoryPriceGroups method.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->updateInventoryProductsPrices(307, [2685 => [105 => 33.70, 106 => 34.70], 2068 => [105 => 35.23, 106 => 54.45]);
     *
     * @see https://api.baselinker.com/index.php?method=updateInventoryProductsPrices
     */
    public function updateInventoryProductsPrices(
        int $inventoryId,
        array $products
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'inventory_id' => $inventoryId,
                'products' => $products,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve a list of events related to product change (or their variants) in the BaseLinker catalog.
     *
     * @param int $productId Product identifier. In case of retrieving logs for a variant, the variant identifier must be provided as the product identifier.
     * @param string|null $dateFrom (optional) Date from which logs are to be retrieved. Unix time stamp format.
     * @param string|null $dateTo (optional) Date up to which logs are to be retrieved. Unix time stamp format.
     * @param string|null $logType (optional) List of event types you want to retrieve. Available values:
     * 1 - Change in stock
     * 2 - Price change
     * 3 - Product creation
     * 4 - Product deletion
     * 5 - Text fields modifications
     * 6 - Locations modifications
     * 7 - Modifications of links
     * 8 - Gallery modifications
     * 9 - Variant modifications
     * 10 - Modifications of bundle products
     *
     * @param string|null $sort (optional) Type of log sorting. Possible "ASC" values ( ascending from date), "DESC" (descending after the date). By default the sorting is done in ascending order.
     * @param int|null $page (optional) Results paging (100 product editions per page).
     *
     * Example:
     * ->getInventoryProductLogs(18705, 1592904594);
     *
     * @see https://api.baselinker.com/index.php?method=getInventoryProductLogs
     */
    public function getInventoryProductLogs(
        int $productId,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?string $logType = null,
        ?string $sort = null,
        ?int $page = null
    )
    {
        return $this->makeRequest([
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
    }

    /**
     * The method allows you to run personal trigger for products automatic actions.
     *
     * @param int $productId
     * @param int $triggerId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->runProductMacroTrigger(18705, 1234);
     *
     * @see https://api.baselinker.com/index.php?method=runProductMacroTrigger
     */
    public function runProductMacroTrigger(
        int $productId,
        int $triggerId
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'product_id' => $productId,
                'trigger_id' => $triggerId,
            ]),
        ]);
    }
}
