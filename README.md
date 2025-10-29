# 🗳️ Anonymous Voting System – Symfony

## 🧩 Description

A web application designed to organize **anonymous voting sessions** (e.g., internal elections, polls, or decision votes).
Each user can participate in an election without their choice being identifiable, while preventing multiple votes per user.
Vote processing is handled **asynchronously** via **RabbitMQ**, ensuring performance and scalability.

---

## ⚙️ Tech Stack

### **Language & Framework**

* **PHP 8.2+**
* **Symfony 6/7**
* **Composer** – dependency management

### **Database**

* **MySQL 8** 

  > Chosen for its simplicity and seamless integration with Doctrine ORM.
  > Votes are stored in an anonymized form (token-based), with no link to the user’s identity.

### **Message Broker**

* **RabbitMQ**

  > Used to handle votes asynchronously via the **Symfony Messenger component**:

  * Dispatch a message when a user submits a vote
  * Process votes in the background (insert, validate, count)
  * Return a quick response to the user while ensuring reliable processing

### **Cache (optional)**

* **Redis** *(planned for future enhancement)* – for caching or real-time stats.

### **Other Tools**

* **Symfony Messenger** – async message handling with RabbitMQ
* **TailwindCSS** – for the frontend interface
* **RabbitMQ Management UI** – admin interface available at `http://localhost:15672`


## 🗄️ Database Schema (Simplified)

| Table            | Description                                                            |
| ---------------- | ---------------------------------------------------------------------- |
| **user**         | Basic user info (contains no voting data)                              |
| **vote** | A global session of votes (e.g. “Elections 2025”)                      |
| **election**     | A specific election within the session (e.g. “President”, “Treasurer”) |
| **candidate**       | The available choices or candidates                                    |
| **vote_user**    | Anonymous votes (token + option_id)                                    |
| **vote_check**   | Tracks whether a user has already voted in a given election            |

---

## 🚀 Key Features

* 🔒 **Anonymous voting** — no link between user and chosen candidate
* ✅ **Prevention of double voting**
* ⚡ **Asynchronous processing** with RabbitMQ
* 👤 **Admin panel** for managing sessions and elections
* 📊 **Dashboard** for visualizing results

---


## 🔧 Useful Commands

### Install dependencies:

```bash
composer install
```

### Run Symfony server:

```bash
symfony serve
```

### Consume RabbitMQ messages:

```bash
php bin/console messenger:consume async -vv
```

### Start RabbitMQ:

```bash
sudo systemctl start rabbitmq-server
```

---

## 🧑‍💻 Author

**Nofy Rnd**
Personal project demonstrating skills in:

* Symfony & Doctrine ORM
* RabbitMQ & asynchronous message processing
* Secure and anonymized web application design

---

## 🔮 Future Improvements

* Redis integration for caching and real-time vote stats
* REST API for mobile or external apps
* Multi-language support

---
