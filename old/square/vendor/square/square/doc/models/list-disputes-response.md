
# List Disputes Response

Defines fields in a `ListDisputes` response.

## Structure

`ListDisputesResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Information about errors encountered during the request. | getErrors(): ?array | setErrors(?array errors): void |
| `disputes` | [`?(Dispute[])`](/doc/models/dispute.md) | Optional | The list of disputes. | getDisputes(): ?array | setDisputes(?array disputes): void |
| `cursor` | `?string` | Optional | The pagination cursor to be used in a subsequent request.<br>If unset, this is the final response. For more information, see [Pagination](https://developer.squareup.com/docs/basics/api101/pagination). | getCursor(): ?string | setCursor(?string cursor): void |

## Example (as JSON)

```json
{
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
  ],
  "disputes": [
    {
      "dispute_id": "dispute_id5",
      "amount_money": {
        "amount": 29,
        "currency": "GHS"
      },
      "reason": "CANCELLED",
      "state": "INQUIRY_EVIDENCE_REQUIRED",
      "due_at": "due_at9"
    },
    {
      "dispute_id": "dispute_id6",
      "amount_money": {
        "amount": 30,
        "currency": "GIP"
      },
      "reason": "AMOUNT_DIFFERS",
      "state": "UNKNOWN_STATE",
      "due_at": "due_at8"
    },
    {
      "dispute_id": "dispute_id7",
      "amount_money": {
        "amount": 31,
        "currency": "GMD"
      },
      "reason": "EMV_LIABILITY_SHIFT",
      "state": "WAITING_THIRD_PARTY",
      "due_at": "due_at7"
    }
  ],
  "cursor": "cursor6"
}
```

