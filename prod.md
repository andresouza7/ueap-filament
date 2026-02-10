Definir dois workers para gerenciamento de jobs em produção
Um para jobs de alta prioridade e outro para newsletter

php artisan queue:work --queue=default,high
php artisan queue:work --queue=newsletter

php artisan queue:restart