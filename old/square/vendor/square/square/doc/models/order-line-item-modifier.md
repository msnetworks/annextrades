
# Order Line Item Modifier

A [CatalogModifier](#type-catalogmodifier).

## Structure

`OrderLineItemModifier`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `uid` | `?string` | Optional | Unique ID that identifies the modifier only within this order. | getUid(): ?string | setUid(?string uid): void |
| `catalogObjectId` | `?string` | Optional | The catalog object id referencing [CatalogModifier](#type-catalogmodifier). | getCatalogObjectId(): ?string | setCatalogObjectId(?string catalogObjectId): void |
| `name` | `?string` | Optional | The name of the item modifier. | getName(): ?string | setName(?string name): void |
| `basePriceMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getBasePriceMoney(): ?Money | setBasePriceMoney(?Money basePriceMoney): void |
| `totalPriceMoney` | [`?Money`](/doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTotalPriceMoney(): ?Money | setTotalPriceMoney(?Money totalPriceMoney): void |

## Example (as JSON)

```json
{
  "uid": "uid0",
  "catalog_object_id": "catalog_object_id6",
  "name": "name0",
  "base_price_money": {
    "amount": 114,
    "currency": "ALL"
  },
  "total_price_money": {
    "amount": 52,
    "currency": "MYR"
  }
}
```

