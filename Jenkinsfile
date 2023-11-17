pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Checkout the code from your Git repository
                git(url: 'https://github.com/shahzad1999/3103-jenkins-test.git')
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
