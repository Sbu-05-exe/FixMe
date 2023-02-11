This document will be used to keep track of the progress on our PHP files. 

#Backlog

[X] turn the admin php into a form to easily add and remove php
[x] write the sql for each table
[] change the password type to binary or something

things left to do on the index page
[] replace the lorem ipsum with proper text (including faqs)
[] choose the fonts (this code should go into main.css)
[] hook up login and register button to relevant page
[] change the cursor to pointer when you hover on the social media links


### notes

Initial Set up 
[] Change pasword type to Binary or something
[] encrypt already stored passwords and resave 


## HTML
[x] register
[x] login
[x] landing (index.php)
[] dashboard (user)
[] dashboard (technician)
[] dashboard (admin)

## JS
[x] add register form restriction to prevent unsanitized data from being submitted 

## CSS
[x] index.php
[x] login.php
[x] register.php


## PHP
[x] login
[x] register
[] logout
## Queries
[x] create new user
[x] create new device
[] delete device

# bugs
- need to destroy session when you sign out. (otherwise funny things happen when you try to log in with someone elses account)

# tasks

[] add enum to technician (to see the status of them working (if they have resigned or if they're on leave or if they work for us still))
[x] find a default picture for devices
[] find a landing page picture
[x] add picture
[] log out functionality
[] switch between different modes (user, technician admin if possible)
[] make the technician profile page, exactly like the user profile page (copy past job)
[] make repair job view 
[] add number of active assigned jobs to technicians (jj)



# Bells and whistles

 - all pages mobile friendly
 - slideover animation for login 
 - match default icon to device type IF image in database == null
