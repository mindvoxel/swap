# swap #
## ebay mixed with a barter system ##

Move this folder to htdocs in xampp or lampp to run the site.

The name of the mysql database is `swapbase` and the name of the profiles table is`profiles` which links to a table called
`items`

`profiles` as you may have guessed is a table containing profiles which consist of a username, and password.

`items` contains rows with a name, a key to the profile which the item belongs to, an item description, and an estimated value. Added a new row for images, stored as a LONGBLOB in the database 

We need another table for `inbox`, contains rows with a recipient, sender, item1, item2. 
