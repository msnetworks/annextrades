
# Search Orders State Filter

Filter by current Order `state`.

## Structure

`SearchOrdersStateFilter`

## Fields

| Name | Type | Description | Getter | Setter |
|  --- | --- | --- | --- | --- |
| `states` | [`string[] (OrderState)`](/doc/models/order-state.md) | States to filter for.<br>See [OrderState](#type-orderstate) for possible values | getStates(): array | setStates(array states): void |

## Example (as JSON)

```json
{
  "states": [
    "CANCELED",
    "OPEN"
  ]
}
```

