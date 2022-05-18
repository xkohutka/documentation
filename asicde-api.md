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
    "firstname":"[first name]",
    "lastname":"[last name]",
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

**Parameters**

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


**Parameters**


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
	content: [{@id: "1", uuid: "1266715a-7ed5-4432-9b63-951d9d741577", created: "2022-05-08T13:52:32.932+0000",…},…]
	0: {@id: "1", uuid: "1266715a-7ed5-4432-9b63-951d9d741577", created: "2022-05-08T13:52:32.932+0000",…}
	1: {@id: "2", uuid: "b8cffffc-18cb-4ab8-816d-eab34a841911", created: "2022-05-08T13:52:50.159+0000",…}
	2: {@id: "3", uuid: "a8faba8a-4d37-45b7-9b54-aedff82d742b", created: "2022-05-08T14:32:33.632+0000",…}
	empty: false
	first: true
	last: true
	number: 0
	numberOfElements: 3
	pageable: "INSTANCE"
	size: 3
	sort: {sorted: false, unsorted: true, empty: true}
	totalElements: 3
	totalPages: 1
}
```


### Get Public Repos Except Current User's Repos

**URL** : `/repos /allPublic `

**Method** : `PUT`

**Auth required** : YES (bearerAuth)

**Description** : 

**Parameters**


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
	content: [{@id: "1", uuid: "4c5198f0-16db-4028-97e1-b502e3848469", created: "2022-05-05T11:38:58.460+0000",…},…]
	empty: false
	first: true
	last: true
	number: 0
	numberOfElements: 18
	pageable: {sort: {sorted: false, unsorted: true, empty: true}, offset: 0, pageNumber: 0, pageSize: 2147483647,…}
	size: 2147483647
	sort: {sorted: false, unsorted: true, empty: true}
	totalElements: 18
	totalPages: 1
}
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
