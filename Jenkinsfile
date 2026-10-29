pipeline {
    agent any

    options {
        timestamps()
        disableConcurrentBuilds()
    }

    environment {
        IMAGE_NAME = 'act_hw2_iqa_system'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Validate Dockerfile') {
            steps {
                sh 'test -f Dockerfile'
                sh 'test -f docker-compose.yml'
                sh 'test -f database/init.sql'
                echo 'Required project files are present.'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t ${IMAGE_NAME}:${BUILD_NUMBER} .'
            }
        }
    }

    post {
        success {
            echo 'CI pipeline completed successfully.'
        }
        failure {
            echo 'CI pipeline failed. Review the stage logs.'
        }
    }
}
