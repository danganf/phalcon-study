# phalcon-study

## Tecnologia utilizada

> Framework Phalcon, MongoDB, Nginx e Ambiente de desenvolvimento utilizando Docker containners

## Banco de Dados
>>> base: music

>>> collection: author


### Tradução
> Em todas as requisiçoes, envie no header a informação `phalcon-lang-default`
com o valor: **`en`** ou **`ptbr`** para selecionar o idioma das mensagens de feedback 
das ações

### list Authors

> GET http://_DNS_/authors

```json  
[
    {
        "id": null,
        "name": "isabella gomes",
        "address": "avenida cesario, 220",
        "dob": "2013-12-23",
        "phone": "21981692318",
        "_oid": "5d30a0ff66746a0b5d1e9d37"
    },
    {
        "id": null,
        "name": "priscila",
        "_oid": "5d30a0ff66746a0b5d1e9d38"
    },
    {
        "id": null,
        "name": "daniel azevedo",
        "address": "avenida das américas, 7000",
        "phone": "21981692318",
        "dob": "1981-12-18",
        "_oid": "5d30c26cc7e7a1000b605af3"
    }
] 
```  

### new Author

> POST http://_DNS_/authors
>> Request body raw
```json  
{
	"name": "daniel azevedo",
	"address": "Avenida Cesário de Melo, 7000",
	"phone": "21981692318",
	"dob": "1981-12-18"
}
```

>> Response json success
>>> status code success: **201**
```json  
{
    "message": "OK"
}
```

>> Response json error
>>> status code success: **400**
```json  
{
    "message": "_MSG_ERROR"
}
```

### Edit Author

> PUT http://_DNS_/authors/{_oid}
>> Request body raw
```json  
{
	"name": "daniel azevedo",
	"address": "Avenida Cesário de Melo, 7000",
	"phone": "21981692318",
	"dob": "1981-12-18"
}
```

>> Response json success
>>> status code: **200**
```json  
{
    "message": "OK"
}
```
>> Response json error
>>> status code: **400**
```json  
{
    "message": "_MSG_ERROR"
}
```

### delete Author

> DELETE http://_DNS_/authors/{_oid}

>> Response json success
>>> status code: **200**
```json  
{
    "message": "OK"
}
```
>> Response json error
>>> status code: **400**
```json  
{
    "message": "_MSG_ERROR"
}
