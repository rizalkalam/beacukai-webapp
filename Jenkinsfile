pipeline {
    agent any
    stages {
        stage('Checkout') {
            steps {
                checkout scm
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

                    // Copy .env
                    sh '''
                    cp /home/rizalkalam/.jenkins/workspace/beacukai-webapp/.env.example /var/www/bcweb.nugasyuk.my.id/html/.env
                    '''

                    // Update konfigurasi database
                    sed -i 's/DB_HOST=.*/DB_HOST=127.0.0.1/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_PORT=.*/DB_PORT=3306/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_DATABASE=.*/DB_DATABASE=bc-webapp/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_USERNAME=.*/DB_USERNAME=root/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=rizalkalam178/' /var/www/bcweb.nugasyuk.my.id/html/.env
                    
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
