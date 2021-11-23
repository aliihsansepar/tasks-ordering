<div style="text-align: justify">
    <h1><b>Task Ordering</b></h1>
    <h3> Tasks are ordered according to the specified prerequisites. </h3>
</div>

## Build Setup

PHP Version: 7.4

## Docker files is already configurated. 

```bash
$ cp .env.example .env
```
```bash
$ cd .laradock && cp .env.example .env
```
```bash
$ docker-compose up -d nginx mysql phpmyadmin
```
```bash
$ docker-compose exec workspace bash
```
```bash
$ composer update && art migrate
```

# EndPoint Usage
<ul>
<li> [GET] http://base-url.local/api/tasks/ return all tasks</li>
<li> [POST] http://base-url.local/api/tasks/create => "title" and "type" fields are required.Depending on the type, "amount" and "currency" or "country" fields can also be sent. These fields are not required. </li>
<li> [POST] http://base-url.local/api/tasks/add-prerequisites => "task_id" field is required</li>
<li> [GET] http://base-url.local/api/tasks/order => returns tasks sorted by prerequisites</li>
</ul>
