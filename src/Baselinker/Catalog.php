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
    public function addInventoryPriceGroup(string $name, string $description, string $currency)
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
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=addInventoryWarehouse
     */
    public function addInventoryWarehouse(string $name, string $description, bool $stockEdition = false)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
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
        ?int $inventoryId = null)
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
    public function deleteInventory( int $inventoryId)
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
    public function addInventoryCategory(string $name, int $parentId = 0, ?int $inventoryId = null, ?int $categoryId = null)
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


}
