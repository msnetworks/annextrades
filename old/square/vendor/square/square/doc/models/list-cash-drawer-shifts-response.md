
# List Cash Drawer Shifts Response

## Structure

`ListCashDrawerShiftsResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `items` | [`?(CashDrawerShiftSummary[])`](/doc/models/cash-drawer-shift-summary.md) | Optional | A collection of CashDrawerShiftSummary objects for shifts that match<br>the query. | getItems(): ?array | setItems(?array items): void |
| `cursor` | `?string` | Optional | Opaque cursor for fetching the next page of results. Cursor is not<br>present in the last page of results. | getCursor(): ?string | setCursor(?string cursor): void |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Any errors that occurred during the request. | getErrors(): ?array | setErrors(?array errors): void |

## Example (as JSON)

```json
{
  "items": [
    {
      "id": "id7",
      "state": "CLOSED",
      "opened_at": "opened_at5",
      "ended_at": "ended_at9",
      "closed_at": "closed_at9"
    },
    {
      "id": "id8",
      "state": "ENDED",
      "opened_at": "opened_at6",
      "ended_at": "ended_at0",
      "closed_at": "closed_at0"
    }
  ],
  "cursor": "cursor6",
  "errors": [
    {
      "category": "AUTHENTICATION_ERROR",
      "code": "VALUE_TOO_SHORT",
      "detail": "detail1",
      "field": "field9"
    },
    {
      "category": "INVALID_REQUEST_ERROR",
      "code": "VALUE_TOO_LONG",
      "detail": "detail2",
      "field": "field0"
    },
    {
      "category": "RATE_LIMIT_ERROR",
      "code": "VALUE_TOO_LOW",
      "detail": "detail3",
      "field": "field1"
    }
  ]
}
```

