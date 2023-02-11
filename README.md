# Fix Me

Initial Set up 
[] Change pasword type to Binary or something?


HTML
[] register
[] login
[] landing
[] dashboard (user)
[] dashboard (technician)
[] dashboard (admin)


CSS
[]index.php
[]home.php

PHP
[]

Queries
[] create new user
[] create new



$query = "select extract(month from date) as month, 
                       sum(inspectionFee + repairFee) as total from ctrls.repairjobs
                       group by extract(month from date);";