# Database-Project
_Project of Database_

_Grade: 30 / 30_

_Antonio Scardace_ @ 
_Dept of Math and Computer Science, University of Catania_

## Introduction

This project contains the conceptual, logical and physical design tactics, for the development of a database created for the management of data and daily and analytical operations in an IT company (of the whole company, the project focuses on the assistance center specialized in PCs, Printers and Smartphones).
The base will not be put into production at the end of the exam.

![er](/images/er.png)

![er](/images/logico.png)

The professor has requested:
* a detailed report of how the database has been created (it is in italian)
* a set of four SQL files to create, populate, and interact with the database.
* an optional GUI (implemented but not included in this repo)

I've implemented 9 queries (sql/queries.sql_):
1. Adds a new client with relative contact
2. Adds a new device
3. Adds a new operation with relative reparations
4. Adds a new material to its reparation
5. Gets data correlate to operation
6. Calculation of the total monthly profit
7. Calculation of the total monthly profit for each employee
8. Find the employee who recorded the most visits in the current month
9. Find the most expensive surgery of the current month

And 3 triggers:
1. Update _total_cost_ in _Operation_ every time a material is inserted in _Material_ among those useful for the repair.
2. Update _total_cost_ in _Operation_ every time a material useful for repair is deleted in _Material_.
3. Prevents the insertion of a device into an already occupied slot.

## Getting Started

So that the repository is successfully cloned and simulator run smoothly, a few steps need to be followed.

### Prerequisites

* Needs to have [MySQL Client](https://www.mysql.com/downloads/) installed or in any case to have a MySQL database available.
* Need to download and install [MySQL Client](https://www.mysql.com/downloads/).
* The use of [Visual Studio Code](https://code.visualstudio.com/download) is recommended for read and modify.

### Installation

1. Clone the repository 
```sh
   git clone https://github.com/ElephanZ/Database-Project.git
``` 
2. Open MySQL Client and set these parameters:
```sh
   username = "root" | password = ""
```
3. Then, import Database in this way through MySQL Command Line
```sql
   SOURCE PROJECT_PATH_IN_YOUR_PC\src\schema.sql;
   SOURCE PROJECT_PATH_IN_YOUR_PC\src\data.sql;
   SOURCE PROJECT_PATH_IN_YOUR_PC\src\triggers.sql;
   SOURCE PROJECT_PATH_IN_YOUR_PC\src\functions.sql;
``` 

## License

Distributed under the MIT License. See ``` LICENSE ``` for more information.
