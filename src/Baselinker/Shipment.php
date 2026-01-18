<?php declare(strict_types=1);

namespace Core45\LaravelBaselinker\Baselinker;

class Shipment extends LaravelBaselinker
{
    /**
     * The method createPackage allows you to create a shipment in the system of the selected courier.
     *
     * @param int $orderId Order ID
     * @param string $courierCode Courier code (retrieved from getCouriersList)
     * @param array<int, array{id: string, value: string}> $fields List of form fields retrieved from getCourierFields
     *                                                              For checkbox with multiple selection, send separate arrays:
     *                                                              [["id" => "services", "value" => "sms"], ["id" => "services", "value" => "email"]]
     * @param array<int, array<string, mixed>> $packages Array of packages. Weight of at least one package required.
     *                                                    As a key use the field 'id' from packages_fields in getCourierFields response.
     *                                                    Height, length, width in centimeters. Weight in kilograms.
     *                                                    Example: [["weight" => "1", "height" => "25"]]
     * @param int|null $accountId Courier API account id from getCourierAccounts. If blank, the first account will be used.
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->createPackage(6910995, 'dpd', [['id' => 'cod', 'value' => '0']], [['weight' => '1']])
     *
     * @see https://api.baselinker.com/?method=createPackage
     */
    public function createPackage(
        int $orderId,
        string $courierCode,
        array $fields,
        array $packages,
        ?int $accountId = null
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'courier_code' => $courierCode,
                'account_id' => $accountId,
                'fields' => $fields,
                'packages' => $packages,
            ]),
        ]);
    }

    /**
     * The method createPackageManual allows you to enter the shipping number and the name of the courier to the order.
     * Used only to add shipments created outside BaseLinker.
     *
     * @param int $orderId Order ID
     * @param string $courierCode Courier code (from getCouriersList or custom courier name)
     * @param string $packageNumber Shipping number (consignment number)
     * @param string $pickupDate Date of dispatch (unix time format)
     * @param bool $returnShipment Marks package as return shipment
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->createPackageManual(6910995, 'dpd', '123456789', '1622505600', false)
     *
     * @see https://api.baselinker.com/?method=createPackageManual
     */
    public function createPackageManual(
        int $orderId,
        string $courierCode,
        string $packageNumber,
        string $pickupDate,
        bool $returnShipment = false
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'courier_code' => $courierCode,
                'package_number' => $packageNumber,
                'pickup_date' => $pickupDate,
                'return_shipment' => $returnShipment,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve a list of available couriers.
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getCouriersList()
     *
     * @see https://api.baselinker.com/?method=getCouriersList
     */
    public function getCouriersList(): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
        ]);
    }

    /**
     * The method allows you to retrieve the form fields for creating shipments for the selected courier.
     *
     * @param string $courierCode Courier code (retrieved from getCouriersList)
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getCourierFields('dpd')
     *
     * @see https://api.baselinker.com/?method=getCourierFields
     */
    public function getCourierFields(string $courierCode): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve additional courier services, which depend on other shipment settings.
     * Used only for X-press, BrokerSystem, Wysyłam z Allegro, ErliPRO couriers.
     * Not applicable to other couriers whose forms have fixed options.
     *
     * @param string $courierCode Courier code
     * @param string $packageNumber Package number
     * @param array<int, array{id: string, value: string}> $fields List of form fields from getCourierFields
     * @param array<int, array<string, mixed>> $packages Array of packages with weight, dimensions etc.
     * @param int|null $accountId Courier API account id from getCourierAccounts
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getCourierServices
     */
    public function getCourierServices(
        string $courierCode,
        string $packageNumber,
        array $fields,
        array $packages,
        ?int $accountId = null
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_number' => $packageNumber,
                'account_id' => $accountId,
                'fields' => $fields,
                'packages' => $packages,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve the list of accounts connected to a given courier.
     *
     * @param string $courierCode Courier code (retrieved from getCouriersList)
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getCourierAccounts('pkwid')
     *
     * @see https://api.baselinker.com/?method=getCourierAccounts
     */
    public function getCourierAccounts(string $courierCode): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
            ]),
        ]);
    }

    /**
     * The method allows you to download a shipping label (consignment) for a selected shipment.
     *
     * @param string $courierCode Courier code
     * @param int $packageId Shipment ID
     * @param string|null $packageNumber Shipping number (consignment number)
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getLabel('dpd', 123456789)
     *
     * @see https://api.baselinker.com/?method=getLabel
     */
    public function getLabel(
        string $courierCode,
        int $packageId,
        ?string $packageNumber = null
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_id' => $packageId,
                'package_number' => $packageNumber,
            ]),
        ]);
    }

    /**
     * The method allows you to download a parcel protocol for selected shipments if the protocol is available for chosen courier.
     *
     * @param string $courierCode Courier code
     * @param array<int>|null $packageIds Array of shipment IDs (optional if packageNumbers provided)
     * @param array<string>|null $packageNumbers Array of shipment numbers (optional if packageIds provided)
     * @param int|null $accountId Courier API account id from getCourierAccounts
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getProtocol('raben', [123456789, 123456790], null)
     * ->getProtocol('raben', null, ['7323859', '8421839'])
     *
     * @see https://api.baselinker.com/?method=getProtocol
     */
    public function getProtocol(
        string $courierCode,
        ?array $packageIds = null,
        ?array $packageNumbers = null,
        ?int $accountId = null
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_ids' => $packageIds,
                'package_numbers' => $packageNumbers,
                'account_id' => $accountId,
            ]),
        ]);
    }

    /**
     * The method allows you to download a courier document.
     *
     * @param string $courierCode Courier code
     * @param string $documentType Document type (e.g. "manifest")
     * @param int|null $accountId Courier API account id from getCourierAccounts
     * @param array<int>|null $packageIds Array of shipment IDs (optional if packageNumbers provided)
     * @param array<string>|null $packageNumbers Array of shipment numbers (optional if packageIds provided)
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getCourierDocument
     */
    public function getCourierDocument(
        string $courierCode,
        string $documentType,
        ?int $accountId = null,
        ?array $packageIds = null,
        ?array $packageNumbers = null
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'document_type' => $documentType,
                'account_id' => $accountId,
                'package_ids' => $packageIds,
                'package_numbers' => $packageNumbers,
            ]),
        ]);
    }

    /**
     * The method allows you to download shipments previously created for the selected order.
     *
     * @param int $orderId Order ID
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getOrderPackages(6910995)
     *
     * @see https://api.baselinker.com/?method=getOrderPackages
     */
    public function getOrderPackages(int $orderId): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve package details.
     *
     * @param int $packageId Shipment ID
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=getPackageDetails
     */
    public function getPackageDetails(int $packageId): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'package_id' => $packageId,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve the history of the status list of the given shipments.
     * Maximum 100 shipments at a time.
     *
     * @param array<int> $packageIds Array of shipment IDs
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getCourierPackagesStatusHistory([123456789, 123456790])
     *
     * @see https://api.baselinker.com/?method=getCourierPackagesStatusHistory
     */
    public function getCourierPackagesStatusHistory(array $packageIds): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'package_ids' => $packageIds,
            ]),
        ]);
    }

    /**
     * The method allows you to delete a previously created shipment.
     * Removes the shipment from BaseLinker and from the courier system if the courier API allows it.
     *
     * @param string $courierCode Courier code
     * @param int $packageId Shipment ID (optional if packageNumber provided)
     * @param string|null $packageNumber Shipping number (optional if packageId provided)
     * @param bool $forceDelete Force removal from BaseLinker even if courier API deletion fails
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->deleteCourierPackage('dpd', 123456789)
     *
     * @see https://api.baselinker.com/?method=deleteCourierPackage
     */
    public function deleteCourierPackage(
        string $courierCode,
        int $packageId,
        ?string $packageNumber = null,
        bool $forceDelete = false
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_id' => $packageId,
                'package_number' => $packageNumber,
                'force_delete' => $forceDelete,
            ]),
        ]);
    }

    /**
     * Alias for runRequestParcelPickup.
     *
     * @param string $courierCode Courier code
     * @param array<int>|null $packageIds Array of shipment IDs (optional if packageNumbers provided)
     * @param array<string>|null $packageNumbers Array of shipment numbers (optional if packageIds provided)
     * @param int|null $accountId Courier API account id from getCourierAccounts
     * @param array<int, array{id: string, value: string}>|null $fields List of fields from getRequestParcelPickupFields
     *                                                                   Example: [["id" => "pickup_date", "value" => "1642416311"]]
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=runRequestParcelPickup
     */
    public function requestParcelPickup(
        string $courierCode,
        ?array $packageIds = null,
        ?array $packageNumbers = null,
        ?int $accountId = null,
        ?array $fields = null
    ): array {
        return $this->runRequestParcelPickup(
            courierCode: $courierCode,
            packageIds: $packageIds,
            packageNumbers: $packageNumbers,
            accountId: $accountId,
            fields: $fields
        );
    }

    /**
     * The method allows you to request a parcel pickup for previously created shipments.
     * Sends a parcel pickup request to courier API if the courier API allows it.
     *
     * @param string $courierCode Courier code
     * @param array<int>|null $packageIds Array of shipment IDs (optional if packageNumbers provided)
     * @param array<string>|null $packageNumbers Array of shipment numbers (optional if packageIds provided)
     * @param int|null $accountId Courier API account id from getCourierAccounts
     * @param array<int, array{id: string, value: string}>|null $fields List of fields from getRequestParcelPickupFields
     *                                                                   Example: [["id" => "pickup_date", "value" => "1642416311"]]
     *
     * @return array<string, mixed>
     *
     * @see https://api.baselinker.com/?method=runRequestParcelPickup
     */
    public function runRequestParcelPickup(
        string $courierCode,
        ?array $packageIds = null,
        ?array $packageNumbers = null,
        ?int $accountId = null,
        ?array $fields = null
    ): array {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_ids' => $packageIds,
                'package_numbers' => $packageNumbers,
                'account_id' => $accountId,
                'fields' => $fields,
            ]),
        ]);
    }

    /**
     * The method allows you to retrieve additional fields for a parcel pickup request.
     *
     * @param string $courierCode Courier code
     *
     * @return array<string, mixed>
     *
     * Example:
     * ->getRequestParcelPickupFields('dpd')
     *
     * @see https://api.baselinker.com/?method=getRequestParcelPickupFields
     */
    public function getRequestParcelPickupFields(string $courierCode): array
    {
        return $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
            ]),
        ]);
    }
}
