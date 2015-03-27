## Shoe Brands

### Tom Mertz

###### March 27, 2015


#### Description

The Shoe Brands project lets a user create multiple shoe stores and brands and connect multiple brands to multiple stores in a many-to-many relationship.

#### Set up

1. Run a `git clone`
2. Import the SQL database into postgres by following along under the *Database* section
3. Navigate to the web folder inside the project directory
4. Start a php server from the terminal (`php -S localhost:8000`)
5. Connect to `localhost:8000` in your browser

#### Database

1. Create a new postgres database called shoe_db in postgres
2. Connect to the database using `\c shoe_db`
3. Import the sql file using `\i shoe_db.sql`

**Note**

If the import command fails, create the database manually with the following commands:

```sql
CREATE DATABASE shoe_db;
 \c shoe_db
CREATE TABLE brands (id serial PRIMARY KEY, name varchar);
CREATE TABLE stores (id serial PRIMARY KEY, name varchar);
CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int);
CREATE DATABASE shoe_test WITH TEMPLATE shoe_db;
```

#### Technology Used

* PHP/HTML
* PostgreSQL
* Test Driven Development
* PHPUnit
* Silex
* Twig
* CSS

#### License

The MIT License (MIT)

Copyright (c) 2015 Tom Mertz

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
