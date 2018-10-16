# API Endpoints
* Header Required: "Content-Type: application/json"

* [POST */auth/login* ](#9e9be264d609c0e1a535693ba4c389aa)  
* [POST */auth/githubLogin* ](#edeb9564c9efd26efb8f581eb1c9e702)  
* [POST */auth/refresh* ](#6aadba1bf11b4320428155ff0462660d)  
* [GET */auth/payload* ](#4d7a604816d1fcd64905c4ea44b2ff34)  
* [GET */comment/{comment_id}* ](#bdf65e4ac71fd4734b8911450b48747a)  
* [GET */comments/{entity_id}* ](#730279b6daf48b67b7c5b4f3d60cade1)  
* [GET */comment/replies/{comment_id}* ](#5e9baa95c85cd05f1883a1658c695e38)  
* [GET */comments/{entity_id}/page/{page}* ](#7e5db0f20f531104447319e4749337b6)  
* [GET */comment/replies/{comment_id}/page/{page}* ](#0eb915a573fc15cf3417693b3f1193ef)  
* [POST */comment/reply/{comment_id}* ](#72ac4ef8c4bf8ebf07e7109699cbca43)  
* [POST */comment/{entity_id}* ](#233eaa6e9c081848acb3307f1667e039)  
* [GET */comments/contextual/{comment_id}* ](#e1cbf581295f39716da8907a49461879)  
* [POST */entity/getForFeed* ](#6defe9443c2e6e9c048ede20f8c3c0fc)  
* [POST */follow/{entity_id}* ](#aa5afd626aa97e6b72073f5e19cedd89)  
* [DELETE */follow/{entity_id}* ](#aa5afd626aa97e6b72073f5e19cedd89)  
* [GET */follows/{user_id}* ](#a6187c671e0f3ea8f370d2fdf2ee45e2)  
* [GET */list/topics* ](#24503bb79493da082da83d00929ec480)  
* [GET */oauth/github/auth/url/{state}* ](#f2fc8eef589cec3f3f95ca6d65edc22c)  
* [GET */organisation/{id}* ](#e1762d100a6929cfc74781d2ddb1cc00)  
* [POST */pay/pledge/{pledge_id}/stripeToken* ](#e9bc731ddfb1c933002f9277ffcf6210)  
* [POST */pay/pledge/{pledge_id}/paymentMethod* ](#b42b12928e36d75afafc0779f12e1d8e)  
* [POST */pay/method/stripe/create* ](#773f97a97f3ce1f2c33bf299ff4f84a7)  
* [GET */pay/stripe/apiKey* ](#f4736e794cd1ef92efc6774ed9537d5c)  
* [POST */problem/create* ](#b31bd1dcd02261da71d8e613f604296d)  
* [PATCH */problem/{problem_id}* ](#eb9c789eb542b25f86b7179231882da4)  
* [GET */problem/{problem_id}* ](#eb9c789eb542b25f86b7179231882da4)  
* [GET */problems/user/{user_id}* ](#93db5e08602096fd25e7b5209bc4250c)  
* [POST */problem/{problem_id}/solution* ](#f0f81537410f05c5d6cf468acc06962d)  
* [POST */problem/{problem_id}/pledge* ](#a7814c807a05b3b8169022dc114bb8b5)  
* [GET */public/user/{username}* ](#159f30377e530b420f60a64b6f9e38db)  
* [GET */public/github/id/{github_id}* ](#1dad4a57683e221428d1da02526abd24)  
* [GET */public/github/{$user_id}* ](#bd2faa05784c7728f59d707d7c7f6cc7)  
* [GET */server/datetime* ](#8c5715baa1eb22b1cc956e8cd1e1407a)  
* [GET */server/methods* ](#4be0e25a2128cb1258740cb98776cd06)  
* [GET */server/endpoints* ](#b2c546f004f0bb2d69d8ba521a119db5)  
* [GET */status/{status_id}* ](#3b59a365a859a401e71ef727611b0b75)  
* [POST */status/create* ](#aa1be36547a94d55610b42930522412b)  
* [GET */statuses/user/{user_id}* ](#19c75cda305a74aa79b9f10a4adfdf50)  
* [POST */user/createFromEmailPassword* ](#d31bc5fc76e2808d46f1ac55cd00619f)  
* [POST */user/createFromGitHub* ](#5d12bfd57ed22f2195aed47aad5c5fae)  
* [POST */user/checkUsernameAvailability* ](#a4ca820248758b268f84bbb95ac6e4c8)  
* [POST */user/updatePassword/{user_id}* ](#4b2718ed3db8a55691535ad48ff7d95e)  
* [POST */user/updateGitHub/{user_id}* ](#d7e3332f0a7e07195a7d246df28702d9)  
* [PATCH */user/{user_id}* ](#42cdaca1e391f365915115ad7d2e2343)  
* [POST */user/createStripePaymentMethod/{user_id}* ](#a649067d90bf9cd3f777ac6b97784113)  
* [GET */user/paymentMethods/{user_id}* ](#7f333a4604623e21f987644be9ac6783)  
* [GET */user/pledges/{user_id}* ](#7e57cb273990dca830002bf6deb2711e)  
## <a name="9e9be264d609c0e1a535693ba4c389aa"></a>POST /auth/login
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
{
    "username": "CoolGuy121",
    "password": "myextremelySAFEpassword!z**"
}
```
#### Example Response
```
{
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="edeb9564c9efd26efb8f581eb1c9e702"></a>POST /auth/githubLogin
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
{
    "code": "987ygnedjdmdlajhda",
    "state": "nd98ydahedkjabsdkjb"
}
```
#### Example Response
```
{
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="6aadba1bf11b4320428155ff0462660d"></a>POST /auth/refresh
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
{}
```
#### Example Response
```
{
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="4d7a604816d1fcd64905c4ea44b2ff34"></a>GET /auth/payload
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Response
```
{
    "payload": {
        "permissions": [
            {
                "permission_id": "prm-accb383c-78ba-49a8-9b84-1fef39db625d",
                "resource": "problems",
                "resource_id": null,
                "action": "create"
            },
            {
                "permission_id": "prm-cc42e469-c021-4dec-a0eb-fdf5ce66dce7",
                "resource": "organisations",
                "resource_id": null,
                "action": "create"
            },
            {
                "permission_id": "prm-2e018152-d2ed-463d-a4ef-25a1d6d3b1f1",
                "resource": "solutions",
                "resource_id": null,
                "action": "create"
            }
        ]
    }
}
```

## <a name="bdf65e4ac71fd4734b8911450b48747a"></a>GET /comment/{comment_id}
#### Example Response
```
{
    "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
    "parent_comment_id": null,
    "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "last_five_replies": [],
    "total_replies": 0,
    "comment_type": "comment_on_entity",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    }
}
```

## <a name="730279b6daf48b67b7c5b4f3d60cade1"></a>GET /comments/{entity_id}
#### Example Response
```
{
    "comments": [
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        },
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ]
}
```

## <a name="5e9baa95c85cd05f1883a1658c695e38"></a>GET /comment/replies/{comment_id}
#### Example Response
```
{
    "comments": [
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        },
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ]
}
```

## <a name="7e5db0f20f531104447319e4749337b6"></a>GET /comments/{entity_id}/page/{page}
#### Example Response
```
{
    "comments": [
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        },
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ]
}
```

## <a name="0eb915a573fc15cf3417693b3f1193ef"></a>GET /comment/replies/{comment_id}/page/{page}
#### Example Response
```
{
    "comments": [
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        },
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ]
}
```

## <a name="72ac4ef8c4bf8ebf07e7109699cbca43"></a>POST /comment/reply/{comment_id}
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
{
    "comment": "My awesome comment! http:\/\/www.google.com link to stuff"
}
```
#### Example Response
```
{
    "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
    "parent_comment_id": null,
    "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "last_five_replies": [],
    "total_replies": 0,
    "comment_type": "comment_on_entity",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    }
}
```

## <a name="233eaa6e9c081848acb3307f1667e039"></a>POST /comment/{entity_id}
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
{
    "comment": "My awesome comment! http:\/\/www.google.com link to stuff"
}
```
#### Example Response
```
{
    "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
    "parent_comment_id": null,
    "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "last_five_replies": [],
    "total_replies": 0,
    "comment_type": "comment_on_entity",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    }
}
```

## <a name="e1cbf581295f39716da8907a49461879"></a>GET /comments/contextual/{comment_id}
#### Example Response
```
{
    "comments": [
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        },
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ]
}
```

## <a name="6defe9443c2e6e9c048ede20f8c3c0fc"></a>POST /entity/getForFeed
#### Example Request
```
"coming soon"
```
#### Example Response
```
"coming soon"
```

## <a name="aa5afd626aa97e6b72073f5e19cedd89"></a>POST /follow/{entity_id}
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
{}
```
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "entity": "problem",
    "created": "2018-10-16 19:27:36"
}
```

## <a name="aa5afd626aa97e6b72073f5e19cedd89"></a>DELETE /follow/{entity_id}
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
"coming soon"
```
#### Example Response
```
{
    "deleted": true
}
```

## <a name="a6187c671e0f3ea8f370d2fdf2ee45e2"></a>GET /follows/{user_id}
#### Example Response
```
{
    "follows": [
        {
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "entity": "problem",
            "created": "2018-10-16 19:27:36"
        },
        {
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "entity": "problem",
            "created": "2018-10-16 19:27:36"
        },
        {
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "entity": "problem",
            "created": "2018-10-16 19:27:36"
        }
    ]
}
```

## <a name="24503bb79493da082da83d00929ec480"></a>GET /list/topics
#### Example Response
```
{
    "topics": [
        {
            "topic_id": "top-Framework",
            "name": "Framework",
            "parent_name": null,
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Language",
            "name": "Language",
            "parent_name": null,
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Technology",
            "name": "Technology",
            "parent_name": null,
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-PHP",
            "name": "PHP",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-HTML",
            "name": "HTML",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-JS",
            "name": "JS",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Python",
            "name": "Python",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-CSS",
            "name": "CSS",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Shell",
            "name": "Shell",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Swift",
            "name": "Swift",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Go",
            "name": "Go",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-C-23",
            "name": "C#",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-C",
            "name": "C",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Objective-C",
            "name": "Objective-C",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Docker-Compose",
            "name": "Docker Compose",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Docker-File",
            "name": "Docker File",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Java",
            "name": "Java",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-SCSS",
            "name": "SCSS",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-SASS",
            "name": "SASS",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-LESS",
            "name": "LESS",
            "parent_name": "Language",
            "description": null,
            "example": null
        },
        {
            "topic_id": "top-Laravel",
            "name": "Laravel",
            "parent_name": "Framework",
            "description": "PHP Framework",
            "example": null
        },
        {
            "topic_id": "top-Code-Igniter",
            "name": "Code Igniter",
            "parent_name": "Framework",
            "description": "PHP Framework",
            "example": null
        },
        {
            "topic_id": "top-Zend",
            "name": "Zend",
            "parent_name": "Framework",
            "description": "PHP Framework",
            "example": null
        },
        {
            "topic_id": "top-React",
            "name": "React",
            "parent_name": "Framework",
            "description": "JS Framework",
            "example": null
        },
        {
            "topic_id": "top-Vue",
            "name": "Vue",
            "parent_name": "Framework",
            "description": "JS Framework",
            "example": null
        },
        {
            "topic_id": "top-Word-Press",
            "name": "Word Press",
            "parent_name": "Framework",
            "description": "PHP Framework",
            "example": null
        },
        {
            "topic_id": "top-Kubernetes",
            "name": "Kubernetes",
            "parent_name": "Technology",
            "description": "Container Orchestration",
            "example": null
        },
        {
            "topic_id": "top-Docker-Swarm",
            "name": "Docker Swarm",
            "parent_name": "Technology",
            "description": "Container Orchestration",
            "example": null
        },
        {
            "topic_id": "top-Docker",
            "name": "Docker",
            "parent_name": "Technology",
            "description": "Container",
            "example": null
        },
        {
            "topic_id": "top-Apache",
            "name": "Apache",
            "parent_name": "Technology",
            "description": "Server Technologies",
            "example": null
        },
        {
            "topic_id": "top-Nginx",
            "name": "Nginx",
            "parent_name": "Technology",
            "description": "PHP Framework",
            "example": null
        },
        {
            "topic_id": "top-Web-Sockets",
            "name": "Web Sockets",
            "parent_name": "Technology",
            "description": "Protocol",
            "example": null
        },
        {
            "topic_id": "top-TCP",
            "name": "TCP",
            "parent_name": "Technology",
            "description": "Protocol",
            "example": null
        },
        {
            "topic_id": "top-SSL",
            "name": "SSL",
            "parent_name": "Technology",
            "description": "Security Protocol",
            "example": null
        },
        {
            "topic_id": "top-Swoole",
            "name": "Swoole",
            "parent_name": "Technology",
            "description": "Server Technologies",
            "example": null
        },
        {
            "topic_id": "top-System-Administration",
            "name": "System Administration",
            "parent_name": "Technology",
            "description": "Taking care of Server Technologies",
            "example": null
        },
        {
            "topic_id": "top-Ansible",
            "name": "Ansible",
            "parent_name": "Technology",
            "description": "Server Orchestration",
            "example": null
        }
    ]
}
```

## <a name="f2fc8eef589cec3f3f95ca6d65edc22c"></a>GET /oauth/github/auth/url/{state}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
#### Example Response
```
{
    "url": "https:\/\/github.com\/login\/oauth\/authorize?client_id=&redirect_uri=&state=aSt2taateYouGeenerAtEd00"
}
```

## <a name="e1762d100a6929cfc74781d2ddb1cc00"></a>GET /organisation/{id}
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Response
```
"coming soon"
```

## <a name="e9bc731ddfb1c933002f9277ffcf6210"></a>POST /pay/pledge/{pledge_id}/stripeToken
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
{
    "token": "98yg3nrkfud8ew92okKnrfmcU8ujNmT"
}
```
#### Example Response
```
{
    "payment_id": "pay-e3eabfca-4621-49a6-afd2-7979f9a9c89a",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "value": 2.9,
    "currency": "USD",
    "gateway": "Stripe",
    "reference": "TransRef0987656789032q",
    "data": "{}",
    "created": "2018-10-16 19:27:36",
    "modified": "2018-10-16 19:27:36"
}
```

## <a name="b42b12928e36d75afafc0779f12e1d8e"></a>POST /pay/pledge/{pledge_id}/paymentMethod
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
"coming soon"
```
#### Example Response
```
"coming soon"
```

## <a name="773f97a97f3ce1f2c33bf299ff4f84a7"></a>POST /pay/method/stripe/create
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
"coming soon"
```
#### Example Response
```
"coming soon"
```

## <a name="f4736e794cd1ef92efc6774ed9537d5c"></a>GET /pay/stripe/apiKey
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
* Header Required: "Origin-Auth: {origin_token}"
#### Example Response
```
{
    "api_key": "woiugbdwef923hoascdkjcn"
}
```

## <a name="b31bd1dcd02261da71d8e613f604296d"></a>POST /problem/create
### Requirements
* Header Required: Authorization: Bearer {access_token}
* User must have "create" on "problems"  permission
#### Example Request
```
{
    "title": "My Problems Title",
    "description": "Description of Problem",
    "specification": "Outline of Specification Needed",
    "make_active": true,
    "active_datetime": "2018-01-01 01:00:00",
    "deadline_datetime": "2018-01-01 01:00:00",
    "topics": [
        "PHP",
        "JS"
    ]
}
```
#### Example Response
```
{
    "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "user_id": null,
    "organisation_id": null,
    "title": "My Problems Title",
    "description": "Description of Problem",
    "specification": "Outline of Specification Needed",
    "data": "{}",
    "active_datetime": null,
    "deadline_datetime": null,
    "deleted": 0,
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "is_active": false,
    "topics": [],
    "solutions": [
        {
            "solution_id": "sol-dcd69374-8a27-4746-914e-ca4cdeddaef9",
            "problem_solution_group_id": null,
            "solution_group_id": null,
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "name": "My Super Solution name",
            "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "open_source_location": "https:\/\/mylinktogithub.com\/mycoolsolution",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            },
            "last_five_comments": [],
            "total_comments": 0
        }
    ],
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "pledges_count": 0,
    "pledges_value": 0,
    "latest_pledges": []
}
```

## <a name="eb9c789eb542b25f86b7179231882da4"></a>PATCH /problem/{problem_id}
### Requirements
* Header Required: Authorization: Bearer {access_token}
* User must have "create" on "problems"  permission
#### Example Request
```
{
    "title": "My Problems Title",
    "description": "Description of Problem",
    "specification": "Outline of Specification Needed",
    "make_active": true,
    "active_datetime": "2018-01-01 01:00:00",
    "deadline_datetime": "2018-01-01 01:00:00",
    "topics": [
        "PHP",
        "JS"
    ]
}
```
#### Example Response
```
{
    "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "user_id": null,
    "organisation_id": null,
    "title": "My Problems Title",
    "description": "Description of Problem",
    "specification": "Outline of Specification Needed",
    "data": "{}",
    "active_datetime": null,
    "deadline_datetime": null,
    "deleted": 0,
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "is_active": false,
    "topics": [],
    "solutions": [
        {
            "solution_id": "sol-dcd69374-8a27-4746-914e-ca4cdeddaef9",
            "problem_solution_group_id": null,
            "solution_group_id": null,
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "name": "My Super Solution name",
            "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "open_source_location": "https:\/\/mylinktogithub.com\/mycoolsolution",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            },
            "last_five_comments": [],
            "total_comments": 0
        }
    ],
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "pledges_count": 0,
    "pledges_value": 0,
    "latest_pledges": []
}
```

## <a name="eb9c789eb542b25f86b7179231882da4"></a>GET /problem/{problem_id}
#### Example Response
```
"coming soon"
```

## <a name="93db5e08602096fd25e7b5209bc4250c"></a>GET /problems/user/{user_id}
#### Example Response
```
"coming soon"
```

## <a name="f0f81537410f05c5d6cf468acc06962d"></a>POST /problem/{problem_id}/solution
### Requirements
* Header Required: Authorization: Bearer {access_token}
* User must have "create" on "solutions"  permission
#### Example Request
```
{
    "name": "My Super Solution name",
    "open_source_location": "https:\/\/mylinktogithub.com\/mycoolsolution"
}
```
#### Example Response
```
{
    "solution_id": "sol-dcd69374-8a27-4746-914e-ca4cdeddaef9",
    "problem_solution_group_id": null,
    "solution_group_id": null,
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "name": "My Super Solution name",
    "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "open_source_location": "https:\/\/mylinktogithub.com\/mycoolsolution",
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    }
}
```

## <a name="a7814c807a05b3b8169022dc114bb8b5"></a>POST /problem/{problem_id}/pledge
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
{
    "comment": "A Solution for this problem will be greatly appreciated! <img src=\"http:\/\/monkey.com\/pic.jpg\" \/>",
    "value": "2.50",
    "currency": "USD"
}
```
#### Example Response
```
{
    "pledge_id": "plg-285f06c2-5e6e-4bef-bc9a-edc1d63d917a",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "kudos_points": 0,
    "value": 2.5,
    "currency": "USD",
    "comment": "A Solution for this problem will be greatly appreciated! ",
    "data": "{}",
    "payment_id": null,
    "solution_id": null,
    "created": "2018-10-16 19:27:36",
    "modified": "2018-10-16 19:27:36",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "is_paid": false,
    "is_verified": false,
    "is_awarded_to_solution": false
}
```

## <a name="159f30377e530b420f60a64b6f9e38db"></a>GET /public/user/{username}
#### Example Response
```
{
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "github_user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "id": 5678765,
        "login": "JohnnyDevHead100",
        "node_id": "hgy78gifrjwemdc",
        "avatar_url": "http:\/\/github.com\/myprofilepic.jpg",
        "gravatar_id": null,
        "type": "User",
        "site_admin": false,
        "name": null,
        "company": null,
        "blog": null,
        "bio": "20 Years Experience Developing Software, Websites & Apps.",
        "location": "Kent",
        "email": "johnndevhead@gmail.com",
        "hireable": null,
        "public_repos": 0,
        "public_gists": 0,
        "followers": 0,
        "following": 0,
        "created_at": "2018-10-16 19:27:36",
        "updated_at": "2018-10-16 19:27:36"
    },
    "problems": [
        {
            "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "user_id": null,
            "organisation_id": null,
            "title": "My Problems Title",
            "description": "Description of Problem",
            "specification": "Outline of Specification Needed",
            "data": "{}",
            "active_datetime": null,
            "deadline_datetime": null,
            "deleted": 0,
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "is_active": false,
            "topics": [],
            "solutions": [
                {
                    "solution_id": "sol-dcd69374-8a27-4746-914e-ca4cdeddaef9",
                    "problem_solution_group_id": null,
                    "solution_group_id": null,
                    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                    "name": "My Super Solution name",
                    "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
                    "open_source_location": "https:\/\/mylinktogithub.com\/mycoolsolution",
                    "modified": "2018-10-16 19:27:36",
                    "created": "2018-10-16 19:27:36",
                    "user": {
                        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                        "name": "Johnny DevHead",
                        "github_id": null,
                        "username": "JohnnyDevHead",
                        "modified": "2018-10-16 19:27:36",
                        "created": "2018-10-16 19:27:36"
                    },
                    "last_five_comments": [],
                    "total_comments": 0
                }
            ],
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            },
            "pledges_count": 0,
            "pledges_value": 0,
            "latest_pledges": []
        }
    ],
    "solutions": [
        {
            "solution_id": "sol-dcd69374-8a27-4746-914e-ca4cdeddaef9",
            "problem_solution_group_id": null,
            "solution_group_id": null,
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "name": "My Super Solution name",
            "problem_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "open_source_location": "https:\/\/mylinktogithub.com\/mycoolsolution",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ],
    "statuses": [
        {
            "comment_id": "cmt-e6bea837-f3f9-45b8-acd5-6d145dcf00ad",
            "parent_comment_id": null,
            "comment": "My awesome comment! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
            "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
            "organisation_id": null,
            "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
            "modified": "2018-10-16 19:27:36",
            "created": "2018-10-16 19:27:36",
            "last_five_replies": [],
            "total_replies": 0,
            "comment_type": "comment_on_entity",
            "user": {
                "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
                "name": "Johnny DevHead",
                "github_id": null,
                "username": "JohnnyDevHead",
                "modified": "2018-10-16 19:27:36",
                "created": "2018-10-16 19:27:36"
            }
        }
    ],
    "pledges_count": 20
}
```

## <a name="1dad4a57683e221428d1da02526abd24"></a>GET /public/github/id/{github_id}
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "id": 5678765,
    "login": "JohnnyDevHead100",
    "node_id": "hgy78gifrjwemdc",
    "avatar_url": "http:\/\/github.com\/myprofilepic.jpg",
    "gravatar_id": null,
    "type": "User",
    "site_admin": false,
    "name": null,
    "company": null,
    "blog": null,
    "bio": "20 Years Experience Developing Software, Websites & Apps.",
    "location": "Kent",
    "email": "johnndevhead@gmail.com",
    "hireable": null,
    "public_repos": 0,
    "public_gists": 0,
    "followers": 0,
    "following": 0,
    "created_at": "2018-10-16 19:27:36",
    "updated_at": "2018-10-16 19:27:36"
}
```

## <a name="bd2faa05784c7728f59d707d7c7f6cc7"></a>GET /public/github/{$user_id}
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "id": 5678765,
    "login": "JohnnyDevHead100",
    "node_id": "hgy78gifrjwemdc",
    "avatar_url": "http:\/\/github.com\/myprofilepic.jpg",
    "gravatar_id": null,
    "type": "User",
    "site_admin": false,
    "name": null,
    "company": null,
    "blog": null,
    "bio": "20 Years Experience Developing Software, Websites & Apps.",
    "location": "Kent",
    "email": "johnndevhead@gmail.com",
    "hireable": null,
    "public_repos": 0,
    "public_gists": 0,
    "followers": 0,
    "following": 0,
    "created_at": "2018-10-16 19:27:36",
    "updated_at": "2018-10-16 19:27:36"
}
```

## <a name="8c5715baa1eb22b1cc956e8cd1e1407a"></a>GET /server/datetime
#### Example Response
```
"coming soon"
```

## <a name="4be0e25a2128cb1258740cb98776cd06"></a>GET /server/methods
#### Example Response
```
"coming soon"
```

## <a name="b2c546f004f0bb2d69d8ba521a119db5"></a>GET /server/endpoints
#### Example Response
```
"coming soon"
```

## <a name="3b59a365a859a401e71ef727611b0b75"></a>GET /status/{status_id}
#### Example Response
```
{
    "comment_id": "sts-12248efe-9ce9-4d40-86d6-8428f2457de2",
    "parent_comment_id": null,
    "comment": "My awesome comment about php vs python! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "comment_type": "status",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "status_id": "sts-12248efe-9ce9-4d40-86d6-8428f2457de2",
    "last_five_comments": [],
    "total_comments": 0,
    "topics": [
        "PHP",
        "Python"
    ]
}
```

## <a name="aa1be36547a94d55610b42930522412b"></a>POST /status/create
### Requirements
* Header Required: "Authorization: Bearer {access_token}"
#### Example Request
```
{
    "comment": "My awesome comment about php vs python! http:\/\/www.google.com link to stuff",
    "topics": [
        "PHP",
        "Python"
    ]
}
```
#### Example Response
```
{
    "comment_id": "sts-12248efe-9ce9-4d40-86d6-8428f2457de2",
    "parent_comment_id": null,
    "comment": "My awesome comment about php vs python! <a href=\"http:\/\/www.google.com\" target=\"_blank\">http:\/\/www.google.com<\/a> link to stuff",
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "organisation_id": null,
    "entity_id": "prb-bb40c3cf-67b3-4be5-8a93-40e9bd154b07",
    "modified": "2018-10-16 19:27:36",
    "created": "2018-10-16 19:27:36",
    "comment_type": "status",
    "user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "github_id": null,
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "status_id": "sts-12248efe-9ce9-4d40-86d6-8428f2457de2",
    "last_five_comments": [],
    "total_comments": 0,
    "topics": [
        "PHP",
        "Python"
    ]
}
```

## <a name="19c75cda305a74aa79b9f10a4adfdf50"></a>GET /statuses/user/{user_id}
#### Example Response
```
"coming soon"
```

## <a name="d31bc5fc76e2808d46f1ac55cd00619f"></a>POST /user/createFromEmailPassword
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
{
    "email": "johnndevhead@gmail.com",
    "password": "MyPrettyBloodyAmazing!Password",
    "username": "JohnnyDevHead"
}
```
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "username": "JohnnyDevHead",
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="5d12bfd57ed22f2195aed47aad5c5fae"></a>POST /user/createFromGitHub
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
{
    "code": "0987ygb2n3edieowkms23wqss2",
    "state": "bd7892hdbkn1212asdasd",
    "username": "JohnnyDevHead"
}
```
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "username": "JohnnyDevHead",
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="a4ca820248758b268f84bbb95ac6e4c8"></a>POST /user/checkUsernameAvailability
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
#### Example Request
```
"coming soon"
```
#### Example Response
```
"coming soon"
```

## <a name="4b2718ed3db8a55691535ad48ff7d95e"></a>POST /user/updatePassword/{user_id}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
* Header Required: "Authorization: Bearer {access_token}"
* User must own the entity being accessed
#### Example Request
```
{
    "old_password": "myveryoldpassWord!",
    "new_password": "MyVeryNewPassword33!z00"
}
```
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "username": "JohnnyDevHead",
    "updated_user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "email": "johnndevhead@gmail.com",
        "github_id": null,
        "data": "{}",
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="d7e3332f0a7e07195a7d246df28702d9"></a>POST /user/updateGitHub/{user_id}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
* Header Required: "Authorization: Bearer {access_token}"
* User must own the entity being accessed
#### Example Request
```
{
    "code": "098ygbn23ebrhduiksmndmc",
    "state": "dihndfjndhjdsms0987"
}
```
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "username": "JohnnyDevHead",
    "updated_user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "email": "johnndevhead@gmail.com",
        "github_id": null,
        "data": "{}",
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="42cdaca1e391f365915115ad7d2e2343"></a>PATCH /user/{user_id}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
* Header Required: "Authorization: Bearer {access_token}"
* User must own the entity being accessed
#### Example Request
```
{
    "name": "Johnny DevHead",
    "email": "johnndevhead@gmail.com",
    "username": "JohnnyDevHead"
}
```
#### Example Response
```
{
    "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
    "username": "JohnnyDevHead",
    "updated_user": {
        "user_id": "usr-9b2a6d39-b2f3-4c5d-b0d3-e56dafa91669",
        "name": "Johnny DevHead",
        "email": "johnndevhead@gmail.com",
        "github_id": null,
        "data": "{}",
        "username": "JohnnyDevHead",
        "modified": "2018-10-16 19:27:36",
        "created": "2018-10-16 19:27:36"
    },
    "token": "eyJhbGciOiJTSEEyNTYiLCJ0eXAiOiJKV1QifQ.eyJ0dGwiOjE1Mzk4MTgwNTYsInR0ciI6MTU0MDcxODA1NiwiZGF0YSI6eyJ1c2VyX2lkIjoidXNyLTliMmE2ZDM5LWIyZjMtNGM1ZC1iMGQzLWU1NmRhZmE5MTY2OSIsIm5hbWUiOiJKb2hubnkgRGV2SGVhZCIsImVtYWlsIjoiam9obm5kZXZoZWFkQGdtYWlsLmNvbSIsImdpdGh1Yl9pZCI6bnVsbCwiZGF0YSI6Int9IiwidXNlcm5hbWUiOiJKb2hubnlEZXZIZWFkIiwibW9kaWZpZWQiOiIyMDE4LTEwLTE2IDE5OjI3OjM2IiwiY3JlYXRlZCI6IjIwMTgtMTAtMTYgMTk6Mjc6MzYiLCJwZXJtaXNzaW9ucyI6W119fQ.ea059d1865bf64fac0790bc55cc090ba192b65eb7f7c2636f94867ccfffa5450"
}
```

## <a name="a649067d90bf9cd3f777ac6b97784113"></a>POST /user/createStripePaymentMethod/{user_id}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
* Header Required: "Authorization: Bearer {access_token}"
* User must own the entity being accessed
#### Example Request
```
"coming soon"
```
#### Example Response
```
"coming soon"
```

## <a name="7f333a4604623e21f987644be9ac6783"></a>GET /user/paymentMethods/{user_id}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
* Header Required: "Authorization: Bearer {access_token}"
* User must own the entity being accessed
#### Example Response
```
"coming soon"
```

## <a name="7e57cb273990dca830002bf6deb2711e"></a>GET /user/pledges/{user_id}
### Requirements
* Header Required: "Origin-Auth: {origin_token}"
* Header Required: "Authorization: Bearer {access_token}"
* User must own the entity being accessed
#### Example Response
```
"coming soon"
```

