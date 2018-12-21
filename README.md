# swap #
## ebay mixed with a barter system ##
### Demo of project: https://www.youtube.com/watch?v=KG9N4Sw5CZ0 ###
Move this folder to htdocs in xampp or lampp to run the site.

The name of the mysql database is `swapbase` and the name of the profiles table is`profiles` which links to a table called
`items`

`profiles` as you may have guessed is a table containing profiles which consist of a username, and password.

`items` contains rows with a name, a key to the profile which the item belongs to, an item description, and an estimated value. Added a new row for images, stored as a LONGBLOB in the database 

We need another table for `inbox`, contains rows with a recipient, sender, item1, item2. 

Form Validation:
Edit Inventory – insertItem.php
Image: must be a .jpeg or .jpg
Item-Name: must be unique for the user- if Mary has a car and Grace has a car it is fine but Grace cannot have 2 items named car and cannot contain +

Description: Must  be less than 140 characters and not contain + - !@#$%&* or any other illegal characters you want to add
Value: must be a positive number greater than 0 and less than 500,000

*Looks like removieItem.php only has inputs which delete items retrieved from the db. There are no text fields.*
Edit Inventory: removeItem.php
Item-Name: characters and numbers only
Value: numbers only
