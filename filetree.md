# File Tree: project_todo_list_bnsp

**Generated:** 4/18/2026, 6:32:51 AM
**Root Path:** `d:\project\project_todo_list_bnsp`

```
├── 📁 app
│   ├── 📁 Http
│   │   └── 📁 Controllers
│   │       ├── 🐘 AuthController.php
│   │       ├── 🐘 CategoryController.php
│   │       ├── 🐘 Controller.php
│   │       ├── 🐘 SubTaskController.php
│   │       └── 🐘 TaskController.php
│   ├── 📁 Models
│   │   ├── 🐘 Category.php
│   │   ├── 🐘 SubTask.php
│   │   ├── 🐘 Task.php
│   │   └── 🐘 User.php
│   └── 📁 Providers
│       └── 🐘 AppServiceProvider.php
├── 📁 bootstrap
│   ├── 🐘 app.php
│   └── 🐘 providers.php
├── 📁 config
│   ├── 🐘 app.php
│   ├── 🐘 auth.php
│   ├── 🐘 cache.php
│   ├── 🐘 database.php
│   ├── 🐘 filesystems.php
│   ├── 🐘 logging.php
│   ├── 🐘 mail.php
│   ├── 🐘 queue.php
│   ├── 🐘 services.php
│   └── 🐘 session.php
├── 📁 database
│   ├── 📁 factories
│   │   └── 🐘 UserFactory.php
│   ├── 📁 migrations
│   │   ├── 🐘 0001_01_01_000000_create_users_table.php
│   │   ├── 🐘 0001_01_01_000001_create_cache_table.php
│   │   ├── 🐘 0001_01_01_000002_create_jobs_table.php
│   │   ├── 🐘 2024_01_01_000001_create_categories_table.php
│   │   ├── 🐘 2024_01_01_000002_create_tasks_table.php
│   │   └── 🐘 2024_01_01_000003_create_sub_tasks_table.php
│   ├── 📁 seeders
│   │   ├── 🐘 CategorySeeder.php
│   │   └── 🐘 DatabaseSeeder.php
│   ├── ⚙️ .gitignore
│   └── 📄 database.sqlite
├── 📁 public
│   ├── ⚙️ .htaccess
│   ├── 📄 favicon.ico
│   ├── 🐘 index.php
│   └── 📄 robots.txt
├── 📁 resources
│   ├── 📁 css
│   │   └── 🎨 app.css
│   ├── 📁 js
│   │   └── 📄 app.js
│   └── 📁 views
│       ├── 📁 auth
│       │   ├── 🐘 login.blade.php
│       │   └── 🐘 register.blade.php
│       ├── 📁 calendar
│       │   └── 🐘 index.blade.php
│       ├── 📁 categories
│       │   └── 🐘 index.blade.php
│       ├── 📁 components
│       │   ├── 📁 layouts
│       │   │   └── 🐘 app.blade.php
│       │   ├── 🐘 bottom-bar.blade.php
│       │   ├── 🐘 header.blade.php
│       │   └── 🐘 modal.blade.php
│       ├── 📁 partials
│       │   └── 🐘 add-task.blade.php
│       ├── 📁 profile
│       │   └── 🐘 index.blade.php
│       ├── 📁 tasks
│       │   ├── 🐘 index.blade.php
│       │   └── 🐘 show.blade.php
│       └── 🐘 welcome.blade.php
├── 📁 routes
│   ├── 🐘 console.php
│   └── 🐘 web.php
├── 📁 storage
│   ├── 📁 app
│   │   ├── 📁 private
│   │   │   └── ⚙️ .gitignore
│   │   ├── 📁 public
│   │   │   └── ⚙️ .gitignore
│   │   └── ⚙️ .gitignore
│   ├── 📁 framework
│   │   ├── 📁 sessions
│   │   │   ├── ⚙️ .gitignore
│   │   │   └── 📄 gsNfGRQ0BUEST3NPhMqFPVXmdTLpLCH2jdcS8k53
│   │   ├── 📁 testing
│   │   │   └── ⚙️ .gitignore
│   │   ├── 📁 views
│   │   │   ├── ⚙️ .gitignore
│   │   │   ├── 🐘 017555f555ee6edbc0277c4b32c86e3d.php
│   │   │   ├── 🐘 0c61f2a0be9d332a0cb5e874a8f8a8fa.php
│   │   │   ├── 🐘 16de22b781406c1444042acf7087f32b.php
│   │   │   ├── 🐘 19bd66dafbdc489e944751c9f2a22ee9.php
│   │   │   ├── 🐘 1cf72c0ed2c9c9e9d80d1e50438ee29b.php
│   │   │   ├── 🐘 41fffe655aa8f341efa0b3ca664fa5f4.php
│   │   │   ├── 🐘 499e76f9cda6d378be84a7d020e3fdb3.php
│   │   │   ├── 🐘 51a1c2a1d5bc9c9acaf4bc7a4424e7b4.php
│   │   │   ├── 🐘 66e882000948760db6d3522fd8ef7969.php
│   │   │   ├── 🐘 9230ff6bbce6894e9ef5ac8448ec3897.php
│   │   │   ├── 🐘 a94425141790ed666207398362106e17.php
│   │   │   ├── 🐘 f7062754734dc33628bdfe4231d03637.php
│   │   │   └── 🐘 ff59a439b51bb13590429eea3d596fe2.php
│   │   └── ⚙️ .gitignore
│   └── 📁 logs
│       └── ⚙️ .gitignore
├── 📁 tests
│   ├── 📁 Feature
│   │   └── 🐘 ExampleTest.php
│   ├── 📁 Unit
│   │   └── 🐘 ExampleTest.php
│   └── 🐘 TestCase.php
├── ⚙️ .editorconfig
├── ⚙️ .env.example
├── ⚙️ .gitattributes
├── ⚙️ .gitignore
├── ⚙️ .npmrc
├── 📝 README.md
├── 📄 artisan
├── ⚙️ composer.json
├── ⚙️ package-lock.json
├── ⚙️ package.json
├── ⚙️ phpunit.xml
└── 📄 vite.config.js
```
