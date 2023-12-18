### 
## Why Users table do not have details like residences and zones and programs.
A user may not know some of these details yet, and it shouldn't prevent the user from creating an account. Making those fileds nullable to leads to too many null values being accumulated which may lead to wastage of space.

### Users who are not students/NsPersonelles 
A new Biodata table (Others_Biodata) will contain the details of such users. 
Users like Preacher and his family, members who are now workers.
So Ns Personelles who become workers living around worshiping with us have their details transferred to this Others_Biodata table.
For Ns Personelles, their year will be set to 0.

##
1. Delete Icons not active yet.
2. searching of names applies to only one of firstname or lastname. It should apply to both combined as well.
3. Checking user goes in right. Unchecking goes in but reflects after refresh though using ajax




### WRAPPING THE PROFILES/BIODATAS AND OTHERS, AROUND THE ACADEMIC YEAR. Ref. Phase 14 -todo
## PURPOSE - To be able to pull the history of a user.

## HOW DOES IT AFFECT 

## A. Alumini Table.
# logic.
The Alumini's history wouldn't have to necessarily be bounded by the Academic year.
If an Alumini makes a change to their biodata during the Academic year,
A new instance for the user would be recorded.

# Problem.
If an alumini should make changes one too many times, it would mean there'd be a
useless number of biodatas for the same alumini which is not necessary.

# Solution.
A new instance of an alumini_biodatas would be created if 
a. User is alumini and not a member and has no alumini biodata.
b. The alumini's latest update of profile is at least over 4 months.
else, the existing instance would be updated.

This solution may apply to all the others.


## B. Student Members.
 A new instance of a members_biodatas(for Student) would be created if,
a. User is a member,Student and has no members_biodatas record.
b. If the latest update of a student member biodata is at least 2 months from the current time.

## C.Non-Student Members
A new instance of members_biodatas (For Non-Members) would be created if,
a. A user is a member and not a student but has no members_biodatas record.
b. if the latest update of a non-student member is at least 2 months from the current time.



## D. ATTENDANCE
To Be able to see Attendance sessions for a particular sem (that's been taken care of already though)

## E. USER-ROLES
To know the 