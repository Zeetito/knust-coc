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

# PHASE 6
##Search attendance sessions
## Delete / Clear Attendance Sessions (Delete and recreate)
Add 'is_member' column to the user table to show people who are currently with the congregation.

# PHASE 7
##Create Academic Year Model
id
name
start_year
end_year
timestamps

## Semester Model
id
name
started_at
ended_at
is_active
timestamps

## Create a Method for all dates to retrieve the Academic Date that it was created or edited.
To acknowledge vacations,
If No Semester Exists that has its 'Started_at' greater than the ended_at of the latest semster.
or If the Semestar has a value for 'ended_at' (not null) yet there's no new Semester. 

###Review Contraints on the foreignKeys for the migrations

## Check For Males or Females Present for each attendance session

# PHASE 8
## Create Permissions and Roles
## Implement the user roles permissions (front and back end)
## check attendance_users table timestamps.

#PHASE 9
## Apply the Breadcrumps on the layout file
# Acadamia and Housing Pages 
