APP_NAME="Schokoladen Staging"
APP_ENV=staging
APP_KEY=
APP_DEBUG=true
APP_URL=https://www.schokoladen-mitte.de
ADMIN_PASSWORD=
REDIRECT_HTTPS=false

LOG_CHANNEL=stack
LOG_LEVEL=debug

#SESSION_DRIVER=memcached
#SESSION_STORE=memcached
#SESSION_DOMAIN=www.schokoladen-mitte.de

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=schokoladen
DB_USERNAME=
DB_PASSWORD=
DB_OLD_DATABASE=schokoladen_prod

BROADCAST_DRIVER=log
CACHE_DRIVER=memcached
CACHE_TTL=1
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=goldenacker.de
MAIL_PORT=25
MAIL_USERNAME=engels@goldenacker.de
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=engels@goldenacker.de
MAIL_FROM_NAME=engels@goldenacker.de

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY=
MIX_PUSHER_APP_CLUSTER=

EXCEPTION_TO_EMAIL_ADDRESS=engels@goldenacker.de
EXCEPTION_FROM_EMAIL_ADDRESS=engels@goldenacker.de
EXCEPTION_EMAIL_SUBJECT="Schoki Error Staging"

FORBIDDEN_ENABLED=false
ACTIVATION_ENABLED=false

MEDIA_DISK=public

# shop
CASHIER_MODEL=App\Models\Customer
STRIPE_KEY=
STRIPE_SECRET=
CASHIER_CURRENCY=eur
CASHIER_CURRENCY_LOCALE=de_DE
CASHIER_LOGGER=stack
STRIPE_WEBHOOK_SECRET=whsec_vCjBWtYYjlczZbY8zOU8pOPpLfbx1BBL

# paypal
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=
PAYPAL_SANDBOX_CLIENT_SECRET=
PAYPAL_LIVE_CLIENT_ID=
PAYPAL_LIVE_CLIENT_SECRET=
PAYPAL_PAYMENT_ACTION=
PAYPAL_CURRENCY=eur
PAYPAL_NOTIFY_URL=
PAYPAL_LOCALE=de_DE
PAYPAL_VALIDATE_SSL=true

MAILCHIMP_APIKEY=
MAILCHIMP_LIST_ID=8a5ae2b822
MAILCHIMP_LIST_NAME="Schokoladen"
MAILCHIMP_TEMPLATE_ID=138

ICAL_NAME="Schokoladen Events"
ICAL_DESCRIPTION="Schokoladen Berlin-Mitte Veranstaltungs-Plan https://www.schokoladen-mitte.de"
ICAL_LOCATION="Ackerstrasse 169, 10115 Berlin"
LOCATION_LAT=52.529745
LOCATION_LNG=13.397245

DEFAULT_EVENT_TIME=19:00

NOCAPTCHA_SITEKEY=
NOCAPTCHA_SECRET=
