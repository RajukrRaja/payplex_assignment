# 🌐 Payplex Pages – Laravel Page Management System

**Payplex Pages** is a Laravel-based content management module that enables admins to create, manage, and edit custom pages within a web application. Designed for flexibility and scalability, it provides an intuitive UI for CRUD operations, robust authentication, and a modular structure.

---

## 📚 Table of Contents

- [Features](#-features)
- [Technologies Used](#-technologies-used)
- [Installation](#-installation)
- [Usage](#-usage)
- [Routes](#-routes)
- [File Structure](#-file-structure)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## ✨ Features

- ✅ Admin authentication & role-based access  
- ✅ CRUD operations for pages  
- ✅ Clean Blade templating with Tailwind CSS  
- ✅ Modular MVC architecture  
- ✅ PostgreSQL compatible  
- ✅ RESTful route design  

---

## ⚙️ Technologies Used

| Stack        | Technology              |
|--------------|------------------------|
| **Backend**  | Laravel 10, PHP 8.1+    |
| **Frontend** | Blade, Tailwind CSS     |
| **Database** | PostgreSQL / MySQL      |
| **Tools**    | Composer, npm           |

---

## 📦 Installation

### Prerequisites

- PHP 8.1 or higher  
- Composer  
- Node.js & npm  
- PostgreSQL or MySQL  
- Git  

### Steps

```bash
# Clone the repository
git clone https://github.com/your-username/payplex-pages.git
cd payplex-pages

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install && npm run dev

# Copy environment variables
cp .env.example .env

# Configure .env (DB credentials, APP_KEY, etc.)
# Example for PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=payplex_pages
DB_USERNAME=postgres
DB_PASSWORD=secret

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Start development server
php artisan serve
Open http://localhost:8000 in your browser.

🚀 Usage
Homepage: Displays a welcome or default view.

Admin Panel: After logging in, admins can create, edit, and delete pages.

Pages Route: Publicly viewable pages by slug (e.g., /pages/about-us).

Dynamic Routing: Pages can be created without hardcoding routes.

🔁 Routes
Method	URI	Name	Description
GET	/	welcome	Homepage
GET	/login	login	Login form
POST	/login	-	Handle login
POST	/logout	logout	Logout
GET	/pages	pages.index	List all pages (admin only)
GET	/pages/create	pages.create	Show page creation form
POST	/pages	pages.store	Store new page
GET	/pages/{page}/edit	pages.edit	Edit page form
PUT	/pages/{page}	pages.update	Update page
DELETE	/pages/{page}	pages.destroy	Delete page
GET	/pages/{slug}	pages.show	View public page by slug

🔒 Routes under /pages (except {slug}) are protected by auth middleware.

🗂️ File Structure
pgsql
Copy
Edit
payplex-pages/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── Admin/
│   │   │   └── PageController.php
│   ├── Models/
│   │   ├── Page.php
│   │   └── User.php
│
├── resources/
│   ├── views/
│   │   ├── pages/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   └── welcome.blade.php
│
├── routes/
│   └── web.php
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── storage/              # Symlink for uploads
│
├── .env
├── composer.json
├── package.json
🤝 Contributing
We welcome contributions from developers of all experience levels.

Steps
Fork the repository.

Create a new branch:

bash
Copy
Edit
git checkout -b feature/your-feature-name
Make your changes and commit:

bash
Copy
Edit
git commit -m "Add your feature"
Push to your branch:

bash
Copy
Edit
git push origin feature/your-feature-name
Open a pull request.

✅ Follow PSR-12 PHP standards.
✅ Keep commits atomic and clear.
✅ Include a brief summary of the feature or fix in the PR.

📄 License
This project is licensed under the MIT License.

📬 Contact
📧 Email: raju@example.com

💼 LinkedIn: linkedin.com/in/rajukumarraja

🐙 GitHub: github.com/rajukrraja

© 2025 Payplex Technologies Pvt. Ltd. – All rights reserved.
