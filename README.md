## Installation

```bash
# Configurer lexik jwt
php bin/console lexik:jwt:generate-keypair

# Pour Hasher un password
php bin/console security:hash-password

# En local, pour éviter le problème de CORS, ajouter un host personnalisé et lancer un serveur avec ce host
127.0.0.1 portfolio-backend