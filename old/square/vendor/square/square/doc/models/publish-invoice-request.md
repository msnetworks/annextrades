
# Publish Invoice Request

Describes a `PublishInvoice` request.

## Structure

`PublishInvoiceRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `version` | `int` |  | The version of the [Invoice](#type-invoice) to publish.<br>This must match the current version of the invoice,<br>otherwise the request is rejected. | getVersion(): int | setVersion(int version): void |
| `idempotencyKey` | `?string` | Optional | A unique string that identifies the `PublishInvoice` request. If you do not<br>provide `idempotency_key` (or provide an empty string as the value), the endpoint<br>treats each request as independent.<br><br>For more information, see [Idempotency](https://developer.squareup.com/docs/working-with-apis/idempotency). | getIdempotencyKey(): ?string | setIdempotencyKey(?string idempotencyKey): void |

## Example (as JSON)

```json
{
  "idempotency_key": "32da42d0-1997-41b0-826b-f09464fc2c2e",
  "version": 1
}
```

