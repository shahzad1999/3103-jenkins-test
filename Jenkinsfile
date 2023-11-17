pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Checkout the code from your Git repository
                checkout scm
            }
        }

        stage('OWASP Dependency-Check Vulnerabilities') {
            steps {
                dependencyCheck additionalArguments: ''' 
                            -o './'
                            -s './'
                            -f 'ALL' 
                            --prettyPrint''', odcInstallation: 'OWASP Dependency-Check Vulnerabilities'

                    dependencyCheckPublisher pattern: 'dependency-check-report.xml'
            }
        }
    }

    post {
        success {
			dependencyCheckPublisher pattern: 'dependency-check-report.xml'
		}
    }
}
