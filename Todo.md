**User Year.
** Work on the role_id constraid in the biodata migration file.

# PHASE 3
## MODELS TO BE CREATED.
### RESIDENCE
//Residence has users 
// Residence belongsTo Zone.
id 
name
zone_id
description
landmark
rep_id('none')
timestamps()

### ZONE
Zone has user,residences
id
name
boundaries
rep_id('none')
timestamps()

### COLLEGE
College has programs
College has Users
id
name
timestamps()

### PROGRAM
Program belongsTo College
Program has Users
id 
name
college_id
span
timestamps()

### ATTENDANCE
id
name
<!-- date :Taken care of by timestamps-->
service_name
venue
timestamps()

### AttendanceUsers
id
attendance_id
user_id

checked_by 
<!-- (the id of user who checked the other user. Could be the user him/herself or a hall or residence rep.) -->

timestamps()

#PHASE 4
##Create Policies 
a.User Policy (Who Can edit user details like username, firstname email, etc.)

b.BiodataPolicy (who can edit user details like )

## Ajax Model view for user Info.
Every User should have his/her info in the small card when the address icon is pressed

# Contacts Model (phone contacts)
id
user_id
contact
is_visible
is_main
timestamps()

#Othername Model
id
user_id
name
is_visible
timestamps()

#Meeting Model
id
name eg:Sunday Servie, Gents training.
description

Meeting has Attendance session.

#PHASE 5

# Map the is_active attribute of the attendance object to the switch on the table
## Implement an attendane session
#Check and Uncheck user
#Implement Search User for attendance-user page and users page as well
#After clearning the text of the search box, the list should go back to the paginated form

returning updated row after unchecking isn't really working well
#Stop the jquery codes from returning url
