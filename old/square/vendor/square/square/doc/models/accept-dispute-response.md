
# Accept Dispute Response

Defines the fields in an `AcceptDispute` response.

## Structure

`AcceptDisputeResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Information about errors encountered during the request. | getErrors(): ?array | setErrors(?array errors): void |
| `dispute` | [`?Dispute`](/doc/models/dispute.md) | Optional | Represents a dispute a cardholder initiated with their bank. | getDispute(): ?Dispute | setDispute(?Dispute dispute): void |

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
  "dispute": {
    "dispute_id": "dispute_id8",
    "amount_money": {
      "amount": 40,
      "currency": "BWP"
    },
    "reason": "CANCELLED",
    "state": "INQUIRY_PROCESSING",
    "due_at": "due_at4"
  }
}
```

