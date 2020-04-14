# valkyrie
Website monitoring system

It's based on PHP with using Firebase as Database.
Composer update is required + adding your firebase json file - I've originally decided to use Realtime Database for this project but changed my mind in the middle and swapped to Cloud Firestore.

Whole roadmap includes making slack notifications for the team - sms - basic mobile app using Flutter - authentication.


To use this repo follow these steps:

1. Download repo
2. Composer install (you need to have gRPC extension - https://cloud.google.com/php/grpc)
3. Switch 'projectId' inside Firestore.php with yours.
