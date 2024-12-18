# 📋 **PHP CRUD Application**

This project is a **simple yet robust PHP CRUD application** designed to manage entities such as **Subjects**, **Subtopics**, **Standards**, and **Resource Types**. It also features a file upload system with built-in validation, Google reCAPTCHA v2 integration, and an admin panel for content management.

---

## 🚀 **Features**

1. **CRUD Functionality**:
    - Fully functional Create, Read, Update, Delete operations for managing data entities.

2. **File and URL Upload**:
    - Upload either a **file** or a **Google Docs URL**.
    - Includes MIME type verification, file size validation (3MB limit), and support for multiple formats: `.pdf`, `.docx`, `.ppt`, `.pptx`.

3. **Dynamic Content Management**:
    - Dropdowns for **Subjects**, **Subtopics**, **Standards**, and **Resource Types** are dynamically populated from the database.

4. **Character Counters**:
    - Real-time counters ensure the **title** (min. 20 characters) and **description** (min. 100 characters) meet content guidelines.

5. **Admin Panel**:
    - Secure panel to manage uploads, edit records, and delete content.

6. **Google reCAPTCHA v2**:
    - Prevents spam submissions with a simple CAPTCHA mechanism.

7. **Environment Configuration**:
    - Secure and flexible `.env` file for managing credentials and secrets.

---
Вот обновленный раздел установки с уточнением про **`.env.example`**.

---

## 🛠️ **Installation**

### **Option 1: Deployment with Docker**

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/justyork/doc-keeper.git
   cd doc-keeper
   ```

2. **Set Up Environment Variables**:  
   Copy the example file `.env.example` and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```

3. **Start Docker Containers**:
   Ensure Docker and Docker Compose are installed, then run:
   ```bash
   docker-compose up -d
   ```

4. **Initialize the Database**:  
   Import the database schema provided in `init.sql`:
   ```bash
   docker exec -i <db_container_name> mysql -u user -ppassword project < init.sql
   ```

5. **Access the Application**:
   Open your browser and navigate to:
   ```
   http://localhost:8080
   ```

---

### **Option 2: Manual Deployment (Without Docker)**

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/justyork/doc-keeper.git
   cd doc-keeper
   ```

2. **Set Up a Local Environment**:
    - Install **Apache** or **Nginx**.
    - Install **MySQL** or MariaDB.
    - Install **PHP 8.0+** with required extensions:
        - `mysqli`, `pdo_mysql`, `mbstring`, `json`.

3. **Set Up Environment Variables**:  
   Copy the `.env.example` file and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```

4. **Create a Database**:
    - Create a MySQL database named `project` and a dedicated user with appropriate privileges.

5. **Import Database Schema**:  
   Use the provided `init.sql` file to set up the database schema:
   ```bash
   mysql -u your_mysql_user -p project < init.sql
   ```

6. **Configure Web Server**:
    - Point your Apache or Nginx web server root to the `public` folder.
    - Enable `.htaccess` for proper routing (Apache).

7. **Access the Application**:
   Open your browser and navigate to:
   ```
   http://localhost
   ```

---

## 📂 **Project Structure**

The project is organized as follows:

```
/app
    ├── controllers/        # Business logic controllers
    ├── helpers/            # Utility classes (Auth, Validator, Dotenv, etc.)
    ├── models/             # Database models
    ├── routes/             # Route handlers
    └── views/              # Front-end templates
        ├── crud/           # CRUD templates
        └── partials/       # Header, Footer, and common components
/config
    ├── config.php          # Application settings
    └── database.php        # Database connection
/docker
    └── Dockerfile          # Docker configuration
/public
    ├── assets/             # Static files (CSS, JS)
    ├── uploads/            # Uploaded files
    ├── .htaccess           # Routing rules
    └── index.php           # Entry point
.env                        # Environment variables
docker-compose.yml          # Docker Compose configuration
init.sql                    # SQL for database initialization
README.md                   # Project documentation
```

---

## 🌐 **Usage**

### **Available Routes**

- **CRUD Routes**:
    - `/subjects` - Manage subjects.
    - `/subtopics` - Manage subtopics.
    - `/standards` - Manage standards.
    - `/resource-types` - Manage resource types.

- **Upload & File Management**:
    - `/upload` - Upload a file or Google Docs URL.
    - `/view` - View uploaded files.
    - `/download` - Download files.

- **Admin Panel**:
    - `/admin` - Manage and view all uploads (protected with a login).

- **Authentication**:
    - `/login` - Admin login.
    - `/logout` - Logout from the system.

---

## 📝 **Example Operations**

### **1. Create a Record**
1. Go to `/subjects/?action=create`.
2. Fill out the form and click **Save**.

### **2. Upload a File or URL**
1. Navigate to `/upload`.
2. Upload either a **file** (max size: 3MB) or enter a valid **Google Docs URL**.
    - Allowed file types: `.pdf`, `.docx`, `.doc`, `.pptx`, `.ppt`.

3. Ensure the form requirements are met:
    - **Title**: Min. 20 characters.
    - **Description**: Min. 100 characters.
4. Complete the reCAPTCHA and submit.

---

## 🔒 **Admin Access**

- Access the admin panel at `/admin`.
- Use the password defined in `ADMIN_PASSWORD` in your `.env` file.

---

## ✅ **Validation**

1. **MIME Type Check**: Ensures files are valid (e.g., PDFs, Docs).
2. **File Size**: Rejects files larger than 3MB.
3. **Content Rules**:
    - Titles must have at least **20 characters**.
    - Descriptions require **100 characters** minimum.
4. **reCAPTCHA Protection**: Prevents spam submissions.

---

## 📜 **License**

This project is open-source and licensed under the **MIT License**.

---

## 📧 **Contact**

For questions or support regarding this project, please contact:

**Email**: [yorkshp@gmail.com]  
**Website**: [file-keeper.justyork.dev]

---

This README ensures a clear understanding of the project's purpose, usage, and structure for the client. Let me know if you need further tweaks! 🚀