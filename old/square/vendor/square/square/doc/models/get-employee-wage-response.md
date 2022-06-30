
# Get Employee Wage Response

A response to a request to get an `EmployeeWage`. Contains
the requested `EmployeeWage` objects. May contain a set of `Error` objects if
the request resulted in errors.

## Structure

`GetEmployeeWageResponse`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `employeeWage` | [`?EmployeeWage`](/doc/models/employee-wage.md) | Optional | The hourly wage rate that an employee will earn on a `Shift` for doing the job<br>specified by the `title` property of this object. Deprecated at verison 2020-08-26. Use `TeamMemberWage` instead. | getEmployeeWage(): ?EmployeeWage | setEmployeeWage(?EmployeeWage employeeWage): void |
| `errors` | [`?(Error[])`](/doc/models/error.md) | Optional | Any errors that occurred during the request. | getErrors(): ?array | setErrors(?array errors): void |

## Example (as JSON)

```json
{
  "employee_wage": {
    "employee_id": "33fJchumvVdJwxV0H6L9",
    "hourly_rate": {
      "amount": 2000,
      "currency": "USD"
    },
    "id": "pXS3qCv7BERPnEGedM4S8mhm",
    "title": "Manager"
  }
}
```

