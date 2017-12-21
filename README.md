# openinvoices
Open Invoices. Invoicing application.

## Database

The database backup is located in `data/mysql-structure.sql`. Please restore the database before you continue. The database should be named `openinvoices`.

Edit `config/autoload/local.php` and set your user name and password:

```
    return [
        'db' => [
            'username' => 'YOUR USERNAME HERE',
            'password' => 'YOUR PASSWORD HERE',
        ],
    ];
```

Finally, delete the database backup file.