# Auth

## Entities

### Organisation

Organisations are companies.
They have a name, a UUID V4 with a prefix of `org-` and a number of members, each of which can have different roles.

#### Organisation Role

Roles exist between a user and an organisation and can consist of `member`, `admin`.

### User

Users have an id which is a UUID V4 with a prefix of `usr-`.
Users have a username, email address and password.

### JWT Token

JWT tokens are created when a user is authenticated and are sent via the UI to all other backend services so as they know who is logged in, and so as they know what permissions are allowed.

#### Structure

```
{
	"sub": "usr-111-111-111-111",
	"orgs": [
		"org-222-222-222-222",
		"org-333-333-333-333"
	],
	"ttl": "1520197820",
	"perms": {
		"resourceName": {
			"action": {
				"restrictionName": [
					"val1",
					"val2"
				],
			}
		}
	}
}
```

- If a resourceName or action is missing from the perms, then access is denied.
- If a resource name and action exists, but there are no restrictions then access is allowed.
- If a resource name and action exists, and there are restrictions, you should check against all restrictions in and `AND` context.

For example, the following permissions...

- A user can read all problems
- A user can create problems for the organisations "org-111-111-111-111" and "org-222-222-222-222"
- A user can update problems for the organisations "org-111-111-111-111" and "org-222-222-222-222"
- A user can delete problems for the organisations "org-111-111-111-111" and "org-222-222-222-222"
- A user can read all organisations
- A user can create an organisation
- A user cannot update or delete any organisations

```
{
	"sub": "usr-111-111-111-111",
	"orgs": [
		"org-222-222-222-222",
		"org-333-333-333-333"
	],
	"ttl": "1520197820",
	"perms": {
		"organisation": {
			"read": {},
			"create": {}
		},
		"problem": {
			"read": {},
			"create": {
				"organisationId": [
					"org-222-222-222-222",
					"org-333-333-333-333"
				]
			},
			"update": {
				"organisationId": [
					"org-222-222-222-222",
					"org-333-333-333-333"
				]
			},
			"delete": {
				"organisationId": [
					"org-222-222-222-222",
					"org-333-333-333-333"
				]
			}
		}
	}
}
```

## Authorization

On protected endpoints you will need to send in an `Authorization` header and provide your JWT token.

The header should look something like this:

```
Authorization: Bearer eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1MjE1MDYxNjksInR0ciI6MTUyMTUwOTc2OSwiZGF0YSI6eyJuYW1lIjoiVG9tbXkgQnVtIEJ1bSIsInVzZXJuYW1lIjoidG9tIiwicGVybXMiOnsib3JnYW5pc2F0aW9ucyI6eyJjcmVhdGUiOnt9LCJyZWFkIjp7fSwidXBkYXRlIjp7fSwiZGVsZXRlIjp7fX0sIm1lbWJlcnMiOnsiY3JlYXRlIjp7fSwicmVhZCI6e30sInVwZGF0ZSI6e30sImRlbGV0ZSI6e319LCJwcm9ibGVtIjp7ImNyZWF0ZSI6e30sInJlYWQiOnt9LCJ1cGRhdGUiOnt9LCJkZWxldGUiOnt9fSwicGxlZGdlIjp7ImNyZWF0ZSI6e30sInJlYWQiOnt9LCJ1cGRhdGUiOnt9LCJkZWxldGUiOnt9fX19fQ.793a682302c81bc1f2e2e50d0b4870f0c3215eb9411d03a606894bb738dde51f
```

## Routes

### `POST` - `/auth/login`

Logs a user in.


```
{
    "username": "PTBarnum",
    "password": "MyCleverPassword34"
}
```

The response will contain the JWT token.

### `GET` - `/auth/payload`

Authorization required!

This endpoint will response with the payload contained in the JWT token.

## Create A User

### `POST`  `/user/createFromEmailPassword`
```
{
    "username": "PTBarnum",
    "email": "pt@barnham.com",
    "password": "MyCleverPassword34"
}
```

### `POST`  `/user/createFromGitHub`
You will need to use GitHubs Oauth to get the access token and github_id (github user id)
```
{
    "username": "PTBarnum",
    "github_id": 19876789,
    "access_token": "WHg092ohiuaed97yujedfndsdjwdjs"
}
```

The /user/create... endpoints will give a new JWT Token or send back an error message.

It will also give state what `field` the error relates to.