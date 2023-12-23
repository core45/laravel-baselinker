<?php

namespace Core45\LaravelBaselinker\Baselinker;

class ExternalStorage extends LaravelBaselinker
{
    /**
     * The method allows you to retrieve a list of available external storages (shops, wholesalers) that can be referenced via API.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getExternalStoragesList()
     *
     * @see https://api.baselinker.com/?method=getExternalStoragesList
     */
    public function getExternalStoragesList()
    {
        return $this->makeRequest([
            'method' => __FUNCTION__
        ]);
    }

    /**
     * The method allows you to retrieve a list of categories from the selected external storage (shop, wholesaler).
     *
     * @param string $storageId
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getExternalStorageCategories('bl_19464')
     *
     * @see https://api.baselinker.com/?method=getExternalStorageCategories
     */
    public function getExternalStorageCategories(string $storageId)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'storage_id' => $storageId,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve detailed data of selected products from an external storage (shop/wholesaler) connected to BaseLinker.
     *
     * @param string $storageId Storage ID in format "[type:shop|warehouse]_[id:int]" (e.g. "shop_2445").
     * @param array $products An array of product ID numbers to download.
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getExternalStorageProductsData('bl_19464', [18755])
     *
     * @see https://api.baselinker.com/?method=getExternalStorageProductsData
     */
    public function getExternalStorageProductsData(string $storageId, array $products)
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'storage_id' => $storageId,
                'products' => $products,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve detailed data of selected products from an external storage (shop/wholesaler) connected to BaseLinker.
     *
     * @param string $storageId Storage ID in format "[type:shop|warehouse]_[id:int]" (e.g. "shop_2445").
     * @param string|null $filterCategoryId (optional) Retrieving products from a specific category
     * @param string|null $filterSort (optional) the value for sorting the product list. Possible values: "id [ASC|DESC]", "name [ASC|DESC]", "quantity [ASC|DESC]", "price [ASC|DESC]"
     * @param string|null $filterId (optional) limiting results to a specific product id
     * @param string|null $filterEan (optional) limiting results to a specific ean
     * @param string|null $filterSku
     * @param string|null $filterName
     * @param float|null $filterPriceFrom (optional) minimum price limit (not displaying products with lower price)
     * @param float|null $filterPriceTo
     * @param int|null $filterQuantityFrom
     * @param int|null $filterQuantityTo
     * @param int|null $filterAvailable (optional) displaying only products marked as available (value 1) or not available (0) or all (empty value)
     * @param int|null $page (optional) Results paging
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=getExternalStorageProductsList
     */
    public function getExternalStorageProductsList(
        string $storageId,
        ?string $filterCategoryId = null,
        ?string $filterSort = null,
        ?string $filterId = null,
        ?string $filterEan = null,
        ?string $filterSku = null,
        ?string $filterName = null,
        ?float $filterPriceFrom = null,
        ?float $filterPriceTo = null,
        ?int $filterQuantityFrom = null,
        ?int $filterQuantityTo = null,
        ?int $filterAvailable = null,
        ?int $page = null
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'storage_id' => $storageId,
                'filter_category_id' => $filterCategoryId,
                'filter_sort' => $filterSort,
                'filter_id' => $filterId,
                'filter_ean' => $filterEan,
                'filter_sku' => $filterSku,
                'filter_name' => $filterName,
                'filter_price_from' => $filterPriceFrom,
                'filter_price_to' => $filterPriceTo,
                'filter_quantity_from' => $filterQuantityFrom,
                'filter_quantity_to' => $filterQuantityTo,
                'filter_available' => $filterAvailable,
                'page' => $page,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve stock from an external storage (shop/wholesaler) connected to BaseLinker.
     *
     * @param string $storageId Storage ID in format "[type:shop|warehouse]_[id:int]" (e.g. "shop_2445").
     * @param int|null $page (optional) Results paging
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * @see https://api.baselinker.com/?method=getExternalStorageProductsQuantity
     */
    public function getExternalStorageProductsQuantity(
        string $storageId,
        ?int $page = null,
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'storage_id' => $storageId,
                'page' => $page,
            ]),
        ]);
    }

    /**
     * The method allows to retrieve product prices from an external storage (shop/wholesaler) connected to BaseLinker.
     *
     * @param string $storageId Storage ID in format "[type:shop|warehouse]_[id:int]" (e.g. "shop_2445").
     * @param int|null $page (optional) Results paging
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->getExternalStorageProductsPrices('shop_2445')
     *
     * @see https://api.baselinker.com/?method=getExternalStorageProductsPrices
     */
    public function getExternalStorageProductsPrices(
        string $storageId,
        ?int $page = null,
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'storage_id' => $storageId,
                'page' => $page,
            ]),
        ]);
    }

    /**
     * The method allows to bulk update the product stock (and/or variants) in an external storage (shop/wholesaler) connected to BaseLinker. Maximum 1000 products at a time.
     *
     * @param string $storageId Storage ID in format "[type:shop|warehouse]_[id:int]" (e.g. "shop_2445").
     * @param array $products An array of products. Each product is a separate element of the array. The product consists of a 3 element array of components:
     * 0 => product ID number (varchar)
     * 1 => variant ID number (0 if the main product is changed, not the variant) (int)
     * 2 => Stock quantity (int)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     *
     * Example:
     * ->updateExternalStorageProductsQuantity('shop_2445', [0 => [1081730, 0, 100], 1 => [1081730, 1734642, 150]])
     *
     * @see https://api.baselinker.com/?method=updateExternalStorageProductsQuantity
     */
    public function updateExternalStorageProductsQuantity(
        string $storageId,
        array $products,
    )
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'storage_id' => $storageId,
                'products' => $products,
            ]),
        ]);
    }
}
