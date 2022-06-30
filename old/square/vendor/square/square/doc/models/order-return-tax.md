
# Order Return Tax

Represents a tax being returned that applies to one or more return line items in an order.

Fixed-amount, order-scoped taxes are distributed across all non-zero return line item totals.
The amount distributed to each return line item is relative to that item’s contribution to the
order subtotal.

## Structure

`OrderReturnTax`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `uid` | `?string` | Optional | Unique ID that identifies the return tax only within this order. | getUid(): ?string | setUid(?string uid): void |
| `sourceTaxUid` | `?string` | Optional | `uid` of the Tax from the Order which contains the original charge of this tax. | getSourceTaxUid(): ?string | setSourceTaxUid(?string sourceTaxUid): void |
| `catalogObjectId` | `?string` | Optional | The catalog object id referencing [CatalogTax](#type-catalogtax). | getCatalogObjectId(): ?string | setCatalogObjectId(?string catalogObjectId): void |
| `name` | `?string` | Optional | The tax's name. | getName(): ?string | setName(?string name): void |
| `type` | [`?string (OrderLineItemTaxType)`](/doc/models/order-line-item-tax-type.md) | Optional | Indicates how the tax is applied to the associated line item or order. | getType(): ?string | setType(?string type): void |
| `percentage` | `?string` | Optional | The percentage of the tax, as a string representation of a decimal number.<br>For example, a value of `"7.25"` corresponds to a percentage of 7.25%. | getPercentage(): ?string | setPercentage(?string percentage): void |
| `appliedMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getAppliedMoney(): ?Money | setAppliedMoney(?Money appliedMoney): void |
| `scope` | [`?string (OrderLineItemTaxScope)`](/doc/models/order-line-item-tax-scope.md) | Optional | Indicates whether this is a line item or order level tax. | getScope(): ?string | setScope(?string scope): void |

## Example (as JSON)

```json
{
  "uid": "uid0",
  "source_tax_uid": "source_tax_uid2",
  "catalog_object_id": "catalog_object_id6",
  "name": "name0",
  "type": "INCLUSIVE"
}
```

