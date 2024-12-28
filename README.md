# <span style="color: #FF8C19;">Orange LMS - Detailed System Documentation </span>

## Project Overview
Orange LMS is a specialized platform designed for Orange Coding Academy students. The platform encompasses all Orange academies and provides comprehensive learning management capabilities.

## <span style="color: #FF8C19;">Home Page</span>
The website features a main page that displays:
- Technologies taught across all academies
- Academy images
- About Us section featuring the project creator and supporting trainers
- Contact Us information
- Call-to-action button ("Start Your Journey") leading to student login page

## <span style="color: #FF8C19;">Authentication System</span>

### Login System Implementation
The system utilizes Laravel Guards with five distinct user types:
- User (Admin)
- Manager
- Trainer
- Job Coach
- Trainee

### Login Access Methods
1. **Trainee Access**
   - Via main page button
   - Automatically sends usertype=trainee parameter

2. **Staff Access**
   - Route: /admin/login
   - Displays 4 buttons for user type selection:
     - Admin
     - Manager
     - Trainer
     - Job Coach

The usertype parameter determines:
- Which model class retrieves the data
- Appropriate dashboard redirect
- Navigation menu content based on default type
- Data display filtered by Auth::user->academy_id

## <span style="color: #FF8C19;">Admin Dashboard Capabilities</span>
### 1. Dashboard
- Displays all academies
- Shows notifications

### 2. Academies Management
- Add new academies
- Edit academy details (name, location)

### 3. Cohorts Management
- Add cohorts to academies
- Set start/end dates
- Control active status

### 4. Managers Management
- Add/edit/activate/deactivate managers
- Set email and password
- Optional profile image upload
- Managers can later update their profile

### 5. Trainers and Job Coach Management
- Add/edit/activate/deactivate
- Assign to academies
- Set credentials
- Optional profile image

### 6. Trainees Management
- Add/edit students
- Assign to academy and cohort
- Set email and password
- Optional fields for student completion:
  - Address
  - Phone
  - Gender
  - Birthday
  - Specialization
  - Image

### 7. Technologies Management
- Add/edit technologies
- Set name, description, image

### 8. Technology Assignments
- Select academy and cohort
- Checkbox selection for technologies
- Display assigned technologies table
- Set start/end dates for roadmap display

### 9. Technology Items
- Add items within technologies
- Select academy, cohort, technology
- Set name and description
- Upload video links
- Add files and links

### 10. Assignments
- Create new assignments
- Select academy, cohort, technology
- Set title, description, deadline

### 11. Assignment Submissions
- View student submissions
- Submission time tracking
- GitHub link access
- View submission details

### 12. Absence Rules
- Available to admin, manager, job coach
- Set allowed absences per academy/cohort

### 13. Absences Management
- Select student
- View absence count
- Set absence type (excused/unexcused/late)
- Record reason for excused absences
- View pending absences
- Job coach approval/rejection
- Export capabilities (print/copy/PDF/Excel)

### 14. Announcements
- Create announcements per cohort
- Set title and content
- Shows creator name
- Edit/delete/deactivate options

## <span style="color: #FF8C19;">Manager Access</span>
- Same permissions as admin but limited to assigned academy

## <span style="color: #FF8C19;">Trainer Access</span>
Limited access to:
- Dashboard
- Trainees
- Technologies
- Technology assignments
- Technology items
- Assignments
- Assignment submissions
- Absences
- Announcements

## <span style="color: #FF8C19;">Job Coach Access</span>
Limited to:
- Dashboard
- Absence rules
- Absences
- Announcements

## <span style="color: #FF8C19;">Trainee Dashboard</span>

### 1. Dashboard
- Training start date
- Absence records (excused/unexcused)
- Late minutes total
- Available technologies count
- Current/future announcements

### 2. My Cohort
- Cohort name
- Start/end dates
- Roadmap visualization:
  - <span style="color: green;">Green: Completed technology</span>
  - <span style="color: #FF8C19;">Orange: Current technology</span>
  - <span style="color: gray;">Gray: Future technology</span>
- Academy staff listing (managers/trainers/job coaches)

### 3. Technologies
- Display cohort technologies
- Color-coded status (<span style="color: green;">green</span>/<span style="color: #FF8C19;">orange</span>/<span style="color: gray;">gray</span>)
- Access to technology items

### 4. Assignments
- View cohort assignments
- Filter by technology/status
- Search functionality
- Submission system:
  - GitHub link submission
  - Optional comments
  - Deadline enforcement

### 5. Announcements
- View all announcements (current/past)

### 6. Simplon Online
- Prominent button
- Direct link to Simplon platform

### 7. Logout
- Secure session termination

## <span style="color: #FF8C19;">Technical Stack</span>
- Frontend: HTML, CSS, JavaScript
- Framework: Boosted Orange
- Backend: Laravel PHP
- Database: MySQL
- Additional: DataTables jQuery

## <span style="color: #FF8C19;">System Components</span>
1. Home page
2. Login page
3. Admin dashboard
4. Trainee dashboard
5. Loading section

## <span style="color: #FF8C19;">Database Schema</span>

### Core Tables
1. **Academies**
   - Primary management unit
   - Contains basic academy information
   - Links to all other entities

2. **Cohorts**
   - Groups within academies
   - Managed timeframes
   - Absence limits

3. **Technologies**
   - Course content structure
   - Linked to cohorts via techno_to_cohorts
   - Contains learning materials

4. **Users**
   - Base user information
   - Role-specific data
   - Authentication details

### <span style="color: #FF8C19;">Relationship Structure</span>

#### Academy Relationships
- One-to-Many with Cohorts
- One-to-Many with Managers
- One-to-Many with Trainers
- One-to-Many with Job Coaches
- One-to-Many with Trainees

#### Cohort Relationships
- Many-to-One with Academy
- One-to-Many with Trainees
- Many-to-Many with Technologies (via techno_to_cohorts)
- One-to-Many with Announcements

#### Technology Relationships
- Many-to-Many with Cohorts
- One-to-Many with Items
- One-to-Many with Assignments

#### User Relationships
- All user types (Admin, Manager, Trainer, Job Coach, Trainee) belong to an Academy
- Trainees belong to a Cohort
- Users can create/manage various content based on their role

### Key Features of Schema
- Comprehensive audit trails (created_at, updated_at)
- Soft delete support for relevant tables
- Role-based access control via type fields
- Flexible content management structure
- Robust relationship management
- Activity tracking and status management

## <span style="color: #FF8C19;">Security Features</span>
- Password hashing
- Remember tokens
- Email verification
- Personal access tokens
- Failed job tracking
- Session management


# <span style="color: #FF8C19;">How to start using the Orange LMS platform:</span>
1. clone the repository from github
2. run composer install to install all the dependencies
3. php artisan breeze:install to install the authentication system
4. run php artisan migrate to create all the tables in the database
5. run php artisan serve to start the server
6. open the browser and go to http://localhost:8000 to see the platform in action
7. you can login as a admin, manager, trainer, job coach or trainee to see the different features of the platform based on your role
8. you can display Admin, Manager, Trainer, Job Coach Login by this link http://localhost:8000/admin/login
### <span style="color: #FF8C19;">This documentation reflects the exact system structure and functionality as implemented in the Orange LMS platform.</span>

<span style="color: #FF8C19;">This system was designed and documented by the student Ahmad Alfararjeh.</span>



![Orange LMS](https://github.com/user-attachments/assets/14512821-fa45-4c8a-a403-9a5b16dfe872)

## Schema : https://dbdiagram.io/d/6739bd24e9daa85acab6cca3
## Figma link : https://www.figma.com/design/kiwPYN82UuZ2mATy3on8Iz/Orange-LMS?node-id=0-1&t=ftnCr5PThMEpONvM-1
