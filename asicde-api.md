[<< Return to documentation overview](README.md)

[>> Go to repository](https://github.com/ASICDE/asicde-api)

# ASICDE - API documentation

This repository holds API interface definitions. The full API specification is listed below. Each separate API module has it's own definition formatted in [Swagger](https://swagger.io/). These definitions are then compiled using Maven into data models which are then used in the backend modules. 

__\*\*\* NOTE: The latest documentation for the API interface can be found here: [https://team01-20.studenti.fiit.stuba.sk/api-docs/](https://team01-20.studenti.fiit.stuba.sk/api-docs/).__

Table of Contents
=================

   * [Auth](#auth)
       * [Create User](#create-user)
       * [Get Users](#get-users)
       * [Get Current User](#get-current-user)
       * [Get User](#get-user)
       * [Update User](#update-user)
       * [Activate User](#activate-user)
       * [Deactivate User](#deactivate-user)
       * [Mark User Login](#mark-user-login)
       * [Get All Users](#get-all-users)
       * [Get All Users Roles](#get-all-users-roles)
   * [Eval](#eval)       
       * [Upload Project](#upload-project)
   * [Repo](#repo)
       * [Create Repo](#create-repo)
       * [Get Repos By Author](#get-repos-by-author)
       * [Get Repo](#get-repo)
       * [Update Repo](#update-repo)
       * [Delete Repo](#delete-repo)
       * [Get Repo Files](#get-repo-files)
       * [Update Repo Files](#update-repo-files)
	   * [Toggle Favorite Repo](#toggle-favorite-repo)
	   * [Toggle Archived Repo](#toggle-favorite-repo)
	   * [Get Repos For Curent Organization](#get-repos-for-current-organization)
	   * [Get Public Repos Except Current User's Repos](#get-public-repos-except-current-users-repos)
   * [Systemverilogparser](#systemverilogparser)
      * [Code To Dia Extract](#code-to-dia-extract)
      * [Get Visualization Data](#get-visualization-data)
      * [Get Subdiagram Data](#get-subdiagram-data)
      * [Get Submodules](#get-submodules)
   * [Visualization](#visualization)
      * [Load Existing Module](#load-existing-module)
   * [Admin Dashboard](#admin-dashboard)
      * [Mark Users Activity](#mark-users-activity)
      * [Get All Users Activity](#get-all-users-activity)
      * [Get User Organization](#get-user-organization)
   * [Classrooms](#classrooms)
      * [Get All Classrooms](#get-all-classrooms)
      * [Publish Assignment](#publish-assignment)
   * [Notifications](#notifications)
      * [Get User Specific Invitations](#get-user-specific-invitations)
      * [Get Outgoing Invitations](#get-outgoing-invitations)
      * [Decide Invitation](#decide-invitation)
      * [Delete Invitation](#delete-invitation)
   * [Forum](#forum)
	   * Public
          * [Get public threads](#get-public-threads)
          * [Create public thread](#create-public-thread)
          * [Get public thread detail](#get-public-thread-detail)
          * [Add message to public thread](#add-message-to-public-thread)
          * [Update message in public thread](#update-message-in-public-thread)
          * [Remove message from public thread](#remove-message-from-public-thread)
	   * Organization
          * [Get organization threads](#get-organization-threads)
          * [Create organization thread](#create-organization-thread)
          * [Get organization thread detail](#get-organization-thread-detail)
          * [Add message to organization thread](#add-message-to-organization-thread)
          * [Update message in organization thread](#update-message-in-organization-thread)
          * [Remove message from organization thread](#remove-message-from-organization-thread)

## Auth
### Create User

**URL** : `/users`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**
(application/json)
```json
{
    "username": "[username]",
    "password": "[password]",
    "email":"[email]",
    "firstName":"[first name]",
    "lastName":"[last name]",
    "descritpion":"[description]"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "data": {
         "id": 0,
         "username": "string",
         "roles": [
            "ADMIN"
         ],
         "active": true,
         "email": "user@example.com",
         "firstName": "string",
         "lastName": "string",
         "description": "string"
    },
    "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 409 | A conflict of data exists, even with valid information |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```




### Get Users

**URL** : `/users`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** :

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| page | integer | True | Results page number |
| size | integer | True | Number of records per page |
| sort | array[string] | False | Sorting criteria property |

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)
```json
{
    "data": {
         "id": 0,
         "username": "string",
         "roles": [
            "ADMIN"
         ],
         "active": true,
         "email": "user@example.com",
         "firstName": "string",
         "lastName": "string",
         "description": "string"
    },
    "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 500 | The servers are not working as expected. |

**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```

### Get Current User

**URL** : `/users/current`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** :

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)
```json
{
    "data": {
         "id": 0,
         "username": "string",
         "roles": [
            "ADMIN"
         ],
         "active": true,
         "email": "user@example.com",
         "firstName": "string",
         "lastName": "string",
         "description": "string"
    },
    "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | An access token isn’t provided, or is invalid. |


**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```



### Get User

**URL** : `/users/{id}`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| id | integer | True | ID of the entity |

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)
```json
{
    "data": {
         "id": 0,
         "username": "string",
         "roles": [
            "ADMIN"
         ],
         "active": true,
         "email": "user@example.com",
         "firstName": "string",
         "lastName": "string",
         "description": "string"
    },
    "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```



### Update User

**URL** : `/users/{id}`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| id | integer | True | ID of the entity |

**Request Body**
(application/json)
```json
{
     "email": "user@example.com",
     "firstName": "string",
     "lastName": "string",
     "description": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)
```json
{
    "data": {
         "id": 0,
         "username": "string",
         "roles": [
            "ADMIN"
         ],
         "active": true,
         "email": "user@example.com",
         "firstName": "string",
         "lastName": "string",
         "description": "string"
    },
    "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```


### Activate User

**URL** : `/users/{id}/activate`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| id | integer | True | ID of the entity |

**Request Body**

Empty

#### Success Response

**Code** : `204 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```



### Deactivate User

**URL** : `/users/{id}/deactivate`

**Method** : `DELETE`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| id | integer | True | ID of the entity |

**Request Body**

Empty

#### Success Response

**Code** : `204 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json)

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```






### Mark User Login

**URL** : `/users/logged`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : Marks users last login

**Parameters**

No parameters

**Request Body**

(application/json)
```json
{
    "lastLogin": "date"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**

No content


### Get All Users

**URL** : `/users/all`

**Method** : `GET`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Retrieve all users

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**

No content



### Get All Users Roles

**URL** : `/users/roles/${uuid}`

**Method** : `GET`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Retrieve all users roles

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**

No content


## Eval

### Upload Project

**URL** : `/evals`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**
(multipart/form-data)
```json
{
    "file": "string"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(text/event-stream)
```json
[
  "string"
]
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist |
| 409 | A conflict of data exists, even with valid information |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json)
```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```



## Repo

### Create Repo

**URL** : `/repos`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**
(application/json)
```json
{
    "name": "string",
    "uri": "string"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "data": {
         "id": 0,
         "author": "string",
         "fileName": "string",
         "name": "string",
         "uri": "string"
     },
     "sideLoads": {}

}
```

#### Error Responses

Missing

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```



### Get Repos By Author

**URL** : `/repos`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| page | integer | True | Results page number |
| size | integer | True | Number of records per page |
| repoAuthor | string | True | Author of the repo |

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)
```json
{
    "pageNum": 0,
    "totalPages": 0,
    "totalItems": 0,
    "data": [
        {
        "id": 0,
        "author": "string",
        "fileName": "string",
        "name": "string",
        "uri": "string"
        }
    ],
    "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```


### Get Repo

**URL** : `/repos/name/{repoName}`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** :

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)
```json
{
     "data": {
     "id": 0,
     "author": "string",
     "fileName": "string",
     "name": "string",
     "uri": "string"
     },
     "sideLoads": {}
}
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```




### Update Repo

**URL** : `/repos /name /{repoName}`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |


**Request Body**
(application/json)
```json
{
  "uri": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
(application/json)


#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```



### Delete Repo

**URL** : `/repos /name /{repoName}`

**Method** : `DELETE`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |


**Request Body**

Empty

#### Success Response

**Code** : `204 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```


### Get Repo Files

**URL** : `/repos /name /{repoName} /files`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |


**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
(application/zip)
```json
"string"
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```




### Update Repo Files

**URL** : `/repos /name /{repoName} /files `

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |


**Request Body**
(multipart/form-data)
```json
{
  "file": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
     "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
     "code": "string",
     "message": "string"
}
```


### Toggle Favorite Repo

**URL** : `/repos /{repoName} /toggleFavorite `

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |


**Request Body**


#### Success Response

**Code** : `200 OK`

**Content example**


#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
    "@id": "1",
    "uuid": "a4f8b5d4-5592-4b76-b2ca-9555558d45ee",
    "created": "2022-05-08T08:57:07.058+0000",
    "createdBy": "test",
    "lastModified": "2022-05-18T14:02:46.210+0000",
    "lastModifiedBy": "typek",
    "lastLogin": null,
    "lastAccountEdit": null,
    "name": "test_repo",
    "authorUUID": "cd552a6d-360a-4dc4-aebb-5a04e056788b",
    "fileName": null,
    "favorite": true,
    "archived": false,
    "description": "",
    "uri": "",
    "is_private": true,
    "isPublic": true
}
```



### Toggle Archived Repo

**URL** : `/repos /{repoName} /toggleArchived `

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters** :

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| repoName | string | True | Name of the repo |


**Request Body**


#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{
    "@id": "1",
    "uuid": "a4f8b5d4-5592-4b76-b2ca-9555558d45ee",
    "created": "2022-05-08T08:57:07.058+0000",
    "createdBy": "test",
    "lastModified": "2022-05-18T14:02:46.210+0000",
    "lastModifiedBy": "typek",
    "lastLogin": null,
    "lastAccountEdit": null,
    "name": "test_repo",
    "authorUUID": "cd552a6d-360a-4dc4-aebb-5a04e056788b",
    "fileName": null,
    "favorite": true,
    "archived": false,
    "description": "",
    "uri": "",
    "is_private": true,
    "isPublic": true
}
```



### Get Repos For Current Organization

**URL** : `/repos /org `

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 


**Parameters** :


**Request Body**


#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**

(application/json):

```json
{
	"content":[
		{"@id":"1",
		"uuid":"1266715a-7ed5-4432-9b63-951d9d741577",
		"created":"2022-05-08T13:52:32.932+0000",
		"createdBy":"test",
		"lastModified":"2022-05-08T13:52:32.932+0000",
		"lastModifiedBy":"test",
		"lastLogin":null,
		"lastAccountEdit":null,
		"name":"teaambestt"
		,"authorUUID":"cd552a6d-360a-4dc4-aebb-5a04e056788b",
		"fileName":null,
		"favorite":false,
		"archived":false,
		"description":null,
		"uri":"","is_private":false,
		"isPublic":null},
		
		{"@id":"2",
		"uuid":"b8cffffc-18cb-4ab8-816d-eab34a841911",
		"created":"2022-05-08T13:52:50.159+0000",
		"createdBy":"test",
		"lastModified":"2022-05-08T13:52:50.159+0000",
		"lastModifiedBy":"test",
		"lastLogin":null,
		"lastAccountEdit":null,
		"name":"repoFromOrg",
		"authorUUID":"cd552a6d-360a-4dc4-aebb-5a04e056788b",
		"fileName":null,
		"favorite":null,
		"archived":null,
		"description":"",
		"uri":" ",
		"is_private":false,
		"isPublic":true},
		
		{"@id":"3",
		"uuid":"a8faba8a-4d37-45b7-9b54-aedff82d742b",
		"created":"2022-05-08T14:32:33.632+0000",
		"createdBy":"test",
		"lastModified":"2022-05-08T14:32:33.632+0000",
		"lastModifiedBy":"test",
		"lastLogin":null,
		"lastAccountEdit":null,
		"name":"orgnewrepo",
		"authorUUID":"cd552a6d-360a-4dc4-aebb-5a04e056788b",
		"fileName":null,
		"favorite":null,
		"archived":null,
		"description":"",
		"uri":" ",
		"is_private":false,
		"isPublic":true}],
	
	"pageable":"INSTANCE",
	"last":true,
	"totalPages":1,
	"totalElements":3,
	"number":0,
	"sort":{"sorted":false,"unsorted":true,"empty":true},
	"size":3,
	"numberOfElements":3,
	"first":true,
	"empty":false
	
	}
```


### Get Public Repos Except Current User's Repos

**URL** : `/repos /allPublic `

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters** :


**Request Body** :


#### Success Response

**Code** : `200 OK`

**Content example**

No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
(application/json):

```json
{"content":[{"@id":"1","uuid":"4c5198f0-16db-4028-97e1-b502e3848469","created":"2022-05-05T11:38:58.460+0000","createdBy":"klihan","lastModified":"2022-05-05T11:38:58.460+0000","lastModifiedBy":"klihan","lastLogin":null,"lastAccountEdit":null,"name":"Test","authorUUID":"7d5068be-c581-48b2-9a96-ce81c9627ce9","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":true,"isPublic":true},{"@id":"2","uuid":"c69cd135-944c-47e3-b23c-91d2dcd47003","created":"2022-05-05T12:38:40.088+0000","createdBy":"david","lastModified":"2022-05-05T12:38:40.088+0000","lastModifiedBy":"david","lastLogin":null,"lastAccountEdit":null,"name":"test repo","authorUUID":"ea9f7214-d44b-40f2-8b39-70b27412e52d","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":true,"isPublic":true},{"@id":"3","uuid":"50542213-7318-44c4-a850-ebe9e6339f19","created":"2022-05-05T22:46:10.533+0000","createdBy":"p.kollarova","lastModified":"2022-05-05T22:46:10.533+0000","lastModifiedBy":"p.kollarova","lastLogin":null,"lastAccountEdit":null,"name":"org repo","authorUUID":"d56f311f-088e-448b-9fae-c850b50820c8","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":false,"isPublic":true},{"@id":"4","uuid":"9df948a2-a012-40ae-a5f1-b65df4813114","created":"2022-05-05T22:46:23.635+0000","createdBy":"p.kollarova","lastModified":"2022-05-05T22:46:23.635+0000","lastModifiedBy":"p.kollarova","lastLogin":null,"lastAccountEdit":null,"name":"my repo","authorUUID":"d56f311f-088e-448b-9fae-c850b50820c8","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":true,"isPublic":true},{"@id":"5","uuid":"72e02fee-6498-4845-a715-b8ee4d8e3a22","created":"2022-05-08T15:10:13.647+0000","createdBy":"user1_testrepo","lastModified":"2022-05-08T15:10:13.647+0000","lastModifiedBy":"user1_testrepo","lastLogin":null,"lastAccountEdit":null,"name":"enworg","authorUUID":"168152c0-9291-438a-94b4-06b924214cc8","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":false,"isPublic":true},{"@id":"6","uuid":"118e4085-4585-4dde-b8e2-ff744fa79536","created":"2022-05-07T11:27:28.885+0000","createdBy":"asicde_test","lastModified":"2022-05-07T11:27:28.885+0000","lastModifiedBy":"asicde_test","lastLogin":null,"lastAccountEdit":null,"name":"TestRepository","authorUUID":"35073ca5-99e8-489b-b2e8-156156c68e4b","fileName":null,"favorite":null,"archived":null,"description":"IcarusVerilogTest","uri":" ","is_private":true,"isPublic":true},{"@id":"7","uuid":"56b51257-7687-4cd0-b0a1-e5675132759c","created":"2022-05-08T15:23:14.194+0000","createdBy":"testuser","lastModified":"2022-05-08T15:23:14.194+0000","lastModifiedBy":"testuser","lastLogin":null,"lastAccountEdit":null,"name":"meine","authorUUID":"1d402653-afd6-4d6e-881e-bdf556cf96cf","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":false,"isPublic":true},{"@id":"8","uuid":"270b19f4-f0dd-4d08-b344-f8a2ec48607b","created":"2022-05-08T19:16:10.441+0000","createdBy":"test","lastModified":"2022-05-08T19:16:10.441+0000","lastModifiedBy":"test","lastLogin":null,"lastAccountEdit":null,"name":"test","authorUUID":"0f619782-1043-4797-a5ce-9e6f209b3b9b","fileName":null,"favorite":null,"archived":null,"description":"test","uri":" ","is_private":false,"isPublic":true},{"@id":"9","uuid":"992242c6-9968-4cf6-b4bf-d38d59abf62e","created":"2022-05-08T19:39:13.295+0000","createdBy":"test","lastModified":"2022-05-08T19:39:13.295+0000","lastModifiedBy":"test","lastLogin":null,"lastAccountEdit":null,"name":"test123456","authorUUID":"0f619782-1043-4797-a5ce-9e6f209b3b9b","fileName":null,"favorite":null,"archived":null,"description":"test","uri":" ","is_private":true,"isPublic":true},{"@id":"10","uuid":"50888488-75e3-4471-89fc-61622e007d3b","created":"2022-05-09T18:18:22.136+0000","createdBy":"matej.janecek19","lastModified":"2022-05-09T18:18:22.136+0000","lastModifiedBy":"matej.janecek19","lastLogin":null,"lastAccountEdit":null,"name":"Project 2","authorUUID":"dd6143e3-4e11-4ecd-9f71-19127cee0ac9","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":true,"isPublic":true},{"@id":"11","uuid":"c23591c0-8fdf-4c20-bc99-aee33d3ba633","created":"2022-05-08T11:39:19.458+0000","createdBy":"user2_testrepo","lastModified":"2022-05-08T11:39:41.382+0000","lastModifiedBy":"user2_testrepo","lastLogin":null,"lastAccountEdit":null,"name":"repozitar_public","authorUUID":"7d89fddd-8661-4aca-99b2-c6be9b5e70d8","fileName":null,"favorite":false,"archived":false,"description":"","uri":" ","is_private":true,"isPublic":true},{"@id":"12","uuid":"c3249118-5855-434e-ac78-d5c86edc68c2","created":"2022-05-08T15:05:39.191+0000","createdBy":"user1_testrepo","lastModified":"2022-05-08T15:05:39.191+0000","lastModifiedBy":"user1_testrepo","lastLogin":null,"lastAccountEdit":null,"name":"sass","authorUUID":"168152c0-9291-438a-94b4-06b924214cc8","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":true,"isPublic":true},{"@id":"13","uuid":"2256079f-a483-425f-856f-5c2770192998","created":"2022-05-10T18:42:05.143+0000","createdBy":"vixizu","lastModified":"2022-05-10T18:44:30.449+0000","lastModifiedBy":"vixizu","lastLogin":null,"lastAccountEdit":null,"name":"team16","authorUUID":"6c61293e-a1c6-4af0-9b72-207282a1fb70","fileName":null,"favorite":true,"archived":null,"description":"team page","uri":"https://team16-21.studenti.fiit.stuba.sk/.git/config","is_private":true,"isPublic":true},{"@id":"14","uuid":"3ebedc7e-cde1-42fd-9696-856acd0fecfe","created":"2022-05-13T00:32:08.983+0000","createdBy":"TEaILhvddB","lastModified":"2022-05-13T00:32:08.983+0000","lastModifiedBy":"TEaILhvddB","lastLogin":null,"lastAccountEdit":null,"name":"TestRepo_IpkaS","authorUUID":"5aff284a-5d0c-4fc4-b6b6-15d6b9a4f888","fileName":null,"favorite":null,"archived":null,"description":"Cypress Test Repository","uri":" ","is_private":true,"isPublic":true},{"@id":"15","uuid":"5c4d5cd6-c611-4d5c-87be-17c7ea6f535f","created":"2022-05-13T00:34:54.721+0000","createdBy":"tq9QNvWyNq","lastModified":"2022-05-13T00:34:54.721+0000","lastModifiedBy":"tq9QNvWyNq","lastLogin":null,"lastAccountEdit":null,"name":"TestRepo_cUpl8","authorUUID":"b9ddb6e8-95c4-49f4-bf63-70a186dd1827","fileName":null,"favorite":null,"archived":null,"description":"Cypress Test Repository","uri":" ","is_private":true,"isPublic":true},{"@id":"16","uuid":"7f36af3f-0e0b-45ea-9df5-d1fa0ce9fc3d","created":"2022-05-14T19:01:29.901+0000","createdBy":"user1_testrepo","lastModified":"2022-05-14T19:01:29.901+0000","lastModifiedBy":"user1_testrepo","lastLogin":null,"lastAccountEdit":null,"name":"awd","authorUUID":"168152c0-9291-438a-94b4-06b924214cc8","fileName":null,"favorite":null,"archived":null,"description":"wa","uri":" ","is_private":true,"isPublic":true},{"@id":"17","uuid":"df2e39d5-73db-4a16-a5b4-26b857a53bf2","created":"2022-05-16T10:16:04.743+0000","createdBy":"edokrajcir","lastModified":"2022-05-16T10:16:04.743+0000","lastModifiedBy":"edokrajcir","lastLogin":null,"lastAccountEdit":null,"name":"repozitar 1","authorUUID":"a2507abf-7deb-4fef-b33f-7056ef29145f","fileName":null,"favorite":null,"archived":null,"description":"repo 1","uri":" ","is_private":true,"isPublic":true},{"@id":"18","uuid":"68c66806-b84b-40ca-ae56-8dddaaf00a2d","created":"2022-05-16T10:16:14.621+0000","createdBy":"edokrajcir","lastModified":"2022-05-16T10:16:14.621+0000","lastModifiedBy":"edokrajcir","lastLogin":null,"lastAccountEdit":null,"name":"repozitar 2","authorUUID":"a2507abf-7deb-4fef-b33f-7056ef29145f","fileName":null,"favorite":null,"archived":null,"description":"","uri":" ","is_private":true,"isPublic":true}],"pageable":{"sort":{"sorted":false,"unsorted":true,"empty":true},"offset":0,"pageNumber":0,"pageSize":2147483647,"paged":true,"unpaged":false},"last":true,"totalPages":1,"totalElements":18,"number":0,"sort":{"sorted":false,"unsorted":true,"empty":true},"size":2147483647,"numberOfElements":18,"first":true,"empty":false}
```



## Systemverilogparser

### Code To Dia Extract

**URL** : `/parse /getPackageData`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : Parses the given source codes and extracts the essential data on
                  return.

**Parameters**

No parameters


**Request Body**
(application/json)
```json
{
     "sourceCode": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
```json
[
     {
     "dataType": "string",
     "dataName": "string"
     }
]
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| default | Unexpected error |

**Content**
(application/json):

```json
{
     "code": "string",
     "message": "string"
}
```




### Get Visualization Data

**URL** : `/parse /getVisualizationData`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : Parses the given source codes and extracts the essential
                  data on return

**Parameters**

No parameters


**Request Body**
(application/json)
```json
{
     "sourceCode": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
```json
[
     {
     "json": "string"
     }
]
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| default | Unexpected error |

**Content**
(application/json):

```json
{
     "code": "string",
     "message": "string"
}
```



### Get Subdiagram Data
 
**URL** : `/parse /getDataForSubDiagram`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : Parses the given source codes and extracts the essential
                  data on return

**Parameters**

No parameters


**Request Body**
(application/json)
```json
{
      "sourceCode": "string",
      "subModuleInterfaces": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
```json
[
     {
     "json": "string"
     }
]
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| default | Unexpected error |

**Content**
(application/json):

```json
{
     "code": "string",
     "message": "string"
}
```


### Get Submodules
 
**URL** : `/parse /getSubModules`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : Parses the given source codes and extracts the essential
                  data on return

**Parameters**

No parameters


**Request Body**
(application/json)
```json
{
      "sourceCode": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
```json
[
     {
      "identifiedModules": "string",
      "identifiedInstance": "string"
     }
]
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| default | Unexpected error |

**Content**
(application/json):

```json
{
     "code": "string",
     "message": "string"
}
```


## Visualization

### Load Existing Module
 
**URL** : `/visualization /loadModule`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : Loads an existing module from given source code.

**Parameters**

No parameters


**Request Body**
(application/json)
```json
{
      "sourceCode": "string"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
```json
[
     {
      "json": "string"

     }
]
```

#### Error Responses
| Code | Message |
| ------ | ------ |
| default | Unexpected error |

**Content**
(application/json):

```json
{
     "code": "string",
     "message": "string"
}
```



## Admin Dashboard

### Mark Users Activity
 
**URL** : `/admin_users/`

**Method** : `POST`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Mark users last activity by type

**Parameters**

No parameters

**Request Body**

```json
{
     "logged": "boolean",
     "signed": "boolean",
     "edited": "boolean",
     "date": "[date of activity]"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

### Get All Users Activity
 
**URL** : `/admin_users/users`

**Method** : `GET`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Get all users activity

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content


### Get All Organizations
 
**URL** : `/organization/all`

**Method** : `GET`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Get all organizations

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content


### Get User Organization
 
**URL** : `/organization/admin/owner/${ownerUsername}`

**Method** : `GET`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Get the organization of this owner

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| ownerUsername | string | True | Username |

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content


## Classrooms

### Get All Classrooms

**URL** : `/edu/usersclassrooms/all`

**Method** : `GET`

**Auth required** : YES (bearerAuth), ADMIN

**Description** : Get all classrooms

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

### Publish Assignment

**URL** : `/edu/classrooms/{classroomUuid}/assignments/{assignmentUuid}`

**Method** : `POST`

**Auth required** : YES (bearerAuth), TEACHER

**Description** : Publish selected assignment by classroom owner

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| classroomUuid | uuid | True | UUID of classroom |
| assignmentUuid | uuid | True | UUID of assignment |

**Request Body**

(application/json)
```json
{
    "publishStatus": "boolean"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

## Notifications

### Get User Specific Invitations

**URL** : `/organization_invite/get_users_invitations`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : Get loggen in users invitations

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

### Get Outgoing Invitations

**URL** : `/organization_invite/get_invited_users`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : Get outgoing users invitations for currently logged in users

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

### Decide Invitation

**URL** : `/invitation/decision`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : Dedice invitation

**Parameters**

No parameters

**Request Body**

```json
{
     "decStatus": "boolean"
}
```

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

### Delete Invitation

**URL** : `/organization_invite/{uuid}`

**Method** : `DELETE`

**Auth required** : YES (bearerAuth)

**Description** : Cancel invitation

**Parameters**

| Attribute | Type | Required | Description |
| ------ | ------ | ------ | ------ |
| uuid | uuid | True | Uuid of invitation |

**Request Body**

Empty

#### Success Response

**Code** : `200 OK`

**Content example**
No content

#### Error Responses
| Code | Message |
| ------ | ------ |
| 400 | The requested information is incomplete or malformed. |
| 401 | An access token isn’t provided, or is invalid. |
| 403 | An access token is valid, but requires more privileges |
| 404 | Everything is okay, but the resource doesn’t exist. |
| 409 | A conflict of data exists, even with valid information. |
| 422 | The requested information is okay, but invalid |
| 500 | The servers are not working as expected. |

**Content**
No content

## Forum
### Public
#### Get public threads

**URL** : `/forum`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "content": [
        {
            "uuid": "fb153596-addc-11ec-b909-0242ac120002",
            "title": "test thread",
            "created": "2022-03-27T16:48:28.797+0000",
            "user": {
                "@id": "1",
                "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
                "created": "2022-03-27T14:48:09.145+0000",
                "lastModified": "2022-05-17T13:02:46.576+0000",
                "lastLogin": "2022-05-17T13:02:46.417+0000",
                "lastAccountEdit": null,
                "username": "username",
                "active": true,
                "email": "user@example.com",
                "firstName": "First",
                "lastName": "Second"
            },
            "text": "message"
        }
	]
}
```

#### Create public thread

**URL** : `/forum`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**
(application/json)
```json
{
    "title": "Test",
    "message": "test"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "fb153596-addc-11ec-b909-0242ac120002",
    "title": "test thread",
    "created": "2022-03-27T16:48:28.797+0000",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
        "username": "username",
        "active": true,
        "email": "user@example.com",
        "firstName": "First",
        "lastName": "Second"
    },
    "text": "message"
}
```

#### Get public thread detail

**URL** : `/forum/{thread_uuid}`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "fb153596-addc-11ec-b909-0242ac120002",
    "title": "test thread",
    "created": "2022-03-27T16:48:28.797+0000",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
        "username": "username",
        "active": true,
        "email": "user@example.com",
        "firstName": "First",
        "lastName": "Second"
    },
    "messages": [
		{
			"uuid": "cdcb0ad9-4529-481a-bc45-088ff9b6e1b8",
			"text": "test3",
			"user": {
				"@id": "2",
				"uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
				"created": "2022-03-27T14:48:09.145+0000",
				"lastModified": "2022-05-17T13:02:46.576+0000",
				"lastLogin": "2022-05-17T13:02:46.417+0000",
				"lastAccountEdit": null,
				"username": "username",
				"active": true,
				"email": "user@example.com",
				"firstName": "First",
				"lastName": "Second"
			},
			"created": "2022-04-25T13:30:56.456+0000"
		},
		...
	]
}
```

#### Add message to public thread

**URL** : `/forum/{thread_uuid}`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

(application/json)
```json
{
    "message": "test3"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "0da10f5e-6f23-4f2f-a9cc-c582395cebdc",
    "text": "test3",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
		"username": "username",
		"active": true,
		"email": "user@example.com",
		"firstName": "First",
		"lastName": "Second"
    },
    "created": "2022-05-17T15:10:46.418+0000"
}
```

#### Update message in public thread

**URL** : `/forum/{thread_uuid}/{message_uuid}`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

(application/json)
```json
{
    "message": "test3"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "0da10f5e-6f23-4f2f-a9cc-c582395cebdc",
    "text": "test3",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
		"username": "username",
		"active": true,
		"email": "user@example.com",
		"firstName": "First",
		"lastName": "Second"
    },
    "created": "2022-05-17T15:10:46.418+0000"
}
```

#### Remove message from public thread

**URL** : `/forum/{thread_uuid}/{message_uuid}`

**Method** : `DELETE`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `201 OK`

**Content example**
Empty

### organization
#### Get organization threads

**URL** : `/forum`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "content": [
        {
            "uuid": "fb153596-addc-11ec-b909-0242ac120002",
            "title": "test thread",
            "created": "2022-03-27T16:48:28.797+0000",
            "user": {
                "@id": "1",
                "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
                "created": "2022-03-27T14:48:09.145+0000",
                "lastModified": "2022-05-17T13:02:46.576+0000",
                "lastLogin": "2022-05-17T13:02:46.417+0000",
                "lastAccountEdit": null,
                "username": "username",
                "active": true,
                "email": "user@example.com",
                "firstName": "First",
                "lastName": "Second"
            },
            "text": "message"
        }
	]
}
```

#### Create organization thread

**URL** : `/forum`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**
(application/json)
```json
{
    "title": "Test",
    "message": "test"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "fb153596-addc-11ec-b909-0242ac120002",
    "title": "test thread",
    "created": "2022-03-27T16:48:28.797+0000",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
        "username": "username",
        "active": true,
        "email": "user@example.com",
        "firstName": "First",
        "lastName": "Second"
    },
    "text": "message"
}
```

#### Get organization thread detail

**URL** : `/forum/organization/{thread_uuid}`

**Method** : `GET`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "fb153596-addc-11ec-b909-0242ac120002",
    "title": "test thread",
    "created": "2022-03-27T16:48:28.797+0000",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
        "username": "username",
        "active": true,
        "email": "user@example.com",
        "firstName": "First",
        "lastName": "Second"
    },
    "messages": [
		{
			"uuid": "cdcb0ad9-4529-481a-bc45-088ff9b6e1b8",
			"text": "test3",
			"user": {
				"@id": "2",
				"uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
				"created": "2022-03-27T14:48:09.145+0000",
				"lastModified": "2022-05-17T13:02:46.576+0000",
				"lastLogin": "2022-05-17T13:02:46.417+0000",
				"lastAccountEdit": null,
				"username": "username",
				"active": true,
				"email": "user@example.com",
				"firstName": "First",
				"lastName": "Second"
			},
			"created": "2022-04-25T13:30:56.456+0000"
		},
		...
	]
}
```

#### Add message to organization thread

**URL** : `/forum/organization/{thread_uuid}`

**Method** : `POST`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

(application/json)
```json
{
    "message": "test3"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "0da10f5e-6f23-4f2f-a9cc-c582395cebdc",
    "text": "test3",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
		"username": "username",
		"active": true,
		"email": "user@example.com",
		"firstName": "First",
		"lastName": "Second"
    },
    "created": "2022-05-17T15:10:46.418+0000"
}
```

#### Update message in organization thread

**URL** : `/forum/organization/{thread_uuid}/{message_uuid}`

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**

No parameters

**Request Body**

(application/json)
```json
{
    "message": "test3"
}
```

#### Success Response

**Code** : `201 OK`

**Content example**
(application/json)
```json
{
    "uuid": "0da10f5e-6f23-4f2f-a9cc-c582395cebdc",
    "text": "test3",
    "user": {
        "@id": "1",
        "uuid": "869288b9-416d-486a-bbc4-84ebbd94f991",
        "created": "2022-03-27T14:48:09.145+0000",
        "lastModified": "2022-05-17T13:02:46.576+0000",
        "lastLogin": "2022-05-17T13:02:46.417+0000",
        "lastAccountEdit": null,
		"username": "username",
		"active": true,
		"email": "user@example.com",
		"firstName": "First",
		"lastName": "Second"
    },
    "created": "2022-05-17T15:10:46.418+0000"
}
```

#### Remove message from organization thread

**URL** : `/forum/organization/{thread_uuid}/{message_uuid}`

**Method** : `DELETE`

**Auth required** : YES (bearerAuth)


**Description** : 

**Parameters**

No parameters

**Request Body**

Empty

#### Success Response

**Code** : `201 OK`

**Content example**
Empty
