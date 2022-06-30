
# Search Orders Response

Only one of `order_entries` or `orders` fields will be set, depending on whether
`return_entries` was set on the [SearchOrdersRequest](#type-searchorderrequest).

## Structure

`SearchOrdersResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `orderEntries` | [`?(OrderEntry[])`](/doc/models/order-entry.md) | Optional | List of [OrderEntries](#type-orderentry) that fit the query<br>conditions. Populated only if `return_entries` was set to `true` in the request. | getOrderEntries(): ?array | setOrderEntries(?array orderEntries): void |
| `orders` | [`?(Order[])`](/doc/models/order.md) | Optional | List of<br>[Order](#type-order) objects that match query conditions. Populated only if<br>`return_entries` in the request is set to `false`. | getOrders(): ?array | setOrders(?array orders): void |
| `cursor` | `?string` | Optional | The pagination cursor to be used in a subsequent request. If unset,<br>this is the final response.<br>See [Pagination](https://developer.squareup.com/docs/basics/api101/pagination) for more information. | getCursor(): ?string | setCursor(?string cursor): void |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | [Errors](#type-error) encountered during the search. | getErrors(): ?array | setErrors(?array errors): void |

## Example (as JSON)

```json
{
  "cursor": "123",
  "order_entries": [
    {
      "location_id": "057P5VYJ4A5X1",
      "order_id": "CAISEM82RcpmcFBM0TfOyiHV3es",
      "version": 1
    },
    {
      "location_id": "18YC4JDH91E1H",
      "order_id": "CAISENgvlJ6jLWAzERDzjyHVybY"
    },
    {
      "location_id": "057P5VYJ4A5X1",
      "order_id": "CAISEM52YcpmcWAzERDOyiWS3ty"
    }
  ]
}
```

