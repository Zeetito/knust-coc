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
# Acadamia and Housing Pages 
#Faculty,Department,and courses* model
#Refactor the views folders to get rid of the model folder sitting in the views folder

#Edit the Program Model
name
college_id
faculty_id
department_id
type
span

###PHASE 10
<!-- activities table? -->

#Create SemesterProgram Model
id
name
venue
related_ministry (role_slug)
start_date
end_date
timestamps

#programOfficiators table
//
id
program_id
officiating_role_name
user_id

#OfficiatingRoles table.
these role's name is needed as values more than thier ids
a user can type in their own role if it's not caputred in here.
they'll be used as part of a datalist only.

id
name
timestamps



#Seed UnderGraduate programs

#Get rid of Othername model and it's stuff [Using biodata table to take care of the othernames attribute]
Started api implementation in this phase
Fixed Issues with Modal too.


###PHASE 11

Get rid of othername table, seeder and model

## Add Birthday Column to the user table
Implement it on the frontend.
Let a user choose whether He or she is a student, an alumni or none.

## Get rid of the current Biodata model
1.Getting the  profile of a user depends on whether or not they're a member.
2.Non-members would have their details on the non-members-biodatas table and members would have their on the members_biodatas
3.Change the biodatas table name to "members_biodatas".
4.

Biodata Tables.
a. Members Biodata (Student Or Not)
This two classes of data would be store on the same members_biodatas table
1. A Student would have everything and the ns status would be set to zero
meaning He or she is not an N.S personnel.
2. A non-student would have the college and residence ids null and ns status 
set to 1 or 0 would tell whether or not they're ns personelles or not.
3. A non-student should be able to choose whether or not they're alumni. and there should be year_group_id column to
handle that

Members who are no longer with us could be determined by the is_available column
on the users table.

b. Non members (Alumni)

#Add is baptised coulumn to the user table and
implement it on the frontend for register page

##create a year group table
id
name

--Added a new Middleware, RoleMiddleware to tell if user can access a page or not--
<!-- Implement Delete and confirm delete for each attendance session -->


##PHASE 12
#ProgramOutline table
A program could have an outline but no Officiators lists
Or it could have both.

id
section_name
user_id
start_time
end_time
timestamps

---Stopping at Where the position of the program outlines must be refreshed after an update or delete.

###PHASE 13
## Set Up Admin DashBoard
-- InActive Accounts
-- UnAvailable Members
-- Complaints
-- User Requests 
## Create inactive accounts table.
id
user_id
reason ('suspended','fresher','new_account')
# Iplement an Activate User Account functionality with a model and also same for user availability

## Create Unavailable Member table
id
user_id
category (sick,travelled,'not_yet_in')
info

--------------------------------- 
## Set up the Specail or whatever logic.
-- Know Your CourseMate / Program Mates

#### PHASE 14 - TIE EVERYTHING UP TO THE ACADEMIC YEAR THROUGH THE SEMESTER ID.

## This will mainly affect tables like, the biodatas,semester_programs, attendance and others.
## A lot of refactoring to be done for this.

# Make a new biodata seeder, PastSudentBiodataSeeder to seed in previous years details for users who are students.
 --NB:Will be using UpdateOrInsert insert of InsertOrIgnore in most of these cases
 -- Implement Biodata edit and update for the various users

### Phase 15
# User request table to store create and edit request till they are aproved. For example, members biodata updates requests.
id
user_id
body
type(Biodata, Account)
is_draft (It would store incomplete create request as draft)
table_name
method (update,insert,delete)
is_granted
granted_by
granted_on (date) - to control the uniqueness of the tuples. By default, is null.
academic_year_id

Unique (user_id, type, method, 'table_name', 'granted_on', 'academic_year_id')
# Guest request table following the same format as the user table above.
# Display User request and Guest reqeust on Admin dashboard and be able to grant them.
# Modify guest Table
'status' (fresher,member,visitor,alumni)
# Fresher Register Page.
# Bind Attendance sessions to Semeste_programs
Attendance
...
'semester_program_id'
...

# Compare Old Data with New Data when granting user update request -- incomplete

## Phase 16
## Implement Polymorphic relationships for Images of Users, Zones, Residences and Semester Programs
## A carousel to display program on the main dashboard [Default picture for intsances without pictures] --
## Use meetingId on SemesterProgram table and model
##
# User composite unique columns on some tables to check double entry and use try and catch to throw     appropriate error message.
## Absentees page. See Absentees without reason and absentees with reason.

## Phase 17
# See what a guest is creating before granting or denying the request
## Door To Door Model (DTD)
-type ['evangelism','fishing_out','visitation']
-location_id
-is_zone
-created_by
timestamps
# Group [Zone,residence,Program,Course,door_to_door]
groupable type
name

...

# user_groups
user_id
group_id

# dtd_persons
dtd_id
group_id
residence_id
person_id
is_user
room
floor  
info - nullable()
timestamps


Edit,Delete,create - Groups

Edit,Delete,create - DTDs

Make User Admin of Groups functionality
# User contacts
Add Contact when Creating Profile and Get rid of 
College and Zone which are taken care of by the Program and residence respectively.
Get Number of Users without Profile.


# Make Contact update request when contact is edited during profile editing

### Phase 18
# Be able to see all request made by a particular user
# Sort request according to -- [ Users , Zone-users, ], [Insert, delete, update,],
# Setup ControlMiddleware
# Setup Accessories [ 'picture_per_user','System_online',etc ]
# work on Alumini and Non student member biodata create and update. Factor in the contacts.
# Update user [birthday, FirstName, Second Name, Username, etc...]
# BreadCrumbs X
# Control User's whose residences are not in the list of residences
user-residence table
id
name
description
# Control Students whose programs are not in the lists of programs.
user-programs table
id
name
college_id
span
status - ug or pg
# Dashboard Pics
Active or inactive to groups.
QR code Attendance.
Create and Edit Residence


Assign Permissions Directly
Denied Requests page(User and Guest).
Delete Residence




<!-- NOTIFICATIONS -->
# Nofitications table
id
type /Announcements, birthdays, 
start_date
end_date //Equal to start_date by default




### phase 19
# Use GeoLocation to permit marking attendance 
# Implement the User history using the Biodata details.
# A Two factor verification would be implement later on to cater for authrorization
# Requests to join Group
