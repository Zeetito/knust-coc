
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