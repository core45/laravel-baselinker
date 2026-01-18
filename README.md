# Baselinker API integration for Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

A comprehensive Laravel package for integrating with the [Baselinker/Base.com](https://baselinker.com) API. This package provides a clean, fluent interface for the Catalog, External Storage, Order, and Shipment modules.

## Requirements

- PHP >= 8.1
- Laravel >= 9.0

## Installation

Install the package with composer:

```bash
composer require core45/laravel-baselinker
```

Optionally publish the configuration file:

```bash
php artisan vendor:publish --provider="Core45\LaravelBaselinker\BaselinkerServiceProvider"
```

The package is auto-discovered by Laravel. After installation, add your API token to your `.env` file:

```env
BASELINKER_TOKEN=your-api-token-here
BASELINKER_DEBUG=false
```

## Usage

The Baselinker API is divided into 4 main modules:

| Module | Description |
|--------|-------------|
| **Catalog** | Product catalog, inventories, price groups, warehouses, categories, manufacturers, tags |
| **External Storage** | External shops and wholesalers connected to Baselinker |
| **Order** | Orders, receipts, invoices, order sources, order returns |
| **Shipment** | Courier shipments, labels, protocols, pickup requests |

Access any module using the `Baselinker` facade:

```php
use Core45\LaravelBaselinker\Facades\Baselinker;

// Access modules
$catalog = Baselinker::catalog();
$externalStorage = Baselinker::externalStorage();
$order = Baselinker::order();
$shipment = Baselinker::shipment();
```

## Catalog Module

### Inventories

```php
// Get list of inventories
$inventories = Baselinker::catalog()->getInventories();

// Add a new inventory
$result = Baselinker::catalog()->addInventory(
    name: 'Main Warehouse',
    description: 'Primary product warehouse',
    languages: ['en', 'pl'],
    defaultLanguage: 'en',
    priceGroups: [1, 2],
    defaultPriceGroup: 1,
    warehouses: ['bl_123'],
    defaultWarehouse: 'bl_123',
    reservations: true
);
```

### Price Groups

```php
// Get price groups
$priceGroups = Baselinker::catalog()->getInventoryPriceGroups();

// Add a price group
$result = Baselinker::catalog()->addInventoryPriceGroup(
    name: 'Retail Prices',
    description: 'Standard retail pricing',
    currency: 'EUR'
);
```

### Warehouses

```php
// Get warehouses
$warehouses = Baselinker::catalog()->getInventoryWarehouses();

// Add a warehouse
$result = Baselinker::catalog()->addInventoryWarehouse(
    name: 'Main Warehouse',
    description: 'Primary storage location',
    stockEdition: true
);
```

### Categories

```php
// Get categories
$categories = Baselinker::catalog()->getInventoryCategories(inventoryId: 123);

// Add a category
$result = Baselinker::catalog()->addInventoryCategory(
    inventoryId: 123,
    name: 'Electronics',
    parentId: 0 // 0 for root category
);
```

### Products

```php
// Get products list
$products = Baselinker::catalog()->getInventoryProductsList(
    inventoryId: 123,
    filterCategoryId: 456,
    filterSort: 'name ASC',
    page: 1
);

// Get product data
$product = Baselinker::catalog()->getInventoryProductsData(
    inventoryId: 123,
    products: [1001, 1002, 1003]
);

// Add a product
$result = Baselinker::catalog()->addInventoryProduct(
    inventoryId: 123,
    productId: 'new', // 'new' for new product or existing ID
    parentId: null,
    isBundle: false,
    ean: '1234567890123',
    sku: 'PROD-001',
    taxRate: 23.0,
    weight: 0.5,
    height: 10.0,
    width: 20.0,
    length: 30.0,
    star: 0,
    manufacturerId: 1,
    categoryId: 456,
    prices: ['1' => 99.99, '2' => 89.99],
    stock: ['bl_123' => 100],
    locations: ['bl_123' => 'A1-B2'],
    textFields: [
        'name|en' => 'Product Name',
        'description|en' => 'Product description',
        'features|en' => 'Feature 1|Feature 2'
    ],
    images: ['https://example.com/image1.jpg'],
    links: ['https://example.com/product'],
    bundleProducts: []
);

// Update stock
$result = Baselinker::catalog()->updateInventoryProductsStock(
    inventoryId: 123,
    products: [
        ['product_id' => 1001, 'variant_id' => 0, 'stock' => ['bl_123' => 50]]
    ]
);
```

### Manufacturers & Tags

```php
// Get manufacturers
$manufacturers = Baselinker::catalog()->getInventoryManufacturers();

// Add a manufacturer
$result = Baselinker::catalog()->addInventoryManufacturer(
    name: 'Apple Inc.'
);

// Get tags
$tags = Baselinker::catalog()->getInventoryTags();
```

## External Storage Module

```php
// Get list of connected external storages
$storages = Baselinker::externalStorage()->getExternalStoragesList();

// Get categories from external storage
$categories = Baselinker::externalStorage()->getExternalStorageCategories(
    storageId: 'shop_2445'
);

// Get products list
$products = Baselinker::externalStorage()->getExternalStorageProductsList(
    storageId: 'shop_2445',
    filterSort: 'name ASC',
    page: 1
);

// Get product details
$productData = Baselinker::externalStorage()->getExternalStorageProductsData(
    storageId: 'shop_2445',
    products: [18755, 18756]
);

// Update stock in external storage
$result = Baselinker::externalStorage()->updateExternalStorageProductsQuantity(
    storageId: 'shop_2445',
    products: [
        [1081730, 0, 100],      // [product_id, variant_id (0=main), quantity]
        [1081730, 1734642, 50]  // Update variant stock
    ]
);
```

## Order Module

### Managing Orders

```php
// Get journal (order changes log)
$journal = Baselinker::order()->getJournalList(
    lastLogId: 0,
    logsTypes: [1, 2], // 1 = new order, 2 = order update
    orderId: null
);

// Get orders
$orders = Baselinker::order()->getOrders(
    orderId: null,
    dateConfirmedFrom: 1609459200, // Unix timestamp
    dateFrom: null,
    idFrom: null,
    getUnconfirmedOrders: false,
    includeCustomExtraFields: true,
    statusId: null,
    filterEmail: null,
    filterOrderSource: null,
    filterOrderSourceId: null
);

// Add a new order
$result = Baselinker::order()->addOrder(
    orderStatusId: 1234,
    dateAdd: time(),
    currency: 'EUR',
    paymentMethod: 'PayPal',
    paymentMethodCod: 0,
    paid: 1,
    userComments: 'Please deliver before 5 PM',
    adminComments: 'VIP customer',
    email: 'customer@example.com',
    phone: '+48123456789',
    userLogin: 'johndoe',
    deliveryMethod: 'DPD',
    deliveryPrice: 9.99,
    deliveryFullname: 'John Doe',
    deliveryCompany: 'ACME Inc.',
    deliveryAddress: '123 Main Street',
    deliveryPostcode: '00-001',
    deliveryCity: 'Warsaw',
    deliveryState: '',
    deliveryCountryCode: 'PL',
    deliveryPointId: '',
    deliveryPointName: '',
    deliveryPointAddress: '',
    deliveryPointPostcode: '',
    deliveryPointCity: '',
    invoiceFullname: 'John Doe',
    invoiceCompany: 'ACME Inc.',
    invoiceNip: 'PL1234567890',
    invoiceAddress: '123 Main Street',
    invoicePostcode: '00-001',
    invoiceCity: 'Warsaw',
    invoiceState: '',
    invoiceCountryCode: 'PL',
    wantInvoice: 1,
    extraField1: '',
    extraField2: '',
    customExtraFields: [],
    products: [
        [
            'storage' => 'bl',
            'storage_id' => 123,
            'product_id' => 1001,
            'variant_id' => 0,
            'name' => 'Product Name',
            'sku' => 'SKU-001',
            'ean' => '1234567890123',
            'price_brutto' => 99.99,
            'tax_rate' => 23,
            'quantity' => 2,
            'weight' => 0.5
        ]
    ]
);

// Update order fields
$result = Baselinker::order()->setOrderFields(
    orderId: 6910995,
    adminComments: 'Updated comment',
    deliveryAddress: 'New Address 456'
);

// Set order status
$result = Baselinker::order()->setOrderStatus(
    orderId: 6910995,
    statusId: 5678
);

// Delete orders
$result = Baselinker::order()->deleteOrders(
    orderIds: [6910995, 6910996]
);
```

### Order Products

```php
// Add product to order
$result = Baselinker::order()->addOrderProduct(
    orderId: 6910995,
    storage: 'bl',
    storageId: 123,
    productId: 1001,
    name: 'New Product',
    priceBrutto: 49.99,
    taxRate: 23,
    quantity: 1
);

// Set product fields
$result = Baselinker::order()->setOrderProductFields(
    orderId: 6910995,
    orderProductId: 12345,
    priceBrutto: 39.99
);

// Delete product from order
$result = Baselinker::order()->deleteOrderProduct(
    orderId: 6910995,
    orderProductId: 12345
);
```

### Order Statuses & Sources

```php
// Get order status list
$statuses = Baselinker::order()->getOrderStatusList();

// Get order sources
$sources = Baselinker::order()->getOrderSources();
```

### Receipts & Invoices

```php
// Get receipts
$receipts = Baselinker::order()->getReceipts(
    receiptId: null,
    orderId: 6910995,
    dateFrom: null,
    seriesId: null
);

// Get invoices
$invoices = Baselinker::order()->getInvoices(
    invoiceId: null,
    orderId: 6910995,
    dateFrom: null,
    seriesId: null,
    getExternalInvoices: false
);

// Get invoice file
$file = Baselinker::order()->getInvoiceFile(invoiceId: 123456);

// Add invoice
$result = Baselinker::order()->addInvoice(
    orderId: 6910995,
    seriesId: 1
);
```

### Order Returns (New in v2.0)

```php
// Get return reasons
$reasons = Baselinker::order()->getOrderReturnReasonsList();

// Get order return journal
$journal = Baselinker::order()->getOrderReturnJournalList(
    lastLogId: 0,
    logsTypes: [1, 2]
);

// Get returns
$returns = Baselinker::order()->getOrderReturns(
    orderReturnId: null,
    orderId: null,
    dateFrom: 1609459200,
    idFrom: null,
    statusId: null,
    includeCustomExtraFields: true
);

// Add a return
try {
    $result = Baselinker::order()->addOrderReturn(
        orderId: 6910995,
        statusId: 100, // This is the ID of the return status
        adminComments: 'Return created by support',
        products: [
            ['order_product_id' => 12345, 'quantity' => 1]
        ],
        dateAdd: time(),
        currency: 'EUR',
        refunded: false
    );
} catch (\Core45\LaravelBaselinker\Exceptions\BaselinkerException $e) {
    // Handle API error
    // e.g., Log::error($e->getMessage());
}

// Set return status
$result = Baselinker::order()->setOrderReturnStatus(
    returnId: 789,
    statusId: 200
);
```

## Shipment Module

### Couriers

```php
// Get list of available couriers
$couriers = Baselinker::shipment()->getCouriersList();

// Get courier accounts
$accounts = Baselinker::shipment()->getCourierAccounts(courierCode: 'dpd');

// Get courier form fields
$fields = Baselinker::shipment()->getCourierFields(courierCode: 'dpd');
```

### Creating Shipments

```php
// Create a shipment
$result = Baselinker::shipment()->createPackage(
    orderId: 6910995,
    courierCode: 'dpd',
    fields: [
        ['id' => 'cod', 'value' => '0'],
        ['id' => 'insurance', 'value' => '1']
    ],
    packages: [
        ['weight' => '2', 'height' => '30', 'width' => '20', 'length' => '40']
    ],
    accountId: null
);

// Manually add shipment (for packages created outside Baselinker)
$result = Baselinker::shipment()->createPackageManual(
    orderId: 6910995,
    courierCode: 'dpd',
    packageNumber: '1234567890',
    pickupDate: '1622505600'
);

// Get packages for order
$packages = Baselinker::shipment()->getOrderPackages(orderId: 6910995);

// Delete a package
$result = Baselinker::shipment()->deleteCourierPackage(
    courierCode: 'dpd',
    packageId: 123456
);
```

### Labels & Protocols

```php
// Get shipping label
$label = Baselinker::shipment()->getLabel(
    courierCode: 'dpd',
    packageId: 123456
);

// Get protocol
$protocol = Baselinker::shipment()->getProtocol(
    courierCode: 'dpd',
    packageIds: [123456, 123457]
);
```

### Pickup Requests

```php
// Get pickup request fields
$fields = Baselinker::shipment()->getRequestParcelPickupFields(courierCode: 'dpd');

// Request parcel pickup
$result = Baselinker::shipment()->runRequestParcelPickup(
    courierCode: 'dpd',
    packageIds: [123456, 123457],
    fields: [
        ['id' => 'pickup_date', 'value' => '1642416311'],
        ['id' => 'shipments_weight', 'value' => '40']
    ]
);
```

### Package Status History

```php
// Get status history for packages
$history = Baselinker::shipment()->getCourierPackagesStatusHistory(
    packageIds: [123456, 123457]
);
```

## Configuration

The configuration file (`config/baselinker.php`) contains:

```php
return [
    'token' => env('BASELINKER_TOKEN'),
    'debug' => env('BASELINKER_DEBUG', false),
    'verify' => env('BASELINKER_VERIFY', true), // SSL verification
];
```

## API Rate Limiting

Baselinker API has a rate limit of **100 requests per minute**. The package does not implement automatic rate limiting, so you should handle this in your application if making many requests.

## Error Handling

The package now uses centralized exception handling. If the Baselinker API returns an error, or if there is an HTTP-level failure, the package will throw a `\Core45\LaravelBaselinker\Exceptions\BaselinkerException`.

You should wrap your API calls in a `try...catch` block to handle potential errors gracefully.

```php
use Core45\LaravelBaselinker\Facades\Baselinker;
use Core45\LaravelBaselinker\Exceptions\BaselinkerException;
use Illuminate\Support\Facades\Log;

try {
    $inventories = Baselinker::catalog()->getInventories();
    // Handle success
} catch (BaselinkerException $e) {
    // Handle API error
    Log::error('Baselinker API Error: ' . $e->getMessage());
    // You can also get the error code if needed
    $errorCode = $e->getCode();
} catch (\Illuminate\Http\Client\RequestException $e) {
    // Handle HTTP connection error
    Log::error('Baselinker Connection Error: ' . $e->getMessage());
}
```

## Official API Documentation

For complete API documentation, visit: https://api.baselinker.com

## License

MIT License. See [LICENSE](LICENSE) for more information.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

[ico-version]: https://img.shields.io/packagist/v/core45/laravel-baselinker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/core45/laravel-baselinker.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/core45/laravel-baselinker
[link-downloads]: https://packagist.org/packages/core45/laravel-baselinker
