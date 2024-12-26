pipeline {
    agent any
    environment {
        DB_HOST = '127.0.0.1'
        DB_PORT = '3306'
        DB_DATABASE = 'bc-webapp'
        DB_USERNAME = 'root'
        DB_PASSWORD = 'rizalkalam178'
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Validate Workspace') {
            steps {
                script {
                    def workspacePath = "/home/rizalkalam/.jenkins/workspace/bcwebapp"
                    def isWorkspaceExists = fileExists("${workspacePath}/.git")
                    if (!isWorkspaceExists) {
                        error "Workspace ${workspacePath} tidak ditemukan atau kosong!"
                    }
                }
            }
        }

        stage('Deploy Laravel') {
            steps {
                script {
                    // Salin file ke server tujuan
                    sh '''
                    sudo cp -r /home/rizalkalam/.jenkins/workspace/beacukai-webapp/* /var/www/bcweb.nugasyuk.my.id/html/
                    sudo chmod -R 755 /var/www/bcweb.nugasyuk.my.id/html/
                    sudo chown -R www-data:www-data /var/www/bcweb.nugasyuk.my.id/html/
                    '''

                    // Instalasi Composer
                    sh '''
                    cd /var/www/bcweb.nugasyuk.my.id/html/
                    composer install --no-dev --optimize-autoloader
                    '''

                    // Copy dan Update .env
                    sh '''
                    cp /home/rizalkalam/.jenkins/workspace/beacukai-webapp/.env.example /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_HOST=.*/DB_HOST=${DB_HOST}/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_PORT=.*/DB_PORT=${DB_PORT}/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    '''

                    // Artisan Commands
                    sh '''
                    cd /var/www/bcweb.nugasyuk.my.id/html/
                    php artisan key:generate
                    php artisan migrate --force
                    php artisan storage:link
                    '''
                }
            }
        }
    }
    post {
        success {
            echo 'Deployment Laravel berhasil!'
        }
        failure {
            echo 'Deployment Laravel gagal!'
        }
    }
}
