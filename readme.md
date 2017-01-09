## Prerequisites to run the Solution

- Please rollback any migrations from the other solutions.
```
php artisan migrate:rollback
```
- Please run the following commands in project folder:
```
php artisan migrate
```

---
## Solution Workflow

- The user will be presented with his entity management controls (Create Columns, Edit Columns, Delete Columns where he can dynamically make his table columns.
- All the columns Names and Types will be added Temporarily to a table called ‘entity’ before creating a table called ‘values’ with the actual columns.
- When the user has finished adding columns, he can click on “Done” button to start adding records.
- All the records are now persistent in ‘values’ table.

---

### Solution Done By: Islam Emam Ibrahim
### Email: islam94.ibrahim@gmail.com
