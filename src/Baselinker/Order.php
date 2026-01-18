<?php

namespace Core45\LaravelBaselinker\Baselinker;

class Order extends LaravelBaselinker
{
    /**
     * The method allows you to download a list of order events from the last 3 days.
     *
     * @param int $lastLogId Log ID number from which the logs are to be retrieved
     * @param array<int, int> $logsTypes Event ID list
     * @param int|null $orderId Order ID number
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getJournalList
     */
    public function getJournalList(int $lastLogId, array $logsTypes, ?int $orderId = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'last_log_id' => $lastLogId,
                'logs_types' => $logsTypes,
                'order_id' => $orderId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows adding a new order to the BaseLinker order manager.
     *
     * @param int $orderStatusId Order status ID
     * @param int $dateAdd Date of order creation (unix timestamp)
     * @param string $currency 3-letter currency symbol (e.g. EUR, PLN)
     * @param string $paymentMethod
     * @param int $paymentMethodCod Is payment COD (1=yes, 0=no)
     * @param int $paid Is order paid (1=yes, 0=no)
     * @param string $userComments
     * @param string $adminComments
     * @param string $email
     * @param string $phone
     * @param string $userLogin
     * @param string $deliveryMethod
     * @param float $deliveryPrice
     * @param string $deliveryFullname
     * @param string $deliveryCompany
     * @param string $deliveryAddress
     * @param string $deliveryPostcode
     * @param string $deliveryCity
     * @param string $deliveryState
     * @param string $deliveryCountryCode Two-letter country code
     * @param string $deliveryPointId
     * @param string $deliveryPointName
     * @param string $deliveryPointAddress
     * @param string $deliveryPointPostcode
     * @param string $deliveryPointCity
     * @param string $invoiceFullname
     * @param string $invoiceCompany
     * @param string $invoiceNip
     * @param string $invoiceAddress
     * @param string $invoicePostcode
     * @param string $invoiceCity
     * @param string $invoiceState
     * @param string $invoiceCountryCode Two-letter country code
     * @param int $wantInvoice Customer wants invoice (1=yes, 0=no)
     * @param string $extraField1
     * @param string $extraField2
     * @param array<int, mixed> $customExtraFields Custom extra fields
     * @param array<int, array<string, mixed>> $products Order products
     * @param int|null $customSourceId Custom order source ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrder
     */
    public function addOrder(
        int $orderStatusId,
        int $dateAdd,
        string $currency,
        string $paymentMethod,
        int $paymentMethodCod,
        int $paid,
        string $userComments,
        string $adminComments,
        string $email,
        string $phone,
        string $userLogin,
        string $deliveryMethod,
        float $deliveryPrice,
        string $deliveryFullname,
        string $deliveryCompany,
        string $deliveryAddress,
        string $deliveryPostcode,
        string $deliveryCity,
        string $deliveryState,
        string $deliveryCountryCode,
        string $deliveryPointId,
        string $deliveryPointName,
        string $deliveryPointAddress,
        string $deliveryPointPostcode,
        string $deliveryPointCity,
        string $invoiceFullname,
        string $invoiceCompany,
        string $invoiceNip,
        string $invoiceAddress,
        string $invoicePostcode,
        string $invoiceCity,
        string $invoiceState,
        string $invoiceCountryCode,
        int $wantInvoice,
        string $extraField1,
        string $extraField2,
        array $customExtraFields,
        array $products,
        ?int $customSourceId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_status_id' => $orderStatusId,
                'custom_source_id' => $customSourceId,
                'date_add' => $dateAdd,
                'currency' => $currency,
                'payment_method' => $paymentMethod,
                'payment_method_cod' => $paymentMethodCod,
                'paid' => $paid,
                'user_comments' => $userComments,
                'admin_comments' => $adminComments,
                'email' => $email,
                'phone' => $phone,
                'user_login' => $userLogin,
                'delivery_method' => $deliveryMethod,
                'delivery_price' => $deliveryPrice,
                'delivery_fullname' => $deliveryFullname,
                'delivery_company' => $deliveryCompany,
                'delivery_address' => $deliveryAddress,
                'delivery_postcode' => $deliveryPostcode,
                'delivery_city' => $deliveryCity,
                'delivery_state' => $deliveryState,
                'delivery_country_code' => $deliveryCountryCode,
                'delivery_point_id' => $deliveryPointId,
                'delivery_point_name' => $deliveryPointName,
                'delivery_point_address' => $deliveryPointAddress,
                'delivery_point_postcode' => $deliveryPointPostcode,
                'delivery_point_city' => $deliveryPointCity,
                'invoice_fullname' => $invoiceFullname,
                'invoice_company' => $invoiceCompany,
                'invoice_nip' => $invoiceNip,
                'invoice_address' => $invoiceAddress,
                'invoice_postcode' => $invoicePostcode,
                'invoice_city' => $invoiceCity,
                'invoice_state' => $invoiceState,
                'invoice_country_code' => $invoiceCountryCode,
                'want_invoice' => $wantInvoice,
                'extra_field_1' => $extraField1,
                'extra_field_2' => $extraField2,
                'custom_extra_fields' => $customExtraFields,
                'products' => $products,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to duplicate an existing order.
     *
     * @param int $orderId Order ID to duplicate
     * @param int|null $orderStatusId New order status ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderDuplicate
     */
    public function addOrderDuplicate(int $orderId, ?int $orderStatusId = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'order_status_id' => $orderStatusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method returns types of order sources along with their IDs.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderSources
     */
    public function getOrderSources(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method returns extra fields defined for the orders.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderExtraFields
     */
    public function getOrderExtraFields(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The getOrders method allows you to download orders from a specific date from the BaseLinker order manager.
     * A maximum of 100 orders are returned at a time.
     *
     * @param int|null $orderId Order identifier
     * @param int|null $dateConfirmedFrom Date of order confirmation (unix timestamp)
     * @param int|null $dateFrom Order date from (unix timestamp)
     * @param int|null $idFrom Order ID to start from
     * @param bool $getUnconfirmedOrders Include unconfirmed orders
     * @param bool $includeCustomExtraFields Include custom extra fields
     * @param int|null $statusId Filter by status ID
     * @param string|null $filterEmail Filter by email
     * @param string|null $filterOrderSource Filter by order source
     * @param string|null $filterOrderSourceId Filter by order source ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrders
     */
    public function getOrders(
        ?int $orderId = null,
        ?int $dateConfirmedFrom = null,
        ?int $dateFrom = null,
        ?int $idFrom = null,
        bool $getUnconfirmedOrders = false,
        bool $includeCustomExtraFields = false,
        ?int $statusId = null,
        ?string $filterEmail = null,
        ?string $filterOrderSource = null,
        ?string $filterOrderSourceId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'date_confirmed_from' => $dateConfirmedFrom,
                'date_from' => $dateFrom,
                'id_from' => $idFrom,
                'get_unconfirmed_orders' => $getUnconfirmedOrders,
                'include_custom_extra_fields' => $includeCustomExtraFields,
                'status_id' => $statusId,
                'filter_email' => $filterEmail,
                'filter_order_source' => $filterOrderSource,
                'filter_order_source_id' => $filterOrderSourceId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve transaction details for a selected order.
     *
     * @param int $orderId
     * @param bool|null $includeComplexTaxes Include detailed tax breakdown
     * @param bool|null $includeAmazonData Include legacy Amazon fulfillment data
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderTransactionData
     */
    public function getOrderTransactionData(
        int $orderId,
        ?bool $includeComplexTaxes = null,
        ?bool $includeAmazonData = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'include_complex_taxes' => $includeComplexTaxes,
                'include_amazon_data' => $includeAmazonData,
            ]),
        ]);

        return $response->json();
    }

    /**
     * Alias for getOrderTransactionData.
     *
     * @param int $orderId
     * @param bool|null $includeComplexTaxes Include detailed tax breakdown
     * @param bool|null $includeAmazonData Include legacy Amazon fulfillment data
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderTransactionData
     */
    public function getOrderTransactionDetails(
        int $orderId,
        ?bool $includeComplexTaxes = null,
        ?bool $includeAmazonData = null
    ): array {
        return $this->getOrderTransactionData($orderId, $includeComplexTaxes, $includeAmazonData);
    }

    /**
     * The method allows to search for orders related to the given e-mail address.
     *
     * @param string $email
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrdersByEmail
     */
    public function getOrdersByEmail(string $email): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'email' => $email,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to search for orders related to the given phone number.
     *
     * @param string $phone
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrdersByPhone
     */
    public function getOrdersByPhone(string $phone): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'phone' => $phone,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete orders.
     *
     * @param array<int, int> $orderIds Array of order IDs to delete
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteOrders
     */
    public function deleteOrders(array $orderIds): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_ids' => $orderIds,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to split selected products into a new order.
     *
     * @param int $orderId Order ID to split
     * @param array<int, array{order_product_id: int, quantity: int}> $itemsToSplit Items to move
     * @param float|null $deliveryCostToSplit Delivery cost to transfer to the new order
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderBySplit
     */
    public function addOrderBySplit(
        int $orderId,
        array $itemsToSplit,
        ?float $deliveryCostToSplit = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'items_to_split' => $itemsToSplit,
                'delivery_cost_to_split' => $deliveryCostToSplit,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to merge multiple orders into one.
     *
     * @param int $mainOrderId Main order ID
     * @param array<int, int> $orderIdsToMerge Order IDs to merge
     * @param string $mergeMode Merge mode (technical_merge or into_main_order)
     * @param bool $sumDeliveryCosts Sum delivery costs from merged orders
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrdersMerge
     */
    public function setOrdersMerge(
        int $mainOrderId,
        array $orderIdsToMerge,
        string $mergeMode,
        bool $sumDeliveryCosts = false
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'main_order_id' => $mainOrderId,
                'order_ids_to_merge' => $orderIdsToMerge,
                'merge_mode' => $mergeMode,
                'sum_delivery_costs' => $sumDeliveryCosts,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The addInvoice method allows to issue an order invoice.
     *
     * @param int $orderId Order ID
     * @param int $seriesId Series numbering ID
     * @param string|null $vatRate VAT rate (DEFAULT, ITEM, EXPT/ZW, NP, OO, or 0-100)
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInvoice
     */
    public function addInvoice(int $orderId, int $seriesId, ?string $vatRate = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'series_id' => $seriesId,
                'vat_rate' => $vatRate,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to issue an invoice correction.
     *
     * @param int $invoiceId Invoice ID to correct
     * @param int $seriesId Correction series ID
     * @param string $reason Reason for correction
     * @param array<int, array<string, mixed>>|null $correctionItems Items to correct
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addInvoiceCorrection
     */
    public function addInvoiceCorrection(
        int $invoiceId,
        int $seriesId,
        string $reason,
        ?array $correctionItems = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'invoice_id' => $invoiceId,
                'series_id' => $seriesId,
                'reason' => $reason,
                'correction_items' => $correctionItems,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method getInvoices allows you to download invoices issued from the BaseLinker order manager.
     * Maximum 100 invoices are returned at a time.
     *
     * @param int|null $invoiceId Invoice identifier
     * @param int|null $orderId Order identifier
     * @param int|null $dateFrom Date from (unix timestamp)
     * @param int|null $idFrom Invoice ID to start from
     * @param int|null $seriesId Filter by series ID
     * @param bool $getExternalInvoices Include external invoices
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInvoices
     */
    public function getInvoices(
        ?int $invoiceId = null,
        ?int $orderId = null,
        ?int $dateFrom = null,
        ?int $idFrom = null,
        ?int $seriesId = null,
        bool $getExternalInvoices = true
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'invoice_id' => $invoiceId,
                'order_id' => $orderId,
                'date_from' => $dateFrom,
                'id_from' => $idFrom,
                'series_id' => $seriesId,
                'get_external_invoices' => $getExternalInvoices,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to download a series of invoice/receipt numbering.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getSeries
     */
    public function getSeries(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download order statuses created by the customer.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderStatusList
     */
    public function getOrderStatusList(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve payment history for a selected order.
     *
     * @param int $orderId
     * @param bool $showFullHistory
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderPaymentsHistory
     */
    public function getOrderPaymentsHistory(int $orderId, bool $showFullHistory = false): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'show_full_history' => $showFullHistory,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve pick/pack history for a selected order.
     *
     * @param int $orderId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderPickPackHistory
     */
    public function getOrderPickPackHistory(int $orderId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The getNewReceipts method allows you to retrieve receipts waiting to be issued.
     *
     * @param int|null $seriesId Filter by series ID
     * @param int $idFrom ID to start from
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getNewReceipts
     */
    public function getNewReceipts(?int $seriesId = null, int $idFrom = 0): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'series_id' => $seriesId,
                'id_from' => $idFrom,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve a list of receipts.
     *
     * @param int|null $receiptId Receipt ID
     * @param int|null $orderId Order ID
     * @param int|null $dateFrom Date from (unix timestamp)
     * @param int|null $idFrom Receipt ID to start from
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getReceipts
     */
    public function getReceipts(
        ?int $receiptId = null,
        ?int $orderId = null,
        ?int $dateFrom = null,
        ?int $idFrom = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'receipt_id' => $receiptId,
                'order_id' => $orderId,
                'date_from' => $dateFrom,
                'id_from' => $idFrom,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve a single receipt from the BaseLinker order manager.
     *
     * @param int $orderId
     * @param int|null $receiptId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getReceipt
     */
    public function getReceipt(int $orderId, ?int $receiptId = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'receipt_id' => $receiptId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to edit selected fields of a specific order.
     *
     * @param int $orderId Order identifier
     * @param string|null $adminComments
     * @param string|null $userComments
     * @param string|null $paymentMethod
     * @param int|null $paymentMethodCod
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $userLogin
     * @param string|null $deliveryMethod
     * @param float|null $deliveryPrice
     * @param string|null $deliveryFullname
     * @param string|null $deliveryCompany
     * @param string|null $deliveryAddress
     * @param string|null $deliveryPostcode
     * @param string|null $deliveryCity
     * @param string|null $deliveryState
     * @param string|null $deliveryCountryCode
     * @param string|null $deliveryPointId
     * @param string|null $deliveryPointName
     * @param string|null $deliveryPointAddress
     * @param string|null $deliveryPointPostcode
     * @param string|null $deliveryPointCity
     * @param string|null $invoiceFullname
     * @param string|null $invoiceCompany
     * @param string|null $invoiceNip
     * @param string|null $invoiceAddress
     * @param string|null $invoicePostcode
     * @param string|null $invoiceCity
     * @param string|null $invoiceState
     * @param string|null $invoiceCountryCode
     * @param int|null $wantInvoice
     * @param string|null $extraField1
     * @param string|null $extraField2
     * @param array<int, mixed>|null $customExtraFields
     * @param string|null $pickState
     * @param string|null $packState
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderFields
     */
    public function setOrderFields(
        int $orderId,
        ?string $adminComments = null,
        ?string $userComments = null,
        ?string $paymentMethod = null,
        ?int $paymentMethodCod = null,
        ?string $email = null,
        ?string $phone = null,
        ?string $userLogin = null,
        ?string $deliveryMethod = null,
        ?float $deliveryPrice = null,
        ?string $deliveryFullname = null,
        ?string $deliveryCompany = null,
        ?string $deliveryAddress = null,
        ?string $deliveryPostcode = null,
        ?string $deliveryCity = null,
        ?string $deliveryState = null,
        ?string $deliveryCountryCode = null,
        ?string $deliveryPointId = null,
        ?string $deliveryPointName = null,
        ?string $deliveryPointAddress = null,
        ?string $deliveryPointPostcode = null,
        ?string $deliveryPointCity = null,
        ?string $invoiceFullname = null,
        ?string $invoiceCompany = null,
        ?string $invoiceNip = null,
        ?string $invoiceAddress = null,
        ?string $invoicePostcode = null,
        ?string $invoiceCity = null,
        ?string $invoiceState = null,
        ?string $invoiceCountryCode = null,
        ?int $wantInvoice = null,
        ?string $extraField1 = null,
        ?string $extraField2 = null,
        ?array $customExtraFields = null,
        ?string $pickState = null,
        ?string $packState = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'admin_comments' => $adminComments,
                'user_comments' => $userComments,
                'payment_method' => $paymentMethod,
                'payment_method_cod' => $paymentMethodCod,
                'email' => $email,
                'phone' => $phone,
                'user_login' => $userLogin,
                'delivery_method' => $deliveryMethod,
                'delivery_price' => $deliveryPrice,
                'delivery_fullname' => $deliveryFullname,
                'delivery_company' => $deliveryCompany,
                'delivery_address' => $deliveryAddress,
                'delivery_postcode' => $deliveryPostcode,
                'delivery_city' => $deliveryCity,
                'delivery_state' => $deliveryState,
                'delivery_country_code' => $deliveryCountryCode,
                'delivery_point_id' => $deliveryPointId,
                'delivery_point_name' => $deliveryPointName,
                'delivery_point_address' => $deliveryPointAddress,
                'delivery_point_postcode' => $deliveryPointPostcode,
                'delivery_point_city' => $deliveryPointCity,
                'invoice_fullname' => $invoiceFullname,
                'invoice_company' => $invoiceCompany,
                'invoice_nip' => $invoiceNip,
                'invoice_address' => $invoiceAddress,
                'invoice_postcode' => $invoicePostcode,
                'invoice_city' => $invoiceCity,
                'invoice_state' => $invoiceState,
                'invoice_country_code' => $invoiceCountryCode,
                'want_invoice' => $wantInvoice,
                'extra_field_1' => $extraField1,
                'extra_field_2' => $extraField2,
                'custom_extra_fields' => $customExtraFields,
                'pick_state' => $pickState,
                'pack_state' => $packState,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The addOrderProduct method allows you to add a new product to your order.
     *
     * @param int $orderId Order ID
     * @param string $storage Storage type (db, shop, warehouse)
     * @param string $storageId Storage identifier
     * @param string $name Product name
     * @param int $warehouseId Warehouse ID
     * @param float $priceBrutto Gross price
     * @param float $taxRate VAT rate
     * @param int $quantity Quantity
     * @param string|null $productId Product ID
     * @param string|null $variantId Variant ID
     * @param string|null $auctionId Auction ID
     * @param string|null $sku SKU
     * @param string|null $ean EAN
     * @param string|null $location Location
     * @param string|null $attributes Attributes (e.g. "Color: blue")
     * @param float|null $weight Weight
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderProduct
     */
    public function addOrderProduct(
        int $orderId,
        string $storage,
        string $storageId,
        string $name,
        int $warehouseId,
        float $priceBrutto,
        float $taxRate,
        int $quantity,
        ?string $productId = null,
        ?string $variantId = null,
        ?string $auctionId = null,
        ?string $sku = null,
        ?string $ean = null,
        ?string $location = null,
        ?string $attributes = null,
        ?float $weight = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'storage' => $storage,
                'storage_id' => $storageId,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'auction_id' => $auctionId,
                'name' => $name,
                'sku' => $sku,
                'ean' => $ean,
                'location' => $location,
                'warehouse_id' => $warehouseId,
                'attributes' => $attributes,
                'price_brutto' => $priceBrutto,
                'tax_rate' => $taxRate,
                'quantity' => $quantity,
                'weight' => $weight,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method setOrderProductFields allows you to edit the data of selected items.
     *
     * @param int $orderId Order ID
     * @param int $orderProductId Order product ID
     * @param string $storage Storage type
     * @param string $storageId Storage ID
     * @param string $name Product name
     * @param int $warehouseId Warehouse ID
     * @param float $priceBrutto Gross price
     * @param float $taxRate Tax rate
     * @param int $quantity Quantity
     * @param string|null $productId Product ID
     * @param string|null $variantId Variant ID
     * @param string|null $auctionId Auction ID
     * @param string|null $sku SKU
     * @param string|null $ean EAN
     * @param string|null $location Location
     * @param string|null $attributes Attributes
     * @param float|null $weight Weight
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderProductFields
     */
    public function setOrderProductFields(
        int $orderId,
        int $orderProductId,
        string $storage,
        string $storageId,
        string $name,
        int $warehouseId,
        float $priceBrutto,
        float $taxRate,
        int $quantity,
        ?string $productId = null,
        ?string $variantId = null,
        ?string $auctionId = null,
        ?string $sku = null,
        ?string $ean = null,
        ?string $location = null,
        ?string $attributes = null,
        ?float $weight = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'order_product_id' => $orderProductId,
                'storage' => $storage,
                'storage_id' => $storageId,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'auction_id' => $auctionId,
                'name' => $name,
                'sku' => $sku,
                'ean' => $ean,
                'location' => $location,
                'warehouse_id' => $warehouseId,
                'attributes' => $attributes,
                'price_brutto' => $priceBrutto,
                'tax_rate' => $taxRate,
                'quantity' => $quantity,
                'weight' => $weight,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method deleteOrderProduct allows you to remove a specific product from the order.
     *
     * @param int $orderId
     * @param int $orderProductId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteOrderProduct
     */
    public function deleteOrderProduct(int $orderId, int $orderProductId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'order_product_id' => $orderProductId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method setOrderPayment allows you to add a payment to the order.
     *
     * @param int $orderId
     * @param float $paymentDone Payment amount
     * @param int $paymentDate Payment date (unix timestamp)
     * @param string $paymentComment
     * @param string|null $externalPaymentId External payment ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderPayment
     */
    public function setOrderPayment(
        int $orderId,
        float $paymentDone,
        int $paymentDate,
        string $paymentComment,
        ?string $externalPaymentId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'payment_done' => $paymentDone,
                'payment_date' => $paymentDate,
                'payment_comment' => $paymentComment,
                'external_payment_id' => $externalPaymentId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to change order status.
     *
     * @param int $orderId
     * @param int $statusId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderStatus
     */
    public function setOrderStatus(int $orderId, int $statusId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'status_id' => $statusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to batch set orders statuses.
     *
     * @param array<int, int> $orderIds
     * @param int $statusId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderStatuses
     */
    public function setOrderStatuses(array $orderIds, int $statusId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_ids' => $orderIds,
                'status_id' => $statusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to mark orders with a receipt already issued.
     *
     * @param int $receiptId
     * @param string $receiptNr
     * @param int $date Receipt date (unix timestamp)
     * @param bool $printerError Error occurred during printing
     * @param string|null $printerName
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderReceipt
     */
    public function setOrderReceipt(
        int $receiptId,
        string $receiptNr,
        int $date,
        bool $printerError = false,
        ?string $printerName = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'receipt_id' => $receiptId,
                'receipt_nr' => $receiptNr,
                'date' => $date,
                'printer_error' => $printerError,
                'printer_name' => $printerName,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add an external PDF file to an invoice.
     *
     * @param int $invoiceId
     * @param string $file Base64 encoded PDF with "data:" prefix
     * @param string|null $externalInvoiceNumber
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderInvoiceFile
     */
    public function addOrderInvoiceFile(int $invoiceId, string $file, ?string $externalInvoiceNumber = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'invoice_id' => $invoiceId,
                'file' => $file,
                'external_invoice_number' => $externalInvoiceNumber,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to add an external PDF file to a receipt.
     *
     * @param int $receiptId
     * @param string $file Base64 encoded PDF with "data:" prefix
     * @param string|null $externalReceiptNumber
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderReceiptFile
     */
    public function addOrderReceiptFile(int $receiptId, string $file, ?string $externalReceiptNumber = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'receipt_id' => $receiptId,
                'file' => $file,
                'external_receipt_number' => $externalReceiptNumber,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to get the invoice file from BaseLinker.
     *
     * @param int $invoiceId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getInvoiceFile
     */
    public function getInvoiceFile(int $invoiceId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'invoice_id' => $invoiceId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve order printout templates.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderPrintoutTemplates
     */
    public function getOrderPrintoutTemplates(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method runOrderMacroTrigger allows you to run personal trigger for orders automatic actions.
     *
     * @param int $orderId
     * @param int $triggerId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=runOrderMacroTrigger
     */
    public function runOrderMacroTrigger(int $orderId, int $triggerId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'trigger_id' => $triggerId,
            ]),
        ]);

        return $response->json();
    }

    // ==================== ORDER RETURNS ====================

    /**
     * The method allows you to download a list of order return events.
     *
     * @param int $lastLogId Log ID to start from
     * @param array<int, int> $logsTypes Event ID list
     * @param int|null $orderReturnId Return ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturnJournalList
     */
    public function getOrderReturnJournalList(int $lastLogId, array $logsTypes, ?int $orderReturnId = null): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'last_log_id' => $lastLogId,
                'logs_types' => $logsTypes,
                'return_id' => $orderReturnId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows adding a new order return.
     *
     * @param int|null $orderId Original order ID
     * @param int $orderReturnStatusId Return status ID
     * @param string|null $adminComments
     * @param array<int, array<string, mixed>>|null $products Products to return
     * @param int|null $customSourceId Custom order return source ID
     * @param string|null $referenceNumber External reference number
     * @param int|null $dateAdd Date of return creation (unix timestamp)
     * @param string|null $currency 3-letter currency code
     * @param bool|null $refunded Mark return as refunded
     * @param string|null $email Buyer email
     * @param string|null $phone Buyer phone
     * @param string|null $userLogin Marketplace user login
     * @param float|null $deliveryPrice Gross delivery price
     * @param string|null $deliveryFullname Delivery fullname
     * @param string|null $deliveryCompany Delivery company
     * @param string|null $deliveryAddress Delivery address
     * @param string|null $deliveryPostcode Delivery postcode
     * @param string|null $deliveryCity Delivery city
     * @param string|null $deliveryState Delivery state
     * @param string|null $deliveryCountryCode Delivery country code
     * @param string|null $extraField1 Extra field 1
     * @param string|null $extraField2 Extra field 2
     * @param array<int, mixed>|null $customExtraFields Custom extra fields
     * @param string|null $refundAccountNumber Refund account number
     * @param string|null $refundIban Refund IBAN
     * @param string|null $refundSwift Refund SWIFT
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderReturn
     */
    public function addOrderReturn(
        ?int $orderId,
        int $orderReturnStatusId,
        ?string $adminComments = null,
        ?array $products = null,
        ?int $customSourceId = null,
        ?string $referenceNumber = null,
        ?int $dateAdd = null,
        ?string $currency = null,
        ?bool $refunded = null,
        ?string $email = null,
        ?string $phone = null,
        ?string $userLogin = null,
        ?float $deliveryPrice = null,
        ?string $deliveryFullname = null,
        ?string $deliveryCompany = null,
        ?string $deliveryAddress = null,
        ?string $deliveryPostcode = null,
        ?string $deliveryCity = null,
        ?string $deliveryState = null,
        ?string $deliveryCountryCode = null,
        ?string $extraField1 = null,
        ?string $extraField2 = null,
        ?array $customExtraFields = null,
        ?string $refundAccountNumber = null,
        ?string $refundIban = null,
        ?string $refundSwift = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'status_id' => $orderReturnStatusId,
                'custom_source_id' => $customSourceId,
                'reference_number' => $referenceNumber,
                'date_add' => $dateAdd,
                'currency' => $currency,
                'refunded' => $refunded,
                'admin_comments' => $adminComments,
                'email' => $email,
                'phone' => $phone,
                'user_login' => $userLogin,
                'delivery_price' => $deliveryPrice,
                'delivery_fullname' => $deliveryFullname,
                'delivery_company' => $deliveryCompany,
                'delivery_address' => $deliveryAddress,
                'delivery_postcode' => $deliveryPostcode,
                'delivery_city' => $deliveryCity,
                'delivery_state' => $deliveryState,
                'delivery_country_code' => $deliveryCountryCode,
                'extra_field_1' => $extraField1,
                'extra_field_2' => $extraField2,
                'custom_extra_fields' => $customExtraFields,
                'products' => $products,
                'refund_account_number' => $refundAccountNumber,
                'refund_iban' => $refundIban,
                'refund_swift' => $refundSwift,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method returns extra fields defined for order returns.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturnExtraFields
     */
    public function getOrderReturnExtraFields(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download order returns.
     *
     * @param int|null $orderReturnId Return ID
     * @param int|null $orderId Original order ID
     * @param int|null $dateFrom Date from (unix timestamp)
     * @param int|null $idFrom Return ID to start from
     * @param int|null $statusId Filter by status
     * @param bool $includeCustomExtraFields Include extra fields
     * @param string|null $filterOrderReturnSource Filter by return source
     * @param int|null $filterOrderReturnSourceId Filter by return source ID
     * @param bool $includeConnectData Include Base Connect data
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturns
     */
    public function getOrderReturns(
        ?int $orderReturnId = null,
        ?int $orderId = null,
        ?int $dateFrom = null,
        ?int $idFrom = null,
        ?int $statusId = null,
        bool $includeCustomExtraFields = false,
        ?string $filterOrderReturnSource = null,
        ?int $filterOrderReturnSourceId = null,
        bool $includeConnectData = false
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'order_id' => $orderId,
                'date_from' => $dateFrom,
                'id_from' => $idFrom,
                'status_id' => $statusId,
                'include_custom_extra_fields' => $includeCustomExtraFields,
                'filter_order_return_source' => $filterOrderReturnSource,
                'filter_order_return_source_id' => $filterOrderReturnSourceId,
                'include_connect_data' => $includeConnectData,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download order return statuses.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturnStatusList
     */
    public function getOrderReturnStatusList(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve payment/refund history for an order return.
     *
     * @param int $orderReturnId
     * @param bool $showFullHistory
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturnPaymentsHistory
     */
    public function getOrderReturnPaymentsHistory(int $orderReturnId, bool $showFullHistory = false): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'show_full_history' => $showFullHistory,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to edit order return fields.
     *
     * @param int $orderReturnId
     * @param string|null $adminComments
     * @param array<int, mixed>|null $customExtraFields
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderReturnFields
     */
    public function setOrderReturnFields(
        int $orderReturnId,
        ?string $adminComments = null,
        ?array $customExtraFields = null,
        ?string $extraField1 = null,
        ?string $extraField2 = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'admin_comments' => $adminComments,
                'custom_extra_fields' => $customExtraFields,
                'extra_field_1' => $extraField1,
                'extra_field_2' => $extraField2,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to add a product to an order return.
     *
     * @param int $orderReturnId
     * @param int $orderProductId Original order product ID
     * @param int $quantity Quantity to return
     * @param int|null $reasonId Return reason ID
     * @param int|null $productStatusId Product status ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=addOrderReturnProduct
     */
    public function addOrderReturnProduct(
        int $orderReturnId,
        int $orderProductId,
        int $quantity,
        ?int $reasonId = null,
        ?int $productStatusId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'order_product_id' => $orderProductId,
                'quantity' => $quantity,
                'reason_id' => $reasonId,
                'product_status_id' => $productStatusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to edit a product in an order return.
     *
     * @param int $orderReturnId
     * @param int $orderReturnProductId
     * @param int $quantity
     * @param int|null $reasonId
     * @param int|null $productStatusId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderReturnProductFields
     */
    public function setOrderReturnProductFields(
        int $orderReturnId,
        int $orderReturnProductId,
        int $quantity,
        ?int $reasonId = null,
        ?int $productStatusId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'order_return_product_id' => $orderReturnProductId,
                'quantity' => $quantity,
                'reason_id' => $reasonId,
                'product_status_id' => $productStatusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to delete a product from an order return.
     *
     * @param int $orderReturnId
     * @param int $orderReturnProductId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=deleteOrderReturnProduct
     */
    public function deleteOrderReturnProduct(int $orderReturnId, int $orderReturnProductId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'order_return_product_id' => $orderReturnProductId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows to add a refund to an order return.
     *
     * @param int $orderReturnId
     * @param float $refundDone Refund amount
     * @param int $refundDate Refund date (unix timestamp)
     * @param string $refundComment
     * @param string|null $externalRefundId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderReturnRefund
     */
    public function setOrderReturnRefund(
        int $orderReturnId,
        float $refundDone,
        int $refundDate,
        string $refundComment,
        ?string $externalRefundId = null
    ): array {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'refund_done' => $refundDone,
                'refund_date' => $refundDate,
                'refund_comment' => $refundComment,
                'external_refund_id' => $externalRefundId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download return reasons list.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturnReasonsList
     */
    public function getOrderReturnReasonsList(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to change order return status.
     *
     * @param int $orderReturnId
     * @param int $statusId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderReturnStatus
     */
    public function setOrderReturnStatus(int $orderReturnId, int $statusId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'status_id' => $statusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to batch change order return statuses.
     *
     * @param array<int, int> $orderReturnIds
     * @param int $statusId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=setOrderReturnStatuses
     */
    public function setOrderReturnStatuses(array $orderReturnIds, int $statusId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_ids' => $orderReturnIds,
                'status_id' => $statusId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to run a macro trigger for order returns.
     *
     * @param int $orderReturnId
     * @param int $triggerId
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=runOrderReturnMacroTrigger
     */
    public function runOrderReturnMacroTrigger(int $orderReturnId, int $triggerId): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'return_id' => $orderReturnId,
                'trigger_id' => $triggerId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download order return product statuses.
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getOrderReturnProductStatuses
     */
    public function getOrderReturnProductStatuses(): array
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }
}
