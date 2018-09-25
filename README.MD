# API

### JWT Token

JWT tokens are created when a user is authenticated and are sent via the UI to all other backend services so as they know who is logged in, and so as they know what permissions are allowed.

#### Structure

```
{
  "ttl": 1533395606,
  "ttr": 1534295606,
  "data": {
    "user_id": "usr-67a93cc0-d183-46e6-82a6-1f23feb15d1c",
    "name": "Kaddy Brow",
    "email": "bozo@gmail.co.uk",
    "data": "{}",
    "username": "KaddyBrow21",
    "modified": "2018-08-03 11:26:46",
    "created": "2018-08-02 08:57:14",
    "permissions": [
      {
        "permission_id": "prm-c3d56df4-4008-43ee-b47b-ff996581ecaa",
        "resource": "organisations",
        "resource_id": null,
        "action": "create"
      },
      {
        "permission_id": "prm-f1604942-cd81-4e6e-b9d4-0b265d2cbae4",
        "resource": "problems",
        "resource_id": null,
        "action": "create"
      },
      {
        "permission_id": "prm-1d0bdd9f-37fb-44a0-8a5c-a31af8a9382a",
        "resource": "solutions",
        "resource_id": null,
        "action": "create"
      }
    ]
  }
}
```


## Authorization

On protected endpoints you will need to send in an `Authorization` header and provide your JWT token.

The header should look something like this:

```
Authorization: Bearer eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1MjE1MDYxNjksInR0ciI6MTUyMTUwOTc2OSwiZGF0YSI6eyJuYW1lIjoiVG9tbXkgQnVtIEJ1bSIsInVzZXJuYW1lIjoidG9tIiwicGVybXMiOnsib3JnYW5pc2F0aW9ucyI6eyJjcmVhdGUiOnt9LCJyZWFkIjp7fSwidXBkYXRlIjp7fSwiZGVsZXRlIjp7fX0sIm1lbWJlcnMiOnsiY3JlYXRlIjp7fSwicmVhZCI6e30sInVwZGF0ZSI6e30sImRlbGV0ZSI6e319LCJwcm9ibGVtIjp7ImNyZWF0ZSI6e30sInJlYWQiOnt9LCJ1cGRhdGUiOnt9LCJkZWxldGUiOnt9fSwicGxlZGdlIjp7ImNyZWF0ZSI6e30sInJlYWQiOnt9LCJ1cGRhdGUiOnt9LCJkZWxldGUiOnt9fX19fQ.793a682302c81bc1f2e2e50d0b4870f0c3215eb9411d03a606894bb738dde51f
```

[ All API Endpoints ](/ENDPOINTS.MD)