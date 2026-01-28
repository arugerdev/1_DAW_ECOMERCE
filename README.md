
# EviMerce

A ECommerce web, for 1ºDAW practices.

![Logo](https://i.ibb.co/cKn9bDpC/logo.png)

## Tech Stack

**Front:** ```HTML, CSS, JavaScript, JQuery 3.7.1,  JQueryUI, JQueryKnob, AdminLTE, BootStrap 5, Font Awesome, JVectorMap, DateTimePicker, DateRangePicker, DataTables, ChartJS, Moment, .```

**Back:** ```PHP 8.5.1 , PDO (PHP), MySQL 8.0.44.```

## ⚠️ Warning ⚠️

**This project is not designed for production. It uses a weak login and authentication method and has security vulnerabilities. Please do not use it in production environments; it is intended for testing and learning purposes only.**

*If you want to make a copy or a reusable branch, just make sure that the way PHP detects whether a user has logged in or not is not a simple **"{authenticated: true}"** object, but rather keys and tokens generated in the database or other methods of doing so.*

## Screenshots

![App Screenshot](/mockups/0.png)
![App Screenshot](/mockups/1.png)
![App Screenshot](/mockups/2.png)
![App Screenshot](/mockups/3.png)

## Docker
Enter in docker hub and follow the steps:

aruger/evimerce -> [General (front + back w/ docker-compose.yml)](https://hub.docker.com/r/aruger/evimerce)

aruger/evimerce-db -> [Only Database](https://hub.docker.com/r/aruger/evimerce-db)

## Run Locally

Clone the project

```bash
  git clone https://github.com/arugerdev/1_DAW_ECOMERCE.git
```

Go to the project directory

```bash
  cd 1_DAW_ECOMERCE
```

Before running you need a ***MySQL server*** with ***"root" as username and password***.

Also need ***php installed at C:/php/php.exe***.

Before start the server, PHP need use pod_mysql.
Remember activate in php.ini:

*(Remove **;**)*

```bach
/php/php.ini :

  ;pod_mysql -> pod_mysql
```

**Or copy the custom [*php.ini*](https://raw.githubusercontent.com/arugerdev/1_DAW_ECOMERCE/refs/heads/main/php.ini) in this repo, and paste and replace to the directory where is php installed.**

Start the server

```bach
./start.bat
```

or double click the file *start.bat* on file explorer.

**If you want expose or not in the local network, edit the "start.bat" file and change *"localhost"* to local ip or change the local ip by *"localhost"*:**

*EXPOSED:*

```bach
C:/php/php.exe -S 192.168.2.175:80
```

*NOT EXPOSED:*

```bach
C:/php/php.exe -S localhost:80 
```

## Created for

This project is created for 1ºDAW practices, for Evirom company (Cañada Rosal, Sevilla, Spain)

Is a simple project and the first created by me with this technologies.

## Roadmap

##### *✅ -> Correctly working / Realized*

##### *⚠️ -> Implemented but not working perfectly / On a future*

##### *❌ -> Not implemented / Not working*

##### *🔵 -> Not implemented but is OPTIONAL / Its not decide to implements*

- Fully SQL Database ✅
- Separate Admin / Customer UI ✅
- Custom PHP router ✅
- List products ✅
- Create products ✅
- Remove products ✅
- Edit products ✅
- Upload images for products ✅
- Load images for products ✅
- Beauty products see as customer ✅
- Buy function ✅
- Shipping function ✅
- Login admin ✅
- Login ✅
- Shopping cart ✅
- Categories filter ✅
- Edit orders ✅
- Edit users ✅
- Edit categories ✅
- Search products ✅
- Chat bot for customers 🔵
- Refounds ✅
- Edit Refounds ❌
- Download CSV of data tables ✅
- Customize Ecommerce Page ✅
- Mobile responsive ✅

**Progress: 95% ███████████████████▒**

## License

[MIT License](https://choosealicense.com/licenses/mit/)

Copyright (c) 2026 ArugerDev

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
