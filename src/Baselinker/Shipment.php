<?php

namespace Core45\LaravelBaselinker\Baselinker;

class Shipment extends LaravelBaselinker
{
    /**
     * The method createPackage allows you to create a shipment in the system of the selected courier.
     *
     * @param int $orderId
     * @param string $courierCode
     * @param int $accountId (optional) Courier API account id for the courier accounts retrieved from the request getCourierAccounts. If blank, the first account will be used.
     *
     * @param array $fields List of form fields retrieved from the request getCourierFields
     * For checkbox with multiple selection, the information should be sent in separate arrays e.g.
     * [
     * {
     * "id":"services",
     * "value":"sms"
     * },
     * {
     * "id":"services",
     * "value":"email"
     * },
     * ]
     * | - id    varchar(50)    The field ID
     * | - value    varchar    Option ID (required for checkbox, select field types) or value (required for text, date field types)
     * Date - format unix time
     *
     * @param array $packages Array of shipments list, weight of at least one shipment required. The array includes fields received in response to the request getCourierFields. The response returns also information whether the courier supports multiple shipments.
     * As a key use the field 'id' retrieved from the packages_fields parameter in response of the getCourierFields method.
     * As a value of field provide a value compatible with the field type from the getCourierFields response. Height, length, width should be sent in centimeters. Weight should be sent in kilograms.
     * E.g.
     * [
     * "weight":"1",
     * "height":"25",
     * ]
     *
     * @return array
     *
     * Example:
     * ->createPackage()
     *
     * @see https://api.baselinker.com/?method=createPackage
     */
    public function createPackage(
        int $orderId,
        string $courierCode,
        array $fields,
        array $packages,
        ?int $accountId = null,
    )
    {
        $response = $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'courier_code' => $courierCode,
                'account_id' => $accountId,
                'fields' => $fields,
                'packages' => $packages,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method createPackageManual allows you to enter the shipping number and the name of the courier to the order (function used only to add shipments created outside BaseLinker)
     *
     * @param int $orderId
     * @param string $courierCode Courier code (courier code retrieved with getCourierList or custom courier name)
     * @param string $packageNumber Shipping number (consignment number)
     * @param string $pickupDate Date of dispatch (unix time format)
     * @param bool $returnShipment (optional, false by default) Marks package as return shipment
     *
     * @return array
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
        bool $returnShipment = false,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
                'courier_code' => $courierCode,
                'package_number' => $packageNumber,
                'pickup_date' => $pickupDate,
                'return_shipment' => $returnShipment,
            ]),
        ]);

        return $response->json();
    }

    /**The method allows you to retrieve a list of available couriers.
     *
     * @return array
     *
     * Example:
     * ->getCouriersList()
     *
     * @see https://api.baselinker.com/?method=getCouriersList
     */
    public function getCouriersList()
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve the form fields for creating shipments for the selected courier.
     *
     * @param string $courierCode
     * @return array
     *
     * Example:
     * ->getCourierFields('dpd')
     *
     * @see https://api.baselinker.com/?method=getCourierFields
     */
    public function getCourierFields(string $courierCode)
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve additional courier services, which depend on other shipment settings.
     * Used only for X-press, BrokerSystem, Wysyłam z Allegro, ErliPRO couriers.
     * Not applicable to other couriers whose forms have fixed options.
     * The details of the package should be sent with the method (the format as in createPackage) in order to receive a list of additional services.
     *
     * @param string $courierCode
     * @param string $packageNumber
     * @param array $fields List of form fields retrieved from the request getCourierFields
     * For checkbox with multiple selection, the information should be sent in separate arrays e.g.
     * [
     * {
     * "id":"services",
     * "value":"sms"
     * },
     * {
     * "id":"services",
     * "value":"email"
     * },
     * ]
     * | - id    varchar(50)    The field ID
     * | - value    varchar    Option ID (required for checkbox, select field types) or value (required for text, date field types)
     * Date - format unix time
     *
     * @param array $packages Array of shipments list, weight of at least one shipment required. The array includes fields received in response to the request getCourierFields. The response returns also information whether the courier supports multiple shipments.
     * As a key use the field 'id' retrieved from the packages_fields parameter in response of the getCourierFields method.
     * As a value of field provide a value compatible with the field type from the getCourierFields response. Height, length, width should be sent in centimeters. Weight should be sent in kilograms.
     * E.g.
     * [
     * "weight":"1",
     * "height":"25",
     * ]
     *
     * @return array
     *
     * @see https://api.baselinker.com/?method=getCourierServices
     */
    public function getCourierServices(
        string $courierCode,
        string $packageNumber,
        array $fields,
        array $packages,
        ?int $accountId = null,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_number' => $packageNumber,
                'account_id' => $accountId,
                'fields' => $fields,
                'packages' => $packages,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve the list of accounts connected to a given courier.
     *
     * @param string $courierCode
     * @return array
     *
     * Example:
     * ->getCourierAccounts('pkwid')
     *
     * @see https://api.baselinker.com/?method=getCourierAccounts
     */
    public function getCourierAccounts(
        string $courierCode,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download a shipping label (consignment) for a selected shipment.
     *
     * @param string $courierCode
     * @param int $packageId
     * @param string|null $packageNumber
     *
     * @return array
     *
     * Example:
     * ->getLabel('dpd', 123456789')
     */
    public function getLabel(
        string $courierCode,
        int $packageId,
        ?string $packageNumber = null,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_id' => $packageId,
                'package_number' => $packageNumber,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download a parcel protocol for selected shipments if the protocol is available for chosen courier
     *
     * @param string $courierCode
     * @param array|null $packageIds Array of shipments ID, optional if package_numbers was provided
     * @param array|null $packageNumbers Array of shipments number (consignment number), optional if package_ids was provided
     * @param int|null $accountId Courier API account id for the courier accounts retrieved from the request getCourierAccounts
     *
     * @return array
     *
     * Example:
     * ->getProtocol('raben', [123456789,123456789], null) //when shipment Ids are provided
     * ->getProtocol('raben', null, [7323859,8421839]) //when shipment (consignment) numbers are provided
     *
     * @see https://api.baselinker.com/?method=getProtocol
     */
    public function getProtocol(
        string $courierCode,
        array $packageIds,
        array $packageNumbers,
        ?int $accountId = null,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_ids' => $packageIds,
                'package_numbers' => $packageNumbers,
                'account_id' => $accountId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to download shipments previously created for the selected order.
     *
     * @param int $orderId
     * @return array
     *
     * Example:
     * ->getOrderPackages(6910995)
     *
     * @see https://api.baselinker.com/?method=getOrderPackages
     */
    public function getOrderPackages(int $orderId)
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'order_id' => $orderId,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve the history of the status list of the given shipments. Maximum 100 shipments at a time
     *
     * @param array $packageIds
     * @return array
     *
     * Example:
     * ->getCourierPackagesStatusHistory([123456789,123456789])
     *
     * @see https://api.baselinker.com/?method=getCourierPackagesStatusHistory
     */
    public function getCourierPackagesStatusHistory(array $packageIds)
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'package_ids' => $packageIds,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to delete a previously created shipment.
     * The method removes the shipment from the BaseLinker system and from the courier system if the courier API allows it.
     *
     * @param string $courierCode
     * @param int $packageId Shipment ID, optional if package_number is provided
     * @param string|null $packageNumber Shipping number (consignment number), optional if package_id was provided
     * @param bool $forceDelete (optional, false by default) Forcing a shipment to be removed from BaseLinker database in the case of an error with the removal of the shipment in the courier API.
     *
     * @return array
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
        bool $forceDelete = false,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_id' => $packageId,
                'package_number' => $packageNumber,
                'force_delete' => $forceDelete,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to request a parcel pickup for previously created shipments.
     * The method sends a parcel pickup request to courier API if the courier API allows it.
     *
     * @param string $courierCode
     * @param array $packageIds Array of shipments ID, optional if package_numbers was provided
     * @param array|null $packageNumbers Array of shipments number (consignment number), optional if package_ids was provided
     * @param int|null $accountId Courier API account id for the courier accounts retrieved from the request getCourierAccounts
     * @param array|null $fields List of form fields retrieved from the request getRequestParcelPickupFields
     * For checkbox with multiple selection, the information should be sent in separate arrays e.g.
     * [
     * {
     * "id":"pickup_date",
     * "value":"1642416311"
     * },
     * {
     * "id":"shipments_weight",
     * "value":"40"
     * },
     * ]
     *
     *
     * @return array
     */
    public function requestParcelPickup(
        string $courierCode,
        array $packageIds,
        ?array $packageNumbers = null,
        ?int $accountId = null,
        ?array $fields = null,
    )
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
                'package_ids' => $packageIds,
                'package_numbers' => $packageNumbers,
                'account_id' => $accountId,
                'fields' => $fields,
            ]),
        ]);

        return $response->json();
    }

    /**
     * The method allows you to retrieve additional fields for a parcel pickup request.
     *
     * @param string $courierCode
     * @return array
     *
     * Example:
     * ->getRequestParcelPickupFields('dpd')
     *
     * @see https://api.baselinker.com/?method=getRequestParcelPickupFields
     */
    public function getRequestParcelPickupFields(string $courierCode)
    {
        $response =  $this->makeRequest([
            'method' => __FUNCTION__,
            'parameters' => json_encode([
                'courier_code' => $courierCode,
            ]),
        ]);

        return $response->json();
    }
}
