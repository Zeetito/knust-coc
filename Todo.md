**User Year.

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