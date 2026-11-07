# IQA Office Management System

A web-based office management application developed using PHP, MariaDB, HTML, CSS, and JavaScript. This project demonstrates containerization and automated CI/CD deployment using Docker, Jenkins, GitHub, Amazon Elastic Container Registry (ECR), and Docker Swarm on AWS EC2.

## 1. Project Overview

The IQA Office Management System provides a simple web-based application for managing university office information.

### Features

- Dashboard for navigating the application
- Employee management
- Department management
- Display employee information and associated departments
- Store application data in MariaDB
- PHP database connectivity using PDO
- Containerized application and database
- Automated CI/CD deployment through Jenkins
- Docker Swarm deployment across AWS EC2 instances

## 2. Technology Stack

| Component | Technology |
|---|---|
| Frontend | HTML, CSS, JavaScript |
| Backend | PHP 8.5 |
| Web Server | Apache |
| Database | MariaDB 11.4 |
| Database Connectivity | PHP PDO |
| Containerization | Docker |
| Local Orchestration | Docker Compose |
| Container Orchestration | Docker Swarm |
| CI/CD | Jenkins |
| Version Control | Git and GitHub |
| Container Registry | Amazon ECR |
| Cloud Infrastructure | AWS EC2 |

## 3. Project Structure

```text
act_hw2/
├── database/
│   └── init.sql
├── includes/
│   └── db.php
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   ├── departments.php
│   ├── employees.php
│   └── index.php
├── .gitignore
├── Dockerfile
├── docker-compose.yml
├── docker-stack.yml
├── Jenkinsfile
└── README.md
```

## 4. Application Architecture

The application uses a container-based architecture with three main components:

1. Web Application: PHP and Apache serve the application.
2. Database: MariaDB stores employee and department information.
3. CI/CD Pipeline: Jenkins builds and publishes Docker images to Amazon ECR and deploys the application to Docker Swarm.

### AWS Deployment Architecture

- Jenkins EC2 instance: Executes the CI/CD pipeline.
- Docker Swarm Manager EC2 instance: Manages the Swarm cluster and hosts the database service.
- Docker Swarm Worker EC2 instance: Runs the web application service.
- Amazon ECR: Stores private Docker images.

The web and database services communicate through a Docker overlay network.

## 5. Local Deployment Using Docker Compose

### Prerequisites

- Docker Desktop
- Git
- Visual Studio Code (recommended)

### Clone the Repository

```bash
git clone https://github.com/keasokvibol/act_hw2.git
cd act_hw2
```

### Build and Start the Application

```bash
docker compose up -d --build
```

### Access the Application

- Dashboard: http://localhost:9002/
- Employees: http://localhost:9002/employees.php
- Departments: http://localhost:9002/departments.php

The local port mapping should match the current `docker-compose.yml` configuration.

## 6. Database Configuration

Database name:

`iqa_hw2_db`

Database engine:

`MariaDB 11.4`

The initialization script is located at:

`database/init.sql`

It initializes the database schema, including the `departments` and `employees` tables, and inserts sample department records.

The PHP application connects to MariaDB through PDO.

For the AWS deployment, database credentials are managed using Docker Swarm secrets rather than hard-coded passwords.

## 7. Amazon ECR Configuration

The project uses a private Amazon Elastic Container Registry repository.

| Configuration | Value |
|---|---|
| AWS Region | `us-east-1` |
| ECR Repository | `act_hw2_iqa_system` |
| ECR URI | `148676267942.dkr.ecr.us-east-1.amazonaws.com/act_hw2_iqa_system` |

The Jenkins pipeline builds the Docker image and pushes it to ECR using the Jenkins build number as an image tag, together with the `latest` tag.

Example image:

```text
148676267942.dkr.ecr.us-east-1.amazonaws.com/act_hw2_iqa_system:10
```

## 8. Jenkins CI/CD Pipeline

The CI/CD pipeline is defined in the `Jenkinsfile`.

### Pipeline Workflow

1. Declarative Checkout SCM
2. Checkout source code from GitHub
3. Validate project files
4. Build Docker image
5. Authenticate with Amazon ECR
6. Push Docker image to Amazon ECR
7. Deploy the application to Docker Swarm
8. Execute post-build actions

### Jenkins Job

`ACT-HW2-CI-CD`

The successful Jenkins Build #10 completed all eight pipeline stages, including Docker image publication to ECR and deployment to Docker Swarm.

## 9. Docker Swarm Deployment

The production deployment uses Docker Swarm with two EC2 instances.

| Node | Private IP | Role |
|---|---|---|
| Swarm Manager | `172.31.19.179` | Manager |
| Swarm Worker | `172.31.28.139` | Worker |

### Services

| Service | Function |
|---|---|
| `iqa_web` | PHP and Apache web application |
| `iqa_db` | MariaDB database |

The deployment configuration is maintained in:

`docker-stack.yml`

The stack name is:

`iqa`

### Useful Swarm Commands

Check cluster nodes:

```bash
sudo docker node ls
```

Check deployed services:

```bash
sudo docker service ls
```

Check service tasks:

```bash
sudo docker service ps iqa_web
sudo docker service ps iqa_db
```

Check application logs:

```bash
sudo docker service logs iqa_web
```

## 10. Application Access

The deployed application is accessible through the Swarm Manager's public IP:

**http://3.88.106.186:9002**

The application provides access to the dashboard, employee management, and department management pages.

Note: The public IP address may change if the EC2 instance is stopped and restarted. Access also depends on the EC2 security group configuration.

## 11. GitHub Repository and Branch Workflow

GitHub repository:

https://github.com/keasokvibol/act_hw2

The project uses Git for version control and GitHub for source code hosting.

The repository includes a feature branch and Pull Request to demonstrate the GitHub collaboration workflow.

Pull Request:

`Document GitHub feature branch workflow`

## 12. Useful Docker Commands

Check running local containers:

```bash
docker compose ps
```

View application logs:

```bash
docker compose logs
```

Stop local services:

```bash
docker compose down
```

The database uses persistent storage. Stopping the containers without removing their volumes normally preserves database records.

**Important:** Avoid using `docker compose down -v` unless you intentionally want to remove the database volume and its stored data.

## 13. Security Considerations

- Database credentials are managed through Docker secrets in the Swarm deployment.
- AWS credentials should not be committed to GitHub.
- Jenkins credentials are stored in Jenkins Credentials.
- MariaDB is not exposed directly to the public internet.
- EC2 security groups should allow only the required application and cluster traffic.

## 14. Project Status

The application has been deployed successfully to AWS using Docker Swarm.

Verified components include:

- GitHub source code repository
- Docker image stored in private Amazon ECR
- Jenkins CI/CD pipeline
- Docker Swarm Manager and Worker nodes
- Web application and MariaDB services
- Web-to-database connectivity
- Public application access
- Employee and department management pages

## 15. Author

**VIBOL**

Advanced Cloud Computing Technology  
Master of Information Technology

**Academic Year: 2026-2027**