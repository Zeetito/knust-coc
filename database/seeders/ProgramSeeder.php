<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $programs = [
        //  COLLEGE OF AGRICULTURE AND NATURAL RESOURCES
                // FACULTY OF AGRICULTURE 1
                    // Department of Animal Science 1
                    ['name'=>'MPhil. Animal Breeding and Genetics', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Reproductive Physiology', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Animal Nutrition', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Meat Science', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Animal Breeding and Genetics', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Reproductive Physiology', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Animal Nutrition', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Meat Science', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Agricultural Extension and Development Communication', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Agribusiness Management', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Agricultural Extension and Development Communication', 'department_id'=>1, 'faculty_id'=>1,'college_id'=>1, 'type'=>'pg'],

                    // Department of Agricultural Economics, Agribusiness and Extension 2
                    ['name'=>'MSc. Agribusiness Management','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MSc. Agricultural Extension and Development Communication','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Agribusiness Management','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Agricultural Economics','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Agricultural Extension and Development Communication','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Agribusiness Management','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Agricultural Extension and Development Communication','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Agricultural economics','department_id'=>2,'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],

                    // Department of Crop and Soil Sciences 3
                    ['name'=>'MPhil. Agronomy', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Agronomy (Crop Physiology)', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Crop Protection (Entomology) ', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Crop Protection (Nematology) ', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Crop Protection (Plant Pathology) ', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Crop Protection (Plant Virology)', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Plant Breeding', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Soil Science', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Agronomy', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Crop Physiology', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Nematology', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Plant Breeding', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Plant Entomology', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Plant Pathology', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Plant Virology', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Soil Science', 'department_id'=>3, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],

                    // Department of Horticulture 4
                    ['name'=>'MPhil. Postharvest Technology', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Seed Science and Technology', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Fruit Crops Production ', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Vegetable Crops Production', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Landscape Studies', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Postharvest Technology', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Seed Science and Technology', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Fruit Crops Production', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Landscape Studies', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'PhD. Vegetable Crops Production', 'department_id'=>4, 'faculty_id'=>1, 'college_id'=>1, 'type'=>'pg'],
                
  
                // FACULTY OF RENEWABLE NATURAL RESOURCES  2
                    //  Department of Wildlife and Range Management  5
                     ['name'=>'MPhil. Wildlife and Range Management', 'department_id'=>5, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
                     ['name'=>'MSc. Geo-Information Science for Natural Resources Management', 'department_id'=>5, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
                     ['name'=>'PhD. Wildlife and Range Management', 'department_id'=>5, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],

                    //  Department of Silviculture and Forest Management 6          
                     ['name'=>'MPhil. Natural Resources and Environmental Governance', 'department_id'=>6, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
                     ['name'=>'MPhil. Silviculture and Forest Management', 'department_id'=>6, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
                     ['name'=>'PhD. Silviculture and Forest Management', 'department_id'=>6, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
               
                    //  Department of Agroforestry 7
                     ['name'=>'MPhil. Agroforestry',  'department_id'=>7, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
                     ['name'=>'PhD. Agroforestry',  'department_id'=>7, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
               
                    //  Department of Wood Science and Technology Management  8
                    ['name'=>'MPhil. Packaging Technology and Management', 'department_id'=>8, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
                    ['name'=>'MPhil. Wood Science and Technology', 'department_id'=>8, 'faculty_id'=>2, 'college_id'=>1, 'type'=>'pg'],
               
                    // Department of Fisheries and Watershed Management 9
                    ['name'=>'MPhil. Aquaculture and Environment', 'department_id'=>9, 'faculty_id'=>2, 'college_id'=>1,'type'=>'pg'],
                    ['name'=>'MPhil. Fisheries Management', 'department_id'=>9, 'faculty_id'=>2, 'college_id'=>1,'type'=>'pg'],
                    ['name'=>'MPhil. Watershed Management', 'department_id'=>9, 'faculty_id'=>2, 'college_id'=>1,'type'=>'pg'],
                    ['name'=>'PhD. Aquaculture and Environment ', 'department_id'=>9, 'faculty_id'=>2, 'college_id'=>1,'type'=>'pg'],
                    ['name'=>'PhD. Fisheries Management ', 'department_id'=>9, 'faculty_id'=>2, 'college_id'=>1,'type'=>'pg'],
                    ['name'=>'PhD. Watershed Management', 'department_id'=>9, 'faculty_id'=>2, 'college_id'=>1,'type'=>'pg'],
                          
        // COLLEGE OF ART AND BUILT ENVIRONMENT
            // FACULTY OF BUILT ENVIRONMENT 3
                    // Department Of Agriculture 10
                    ['name'=>'MSc. Architecture (Top-up) One Year', 'department_id'=>10, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MArch (Master of Architecture)', 'department_id'=>10, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil Architectural Studies – Two Years', 'department_id'=>10, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'PhD. Architecture', 'department_id'=>10, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],

                    // Department of Construction Technology and Management 11
                     ['name'=>'MSc. Construction Management ', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Construction Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Procurement Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Procurement Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Procurement Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Project Management (One Year) vii. MPhil. Project Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Project Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Building Technology', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Building Technology', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Construction Management', 'department_id'=>11, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],

                    //  Department of Planning 12
                     ['name'=>'MSc. Development Planning and Management (SPRING) (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Development Planning and Management (SPRING) (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Development Policy and Planning (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Development Policy and Planning (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Development Studies (Accra and Kumasi Centres – Weekend', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Development Studies (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Planning (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Planning (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Transportation Planning (Accra and Kumasi Centres - Weekend)', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Development Studies', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Planning', 'department_id'=>12, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],

                    //  Department of Land Economy 13
                     ['name'=>'MSc. Real Estate (One Year - Weekend)', 'department_id'=>13, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Land Governance and Policy (One Year)', 'department_id'=>13, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Facilities Management (One Year)', 'department_id'=>13, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Land Management and Governance', 'department_id'=>13, 'faculty_id'=>3, 'college_id'=>4, 'type'=>'pg'],
            
            //  FACULTY OF ART 4
                    // Department of Painting and Sculpture 14
                     ['name'=>'MFA. Painting', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MFA. Sculpture', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MFA. Painting and Sculpture', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. African Art and Culture', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Creative Art Therapy ', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Creative Art Therapy', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Painting', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Sculpture ', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Painting and Sculpture', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. African Art and Culture', 'department_id'=>14, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],

                    //  Department of Industrial Art 15
                     ['name'=>'MFA. Ceramics', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MFA. Jewellery and Metalsmithing', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MFA. Textiles Design', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Textile Design Technology', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Ceramic Technology', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Fashion Design Technology', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Ceramic Technology', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD Textile Design Technology', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD Fashion Design Technology', 'department_id'=>15, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],

                    //  Department of Indigenous Art and Technology 16
                    ['name'=>'MPhil. Integrated Art', 'department_id'=>16, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],

                    // Department of Publishing Studies 17
                     ['name'=>'Department of Publishing Studies', 'department_id'=>17, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Publishing Studies', 'department_id'=>17, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Publishing Studies (Top-Up', 'department_id'=>17, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],

                    //  Department of Communication Design 18
                     ['name'=>'MComm. Design', 'department_id'=>18, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Communication Design', 'department_id'=>18, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Visual Communication Design', 'department_id'=>18, 'faculty_id'=>4, 'college_id'=>4, 'type'=>'pg'],

            //  FACULTY OF EDUCATIONAL STUDIES 5
                    // Department of Educational Innovations in Science and Technology 19
                     ['name'=>'MA. Art Education (Regular/Weekend/Sandwich)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Art Education (Regular/Weekend)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Art Education (Top-Up)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'Master of Education (M.Ed.) - General Education (Regular/Sandwich)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MSc. Educational Innovation and Leadership Science (Regular/Sandwich)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'MPhil. Educational Innovation and Leadership Science (Regular/Weekend)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                     ['name'=>'PhD. Art Education (Regular/Weekend)', 'department_id'=>19, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],

                    //  Department of Teacher Education 20
                    ['name'=>'MPhil. Educational Planning and Administration (Regular/Weekend – 2 years)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Educational Planning and Administration Top-Up (Weekend - 1 year)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'EDD. Educational Planning and Administration (Regular)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Mathematics Education (Regular/Weekend - 2 years)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Mathematics Education Top-Up (Weekend - 1 year)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Language Education and Literacy', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Language Education and Literacy (Top-Up)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. ICT Education (Regular/Weekend – 2 years)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. ICT Education Top-Up (Weekend – 1 year)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Science Education (Regular/Weekend – 2 years)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MPhil. Science Education Top-Up (Weekend – 1 year)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'PhD. Science Education (Regular)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'PhD. ICT Education (Regular) ', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'PhD. Mathematics Education (Regular)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'PhD. Language and Literacy Education (Regular)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'PhD. Educational Planning and Administration (Regular)', 'department_id'=>20, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],

                    // SANDWICH PROGRAMMES (TO BE RUN ONLINE AND FACETO-FACE DURING GES VACATION) 21
                    ['name'=>'MEd. Higher Education Pedagogy (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'Post Graduate Diploma in Education (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'Post Graduate Diploma in Education (KNUST STUDENTS ONLY)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MEd. Educational Planning and Administration (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MEd. Mathematics Education (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MEd. ICT Education (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MEd. Science Education (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    ['name'=>'MEd. Language Education and Literacy (Online)', 'department_id'=>21, 'faculty_id'=>5, 'college_id'=>4, 'type'=>'pg'],
                    
    // COLLEGE OF ENGINEERING
            // FACULTY OF CIVIL AND GEO-ENGINEERING 6
                    // Department of Civil Engineering 22
                    ['name'=>'MSc. Geotechnical Engineering (Regular, Weekend) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Geotechnical Engineering (Full-Time)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Structural Engineering (Regular, Weekend)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Structural Engineering (Full-Time)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Geotechnical Engineering', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Structural Engineering', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Disaster Prevention and Management (Regular, Weekend) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Water Engineering (Regular, Weekend) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Water Resources Engineering and Management (Regular, Weekend) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Water Resources Engineering and Management (FullTime)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Water Supply Engineering and Management (Regular, Weekend)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Environmental Sanitation and Waste Management (Regular, Weekend) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Water Supply and Environmental Sanitation (Full-Time) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Water Supply and Environmental Sanitation (Full-Time)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Environmental Sanitation and Waste Management', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Water Resources Management', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Water Supply and Treatment Technology', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Transport Systems (Infrastructure and Engineering) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Transport Systems (Infrastructure and Engineering)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Transport Systems (Urban Transport and Operations) ', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Transport Systems (Urban Transport and Operations)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'Ph.D. Transport Systems (Infrastructure and Engineering)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'Ph.D. Transport Systems (Urban Transport and Operations)', 'department_id'=>22, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],

                    // Department of Geomatic Engineering 23
                    ['name'=>'MSc. Geomatic Engineering ', 'department_id'=>23, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Geomatic Engineering', 'department_id'=>23, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Geographic Information System', 'department_id'=>23, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Geomatic Engineering', 'department_id'=>23, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    
                    // Department of Petroleum Engineering  24
                    ['name'=>'MSc. Petroleum Engineering ', 'department_id'=>24, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Petroleum Engineering ', 'department_id'=>24, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MSc. Petroleum Geoscience ', 'department_id'=>24, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Petroleum Geoscience', 'department_id'=>24, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Petroleum Engineering', 'department_id'=>24, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],

                    // Department of Geological Engineering  25
                    ['name'=>'MSc. Geophysical Engineering', 'department_id'=>25, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Geological Engineering', 'department_id'=>25, 'faculty_id'=>6, 'college_id'=>3, 'type'=>'pg'],

            // FACULTY OF ELECTRICAL & COMPUTER ENGINEERING 7
                    // Department of Electrical and Electronic Engineering 26
                    ['name'=>'MPhil. Power Systems Engineering', 'department_id'=>26, 'faculty_id'=>7, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Electrical Engineering', 'department_id'=>26, 'faculty_id'=>7, 'college_id'=>3, 'type'=>'pg'],
                    
                    // Department of Computer Engineering 27
                    ['name'=>'MPhil. Computer Engineering', 'department_id'=>27, 'faculty_id'=>7, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Computer Engineering', 'department_id'=>27, 'faculty_id'=>7, 'college_id'=>3, 'type'=>'pg'],

                    // Department of Telecommunication Engineering 28
                    ['name'=>'MPhil. Telecommunication Engineering', 'department_id'=>28, 'faculty_id'=>7, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Telecommunication Engineering', 'department_id'=>28, 'faculty_id'=>7, 'college_id'=>3, 'type'=>'pg'],
                    
            // FACULTY OF MECHANICAL & CHEMICAL ENGINEERING 8
                    // Department of Chemical Engineering 29
                    ['name'=>'MPhil. Chemical Engineering', 'department_id'=>29, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Chemical Engineering', 'department_id'=>29, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],

                    // Department of Agricultural and Biosystems Engineering 30
                    ['name'=>'MPhil. Agricultural Machinery Engineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Agro-Environmental Engineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Bioengineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Food and Post-Harvest Engineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Soil and Water Engineering', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Intellectual Property (MIP)', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD Agricultural Machinery Engineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD Agro-Environmental Engineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD Bioengineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD Food and Post-Harvest Engineering ', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD Soil and Water Engineering', 'department_id'=>30, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    
                    // Department of Mechanical Engineering 31
                    ['name'=>'MPhil. Mechanical Eng. (Thermo-Fluids and Energy Systems) TopUp ', 'department_id'=>31, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Mechanical Eng. (Applied Mechanics) Top-Up ', 'department_id'=>31, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Mechanical Eng. (Design and Manufacturing) Top-Up', 'department_id'=>31, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Mechanical Engineering ', 'department_id'=>31, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Sustainable Energy Technologies', 'department_id'=>31, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],

                    // Department of Materials Engineering 32
                    ['name'=>'MPhil. Environmental Resources Management', 'department_id'=>32, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'MPhil. Materials Engineering', 'department_id'=>32, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    ['name'=>'PhD. Materials Engineering', 'department_id'=>32, 'faculty_id'=>8, 'college_id'=>3, 'type'=>'pg'],
                    
    // COLLEGE OF HEALTH SCIENCES
            // FACULTY OF PHARMACY AND PHARMACEUTICAL SCIENCES 9
                    // Department of Pharmaceutics 33
                    ['name'=>'MSc. Pharmaceutical Technology', 'department_id'=>33, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Pharmaceutics', 'department_id'=>33, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Pharmaceutical Microbiology', 'department_id'=>33, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Pharmaceutics', 'department_id'=>33, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Pharmaceutical Microbiology', 'department_id'=>33, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Pharmacognosy 34
                    ['name'=>'MPhil. Pharmacognosy', 'department_id'=>34, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Pharmacognosy', 'department_id'=>34, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Pharmaceutical Chemistry 35
                    ['name'=>'MPhil. Pharmaceutical Chemistry', 'department_id'=>35, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Pharmaceutical Chemistry', 'department_id'=>35, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Pharmacy Practice 36
                    ['name'=>'MSc. Clinical Pharmacy (Part-Time)', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Clinical Pharmacy (Full-Time)', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Clinical Pharmacy', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Social Pharmacy', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'Department of Pharmacology ', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil Pharmacology', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil Clinical Pharmacology', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD Pharmacology', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD Clinical Pharmacology', 'department_id'=>36, 'faculty_id'=>9, 'college_id'=>6, 'type'=>'pg'],

            // FACULTY OF ALLIED HEALTH SCIENCES 10
                    // Department of Nursing 37                    
                    ['name'=>'MSc. Clinical Nursing ', 'department_id'=>37, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Nursing', 'department_id'=>37, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],
                    
                    // Department of Physiotherapy and Sports Science 38
                    ['name'=>'MPhil. Clinical Rehabilitation and Exercise Therapy', 'department_id'=>38, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Medical Diagnostics 39
                    ['name'=>'MPhil. Haematology', 'department_id'=>39, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Medical Imaging', 'department_id'=>39, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Haematology', 'department_id'=>39, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Medical Imaging', 'department_id'=>39, 'faculty_id'=>10, 'college_id'=>6, 'type'=>'pg'],

            // SCHOOL OF MEDICINE AND DENTISTRY 11
                    // Department of Molecular Medicine 40
                    ['name'=>'MPhil. Chemical Pathology ', 'department_id'=>40, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Molecular Medicine ', 'department_id'=>40, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Immunology', 'department_id'=>40, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Chemical Pathology ', 'department_id'=>40, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Molecular Medicine ', 'department_id'=>40, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Immunology', 'department_id'=>40, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Clinical Microbiology 41
                    ['name'=>'MPhil. Clinical Microbiology', 'department_id'=>41, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Clinical Microbiology', 'department_id'=>41, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                                    
                    // Department of Anatomy 42
                    ['name'=>'MPhil. Human Anatomy and Cell Biology ', 'department_id'=>42, 'faculty_id'=>11, 'college_id'=> 6, 'type'=>'pg'],
                    ['name'=>'MPhil. Human Anatomy and Cell Biology (Morphological Diagnostics) ', 'department_id'=>42, 'faculty_id'=>11, 'college_id'=> 6, 'type'=>'pg'],
                    ['name'=>'MPhil. Human Anatomy and Forensic Science', 'department_id'=>42, 'faculty_id'=>11, 'college_id'=> 6, 'type'=>'pg'],
                    ['name'=>'MPhil. Mortuary Science and Management', 'department_id'=>42, 'faculty_id'=>11, 'college_id'=> 6, 'type'=>'pg'],
                    ['name'=>'PhD. Human Anatomy and Cell Biology ', 'department_id'=>42, 'faculty_id'=>11, 'college_id'=> 6, 'type'=>'pg'],
                    ['name'=>'PhD. Human Anatomy and Forensic Science', 'department_id'=>42, 'faculty_id'=>11, 'college_id'=> 6, 'type'=>'pg'],

                    // Department of Physiology 43
                    ['name'=>'MPhil. Physiology', 'department_id'=>43, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MSc. Speech and Language Therapy', 'department_id'=>43, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Comparative Anatomy', 'department_id'=>43, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],

                    // SCHOOL OF VETERINARY MEDICINE  44
                    ['name'=>'Master of Veterinary Science in Anatomy', 'department_id'=>44, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Integrative Pathobiology', 'department_id'=>44, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. One Health', 'department_id'=>44, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'PhD. Veterinary Anatomy', 'department_id'=>44, 'faculty_id'=>11, 'college_id'=>6, 'type'=>'pg'],
                                    
            // SCHOOL OF PUBLIC HEALTH   12
                    // Department Unknown
                    ['name'=>'PhD. Public health', 'faculty_id'=>12, 'college_id'=>6, 'type'=> 'pg'],

                    // Department of Health Education, Promotion and Disability Studies  45
                    ['name'=>'MPH/MSc. Health Education and Promotion (Regular/Weekend)', 'department_id'=>45, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Disability, Rehabilitation and Development (Full Time/ Weekend)', 'department_id'=>45, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    
                    // Department of Population, Family and Reproductive Health 46
                    ['name'=>'MSc. Population and Reproductive Health (One Year - Full Time/ Weekend) ', 'department_id'=>46, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPH. Population and Reproductive Health (One Year - Full Time/ Weekend)', 'department_id'=>46, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Occupational and Environmental Health and Safety 47
                    ['name'=>'MSc. Occupational and Environmental Health & Safety (One Year - Full Time/ Weekend) ', 'department_id'=>47, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPH. Occupational and Environmental Health & Safety (One Year - Full Time/ Weekend)', 'department_id'=>47, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],

                    // Department of Health Policy, Management and Economics 48
                    ['name'=>'MSc. Health Services Planning and Management (One Year – Regular/Weekend) ', 'department_id'=>48, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPH. Health Services Planning and Management (One Year – Regular/Weekend) ', 'department_id'=>48, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MSc. Health Systems Research and Management (Regular) iv. MPH. Health Systems Research and Management (Weekend) ', 'department_id'=>48, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    ['name'=>'MPhil. Health Systems Research and Management (Regular/ Weekend', 'department_id'=>48, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    
                    // Department of Epidemiology and Biostatistics 49
                    ['name'=>'MPhil. Field Epidemiology and Applied Biostatistics', 'department_id'=>49, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],
                    
                    // Department of Global and International Health 50
                    ['name'=>'MPH. Global Health (One Year)', 'department_id'=>50, 'faculty_id'=>12, 'college_id'=>6, 'type'=>'pg'],

        // COLLEGE OF HUMANITIES AND SOCIAL SCIENCES 
            // FACULTY OF LAW  13
                    // No Known department
                    ['name'=>'Master of Laws (LLM)', 'faculty_id'=>13, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD Law', 'faculty_id'=>13, 'college_id'=>2, 'type'=>'pg'],

            // FACULTY OF SOCIAL SCIENCES 14
                    // Department of Economics 51
                    ['name'=>'MSc. Economics (One Year) ', 'department_id'=>51, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>' MSc. Economics and Finance (One Year) ', 'department_id'=>51, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'. MSc. Business Economics (One Year)', 'department_id'=>51, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>' MPhil. Economics', 'department_id'=>51, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. Economics', 'department_id'=>51, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],

                    // Department of Language and Communication Sciences 52
                    ['name'=>'MPhil. French', 'department_id'=>52, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. French', 'department_id'=>52, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    
                    // Department of Geography and Rural Development 53
                    ['name'=>'MSc. Geography and Sustainable Development (One Year)', 'department_id'=>53, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'], 
                    ['name'=>'MPhil. Geography and Rural Development', 'department_id'=>53, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'], 
                    ['name'=>'PhD. Geography and Rural Development', 'department_id'=>53, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'], 
                    
                    // Department of Religious Studies 54
                    ['name'=>'MA. Religious Studies (One Year)', 'department_id'=>54, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Religious Studies', 'department_id'=>54, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. Religious Studies', 'department_id'=>54, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    
                    // Department of Sociology and Social Work 55
                    ['name'=>'MA. Sociology', 'department_id'=>55, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Sociology', 'department_id'=>55, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MA. Social Work (One Year)', 'department_id'=>55, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Social Work', 'department_id'=>55, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. Sociology', 'department_id'=>55, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],

                    // Department of History and Political Studies 56
                    ['name'=>'MA. Chieftaincy and Traditional Leadership (One Year)', 'department_id'=>56, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'Master of Public Administration (Full Time/Weekend)', 'department_id'=>56, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MA. Asante History (One Year)', 'department_id'=>56, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Historical Studies', 'department_id'=>56, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Political Science', 'department_id'=>56, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. Historical Studies', 'department_id'=>56, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],

                    // KNUST SCHOOL OF BUSINESS (KSB) 57
                    ['name'=>'Master of Business Administration (MBA) - Regular/Evening/ Weekend', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'Master of Science Programmes (Weekends Only)', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. Organisational Leadership ', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'PhD. Business and Management', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Management and Human Resource Strategy ', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Logistics and Supply Chain Management (Weekend Only) ', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Procurement and Supply Chain Management (Weekend Only)', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                     ['name'=>'MPhil. Accounting', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],
                    ['name'=>'MPhil. Finance', 'department_id'=>57, 'faculty_id'=>14, 'college_id'=>2, 'type'=>'pg'],

        // COLLEGE OF SCIENCE
            // FACULTY OF BIOSCIENCES  15
                    // Department of Biochemistry and Biotechnology 58
                    ['name' => 'MSc. Biotechnology ', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MPhil. Biotechnology', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MPhil. Biochemistry', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MSc. Biodata Analytics and Computational Genomics ', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MPhil. Biodata Analytics and Computational Genomics', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MSc. Forensic Science ', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MPhil. Forensic Science', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'MPhil. Human Nutrition and Dietetics', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'PhD. Biotechnology ', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'PhD. Biochemistry', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'PhD. Human Nutrition and Dietetics', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name' => 'PhD. Biodata Analytics and Computational Genomics ', 'department_id'=>58, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    
                    // Department of Food Science and Technology 59
                    ['name'=>'MSc. Food Quality Management', 'department_id'=>59, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Food Science and Technology', 'department_id'=>59, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Food Science and Technology', 'department_id'=>59, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD Food Science and Technology', 'department_id'=>59, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    
                    // Department of Environmental Science 60
                    ['name'=>'MPhil. Environmental Science', 'department_id'=>60, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Environmental Science (Top-Up)', 'department_id'=>60, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Environmental Science', 'department_id'=>60, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],

                    // Department of Theoretical and Applied Biology 61
                    ['name'=>'MPhil. Parasitology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Ecology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Entomology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Plant Physiology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Microbiology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Plant Pathology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Reproductive Biology', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Parasitology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Ecology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Entomology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Animal Physiology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Limnology and Fisheries ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Plant Physiology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Microbiology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Plant Pathology ', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Reproductive Biology', 'department_id'=>61, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],

                    // Department of Optometry and Visual Science  62
                    ['name'=>'MPhil Vision Science', 'department_id'=>62, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD Vision Science', 'department_id'=>62, 'faculty_id'=>15, 'college_id'=>5, 'type'=>'pg'],

            // FACULTY OF PHYSICAL & COMPUTATIONAL SCIENCES 16
                    // Department of Chemistry 63
                    ['name'=>'MPhil. Chemistry ', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Organic and Natural Products ', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Analytical Chemistry ', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Environmental Chemistry ', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Physical Chemistry', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Polymer Science and Technology', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Chemistry', 'department_id'=>63, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],

                    // Department of Physics 64
                    ['name'=>'MPhil. Geophysics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Environmental Physics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Solid State Physics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Materials Science', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Nuclear Science and Technology', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Mathematical and Computational Physics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Geophysics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Environmental Physics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Solid State Physics ', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Materials Science', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Materials Science', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Nuclear Science and Technology', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Mathematical and Computational Physics', 'department_id'=>64, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    
                    // Department of Meteorology and Climate Science 65
                    ['name'=>'MPhil. Meteorology and Climate Science ', 'department_id'=>65, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Meteorology and Climate Science', 'department_id'=>65, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],

                    // Department of Mathematics 66
                    ['name'=>'MPhil. Pure Mathematics ', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Applied Mathematics', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Scientific Computing and Industrial Modeling', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Scientific Computing and Industrial Modeling', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Pure Mathematics ', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Applied Mathematics', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Pure Mathematics ', 'department_id'=>66, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],

                    // Department of Statistics and Actuarial Science 67
                    ['name'=>'MPhil. Actuarial Science', 'department_id'=>67, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Mathematical Statistics', 'department_id'=>67, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD Actuarial Science ', 'department_id'=>67, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD Mathematical Statistics', 'department_id'=>67, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    
                    // Department of Computer Science 68
                    ['name'=>'MSc. Computer Science ', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Computer Science', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Cyber Security and Digital Forensics ', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Cyber Security and Digital Forensics', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Information Technology ', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Information Technology', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Computer Science ', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'PhD. Information Technology', 'department_id'=>68, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    
                    // INSTITUTE OF DISTANCE LEARNING 69
                    ['name'=>'MSc. Health Informatics ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Information Technology ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Human Nutrition ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Food Quality Management', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Biotechnology ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Forensic Science ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'Commonwealth Master of Business Administration (CMBA)', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MBA International Business ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Planning, Monitoring and Evaluation ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Industrial Finance and Investment ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Business Consulting and Enterprise Risk Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Educational Innovations and Leadership Science ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'Master of Education (M.Ed)', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Project Management (available at the Accra and Takoradi Centres only) ,', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Development Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'Master of Public Administration (MPA) ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Security and Justice Administration ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Energy and Sustainable Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Hospitality and Tourism Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Strategic Management and Leadership ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Corporate Governance and Strategic Leadership ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Insurance and Business Continuity ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Development Finance ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Management and Human Resource Strategy ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Marketing ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Economics (available at the Accra Centre only) ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Post-Harvest Technology (Horticulture) ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Logistics and Supply Chain Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Procurement and Supply Chain Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Geography and Sustainable Development ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Accounting and Finance ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Actuarial Science ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Applied Statistics ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Environmental Science ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Agribusiness Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Mechanical Engineering ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Cyber Security and Digital Forensics ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Environmental Resources Management ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Communication System and Network Engineering ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'Professional Master of Engineering with Management (MEng) Programmes ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MPhil. Crop Science ', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc. Agricultural Extension and Development Communication', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    ['name'=>'MSc Physics', 'department_id'=>69, 'faculty_id'=>16, 'college_id'=>5, 'type'=>'pg'],
                    
                              

        ];
        // Program::factory(150)->create();

        foreach ($programs as $program){
            Program::create($program);
        }
    }
}
