
# EviMerce

A ECommerce web, for 1ºDAW practices.

![Logo](https://i.ibb.co/cKn9bDpC/logo.png)
## Tech Stack

**Front:** ```HTML, CSS, JavaScript, JQuery 3.7.1,  JQueryUI, JQueryKnob, AdminLTE, BootStrap 5, Font Awesome, JVectorMap, DateTimePicker, DateRangePicker, DataTables, ChartJS, Moment, .```

**Back:** ```PHP 8.5.1 , PDO (PHP), MySQL 8.0.44.```


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


- Fully SQL Database ⚠️
- Separate Admin / Customer UI ✅
- Custom PHP router ✅
- List products ✅
- Create products ✅
- Remove products ✅
- Edit products ❌
- Upload images for products ✅
- Load images for products ✅
- Beauty products see as customer ⚠️
- Buy function ✅
- Shipping function ✅
- Login admin ✅
- Login and Register ⚠️
- Token access ❌
- Shopping cart ✅

**Progress: 35% ███████▒▒▒▒▒▒▒░░░░░░**

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
