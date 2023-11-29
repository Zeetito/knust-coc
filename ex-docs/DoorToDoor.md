### DOOR TO DOOR LOGIC.
## DoorToDoor Model DTD.
This Model refers to a door to door instance with a type of one of either evangelism, fishing out or Visitation.

A Door To Door instance could be directed for a Zone or Residence.
## How It realtes to
# Fishing Out
1. Only User with permission to start a fishing out instance could do so.
2. These users could invite others to join.
3. IF the target of this fishing out is a zone, then
they'd now have to go into the various hostels.
4. If the target is a residence, no need for that.
5. For fishing out, person_id or is_user is not needed.
6. We need the rooms, residence_id and the success status for every instance and info, if necessary.
The succes status, 
1-means the room has been attended to but no one was met [reserved for later].
2- means The room has been atteded to it wasn't successful. which may not happend especially for fishing out.
3- means Room has been attended to, no issues left behind.

# Evangelism (Personal or General plan).
1. Evangelism is mostly directed to a zone or two.
2. If the zones are two, two different door to door instance would be created, each for 
a zone.
3. The pairings which may be taken care of by the admin or Evangelism ministry.
4. The info of the group : If it's a general one controlled by the Evangelism ministry, would be The Residence and Rooms to be Visited. If it's a personal something, the individual can choose whichever name they want.
5. The Details of the prospects may be collected and stored as Guests.
6. Success : 
    1-Met no one
    2- met someone but wasn't successful
    3- Met someone, was successful
7. Info : Topic of discussion, the person's reaction.. etc.

# Visitation (Personal or General Plan)
1. Visitation if general, would be started by the Hall reps.
The Away zonal rep would start with his zone memebers.
2. 

