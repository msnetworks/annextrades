
# Update Customer Group Request

Defines the body parameters that can be provided in a request to the
[UpdateCustomerGroup](#endpoint-updatecustomergroup) endpoint.

## Structure

`UpdateCustomerGroupRequest`

## Fields

| Name | Type | Description | Getter | Setter |
|  --- | --- | --- | --- | --- |
| `group` | [`CustomerGroup`](/doc/models/customer-group.md) | Represents a group of customer profiles.<br><br>Customer groups can be created, modified, and have their membership defined either via<br>the Customers API or within Customer Directory in the Square Dashboard or Point of Sale. | getGroup(): CustomerGroup | setGroup(CustomerGroup group): void |

## Example (as JSON)

```json
{
  "group": {
    "name": "Loyal Customers"
  }
}
```

