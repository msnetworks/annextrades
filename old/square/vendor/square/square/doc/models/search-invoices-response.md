
# Search Invoices Response

Describes a `SearchInvoices` response.

## Structure

`SearchInvoicesResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `invoices` | [`?(Invoice[])`](/doc/models/invoice.md) | Optional | The list of invoices returned by the search. | getInvoices(): ?array | setInvoices(?array invoices): void |
| `cursor` | `?string` | Optional | When a response is truncated, it includes a cursor that you can use in a<br>subsequent request to fetch the next set of invoices. If empty, this is the final<br>response.<br>For more information, see [Pagination](https://developer.squareup.com/docs/working-with-apis/pagination). | getCursor(): ?string | setCursor(?string cursor): void |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Information about errors encountered during the request. | getErrors(): ?array | setErrors(?array errors): void |

## Example (as JSON)

```json
{
  "cursor": "CURSOR",
  "invoices": [
    {
      "invoice": {
        "created_at": "2020-06-18T17:45:13Z",
        "custom_fields": [
          {
            "label": "Event Reference Number",
            "placement": "ABOVE_LINE_ITEMS",
            "value": "Ref. #1234"
          },
          {
            "label": "Terms of Service",
            "placement": "BELOW_LINE_ITEMS",
            "value": "The terms of service are..."
          }
        ],
        "description": "We appreciate your business!",
        "id": "gt2zv1z6mnUm1V7KMxxf3w",
        "invoice_number": "inv-100",
        "location_id": "ES0RJRZYEC39A",
        "order_id": "CAISENgvlJ6jLWAzERDzjyHVybY",
        "payment_requests": [
          {
            "computed_amount_money": {
              "amount": 10000,
              "currency": "USD"
            },
            "due_date": "2030-01-24",
            "reminders": [
              {
                "message": "Your invoice is due tomorrow",
                "relative_scheduled_days": -1,
                "status": "PENDING",
                "uid": "beebd363-e47f-4075-8785-c235aaa7df11"
              }
            ],
            "request_method": "EMAIL",
            "request_type": "BALANCE",
            "tipping_enabled": true,
            "total_completed_amount_money": {
              "amount": 0,
              "currency": "USD"
            },
            "uid": "2da7964f-f3d2-4f43-81e8-5aa220bf3355"
          }
        ],
        "primary_recipient": {
          "customer_id": "JDKYHBWT1D4F8MFH63DBMEN8Y4",
          "email_address": "Amelia.Earhart@example.com",
          "family_name": "Earhart",
          "given_name": "Amelia",
          "phone_number": "1-212-555-4240"
        },
        "scheduled_at": "2030-01-13T10:00:00Z",
        "status": "DRAFT",
        "timezone": "America/Los_Angeles",
        "title": "Event Planning Services",
        "updated_at": "2020-06-18T17:45:13Z",
        "version": 0
      }
    }
  ]
}
```

