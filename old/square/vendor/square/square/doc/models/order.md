
# Order

Contains all information related to a single order to process with Square,
including line items that specify the products to purchase. Order objects also
include information on any associated tenders, refunds, and returns.

All Connect V2 Transactions have all been converted to Orders including all associated
itemization data.

## Structure

`Order`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `id` | `?string` | Optional | The order's unique ID. | getId(): ?string | setId(?string id): void |
| `locationId` | `string` |  | The ID of the merchant location this order is associated with. | getLocationId(): string | setLocationId(string locationId): void |
| `referenceId` | `?string` | Optional | A client specified identifier to associate an entity in another system<br>with this order. | getReferenceId(): ?string | setReferenceId(?string referenceId): void |
| `source` | [`?OrderSource`](/doc/models/order-source.md) | Optional | Represents the origination details of an order. | getSource(): ?OrderSource | setSource(?OrderSource source): void |
| `customerId` | `?string` | Optional | The [Customer](#type-customer) ID of the customer associated with the order. | getCustomerId(): ?string | setCustomerId(?string customerId): void |
| `lineItems` | [`?(OrderLineItem[])`](/doc/models/order-line-item.md) | Optional | The line items included in the order. | getLineItems(): ?array | setLineItems(?array lineItems): void |
| `taxes` | [`?(OrderLineItemTax[])`](/doc/models/order-line-item-tax.md) | Optional | The list of all taxes associated with the order.<br><br>Taxes can be scoped to either `ORDER` or `LINE_ITEM`. For taxes with `LINE_ITEM` scope, an<br>`OrderLineItemAppliedTax` must be added to each line item that the tax applies to. For taxes<br>with `ORDER` scope, the server will generate an `OrderLineItemAppliedTax` for every line item.<br><br>On reads, each tax in the list will include the total amount of that tax applied to the order.<br><br>__IMPORTANT__: If `LINE_ITEM` scope is set on any taxes in this field, usage of the deprecated<br>`line_items.taxes` field will result in an error. Please use `line_items.applied_taxes`<br>instead. | getTaxes(): ?array | setTaxes(?array taxes): void |
| `discounts` | [`?(OrderLineItemDiscount[])`](/doc/models/order-line-item-discount.md) | Optional | The list of all discounts associated with the order.<br><br>Discounts can be scoped to either `ORDER` or `LINE_ITEM`. For discounts scoped to `LINE_ITEM`,<br>an `OrderLineItemAppliedDiscount` must be added to each line item that the discount applies to.<br>For discounts with `ORDER` scope, the server will generate an `OrderLineItemAppliedDiscount`<br>for every line item.<br><br>__IMPORTANT__: If `LINE_ITEM` scope is set on any discounts in this field, usage of the deprecated<br>`line_items.discounts` field will result in an error. Please use `line_items.applied_discounts`<br>instead. | getDiscounts(): ?array | setDiscounts(?array discounts): void |
| `serviceCharges` | [`?(OrderServiceCharge[])`](/doc/models/order-service-charge.md) | Optional | A list of service charges applied to the order. | getServiceCharges(): ?array | setServiceCharges(?array serviceCharges): void |
| `fulfillments` | [`?(OrderFulfillment[])`](/doc/models/order-fulfillment.md) | Optional | Details on order fulfillment.<br><br>Orders can only be created with at most one fulfillment. However, orders returned<br>by the API may contain multiple fulfillments. | getFulfillments(): ?array | setFulfillments(?array fulfillments): void |
| `returns` | [`?(OrderReturn[])`](/doc/models/order-return.md) | Optional | Collection of items from sale Orders being returned in this one. Normally part of an<br>Itemized Return or Exchange.  There will be exactly one `Return` object per sale Order being<br>referenced. | getReturns(): ?array | setReturns(?array returns): void |
| `returnAmounts` | [`?OrderMoneyAmounts`](/doc/models/order-money-amounts.md) | Optional | A collection of various money amounts. | getReturnAmounts(): ?OrderMoneyAmounts | setReturnAmounts(?OrderMoneyAmounts returnAmounts): void |
| `netAmounts` | [`?OrderMoneyAmounts`](/doc/models/order-money-amounts.md) | Optional | A collection of various money amounts. | getNetAmounts(): ?OrderMoneyAmounts | setNetAmounts(?OrderMoneyAmounts netAmounts): void |
| `roundingAdjustment` | [`?OrderRoundingAdjustment`](/doc/models/order-rounding-adjustment.md) | Optional | A rounding adjustment of the money being returned. Commonly used to apply Cash Rounding<br>when the minimum unit of account is smaller than the lowest physical denomination of currency. | getRoundingAdjustment(): ?OrderRoundingAdjustment | setRoundingAdjustment(?OrderRoundingAdjustment roundingAdjustment): void |
| `tenders` | [`?(Tender[])`](/doc/models/tender.md) | Optional | The Tenders which were used to pay for the Order. | getTenders(): ?array | setTenders(?array tenders): void |
| `refunds` | [`?(Refund[])`](/doc/models/refund.md) | Optional | The Refunds that are part of this Order. | getRefunds(): ?array | setRefunds(?array refunds): void |
| `metadata` | `?array` | Optional | Application-defined data attached to this order. Metadata fields are intended<br>to store descriptive references or associations with an entity in another system or store brief<br>information about the object. Square does not process this field; it only stores and returns it<br>in relevant API calls. Do not use metadata to store any sensitive information (personally<br>identifiable information, card details, etc.).<br><br>Keys written by applications must be 60 characters or less and must be in the character set<br>`[a-zA-Z0-9_-]`. Entries may also include metadata generated by Square. These keys are prefixed<br>with a namespace, separated from the key with a ':' character.<br><br>Values have a max length of 255 characters.<br><br>An application may have up to 10 entries per metadata field.<br><br>Entries written by applications are private and can only be read or modified by the same<br>application.<br><br>See [Metadata](https://developer.squareup.com/docs/build-basics/metadata) for more information. | getMetadata(): ?array | setMetadata(?array metadata): void |
| `createdAt` | `?string` | Optional | Timestamp for when the order was created. In RFC 3339 format, e.g., "2016-09-04T23:59:33.123Z". | getCreatedAt(): ?string | setCreatedAt(?string createdAt): void |
| `updatedAt` | `?string` | Optional | Timestamp for when the order was last updated. In RFC 3339 format, e.g., "2016-09-04T23:59:33.123Z". | getUpdatedAt(): ?string | setUpdatedAt(?string updatedAt): void |
| `closedAt` | `?string` | Optional | Timestamp for when the order reached a terminal [state](#property-state). In RFC 3339 format, e.g., "2016-09-04T23:59:33.123Z". | getClosedAt(): ?string | setClosedAt(?string closedAt): void |
| `state` | [`?string (OrderState)`](/doc/models/order-state.md) | Optional | The state of the order. | getState(): ?string | setState(?string state): void |
| `version` | `?int` | Optional | Version number which is incremented each time an update is committed to the order.<br>Orders that were not created through the API will not include a version and<br>thus cannot be updated.<br><br>[Read more about working with versions](https://developer.squareup.com/docs/orders-api/manage-orders#update-orders). | getVersion(): ?int | setVersion(?int version): void |
| `totalMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTotalMoney(): ?Money | setTotalMoney(?Money totalMoney): void |
| `totalTaxMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTotalTaxMoney(): ?Money | setTotalTaxMoney(?Money totalTaxMoney): void |
| `totalDiscountMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTotalDiscountMoney(): ?Money | setTotalDiscountMoney(?Money totalDiscountMoney): void |
| `totalTipMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTotalTipMoney(): ?Money | setTotalTipMoney(?Money totalTipMoney): void |
| `totalServiceChargeMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTotalServiceChargeMoney(): ?Money | setTotalServiceChargeMoney(?Money totalServiceChargeMoney): void |
| `pricingOptions` | [`?OrderPricingOptions`](/doc/models/order-pricing-options.md) | Optional | Pricing options for an order. The options affect how the order's price is calculated.<br>They can be used, for example, to apply automatic price adjustments that are based on pre-configured<br>[pricing rules](https://developer.squareup.com/docs/reference/square/objects/CatalogPricingRule). | getPricingOptions(): ?OrderPricingOptions | setPricingOptions(?OrderPricingOptions pricingOptions): void |
| `rewards` | [`?(OrderReward[])`](/doc/models/order-reward.md) | Optional | A set-like list of rewards that have been added to the order. | getRewards(): ?array | setRewards(?array rewards): void |

## Example (as JSON)

```json
{
  "id": "id0",
  "location_id": "location_id4",
  "reference_id": "reference_id2",
  "source": {
    "name": "name4"
  },
  "customer_id": "customer_id8",
  "line_items": [
    {
      "uid": "uid9",
      "name": "name9",
      "quantity": "quantity5",
      "quantity_unit": {
        "measurement_unit": {
          "custom_unit": {
            "name": "name7",
            "abbreviation": "abbreviation9"
          },
          "area_unit": "IMPERIAL_SQUARE_YARD",
          "length_unit": "METRIC_CENTIMETER",
          "volume_unit": "GENERIC_PINT",
          "weight_unit": "METRIC_KILOGRAM"
        },
        "precision": 199
      },
      "note": "note5",
      "catalog_object_id": "catalog_object_id7"
    },
    {
      "uid": "uid0",
      "name": "name0",
      "quantity": "quantity6",
      "quantity_unit": {
        "measurement_unit": {
          "custom_unit": {
            "name": "name8",
            "abbreviation": "abbreviation0"
          },
          "area_unit": "IMPERIAL_SQUARE_MILE",
          "length_unit": "METRIC_MILLIMETER",
          "volume_unit": "GENERIC_QUART",
          "weight_unit": "METRIC_GRAM"
        },
        "precision": 200
      },
      "note": "note6",
      "catalog_object_id": "catalog_object_id6"
    },
    {
      "uid": "uid1",
      "name": "name1",
      "quantity": "quantity7",
      "quantity_unit": {
        "measurement_unit": {
          "custom_unit": {
            "name": "name9",
            "abbreviation": "abbreviation1"
          },
          "area_unit": "METRIC_SQUARE_CENTIMETER",
          "length_unit": "IMPERIAL_MILE",
          "volume_unit": "GENERIC_GALLON",
          "weight_unit": "METRIC_MILLIGRAM"
        },
        "precision": 201
      },
      "note": "note7",
      "catalog_object_id": "catalog_object_id5"
    }
  ]
}
```

