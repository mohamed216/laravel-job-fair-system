# Recruitment Event System - SPEC.md

## Project Overview
- **Project Name**: Recruitment Event System (job-fair)
- **Type**: Laravel 12 Web Application
- **Core Functionality**: A job fair platform where multiple companies participate, candidates register and get QR codes, and companies scan QR codes to access candidate data
- **Target Users**: Admin, Companies, Applicants

---

## Core Features

### 1. Admin Module
- Manage event details (name, date, location, time slots)
- Add/edit/delete companies
- Assign time slots for applicant entry
- Dashboard with statistics
- Manage applicants

### 2. Company Module
- Login/register
- View assigned time slots
- Scan QR codes of applicants
- View applicant details
- Save/shortlist applicants
- Dashboard with visited applicants

### 3. Applicant Module
- Register for the event
- Select preferred time slot
- Generate unique QR code
- View application status

---

## Database Design

### Tables

#### events
- id, name, description, date, location, start_time, end_time, status

#### companies
- id, event_id, name, logo, description, contact_email, booth_number

#### time_slots
- id, event_id, start_time, end_time, capacity, available

#### applicants
- id, event_id, time_slot_id, name, email, phone, phone, education, experience, skills, qr_code, status

#### company_visits
- id, company_id, applicant_id, visited_at, notes

---

## Technology Stack
- Laravel 12
- MySQL
- Bootstrap 5
- QR Code generation (simple-qr or bacon/bacon-qr-code)
- Multi-language support (Arabic/English)
- RTL support

---

## Authentication
- Laravel Sanctum for API
- Session-based for web
- Roles: admin, company, applicant

---

## UI/UX
- Clean, professional design
- Arabic/English toggle
- Responsive
- Dashboard for each role
