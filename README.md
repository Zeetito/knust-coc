### 
## Why Users do not have details like residences and zones and programs.
A user may not know some of these details yet, and it shouldn't prevent the user from creating an account. Making those fileds nullable to leads to too many null values being accumulated which may lead to wastage of space.

### Users who are not students/NsPersonelles 
A new Biodata table (Others_Biodata) will contain the details of such users. 
Users like Preacher and his family, members who are now workers.
So Ns Personelles who become workers living around worshiping with us have their details transferred to this Others_Biodata table.
For Ns Personelles, their year will be set to 0.