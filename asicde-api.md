[<< Return to documentation overview](README.md)

# ASICDE - API documentation

This repository holds API interface definitions. The full API specification is listed below. Each separate API module has it's own definition formatted in [Swagger](https://swagger.io/). These definitions are then compiled using Maven into data models which are then used in the backend modules. 

Table of Contents
=================

<!--ts-->
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
   * [Systemverilogparser](#systemverilogparser)
      * [Code To Dia Extract](#code-to-dia-extract)
      * [Get Visualization Data](#get-visualization-data)
      * [Get Subdiagram Data](#get-subdiagram-data)
      * [Get Submodules](#get-submodules)
   * [Visualization](#visualization)
      * [Load Existing Module](#load-existing-module)
<!--te-->


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
