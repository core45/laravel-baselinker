<?php

namespace Core45\LaravelBaselinker\Baselinker;

class Order extends LaravelBaselinker
{
    /**
     * The method allows you to download a list of order events from the last 3 days.
     *
     * @param int $lastLogId Log ID number from which the logs are to be retrieved
     * @param array $logsTypes Event ID List
     * @param int|null $orderId Order ID number
     *
     * @return array
     *
     * Example:
     * ->getJournalList(654258, [7, 13])
     */
    public function getJournalList(
        int $lastLogId,
        array $logsTypes,
        ?int $orderId = null,
    )
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
     * todo: test and check which parameters are required
     *
     * @param int $orderStatusId Order status (the list available to retrieve with getOrderStatusList)
     * @param int|null $customSourceId (optional) Identifier of custom order source defined in BaseLinker panel. If not provided, default order source is assigned.
     * @param int $dateAdd Date of order creation (in unix time format)
     * @param string $currency 3-letter currency symbol (e.g. EUR, PLN)
     * @param string $paymentMethod
     * @param integer $paymentMethodCod Flag indicating whether the type of payment is COD (cash on delivery)
     * @param integer $paid Information whether the order is already paid. The value "1" automatically adds a full payment to the order.
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
     * @param string $deliveryCountryCode Delivery address - country code (two-letter, e.g. EN)
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
     * @param string $invoiceCountryCode Billing details - country code (two-letter, e.g. EN)
     * @param int $wantInvoice Flag indicating whether the customer wants an invoice (1 - yes, 0 - no)
     * @param string $extraField1
     * @param string $extraField2
     * @param array $customExtraFields A list containing order custom extra fields, where the key is the extra field ID and value is an extra field content for given extra field. The list of extra fields can be retrieved with getOrderExtraFields method.
     * In case of removing a field the empty string is expected.
     * In case of file the following format is expected:
     * {
     * "title": "file.pdf" (varchar(40) - the file name)
     * "file": "data:4AAQSkZJRgABA[...]" (binary - the file body limited to 2MB)
     * }
     *
     * @param array $products Order product array. Each element of the array is also an array containing fields:
     * storage (varchar) - type of magazine from which the product comes (available values: "db" - BaseLinker internal catalog, "shop" - the online store magazine, "warehouse" - a connected wholesaler).
     * storage_id (int) - the identifier of the magazine from which the product comes (one of the shops connected to the account). Value "0" for a product from the BaseLinker internal catalog.
     * product_id (varchar) - Product identifier in BaseLinker or store magazine. Blank if the product number is unknown
     * variant_id (int) - Product variant ID. Blank if the variant number is unknown
     * name (varchar) - Product name
     * sku (varchar) - Product sku
     * ean (varchar) - Product ean
     * location (varchar) - Product location
     * warehouse_id (int) - Product source warehouse identifier. Only applies to products from BaseLinker inventory. By default warehouse_id is determined based on the source of the order.
     * attributes (varchar) - Specific product attributes (e.g. "Color: blue")
     * price_brutto (float) - Single item gross price
     * tax_rate (float) - VAT tax rate e.g. "23", (value from range 0-100, EXCEPTION values: "-1" for "EXPT"/"ZW" exempt from VAT, "-0.02" for "NP" annotation, "-0.03" for "OO" VAT reverse charge)
     * quantity (int) - Quantity of pieces
     * weight (float) - Single item weight
     *
     * @return array
     *
     * @see https://api.baselinker.com/?method=addOrder
     */
    public function addOrder(
        int $orderStatusId,
        ?int $customSourceId = null,
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
    )
    {
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
     * The method returns types of order sources along with their IDs.
     * Order sources are grouped by their type that corresponds to a field order_source from the getOrders method.
     * Available source types are "personal", "shop" or "marketplace_code" e.g. "ebay", "amazon", "ceneo", "emag", "allegro", etc.
     *
     * @return array
     *
     * Example:
     * ->getOrderSources()
     *
     * @see https://api.baselinker.com/index.php?method=getOrderSources
     */
    public function getOrderSources()
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method returns extra fields defined for the orders. Values of those fields can be set with method setOrderFields.
     * In order to retrieve values of those fields set parameter include_custom_extra_fields in method getOrders
     *
     * @return array
     *
     * Example:
     * ->getOrderExtraFields()
     *
     * @see https://api.baselinker.com/index.php?method=getOrderExtraFields
     */
    public function getOrderExtraFields()
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The getOrders method allows you to download orders from a specific date from the BaseLinker order manager.
     * The order list can be limited using the filters described in the method parameters.
     * A maximum of 100 orders are returned at a time.
     *
     * It is recommended to download only confirmed orders (get_unconfirmed_orders = false). Unconfirmed orders may be incomplete. The user may be, for example, in the process of creating an order - it already exists in the database, but not all information is completed. Unconfirmed orders may contain only a partial list of products and may be changed soon. Confirmed orders usually do not change anymore and can be safely downloaded to an external system.
     *
     * The best way to download the ongoing orders is:
     * Collecting new order identifiers using getJournalList.
     *
     * Or, using this method:
     * 1. Setting the starting date and specifying it in the date_confirmed_from field
     * 2. Processing of all received orders. If 100 orders are received, there may be even more to download.
     * 3. Downloading the next package of orders by entering the value of the date_confirmed field from last downloaded order in the date_confirmed_from field. In order to avoid downloading the same orders value of date_confirmed should be increased by 1 second. This operation is repeated until you receive a package with less than 100 orders (this means that there are no more orders left to download).
     * 4. Saving the date_confirmed last processed order. You can download orders from this date onwards so that you do not download the same order twice. It is not possible for an order to 'jump' into the database with an earlier confirmation date. This way you can be sure that all confirmed orders have been downloaded.
     *
     * @param int|null $orderId (optional) Order identifier. Completing this field will download information about only one specific order.
     * @param int|null $dateConfirmedFrom (optional) Date of order confirmation from which orders are to be collected. Format unix time stamp.
     * @param int|null $dateFrom (optional) The order date from which orders are to be collected. Format unix time stamp.
     * @param int|null $idFrom (optional) The order ID number from which subsequent orders are to be collected.
     * @param bool|null $getUnconfirmedOrders (optional, false by default) Download unconfirmed orders as well (this is e.g. an order from Allegro to which the customer has not yet completed the delivery form). Default is false. Unconfirmed orders may not be complete yet, the shipping method and price is also unknown.
     * @param bool|null $includeCustomExtraFields (optional, false by default) Download values of custom additional fields.
     * @param int|null $statusId (optional) The status identifier from which orders are to be collected. Leave blank to download orders from all statuses.
     * @param string|null $filterEmail (optional) Filtering of order lists by e-mail address (displays only orders with the given e-mail address).
     * @param string|null $filterOrderSource (optional) Filtering of order lists by order source, for instance "ebay", "amazon" (displays only orders come from given source). The list of order sources can be retrieved with getOrderSources method.
     * @param string|null $filterOrderSourceId (optional) Filtering of order lists by order source identifier, for instance "2523" (displays only orders come from order source defined in "filter_order_source" identified by given order source identifier). Filtering by order source indentifier requires "filter_order_source" to be set prior. The list of order source identifiers can be retrieved with getOrderSources method.
     *
     * @return array
     */
    public function getOrders(
        ?int $orderId = null,
        ?int $dateConfirmedFrom = null,
        ?int $dateFrom = null,
        ?int $idFrom = null,
        ?bool $getUnconfirmedOrders = false,
        ?bool $includeCustomExtraFields = false,
        ?int $statusId = null,
        ?string $filterEmail = null,
        ?string $filterOrderSource = null,
        ?string $filterOrderSourceId = null,
    )
    {
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
     * The method allows you to retrieve transaction details for a selected order (it now works only for orders from Amazon)
     *
     * @param int $orderId
     *
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=getOrderTransactionDetails
     */
    public function getOrderTransactionDetails(int $orderId)
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
     * The method allows to search for orders related to the given e-mail address.
     *
     * @param string $email varchar(50)	The e-mail address we search for in orders.
     *
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=getOrdersByEmail
     */
    public function getOrdersByEmail(string $email)
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
     * @param string $phone varchar(50)	The phone number we search for in orders.
     *
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=getOrdersByPhone
     */
    public function getOrdersByPhone(string $phone)
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
     * The addInvoice method allows to issue an order invoice.
     *
     * @param string $orderId Order Identifier from BaseLinker order manager
     * @param string $seriesId Series numbering identifier
     * @param string|null $vatRate (optional) VAT rate - parameter accepts values:
     * - "DEFAULT": according to the numbering series (is set as default value)
     * - "ITEM": use the rate assigned to the item of the order
     * - "EXPT" / "ZW": exempt from VAT
     * - "NP": annotation NP
     * - "OO": VAT reverse charge
     * - value: number from range 0-100
     *
     * @return array
     *
     * Example:
     * ->addInvoice('3754894', '15')
     *
     */
    public function addInvoice(
        string $orderId,
        string $seriesId,
        ?string $vatRate = null,
    )
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
     * The method getInvoices allows you to download invoices issued from the BaseLinker order manager.
     * The list of invoices can be limited using filters described in the method parameters.
     * Maximum 100 invoices are returned at a time.
     *
     * @param int|null $invoiceId (optional) Invoice identifier. Completing this field will result in downloading information about only one specific invoice.
     * @param int|null $orderId (optional) Order identifier. Completing this field will result in downloading information only about the invoice associated with this order (if the order has an invoice created).
     * @param int|null $dateFrom (optional) Date from which invoices are to be collected. Unix time stamp format.
     * @param int|null $idFrom (optional) The invoice ID number from which subsequent invoices are to be retrieved.
     * @param int|null $seriesId (optional) numbering series ID that allows filtering after the invoice numbering series.
     * @param bool|null $getExternalInvoices If set to 'false' then omits from the results invoices that already have an external invoice file uploaded by addOrderInvoiceFile method (useful for ERP integrations uploading invoice files to BaseLinker)
     *
     * @return array
     *
     * Example:
     * ->getInvoices(null, null, 1407341754)
     *
     * @see https://api.baselinker.com/index.php?method=getInvoices
     */
    public function getInvoices(
        ?int $invoiceId = null,
        ?int $orderId = null,
        ?int $dateFrom = null,
        ?int $idFrom = null,
        ?int $seriesId = null,
        ?bool $getExternalInvoices = true,
    )
    {
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
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=getSeries
     */
    public function getSeries()
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download order statuses created by the customer in the BaseLinker order manager.
     *
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=getOrderStatusList
     */
    public function getOrderStatusList()
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve payment history for a selected order, including an external payment identifier from the payment gateway.
     * One order can have multiple payment history entries, caused by surcharges, order value changes, manual payment editing
     *
     * @param int $orderId
     * @param bool $showFullHistory
     * @return array
     *
     * Example:
     * ->getOrderPaymentsHistory(3754894)
     *
     * @see https://api.baselinker.com/index.php?method=getOrderPaymentsHistory
     */
    public function getOrderPaymentsHistory(
        int $orderId,
        bool $showFullHistory = false,
    )
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
     * The getNewReceipts method allows you to retrieve receipts waiting to be issued.
     * This method should be used in creating integration with a fiscal printer.
     * The method can be requested for new receipts every e.g. 10 seconds.
     * If any receipts appear in response, they should be confirmed by the setOrderReceipt method after printing to disappear from the waiting list.
     *
     * @param int|null $seriesId (optional) The numbering series ID allows filtering by the receipt numbering series. Using multiple series numbering for receipts is recommended when the user has multiple fiscal printers. Each fiscal printer should have a separate series.
     * @param int|null $idFrom (optional) ID from which logs are to be retrieved. [default=0]
     *
     * @return array
     *
     * Example:
     * ->getNewReceipts(0, 1)
     *
     * @see https://api.baselinker.com/index.php?method=getNewReceipts
     */
    public function getNewReceipts(
        ?int $seriesId = null,
        int $idFrom = 0,
    )
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
     * The method allows you to retrieve a single receipt from the BaseLinker order manager.
     * To retrieve a list of new receipts (when integrating a fiscal printer), use the getNewReceipts method.
     *
     * @param int $receiptId
     * @param int $orderId
     *
     * @return array
     *
     * Example:
     * ->getReceipt(143476260)
     *
     * @see https://api.baselinker.com/index.php?method=getReceipt
     */
    public function getReceipt(
        int $orderId,
        ?int $receiptId = null,
    )
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
     * The method allows you to edit selected fields (e.g. address data, notes, etc.) of a specific order.
     * Only the fields that you want to edit should be given, other fields can be omitted in the request.
     *
     * @param int $orderId Order identifier from the BaseLinker order manager. Field required. Other fields are optional.
     * @param string|null $adminComments
     * @param string|null $userComments
     * @param string|null $paymentMethod
     * @param int|null $paymentMethodCod bool	Flag indicating whether the type of payment is COD (cash on delivery)
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
     * @param string|null $deliveryCountryCode char(2)	Delivery address - country code (two-letter, e.g. EN)
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
     * @param string|null $invoiceCountryCode char(2)	Billing details - country code (two-letter, e.g. EN)
     * @param int|null $wantInvoice Flag indicating whether the customer wants an invoice (1 - yes, 0 - no)
     * @param string|null $extraField1
     * @param string|null $extraField2
     *
     * @param array|null $customExtraFields A list containing order custom extra fields, where the key is the extra field ID and value is an extra field content for given extra field. The list of extra fields can be retrieved with getOrderExtraFields method.
     * In case of removing a field the empty string is expected.
     * In case of file the following format is expected:
     * {
     * "title": "file.pdf" (varchar(40) - the file name)
     * "file": "data:4AAQSkZJRgABA[...]" (binary - the file body limited to 2MB)
     * }
     *
     * @param string|null $pickState Flag indicating the status of the order products collection (1 - all products have been collected, 0 - not all products have been collected)
     * @param string|null $packState Flag indicating the status of the order products packing (1 - all products have been packed, 0 - not all products have been packed)
     *
     * @return array
     *
     * Example:
     * ->setOrderFields(3754894)
     *
     * @see https://api.baselinker.com/index.php?method=setOrderFields
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
        ?string $packState = null,
    )
    {
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
     * todo: test and check which parameters are required
     *
     * @param int $orderId Order Identifier from BaseLinker order manager
     * @param string $storage varchar(9)	Type of product source storage (available values: "db" - BaseLinker internal catalog, "shop" - online shop storage, "warehouse" - the connected wholesaler)
     * @param string $storageId The identifier of the storage (inventory/shop/warehouse) from which the product comes.
     * @param string|null $productId Product identifier in BaseLinker or shop storage. Blank if the product number is not known
     * @param string|null $variantId Product variant ID. Blank if the variant number is unknown
     * @param string|null $auctionId Listing ID number (if the order comes from ebay/allegro)
     * @param string $name
     * @param string $sku
     * @param string $ean
     * @param string $location
     * @param int $warehouseId Product source warehouse identifier. Only applies to products from BaseLinker inventory. By default warehouse_id is determined based on the warehouse identifiers in the existing products of the order. If no such product exist, it will be determined based on the source of the order
     * @param string $attributes varchar(150) The detailed product attributes, e.g. "Colour: blue" (Variant name)
     * @param float $priceBrutto Single item gross price
     * @param float $taxRate VAT tax rate e.g. "23", (value from range 0-100, EXCEPTION values: "-1" for "EXPT"/"ZW" exempt from VAT, "-0.02" for "NP" annotation, "-0.03" for "OO" VAT reverse charge)
     * @param int $quantity
     * @param float|null $weight
     *
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=addOrderProduct
     */
    public function addOrderProduct(
        int $orderId,
        string $storage,
        string $storageId,
        ?string $productId = null,
        ?string $variantId = null,
        ?string $auctionId = null,
        string $name,
        ?string $sku = null,
        ?string $ean = null,
        ?string $location = null,
        int $warehouseId,
        ?string $attributes = null,
        float $priceBrutto,
        float $taxRate,
        int $quantity,
        ?float $weight = null,
    )
    {
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
     * The method setOrderProductFields allows you to edit the data of selected items (e.g. prices, quantities etc.) of a specific order.
     * Only the fields that you want to edit should be given, the remaining fields can be omitted in the request.
     *
     * todo: test and check which parameters are required
     *
     * @param int $orderId
     * @param int $orderProductId
     * @param string $storage varchar(9)    Type of product source storage (available values: "db" - BaseLinker internal catalog, "shop" - online shop storage, "warehouse" - the connected wholesaler)
     * @param string $storageId The identifier of the storage (inventory/shop/warehouse) from which the product comes.
     * @param string|null $productId Product identifier in BaseLinker or shop storage. Blank if the product number is not known
     * @param string|null $variantId Product variant ID. Blank if the variant number is unknown
     * @param string|null $auctionId Listing ID number (if the order comes from ebay/allegro)
     * @param string $name
     * @param string|null $sku
     * @param string|null $ean
     * @param string|null $location
     * @param int $warehouseId Product source warehouse identifier. Only applies to products from BaseLinker inventory. By default warehouse_id is determined based on the warehouse identifiers in the existing products of the order. If no such product exist, it will be determined based on the source of the order
     * @param string $attributes varchar(150) The detailed product attributes, e.g. "Colour: blue" (Variant name)
     * @param float $priceBrutto Single item gross price
     * @param float $taxRate VAT tax rate e.g. "23", (value from range 0-100, EXCEPTION values: "-1" for "EXPT"/"ZW" exempt from VAT, "-0.02" for "NP" annotation, "-0.03" for "OO" VAT reverse charge)* @param int $quantity
     * @param float|null $weight
     *
     * @return array
     *
     * @see https://api.baselinker.com/index.php?method=setOrderProductFields
     */
    public function setOrderProductFields(
        int $orderId,
        int $orderProductId,
        string $storage,
        string $storageId,
        ?string $productId = null,
        ?string $variantId = null,
        ?string $auctionId = null,
        string $name,
        ?string $sku = null,
        ?string $ean = null,
        ?string $location = null,
        int $warehouseId,
        ?string $attributes = null,
        float $priceBrutto,
        float $taxRate,
        int $quantity,
        ?float $weight = null,
    )
    {
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
     *
     * @return array
     *
     * Example:
     * ->deleteOrderProduct(3754894, 59157160)
     *
     * @see https://api.baselinker.com/index.php?method=deleteOrderProduct
     */
    public function deleteOrderProduct(
        int $orderId,
        int $orderProductId,
    )
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
     * @param float $paymentDone The amount of the payment. The value changes the current payment in the order (not added to the previous value). If the amount matches the order value, the order will be marked as paid.
     * @param int $paymentDate Payment date unixtime.
     * @param string $paymentComment varchar(30)
     * @param string|null $externalPaymentId varchar(30) (optional) External payment identifier
     *
     * @return array
     *
     * Example:
     * ->setOrderPayment(3754894, 120.57, 1444736731, 'bank transfer mBank 12.10.2015')
     */
    public function setOrderPayment(
        int $orderId,
        float $paymentDone,
        int $paymentDate,
        string $paymentComment,
        ?string $externalPaymentId = null,
    )
    {
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
     *
     * @return array
     *
     * Example:
     * ->setOrderStatus(3754894, 34562)
     *
     * @see https://api.baselinker.com/index.php?method=setOrderStatus
     */
    public function setOrderStatus(
        int $orderId,
        int $statusId,
    )
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
     * The method allows you to batch set orders statuses
     *
     * @param array $orderIds
     * @param int $statusId Status ID number. The status list can be retrieved using getOrderStatusList.
     *
     * @return array
     *
     * Example:
     * ->setOrderStatuses([3754894, 3754895], 2)
     *
     * @see https://api.baselinker.com/index.php?method=setOrderStatuses
     */
    public function setOrderStatuses(
        array $orderIds,
        int $statusId,
    )
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
     * @param int $receiptId Receipt_id number received in the getNewReceipts method
     * @param string $receiptNr The number of the issued receipt (may be blank if the printer does not return the number)
     * @param int $date Receipt printing date (unixtime format)
     * @param bool $printerError Flag indicating whether an error occurred during receipt printing (false by default)
     * @param string|null $printerName
     *
     * @return array
     *
     * Example:
     * ->setOrderReceipt(143476260, 'FV/2015/10/12/0001', 1444736731)
     *
     * @see https://api.baselinker.com/index.php?method=setOrderReceipt
     */
    public function setOrderReceipt(
        int $receiptId,
        string $receiptNr,
        int $date,
        bool $printerError = false,
        ?string $printerName = null,
    )
    {
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
     * The method allows you to add an external PDF file to an invoice previously issued from BaseLinker.
     * It enables replacing a standard invoice from BaseLinker with an invoice issued e.g. in an ERP program.
     *
     * @param int $invoiceId BaseLinker invoice identifier
     * @param string $file Invoice PDF file in binary format encoded in base64, at the very beginning of the invoice string provide a prefix "data:" e.g. "data:4AAQSkSzkJRgABA[...]"
     * @param string|null $externalInvoiceNumber External system invoice number (overwrites BaseLinker invoice number)
     *
     * @return array
     *
     * Example:
     * ->addOrderInvoiceFile(143476260, 'data:4AAQSkZJRgABA[...]', 'FV/2015/10/12/0001')
     *
     * @see https://api.baselinker.com/index.php?method=addOrderInvoiceFile
     */
    public function addOrderInvoiceFile(
        int $invoiceId,
        string $file,
        ?string $externalInvoiceNumber = null,
    )
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
     * The method allows you to add an external PDF file to a receipt previously issued from BaseLinker.
     * It enables replacing a standard receipt from BaseLinker with a receipt issued e.g. in an ERP program.
     *
     * @param int $receiptId BaseLinker receipt identifier
     * @param string $file Receipt PDF file in binary format encoded in base64, at the very beginning of the receipt string provide a prefix "data:" e.g. "data:4AAQSkSzkJRgABA[...]"
     * @param string|null $externalReceiptNumber External system receipt number (overwrites BaseLinker receipt number)
     *
     * @return array
     *
     * Example:
     * ->addOrderReceiptFile(143476260, 'data:4AAQSkZJRgABA[...]', 'FV/2015/10/12/0001')
     *
     * @see https://api.baselinker.com/index.php?method=addOrderReceiptFile
     */
    public function addOrderReceiptFile(
        int $receiptId,
        string $file,
        ?string $externalReceiptNumber = null,
    )
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
     * @param int $invoiceId BaseLinker invoice identifier
     *
     * @return array
     *
     * Example:
     * ->getInvoiceFile(153845)
     *
     * @see https://api.baselinker.com/index.php?method=getInvoiceFile
     */
    public function getInvoiceFile(int $invoiceId)
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
     * The method runOrderMacroTrigger allows you to run personal trigger for orders automatic actions.
     *
     * @param int $orderId
     * @param int $triggerId
     *
     * @return array
     *
     * Example:
     * ->runOrderMacroTrigger(153845, 12413)
     *
     * @see https://api.baselinker.com/index.php?method=runOrderMacroTrigger
     */
    public function runOrderMacroTrigger(
        int $orderId,
        int $triggerId,
    )
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
}
