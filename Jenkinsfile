pipeline { 
    agent any
    stages { 
        stage('Build') {
            steps {
                echo 'Building app!'
                sh 'docker compose -f docker-compose.yaml build'
            }
        }
    }	
    post {
        success {
            dependencyCheckPublisher pattern: 'dependency-check-report.xml'
		}
    }
}