
# List Cash Drawer Shift Events Response

## Structure

`ListCashDrawerShiftEventsResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `events` | [`?(CashDrawerShiftEvent[])`](/doc/models/cash-drawer-shift-event.md) | Optional | All of the events (payments, refunds, etc.) for a cash drawer during<br>the shift. | getEvents(): ?array | setEvents(?array events): void |
| `cursor` | `?string` | Optional | Opaque cursor for fetching the next page. Cursor is not present in<br>the last page of results. | getCursor(): ?string | setCursor(?string cursor): void |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Any errors that occurred during the request. | getErrors(): ?array | setErrors(?array errors): void |

## Example (as JSON)

```json
{
  "events": [
    {
      "id": "id0",
      "employee_id": "employee_id0",
      "event_type": "PAID_OUT",
      "event_money": {
        "amount": 126,
        "currency": "PGK"
      },
      "created_at": "created_at8"
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

