
# Cancel Invoice Request

Describes a `CancelInvoice` request.

## Structure

`CancelInvoiceRequest`

## Fields

| Name | Type | Description | Getter | Setter |
|  --- | --- | --- | --- | --- |
| `version` | `int` | The version of the [invoice](#type-invoice) to cancel.<br>If you do not know the version, you can call<br>[GetInvoice](#endpoint-Invoices-GetInvoice) or [ListInvoices](#endpoint-Invoices-ListInvoices). | getVersion(): int | setVersion(int version): void |

## Example (as JSON)

```json
{
  "version": 0
}
```

