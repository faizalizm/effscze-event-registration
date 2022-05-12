ABSTRAKT
------------------------------------
Non profit event organizer; ABSTRAKT, established in 2022. Our events are specialized in the field of software and computer science.
Tagline : Let's play a game (reference to Saw, American horror film)

Brought to you by :
	o Muhammad Faizal | SW0107290




Signup/Login Functionalities
------------------------------------
Sign Up :
	o All fields are required
	o Display if username exist in the database, restrict from registering
	o Usernames min length is 6, max length are 30, it wont except extras, database limit is 30
	o Passwords min length is 8,  max length are 30, it wont except extras, database limit is 30
	o Email max length is 320, according to standards
	o If min length is not fulfilled, display message "Please lengthen this text"
	o Password and confirmed password must be the same
	o Phone number is limited to only "numbers" and max length is 11 numbers
	o Display successful registration message after registering.

Log In :
	o All fields are required
	o Same min length of username and password as in signup
	o Upon logging in, display if username doesnt exist
	o Upon logging in, display if entered wrong password
	o Upon logged in, a "Profile" link will pop up at the header bar for user
	o Upon logged in, a "Management" link will pop up at the header bar for administrator
	o Upon logged in, signup/login button will be unavailable at the header bar 




Event Functionalities
------------------------------------
In the events page :
	o Display category name, details, start date and end date
	o Display "slots available" in different colors
		 Green colour if 0 to 1/3 of slots are filled
		 Yellow colour if  1/3 to 2/3 of slots are filled
		 Red  colour if more than 2/3 of slots are filled
	o Each member registered to the category will update the "slots available"
	o Restrict user from registering without an account
	o Restrict user from registering if slots are filled
	o Restrict user from registering the same category twice
	o Restrict administrator from registering




Administrator Functionalities
------------------------------------
Session :
	o All administrator pages are protected from direct access without session
		 admin.php - [ Admin management ]
		 adminAddcategory.php - [ Admin add category ]
		 adminEdit.php - [ Admin edit their own data ]
		 adminViewCategory.php - [ Admin view lists of user in category ]
		 adminViewAdmin.php - [ Admin view lists of admins ] * Requires admin privilege level 1
		 adminViewUser.php - [ Admin view lists of users ]
		 userEdit.php - [ Admin edit single user ]
	o Upon logging out, all admin session IDs are removed

Add category :
	o Admins may add as many new category as they see fit
	o After successfully adding category, the newly added category will appear at the events page
	o ABSTRAKT member may start to register to the category.

Data :
	o Admin may search, view, edit, delete admin's data * Requires admin privilege level 1
	o Admin may search, view, edit, delete user's data
	o Admin may search, view, edit, delete user's participation from any category
	o All search functions have a "Filter By" option
	o Usernames are unchangeable.




User Functionalities
------------------------------------
Session :
	o User pages are protected from direct access without session
		 user.php
	o Upon logging out, all user session IDs are removed

Category :
	o User may register to multiple categories, however not the same category twice.
	o User may remove the chosen category if they wish to change category

Data :
	o User may update their data, with password confirmation
	o Usernames are unchangeable.




Database Functionalities
------------------------------------
Data integrity
	o Utilizes the concept of normalization to enforce referential integrity




Quality of Life Functionalities
------------------------------------
Website :
	o Custom scrollbar to easily determine progress of the page

Links :
	o A number of internal/external links have smooth scroll effect when clicked


Data :
	o Any data entry, data editing, data deletion must be done with "confirmation"

Admin :
	o Display total number of registered admin and user in the admin page
	o Display days-left-till-event in the admin page for each category
	o When hovering over list of admin/user, highlight the corresponding row to prevent accident clicks
	o Usernames edit are restricted, field is grayed out

User :
	o Display no registered events together with link to browse events for quick access
	o Usernames edit are restricted, field is grayed out



Extra Functionalities
------------------------------------
Privilege level :
	o Admin with privilege level 1 have access to search, view, edit, and delete admins
	o Admin with privilege level 2 does not have access to the above.

Days left till event :
	o Administrators can view number of days left before the event category starts







